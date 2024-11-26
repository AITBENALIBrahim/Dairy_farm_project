<?php

namespace App\Controllers;

use App\Models\AssistantModel;
use App\Models\MilkCollectionModel;
use App\Models\CowModel;
use App\Models\UserModel;


class PageController extends BaseController
{
    // Method to check if the user is logged in
    private function checkLogin()
    {
        if (!session()->get('logged_in')) {
            // Redirect to login page if not logged in
            return redirect()->to('/auth/login');
        }
    }

    private function checkAdmin()
    {
        if (session()->get('role') !== 'admin') {
            // Redirect to the dashboard if the user is not an admin
            return redirect()->to('/dashboard');
        }
    }

    public function dashboard()
    {
        // Check if the user is logged in
        $redirect = $this->checkLogin();
        if ($redirect) {
            return $redirect;
        }

        // Get the current user from session
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        if (!$user) {
            $user = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
        }

        return view('layout', ['content' => view('pages/dashboard'), 'user' => $user]);
    }

    public function profile()
    {
        // Check if the user is logged in
        $redirect = $this->checkLogin();
        if ($redirect) {
            return $redirect;
        }

        // Get the current user from session
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        if (!$user) {
            $user = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
        }

        return view('layout', ['content' => view('pages/profile', ['user' => $user, 'validation' => session()->getFlashdata('validation')])]);
    }

    public function manageUsers()
    {
        // Check if the user is logged in
        $redirect = $this->checkLogin();
        if ($redirect) {
            return $redirect;
        }

        // Check if the user is an admin
        $redirect = $this->checkAdmin();
        if ($redirect) {
            return $redirect;
        }

        // Get the current user from session
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        if (!$user) {
            $user = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
        }

        // Fetch assistants created by the current user
        $assistants = $assistantModel->asObject()->where('created_by', $user->id)->findAll();

        return view('layout', ['content' => view('pages/manage_users', ['user' => $user, 'assistants' => $assistants])]);
    }                                                                                                                                                                       

    public function addAssistant()
    {
        return view('pages/add_assistant', [
            'validation' => session()->getFlashdata('validation') // Retrieve flashdata
        ]); // Load the view to add an assistant
    }

    public function saveAssistant()
    {
        // Form validation
        if (!$this->validate([
            'username' => 'required|alpha_numeric|is_unique[users.username]|is_unique[assistants.username]',
            'email' => 'required|valid_email|is_unique[users.email]|is_unique[assistants.email]',
            'password' => 'required|min_length[8]',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $userModel = new \App\Models\UserModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();

        // Save the new assistant
        $assistantModel = new AssistantModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_by' => $user->id
        ];

        if ($assistantModel->save($data)) {
            return redirect()->to('/manage-users')->with('message', 'Assistant added successfully');
        } else {
            return redirect()->back()->with('error', 'There was an error adding the assistant');
        }
    }

    // Controller Method to Load Edit Assistant Page
    public function editAssistant($id)
    {
        $assistantModel = new \App\Models\AssistantModel();

        // Find the assistant by ID
        $assistant = $assistantModel->asObject()->find($id);

        // If assistant is not found, redirect to the user management page with an error
        if (!$assistant) {
            return redirect()->to('/manage-users')->with('error', 'Assistant not found');
        }

        // Load the view with the assistant's data and validation errors
        return view('pages/edit_assistant', [
            'assistant' => $assistant,
            'validation' => session()->getFlashdata('validation') // Retrieve flashdata
        ]);
    }

    // Controller Method to Update the Assistant
    public function updateAssistant($id)
    {
        $assistantModel = new \App\Models\AssistantModel();
        $userModel = new \App\Models\UserModel();

        // Get the assistant by ID
        $assistant = $assistantModel->find($id);
        if (!$assistant) {
            return redirect()->to('/manage-users')->with('error', 'Assistant not found');
        }

        // Manually check for unique username and email
        $newUsername = $this->request->getPost('username');
        $newEmail = $this->request->getPost('email');

        // Check if username is unique across both tables (excluding the current assistant)
        $usernameExistsInUsers = $userModel->where('username', $newUsername)->first();
        $usernameExistsInAssistants = $assistantModel->where('username', $newUsername)->where('id !=', $id)->first();

        if (($usernameExistsInUsers || $usernameExistsInAssistants) && $newUsername !== $assistant['username']) {
            return redirect()->back()->withInput()->with('error', 'The username must be unique across users and assistants.');
        }

        // Check if email is unique across both tables (excluding the current assistant)
        $emailExistsInUsers = $userModel->where('email', $newEmail)->first();
        $emailExistsInAssistants = $assistantModel->where('email', $newEmail)->where('id !=', $id)->first();

        if (($emailExistsInUsers || $emailExistsInAssistants) && $newEmail !== $assistant['email']) {
            return redirect()->back()->withInput()->with('error', 'The email must be unique across users and assistants.');
        }

        // Form validation for other fields
        if (!$this->validate([
            'username' => 'required|alpha_numeric',
            'email' => 'required|valid_email',
            'password' => 'permit_empty|min_length[8]',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Prepare the data to update
        $data = [
            'username' => $newUsername,
            'email' => $newEmail,
        ];

        // Update the password only if a new one is provided
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // Update the assistant data
        if ($assistantModel->update($id, $data)) {
            return redirect()->to('/manage-users')->with('message', 'Assistant updated successfully');
        } else {
            return redirect()->back()->with('error', 'There was an error updating the assistant');
        }
    }

    public function deleteAssistant($id)
    {
        $assistantModel = new \App\Models\AssistantModel();

        // Get the assistant by ID
        $assistant = $assistantModel->asObject()->find($id);
        if (!$assistant) {
            return redirect()->to('/manage-users')->with('error', 'Assistant not found');
        }

        // Delete the assistant
        if ($assistantModel->delete($id)) {
            return redirect()->to('/manage-users')->with('message', 'Assistant deleted successfully');
        } else {
            return redirect()->to('/manage-users')->with('error', 'There was an error deleting the assistant');
        }
    }





    public function settings()
    {
        // Check if the user is logged in
        $redirect = $this->checkLogin();
        if ($redirect) {
            return $redirect;
        }

        // Get the current user from session
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        if (!$user) {
            $user = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
        }

        return view('layout', ['content' => view('pages/settings'), 'user' => $user]);
    }
}
