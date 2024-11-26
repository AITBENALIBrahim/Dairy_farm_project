<?php
namespace App\Controllers;


use App\Models\CowPregnancyModel;
use App\Models\UserModel;



class PregnancyRecordsController extends BaseController
{
    // Display the list of pregnancy records
    public function PregnancyRecords()
    {
        $pregnancyModel = new CowPregnancyModel();
        $pregnancies = $pregnancyModel->findAll();

        $userModel = new UserModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();

        // Pass the pregnancy records and user data to the view
        return view('layout', ['content' => view('pages/pregnancy_records', ['user' => $user, 'pregnancies' => $pregnancies])]);
    }

    // Add a new pregnancy record
    public function addPregnancy()
    {
        $rules = [
            'cow_id' => 'required|integer',
            'pregnancy_start_date' => 'required|valid_date',
            'expected_delivery_date' => 'required|valid_date',
            'notes' => 'permit_empty|string',
            // Additional validation rules as needed
        ];

        if (!$this->validate($rules)) {
            return view('pages/pregnancy_records', ['validation_errors' => $this->validator->listErrors()]);
        }

        $data = [
            'cow_id' => $this->request->getPost('cow_id'),
            'pregnancy_start_date' => $this->request->getPost('pregnancy_start_date'),
            'expected_delivery_date' => $this->request->getPost('expected_delivery_date'),
            'notes' => $this->request->getPost('notes'),
            'created_by' => session()->get('user_id'),
            'employee_id' => session()->get('employee_id'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $pregnancyModel = new CowPregnancyModel();
        $pregnancyModel->insert($data);

        return redirect()->to('/pregnancy-records')->with('success', 'Pregnancy record added successfully.');
    }
}

