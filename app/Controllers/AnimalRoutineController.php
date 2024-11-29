<?php namespace App\Controllers;

use App\Models\RoutinesModel;
use App\Models\UserModel;

class AnimalRoutineController extends BaseController
{
    public function index()
    {
        $routineModel = new RoutinesModel();
        $routines = $routineModel->findAll();
        
        // Get user data
        $userModel = new UserModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
    
        // Return the layout with the 'content' variable
        return view('layout', ['content' => view('pages/animal_routines', ['user' => $user, 'routines' => $routines])]);
    }
    
    public function addRoutine()
    {
        $userModel = new UserModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
    
        // Pass the user data and validation object to the view and wrap it in the layout
        return view('layout', [
            'content' => view('pages/add_routine', [
                'validation' => \Config\Services::validation(),
                'user' => $user  // Pass user data to the view
            ])
        ]);
    }
        
    public function saveRoutine()
    {
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'animal_id'    => 'required',
            'animal_type'  => 'required',
            'routine_type' => 'required',
            'description'  => 'required',
            'frequency'    => 'required',
            'employee_id'  => 'required|integer'
        ])) {
            // If validation fails, redirect to add-routine view with validation errors
            return redirect()->to('/add-routine')->withInput()->with('validation', $validation);
        }

        $routineModel = new RoutinesModel();
        $routineModel->save([
            'animal_id'    => $this->request->getPost('animal_id'),
            'animal_type'  => $this->request->getPost('animal_type'),
            'routine_type' => $this->request->getPost('routine_type'),
            'description'  => $this->request->getPost('description'),
            'frequency'    => $this->request->getPost('frequency'),
            'employee_id'  => $this->request->getPost('employee_id'),
            'created_by'   => session()->get('user_id'),
        ]);

        return redirect()->to('/animal-routines')->with('success', 'Routine added successfully!');
    }

    public function deleteRoutine($id)
    {
        $routineModel = new RoutinesModel();

        // Check if routine exists
        $routine = $routineModel->find($id);
        if ($routine) {
            $routineModel->delete($id);
            return redirect()->to('/animal-routines')->with('success', 'Routine deleted successfully!');
        } else {
            return redirect()->to('/animal-routines')->with('error', 'Routine not found!');
        }
    }

// app/Controllers/AnimalRoutineController.php

public function editRoutine($id)
{
    $routineModel = new RoutinesModel();

    // Find the routine by ID
    $routine = $routineModel->find($id);
    if (!$routine) {
        // If routine is not found, redirect with an error message
        return redirect()->to('/animal-routines')->with('error', 'Routine not found!');
    }

    $userModel = new UserModel();
    $user = $userModel->asObject()
        ->where('username', session()->get('username'))
        ->orWhere('email', session()->get('email'))
        ->first();

    // Pass the routine and user data to the view and wrap it in the layout
    return view('layout', [
        'content' => view('pages/edit_routine', [
            'routine' => $routine,
            'user' => $user  // Pass user data to the view
        ])
    ]);
}
    public function updateRoutine($id)
{
    $routineModel = new RoutinesModel();

    // Validate the form data (you can also add custom validation rules here)
    $validation = \Config\Services::validation();
    if (!$this->validate([
        'animal_id' => 'required',
        'routine_type' => 'required',
        'description' => 'required',
        'frequency' => 'required',
        'employee_id' => 'required|integer'
    ])) {
        return redirect()->to('edit-routine/' . $id)->withInput()->with('error', 'Please fill all fields correctly.');
    }

    // Prepare the updated data
    $updatedData = [
        'animal_id' => $this->request->getPost('animal_id'),
        'routine_type' => $this->request->getPost('routine_type'),
        'description' => $this->request->getPost('description'),
        'frequency' => $this->request->getPost('frequency'),
        'employee_id' => $this->request->getPost('employee_id'),
    ];

    // Update the routine in the database
    $routineModel->update($id, $updatedData);

    // Redirect back with a success message
    return redirect()->to('/animal-routines')->with('success', 'Routine updated successfully!');
}

}
