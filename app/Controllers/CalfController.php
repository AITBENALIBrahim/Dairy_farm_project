<?php
namespace App\Controllers;

use App\Models\MilkCollectionModel;
use App\Models\CowModel;
use App\Models\UserModel;
use App\Models\CalfModel;

class CalfController extends BaseController
{
    
    public function calves(): string
    {
        $userModel = new UserModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
    
        $calfModel = new CalfModel();
        $calves = $calfModel->findAll();
    
        // Assuming you have a CowModel to fetch cows data
        $cowModel = new CowModel();
        $cows = $cowModel->findAll();  // Adjust this if you're fetching cows differently
    
        // Load the validation library
        $validation = \Config\Services::validation();
    
        return view('layout', data: [
            'content' => view('pages/calves', [
                'user' => $user,
                'calves' => $calves,
                'cows' => $cows,  // Add cows to the data array
                'validation' => $validation  // Pass validation object to the view
            ])
        ]);
    }
    
public function addCalf()
{
    // Validation rules
    $rules = [
        'cow_id' => 'required|integer',
        'tag_number' => 'required',
        'date_of_birth' => 'required|valid_date',
        'health_status' => 'required',
        'stall_id' => 'required',
        'sale_status' => 'required'
    ];

    if (!$this->validate($rules)) {
        return view('pages/calves', ['validation_errors' => $this->validator->listErrors()]);
    }

    $data = [
        'cow_id' => $this->request->getPost('cow_id'),
        'tag_number' => $this->request->getPost('tag_number'),
        'date_of_birth' => $this->request->getPost('date_of_birth'),
        'health_status' => $this->request->getPost('health_status'),
        'stall_id' => $this->request->getPost('stall_id'),
        'sale_status' => $this->request->getPost('sale_status'),
        'created_by' => session()->get('user_id') // Assuming you have user authentication
    ];
    

    $calfModel = new CalfModel();
    $calfModel->insert($data);

    return redirect()->to('/calves')->with('success', 'Calf added successfully.');
}

public function editCalf($id)
{
    $calfModel = new CalfModel();
    $calf = $calfModel->find($id);

    if (!$calf) {
        return redirect()->to('calves')->with('error', 'Calf not found.');
    }

    return view('pages/edit_calf', ['calf' => $calf]);
}

public function updateCalf($id)
{
    $rules = [
        'cow_id' => 'required|integer',
        'tag_number' => 'required',
        'date_of_birth' => 'required|valid_date',
        'health_status' => 'required',
        'stall_id' => 'required',
        'sale_status' => 'required'
    ];

    if (!$this->validate($rules)) {
        $calfModel = new CalfModel();
        $calf = $calfModel->find($id);

        return view('edit_calf', [
            'calf' => $calf,
            'validation_errors' => $this->validator->getErrors()
        ]);
    }

    $data = [
        'cow_id' => $this->request->getPost('cow_id'),
        'tag_number' => $this->request->getPost('tag_number'),
        'date_of_birth' => $this->request->getPost('date_of_birth'),
        'health_status' => $this->request->getPost('health_status'),
        'stall_id' => $this->request->getPost('stall_id'),
        'sale_status' => $this->request->getPost('sale_status')
    ];

    $calfModel = new CalfModel();
    $calfModel->update($id, $data);

    return redirect()->to('calves')->with('success', 'Calf updated successfully.');
}

public function deleteCalf($id)
{
    $calfModel = new CalfModel();
    $calfModel->delete($id);

    return redirect()->to('calves')->with('success', 'Calf deleted successfully.');
}

}