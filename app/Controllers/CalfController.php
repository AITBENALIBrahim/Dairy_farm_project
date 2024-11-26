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

    return view('layout', ['content' => view('pages/calves', ['user' => $user,'calves' => $calves])]);
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
}