<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AssistantModel;
use CodeIgniter\I18n\Time;
use PHPUnit\TextUI\XmlConfiguration\Validator;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];

            // Validate the input based on the rules
            if ($this->validate($rules)) {
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');

                $userModel = new UserModel();
                $user = $userModel->asObject()
                    ->where('username', $username)
                    ->orWhere('email', $username)
                    ->first();
                if (!$user) {
                    $assistantModel = new AssistantModel();
                    $user = $assistantModel->asObject()
                        ->where('username', $username)
                        ->orWhere('email', $username)
                        ->first();
                }

                // Check if user exists and verify the password
                if ($user && password_verify($password, $user->password)) {
                    session()->set([
                        'username' => $user->username,
                        'email' => $user->email,
                        'logged_in' => true,
                        'role' => $user->role
                    ]);

                    return redirect()->to('/dashboard');
                }

                // Flash error message for invalid credentials
                return redirect()->to(base_url('auth/login'))
                    ->withInput()
                    ->with('error', 'Invalid Username or Password!');
            }

            // Set flashdata for validation errors
            return redirect()->to(base_url('auth/login'))
                ->withInput()
                ->with('validation', $this->validator);
        }

        // If it's a GET request, display the login view
        return view('auth/login', [
            'validation' => session()->getFlashdata('validation') // Retrieve flashdata
        ]);
    }


    public function register()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => 'required|alpha_numeric|is_unique[users.username]',
                'email'    => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]',
                'cpassword' => 'required|matches[password]'
            ];

            if ($this->validate($rules)) {
                // Generate a confirmation code
                $confirmationCode = random_int(100000, 999999); // Generate a 6-digit code

                // Save the user data temporarily in session
                session()->set([
                    'temp_user_data' => [
                        'username' => $this->request->getPost('username'),
                        'email'    => $this->request->getPost('email'),
                        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                        'confirmation_code' => $confirmationCode,
                    ]
                ]);

                // Send the confirmation code via email
                if ($this->sendConfirmationEmail($this->request->getPost('email'), $confirmationCode)) {
                    return redirect()->to('auth/confirmAccount')
                        ->with('message', 'A confirmation code has been sent to your email.');
                } else {
                    return redirect()->to('auth/register')
                        ->withInput()
                        ->with('error', 'Failed to send the confirmation email.');
                }
            }

            // Set flashdata for validation errors
            return redirect()->to(base_url('auth/register'))
                ->withInput()
                ->with('validation', $this->validator);
        }

        // If it's a GET request, just display the registration view
        return view('auth/register', [
            'validation' => session()->getFlashdata('validation'),
        ]);
    }

    protected function sendConfirmationEmail($email, $confirmationCode)
    {
        $emailService = \Config\Services::email();

        $emailService->setTo($email);
        $emailService->setFrom('aitbenalibrahim2001@gmail.com', 'Dairy');
        $emailService->setSubject('Account Confirmation Code');
        $emailService->setMessage("Your confirmation code is: <strong>{$confirmationCode}</strong>");

        return $emailService->send();
    }


    public function resendCode()
    {
        // Check if there's temporary user data in the session
        $tempUserData = session()->get('temp_user_data');

        if (!$tempUserData) {
            // If no temporary user data is found, redirect to the registration page
            return redirect()->to('auth/register')->with('error', 'No registration data found. Please register again.');
        }

        // Generate a new confirmation code
        $newConfirmationCode = random_int(100000, 999999);

        // Update the temporary user data with the new confirmation code
        $tempUserData['confirmation_code'] = $newConfirmationCode;
        session()->set('temp_user_data', $tempUserData);

        // Send the new confirmation code via email
        if ($this->sendConfirmationEmail($tempUserData['email'], $newConfirmationCode)) {
            return redirect()->to('auth/confirmAccount')
                ->with('message', 'A new confirmation code has been sent to your email.');
        } else {
            return redirect()->to('auth/confirmAccount')
                ->with('error', 'Failed to resend the confirmation email.');
        }
    }


    public function confirmAccount()
    {
        if ($this->request->getMethod() === 'POST') {
            $enteredCode = $this->request->getPost('confirmation_code');
            $tempUserData = session()->get('temp_user_data');

            // Check if the confirmation code matches
            if ($tempUserData && $enteredCode == $tempUserData['confirmation_code']) {
                // Create the new user in the database
                $userModel = new UserModel();
                $userModel->insert([
                    'username' => $tempUserData['username'],
                    'email'    => $tempUserData['email'],
                    'password' => $tempUserData['password'],
                ]);

                // Clear temporary session data
                session()->remove('temp_user_data');

                return redirect()->to('auth/login')
                    ->with('message', 'Your account has been confirmed. You can now log in.');
            }

            return redirect()->to('auth/confirmAccount')
                ->with('error', 'Invalid confirmation code. Please try again.');
        }

        // Display the confirmation view
        return view('auth/confirm_account');
    }


    public function updateProfile()
    {
        // Ensure the user is logged in
        if (!session()->has('email')) {
            return redirect()->to('auth/login');
        }

        // Get the user email from session
        $email = session()->get('email');

        // Load the user and assistant models
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();

        // Determine if the user is a regular user or an assistant
        $user = $userModel->asObject()
            ->where('email', $email)
            ->first();

        $isAssistant = false;
        if (!$user) {
            $user = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }
            $isAssistant = true;
        }

        $file = $this->request->getFile('photo');

        if ($file && $file->isValid()) {
            $fileSize = $file->getSize();  // Get the file size
            log_message('debug', 'File uploaded, size: ' . $fileSize);

            // Check if file size exceeds 2MB (2,048,000 bytes)
            if ($fileSize == 0 || $fileSize > 2048000) {
                log_message('debug', 'File size exceeds 2MB, returning error.');
                return redirect()->back()->with('error', 'File size exceeds the maximum limit of 2MB.');
            }
        }

        // Set validation rules
        $validationRules = [
            'username' => 'required|min_length[3]|is_unique[' . ($isAssistant ? 'assistants' : 'users') . '.username,id,' . $user->id . ']',
            'email' => 'required|valid_email|is_unique[' . ($isAssistant ? 'assistants' : 'users') . '.email,id,' . $user->id . ']',
            'birth' => 'required|valid_date',
            'gender' => 'in_list[male,female,other]',
        ];

        // Add photo validation rules if a photo is uploaded and valid
        if ($file && $file->isValid()) {
            $validationRules['photo'] = [
                'uploaded[photo]',
                'mime_in[photo,image/jpg,image/jpeg,image/png]',
                'max_size[photo,2048]', // 2MB max size
            ];
        }

        // Validate the input data
        if (!$this->validate($validationRules)) {
            // If validation fails, remove the file input from session data
            $inputData = $this->request->getPost();
            unset($inputData['photo']); // Ensure the file field is not passed into the session

            return redirect()->back()->with('validation', $this->validator)->with('inputData', $inputData);
        }

        // Prepare data for updating the profile
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'birth' => $this->request->getPost('birth'),
            'gender' => $this->request->getPost('gender'),
        ];

        // Handle photo upload if a new file is provided
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newFileName = $file->getRandomName();
            // Move the file to the public directory
            $file->move(WRITEPATH . '../public/uploads/profile_photos/', $newFileName); // Adjust path to public folder
            $data['photo'] = 'uploads/profile_photos/' . $newFileName;

            // Optionally delete the old profile photo if it exists
            if (!empty($user->photo) && file_exists(WRITEPATH . '../public/' . $user->photo)) {
                unlink(WRITEPATH . '../public/' . $user->photo);
            }
        }

        // Update the user or assistant data in the database
        $isUpdated = $isAssistant
            ? $assistantModel->update($user->id, $data)
            : $userModel->update($user->id, $data);

        // Check if the update was successful
        if (!$isUpdated) {
            return redirect()->back()->with('error', 'Failed to update profile. Please try again.');
        }
        session()->set('username', $data['username']);
        session()->set('email', $data['email']);
        // Set success message and redirect
        return redirect()->to('/profile')->with('message', 'Profile updated successfully');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }


    public function forgotPassword()
    {
        return view('auth/forgot_password', [
            'validation' => session()->getFlashdata('validation'), // Get flashdata from the session
        ]);
    }

    public function sendResetLink()
    {
        // Define validation rules
        $validationRules = [
            'email' => 'required|valid_email',  // Ensures email is not empty and is in a valid format
        ];

        // Validate the form input
        if (!$this->validate($validationRules)) {
            // If validation fails, redirect back with the errors
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $email = $this->request->getPost('email');

        // Check if the email exists in the database
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        $assistantModel = new \App\Models\AssistantModel();
        $isAssistant = false;

        if (!$user) {
            $user = $assistantModel->asObject() // Retrieves the assistant as an object
                ->where('email', $email)
                ->first();
            if (!$user) {
                return redirect()->back()->withInput()->with('error', 'No account found with this email.');
            }
            $isAssistant = true;
        }

        // Generate a reset token and set its expiration
        $token = bin2hex(random_bytes(50));
        $data = [
            'reset_token' => $token,
            'token_expires_at' => (new \DateTime())->modify('+2 hour')->format('Y-m-d H:i:s'),
        ];

        // Update reset token and expiration in the database
        if ($isAssistant) {
            // Access properties using object notation if user is an assistant
            $assistantModel->update($user->id, $data);
        } else {
            // Access properties using array notation if user is a regular user
            $userModel->update($user['id'], $data);
        }

        // Send the reset email
        $recipientEmail = $isAssistant ? $user->email : $user['email'];
        if ($this->sendEmail($recipientEmail, $token)) {
            return redirect()->back()->with('message', 'A password reset link has been sent to your email.');
        } else {
            return redirect()->back()->with('error', 'Failed to send password reset link.');
        }
    }


    protected function sendEmail($email, $token)
    {
        $resetLink = base_url("auth/resetPassword/{$token}");
        $emailService = \Config\Services::email();

        $emailService->setTo($email);
        $emailService->setFrom('aitbenalibrahim2001@gmail.com', 'Dairy');
        $emailService->setSubject('Password Reset Request');
        $emailService->setMessage("Please click the following link to reset your password: <a href='{$resetLink}'>Reset Password</a>");

        if ($emailService->send()) {
            return true; // Email sent successfully
        } else {
            return false; // Handle the error, log it if necessary
        }
    }


    public function resetPassword($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();
        $assistantModel = new \App\Models\AssistantModel();
        if (!$user) {
            $user = $assistantModel->where('reset_token', $token)->first();
        }

        if (!$user || new Time($user['token_expires_at']) < Time::now()) {
            return redirect()->to('auth/forgotPassword')->with('error', 'Invalid or expired reset token.');
        }

        return view('auth/reset_password', ['token' => $token]);
    }

    public function updatePassword()
    {
        $rules = [
            'password' => 'required|min_length[8]',
            'cpassword' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $token = $this->request->getPost('token');
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();
        $assistantModel = new \App\Models\AssistantModel();
        $isAssistant = false;
        if (!$user) {
            $user = $assistantModel->where('reset_token', $token)->first();
            if (!$user) {
                return redirect()->to('auth/forgotPassword')->with('error', 'Invalid reset token.');
            }
            $isAssistant = true;
        }

        $newPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $isAssistant ? $assistantModel->update($user['id'], [
            'password' => $newPassword,
            'reset_token' => null,
            'token_expires_at' => null,
        ]) : $userModel->update($user['id'], [
            'password' => $newPassword,
            'reset_token' => null,
            'token_expires_at' => null,
        ]);

        return redirect()->to('auth/login')->with('message', 'Password successfully updated.');
    }
}
