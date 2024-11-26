<?php
namespace App\Controllers;

use App\Models\MilkCollectionModel;
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
        'stall_id' => 'required',
        'sale_status' => 'required'
    ];

    if (!$this->validate($rules)) {
        return view('pages/cow', ['validation_errors' => $this->validator->listErrors()]);
    }

    $data = [
        'tag_number' => $this->request->getPost('tag_number'),
        'date_of_birth' => $this->request->getPost('date_of_birth'),
        'health_status' => $this->request->getPost('health_status'),
        'stall_id' => $this->request->getPost('stall_id'),
        'sale_status' => $this->request->getPost('sale_status'),
        'created_by' => session()->get('user_id') // Assuming you have user authentication
    ];

    $cowModel = new CowModel();
    $cowModel->insert($data);

    return redirect()->to('cow')->with('success', 'Cow added successfully.');
}}