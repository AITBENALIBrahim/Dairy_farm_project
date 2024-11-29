<?php
namespace App\Controllers;

use App\Models\StallModel;
use App\Models\CowModel;
use App\Models\UserModel;

class CowController extends BaseController
{



public function cows()
{
    $cowModel = new CowModel();
    $cows = $cowModel->findAll();
    $userModel = new UserModel();
    $user = $userModel->asObject()
    ->where('username', session()->get('username'))
    ->orWhere('email', session()->get('email'))
    ->first();


    return view('layout', ['content' => view('pages/cow', ['user' => $user,'cows' => $cows])]);
}

public function addCow()
{
    // Validation rules
    $rules = [
        'tag_number' => 'required',
        'date_of_birth' => 'required|valid_date',
        'health_status' => 'required',
        'stall_id' => 'required',  // No need for manual input, we'll make this a dropdown
        'sale_status' => 'required'
    ];

    // Fetch the list of available stalls
    $stallModel = new StallModel();  // Assuming you have a StallModel
    $stalls = $stallModel->findAll();  // This fetches all stalls

    // Fetch the user data (similar to cows() method)
    $userModel = new UserModel();
    $user = $userModel->asObject()
        ->where('username', session()->get('username'))
        ->orWhere('email', session()->get('email'))
        ->first();

    // Check if the validation failed
    if (!$this->validate($rules)) {
        return view('layout', [
            'content' => view('pages/add_cow', [
                'validation' => $this->validator,
                'stalls' => $stalls,  // Pass the list of stalls to the view
                'user' => $user  // Pass the user data to layout
            ])
        ]);
    }

    // Process the form data after validation
    $data = [
        'tag_number' => $this->request->getPost('tag_number'),
        'date_of_birth' => $this->request->getPost('date_of_birth'),
        'health_status' => $this->request->getPost('health_status'),
        'stall_id' => $this->request->getPost('stall_id'),  // The selected stall ID
        'sale_status' => $this->request->getPost('sale_status'),
        'created_by' => session()->get('user_id') // Assuming you have user authentication
    ];

    // Insert the new cow
    $cowModel = new CowModel();
    $cowModel->insert($data);

    // Redirect with success message
    return redirect()->to('cow')->with('success', 'Cow added successfully.');
}


public function deleteCow($id)
{
    // Load the CowModel
    $cowModel = new CowModel();

    // Check if the cow exists
    $cow = $cowModel->find($id);
    if ($cow) {
        // Delete the cow
        $cowModel->delete($id);

        // Redirect with a success message
        return redirect()->to('cow')->with('success', 'Cow deleted successfully.');
    } else {
        // If cow not found, show an error
        return redirect()->to('cow')->with('error', 'Cow not found.');
    }
}

}