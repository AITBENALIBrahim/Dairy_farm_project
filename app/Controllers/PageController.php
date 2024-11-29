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


    public function suppliers()
    {
        // Check if the user is logged in
        $redirect = $this->checkLogin();
        if ($redirect) {
            return $redirect;
        }

        // Get the current user from session
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $supplierModel = new \App\Models\SupplierModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        if ($user) {
            $suppliers = $supplierModel->asObject()->where('created_by', $user->id)->findAll();
        } else {
            $user = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
            $suppliers = $supplierModel->asObject()->where('created_by', $user->created_by)->findAll();
        }
        return view('layout', ['content' => view('pages/suppliers', ['user' => $user, 'suppliers' => $suppliers])]);
    }

    public function addSupplier()
    {
        return view('pages/add_supplier', [
            'validation' => session()->getFlashdata('validation') // Retrieve flashdata
        ]); // Load the view to add an assistant
    }

    public function saveSupplier()
    {
        // Load user model to determine user role and ID
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $currentUser = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        if (!$currentUser) {
            $currentUser = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
        }

        // Determine `created_by` based on user role
        $createdBy = null;
        if ($currentUser) {
            if ($currentUser->role == 'admin') {
                $createdBy = $currentUser->id;
            } elseif ($currentUser->role == 'assistant') {
                $createdBy = $currentUser->created_by; // Use the ID of the admin who created the assistant
            }
        }

        // Form validation
        if (!$this->validate([
            'name' => 'required|max_length[100]',
            'contact_number' => 'required|max_length[20]',
            'address' => 'required',
            'supplied_items' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Save the new supplier
        $supplierModel = new \App\Models\SupplierModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'contact_number' => $this->request->getPost('contact_number'),
            'address' => $this->request->getPost('address'),
            'supplied_items' => $this->request->getPost('supplied_items'),
            'created_by' => $createdBy,
        ];

        if ($supplierModel->save($data)) {
            return redirect()->to('/suppliers')->with('message', 'Supplier added successfully');
        } else {
            return redirect()->back()->with('error', 'There was an error adding the supplier');
        }
    }

    // Load the edit form with existing supplier data
    public function editSupplier($id)
    {
        $supplierModel = new \App\Models\SupplierModel();
        $supplier = $supplierModel->find($id);

        if (!$supplier) {
            return redirect()->to('/suppliers')->with('error', 'Supplier not found.');
        }

        return view('pages/edit_supplier', [
            'supplier' => $supplier,
            'validation' => \Config\Services::validation()
        ]);
    }

    // Update supplier data
    public function updateSupplier($id)
    {
        $validation = $this->validate([
            'name' => 'required|min_length[3]',
            'contact_number' => 'required|min_length[10]',
            'address' => 'required',
            'supplied_items' => 'required',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $supplierModel = new \App\Models\SupplierModel();
        $supplierModel->update($id, [
            'name' => $this->request->getPost('name'),
            'contact_number' => $this->request->getPost('contact_number'),
            'address' => $this->request->getPost('address'),
            'supplied_items' => $this->request->getPost('supplied_items'),
        ]);

        return redirect()->to('/suppliers')->with('message', 'Supplier updated successfully.');
    }

    // Delete supplier function
    public function deleteSupplier($id)
    {
        $supplierModel = new \App\Models\SupplierModel();

        // Check if the supplier exists
        $supplier = $supplierModel->find($id);
        if (!$supplier) {
            return redirect()->to('/suppliers')->with('error', 'Supplier not found');
        }

        // Delete the supplier
        if ($supplierModel->delete($id)) {
            return redirect()->to('/suppliers')->with('message', 'Supplier deleted successfully');
        } else {
            return redirect()->to('/suppliers')->with('error', 'Failed to delete supplier');
        }
    }

    public function expenses()
    {
        // Check if the user is logged in
        $redirect = $this->checkLogin();
        if ($redirect) {
            return $redirect;
        }

        // Get the current user from session
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $expenseModel = new \App\Models\ExpenseModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        if ($user) {
            $expenses = $expenseModel->asObject()->where('created_by', $user->id)->findAll();
        } else {
            $user = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
            $expenses = $expenseModel->asObject()->where('created_by', $user->created_by)->findAll();
        }
        return view('layout', ['content' => view('pages/expenses', ['user' => $user, 'expenses' => $expenses])]);
    }

    public function addExpense()
    {
        return view('pages/add_expense', [
            'validation' => session()->getFlashdata('validation')
        ]);
    }

    public function saveExpense()
    {
        // Load user model to determine user role and ID
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $currentUser = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        if (!$currentUser) {
            $currentUser = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
        }

        // Determine `created_by` based on user role
        $createdBy = null;
        if ($currentUser) {
            if ($currentUser->role == 'admin') {
                $createdBy = $currentUser->id;
            } elseif ($currentUser->role == 'assistant') {
                $createdBy = $currentUser->created_by; // Use the ID of the admin who created the assistant
            }
        }

        // Form validation
        if (!$this->validate([
            'expense_date' => 'required',
            'expense_type' => 'required|max_length[50]',
            'amount' => 'required|decimal',
            'description' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Save the new expense
        $expenseModel = new \App\Models\ExpenseModel();
        $data = [
            'expense_date' => $this->request->getPost('expense_date'),
            'expense_type' => $this->request->getPost('expense_type'),
            'amount' => $this->request->getPost('amount'),
            'description' => $this->request->getPost('description'),
            'created_by' => $createdBy,
        ];

        if ($expenseModel->save($data)) {
            return redirect()->to('/expenses')->with('message', 'Expense added successfully');
        } else {
            return redirect()->back()->with('error', 'There was an error adding the expense');
        }
    }

    // Edit expense form
    public function editExpense($id)
    {
        $expenseModel = new \App\Models\ExpenseModel();
        $expense = $expenseModel->find($id);

        if (!$expense) {
            return redirect()->to('/expenses')->with('error', 'Expense not found.');
        }

        return view('pages/edit_expense', [
            'expense' => $expense,
            'validation' => \Config\Services::validation()
        ]);
    }

    // Update expense data
    public function updateExpense($id)
    {
        $validation = $this->validate([
            'expense_date' => 'required|valid_date',
            'expense_type' => 'required|min_length[3]',
            'amount' => 'required|decimal',
            'description' => 'required|min_length[3]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $expenseModel = new \App\Models\ExpenseModel();
        $expenseModel->update($id, [
            'expense_date' => $this->request->getPost('expense_date'),
            'expense_type' => $this->request->getPost('expense_type'),
            'amount' => $this->request->getPost('amount'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/expenses')->with('message', 'Expense updated successfully.');
    }

    // Delete expense
    public function deleteExpense($id)
    {
        $expenseModel = new \App\Models\ExpenseModel();

        // Check if the expense exists
        $expense = $expenseModel->find($id);
        if (!$expense) {
            return redirect()->to('/expenses')->with('error', 'Expense not found');
        }

        // Delete the expense
        if ($expenseModel->delete($id)) {
            return redirect()->to('/expenses')->with('message', 'Expense deleted successfully');
        } else {
            return redirect()->to('/expenses')->with('error', 'Failed to delete expense');
        }
    }

    public function employees()
    {
        // Check if the user is logged in
        $redirect = $this->checkLogin();
        if ($redirect) {
            return $redirect;
        }

        // Get the current user from session
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $employeeModel = new \App\Models\EmployeeModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        if ($user) {
            $employees = $employeeModel->asObject()->where('created_by', $user->id)->findAll();
        } else {
            $user = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
            $employees = $employeeModel->asObject()->where('created_by', $user->created_by)->findAll();
        }
        return view('layout', ['content' => view('pages/employees', ['user' => $user, 'employees' => $employees])]);
    }

    public function addEmployee()
    {
        return view('pages/add_employee', [
            'validation' => session()->getFlashdata('validation')
        ]);
    }

    public function saveEmployee()
    {
        // Load user model to determine user role and ID
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $currentUser = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        if (!$currentUser) {
            $currentUser = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
        }

        // Determine `created_by` based on user role
        $createdBy = null;
        if ($currentUser) {
            if ($currentUser->role == 'admin') {
                $createdBy = $currentUser->id;
            } elseif ($currentUser->role == 'assistant') {
                $createdBy = $currentUser->created_by; // Use the ID of the admin who created the assistant
            }
        }

        // Form validation
        if (!$this->validate([
            'name' => 'required|max_length[100]',
            'position' => 'required|max_length[100]',
            'salary' => 'required|decimal',
            'hire_date' => 'required|valid_date',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Save the new employee
        $employeeModel = new \App\Models\EmployeeModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'position' => $this->request->getPost('position'),
            'salary' => $this->request->getPost('salary'),
            'hire_date' => $this->request->getPost('hire_date'),
            'status' => $this->request->getPost('status'),
            'created_by' => $createdBy,
        ];

        if ($employeeModel->save($data)) {
            return redirect()->to('/employees')->with('message', 'Employee added successfully');
        } else {
            return redirect()->back()->with('error', 'There was an error adding the employee');
        }
    }

    public function editEmployee($id)
    {
        $employeeModel = new \App\Models\EmployeeModel();
        $employee = $employeeModel->find($id);

        if (!$employee) {
            return redirect()->to('/employees')->with('error', 'Employee not found.');
        }

        return view('pages/edit_employee', [
            'employee' => $employee,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function updateEmployee($id)
    {
        // Form validation
        $validation = $this->validate([
            'name' => 'required|max_length[100]',
            'position' => 'required|max_length[100]',
            'salary' => 'required|decimal',
            'hire_date' => 'required|valid_date',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Update the employee data
        $employeeModel = new \App\Models\EmployeeModel();
        $employeeModel->update($id, [
            'name' => $this->request->getPost('name'),
            'position' => $this->request->getPost('position'),
            'salary' => $this->request->getPost('salary'),
            'hire_date' => $this->request->getPost('hire_date'),
            'status' => $this->request->getPost('status'), // Optional status update
        ]);

        return redirect()->to('/employees')->with('message', 'Employee updated successfully.');
    }

    public function deleteEmployee($id)
    {
        $employeeModel = new \App\Models\EmployeeModel();

        // Check if the employee exists
        $employee = $employeeModel->find($id);
        if (!$employee) {
            return redirect()->to('/employees')->with('error', 'Employee not found');
        }

        // Delete the employee
        if ($employeeModel->delete($id)) {
            return redirect()->to('/employees')->with('message', 'Employee deleted successfully');
        } else {
            return redirect()->to('/employees')->with('error', 'Failed to delete employee');
        }
    }

    public function salaries()
    {
        // Check if the user is logged in
        $redirect = $this->checkLogin();
        if ($redirect) {
            return $redirect;
        }

        // Get the current user from session
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $employeeModel = new \App\Models\EmployeeModel();
        $salaryModel = new \App\Models\EmployeeSalaryModel();  // Salary model
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();

        if ($user) {
            // Get employees created by the logged-in user
            $employees = $employeeModel->asObject()->where('created_by', $user->id)->findAll();
            // Get salary records for these employees
            $salaries = $salaryModel->asObject()->whereIn('employee_id', array_column($employees, 'id'))->findAll();
        } else {
            // If the user is an assistant
            $user = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();

            if ($user) {
                $employees = $employeeModel->asObject()->where('created_by', $user->created_by)->findAll();
                $salaries = $salaryModel->asObject()->whereIn('employee_id', array_column($employees, 'id'))->findAll();
            } else {
                $salaries = [];
            }
        }

        // Create an associative array with employee ids as keys and employee names as values
        $employeeNames = [];
        foreach ($employees as $employee) {
            $employeeNames[$employee->id] = $employee->name;
        }

        // Append employee names to the salary records
        foreach ($salaries as &$salary) {
            // Assign the employee name based on the employee_id
            $salary->employee_name = $employeeNames[$salary->employee_id] ?? 'Unknown';
        }

        return view('layout', ['content' => view('pages/salaries', ['user' => $user, 'salaries' => $salaries])]);
    }

    public function addSalary()
    {
        // Pass employee data to the view for selection
        $employeeModel = new \App\Models\EmployeeModel();
        $employees = $employeeModel->findAll();
        return view('pages/add_salary', [
            'validation' => session()->getFlashdata('validation'),
            'employees' => $employees
        ]);
    }

    public function saveSalary()
    {
        // Load user model to determine user role and ID
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $currentUser = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();

        if (!$currentUser) {
            $currentUser = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
        }

        // Determine `created_by` based on user role
        $createdBy = null;
        if ($currentUser) {
            if ($currentUser->role == 'admin') {
                $createdBy = $currentUser->id;
            } elseif ($currentUser->role == 'assistant') {
                $createdBy = $currentUser->created_by; // Use the ID of the admin who created the assistant
            }
        }

        // Form validation for salary
        if (!$this->validate([
            'employee_id' => 'required|integer',
            'amount_paid' => 'required|decimal',
            'payment_date' => 'required|valid_date',
            'payment_method' => 'required|max_length[50]',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Save the salary information
        $salaryModel = new \App\Models\EmployeeSalaryModel();
        $data = [
            'employee_id' => $this->request->getPost('employee_id'),
            'amount_paid' => $this->request->getPost('amount_paid'),
            'payment_date' => $this->request->getPost('payment_date'),
            'payment_method' => $this->request->getPost('payment_method'),
            'note' => $this->request->getPost('note'),
            'created_by' => $createdBy,
        ];

        if ($salaryModel->save($data)) {
            return redirect()->to('/salaries')->with('message', 'Salary added successfully');
        } else {
            return redirect()->back()->with('error', 'There was an error adding the salary');
        }
    }


    public function editSalary($id)
    {
        $salaryModel = new \App\Models\EmployeeSalaryModel();
        $employeeModel = new \App\Models\EmployeeModel();

        $salary = $salaryModel->find($id);

        if (!$salary) {
            return redirect()->to('/salaries')->with('error', 'Salary record not found.');
        }

        $employees = $employeeModel->findAll();

        return view('pages/edit_salary', [
            'salary' => $salary,
            'employees' => $employees,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function updateSalary($id)
    {
        // Form validation
        $validation = $this->validate([
            'employee_id' => 'required|numeric',
            'amount_paid' => 'required|decimal',
            'payment_date' => 'required|valid_date',
            'payment_method' => 'required|max_length[100]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Update the salary data
        $salaryModel = new \App\Models\EmployeeSalaryModel();
        $salaryModel->update($id, [
            'employee_id' => $this->request->getPost('employee_id'),
            'amount_paid' => $this->request->getPost('amount_paid'),
            'payment_date' => $this->request->getPost('payment_date'),
            'payment_method' => $this->request->getPost('payment_method'),
            'note' => $this->request->getPost('note'),
        ]);

        return redirect()->to('/salaries')->with('message', 'Salary updated successfully.');
    }

    public function deleteSalary($id)
    {
        $salaryModel = new \App\Models\EmployeeSalaryModel();

        // Check if the salary record exists
        $salary = $salaryModel->find($id);
        if (!$salary) {
            return redirect()->to('/salaries')->with('error', 'Salary record not found.');
        }

        // Delete the salary record
        if ($salaryModel->delete($id)) {
            return redirect()->to('/salaries')->with('message', 'Salary record deleted successfully.');
        } else {
            return redirect()->to('/salaries')->with('error', 'Failed to delete salary record.');
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
