<?php
namespace App\Controllers;

use App\Models\MilkCollectionModel;
use App\Models\CowModel;
use App\Models\UserModel;
use App\Models\CalfModel;
use App\Models\StallModel;

class StallController extends BaseController
{
    
    public function stalls()
    {
        $userModel = new UserModel();
        $user = $userModel->asObject()
        ->where('username', session()->get('username'))
        ->orWhere('email', session()->get('email'))
        ->first();
    
        $stallModel = new StallModel();
        $stalls = $stallModel->findAll();
    
        return view('layout', ['content' => view('pages/stalls', ['user' => $user,'stalls' => $stalls])]);
    }
    
    public function addStall()
    {
        // Validation rules
        $rules = [
            'stall_number' => 'required',
            'capacity' => 'required|integer',
            'occupied' => 'required|in_list[0,1]',
            'employee_id' => 'required|integer'
        ];
    
        if (!$this->validate($rules)) {
            return view('pages/stalls', ['validation_errors' => $this->validator->listErrors()]);
        }
    
        $data = [
            'stall_number' => $this->request->getPost('stall_number'),
            'capacity' => $this->request->getPost('capacity'),
            'occupied' => $this->request->getPost('occupied'),
            'employee_id' => $this->request->getPost('employee_id'),
            'created_by' => session()->get('user_id') // Assuming you have user authentication
        ];
    
        $stallModel = new StallModel();
        $stallModel->insert($data);
    
        return redirect()->to('/stalls')->with('success', 'Stall added successfully.');
    }
    }