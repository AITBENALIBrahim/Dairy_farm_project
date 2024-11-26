<?php
namespace App\Controllers;

use App\Models\MilkCollectionModel;
use App\Models\CowModel;
use App\Models\UserModel;
use App\Models\CalfModel;
use App\Models\StallModel;
use App\Models\AnimalVaccineModel;


class VaccinationsController extends BaseController
{
    
    public function vaccinations()
    {
        $vaccinationModel = new AnimalVaccineModel();
        $vaccinations = $vaccinationModel->findAll();

        $userModel = new UserModel();
        $user = $userModel->asObject()
        ->where('username', session()->get('username'))
        ->orWhere('email', session()->get('email'))
        ->first();
    

        return view('layout', ['content' => view('pages/vaccinations', ['user' => $user,'vaccinations' => $vaccinations])]);

    
    }
    
    public function addVaccination()
    {
        // Validation rules
        $rules = [
            'animal_id' => 'required|integer',
            'animal_type' => 'required',
            'vaccine_name' => 'required',
            'vaccination_date' => 'required|valid_date',
            // ... other fields ...
        ];
    
        if (!$this->validate($rules)) {
            return view('pages/vaccinations', ['validation_errors' => $this->validator->listErrors()]);
        }
    
        $data = [
            'animal_id' => $this->request->getPost('animal_id'),
            'animal_type' => $this->request->getPost('animal_type'),
            'vaccine_name' => $this->request->getPost('vaccine_name'),
            'vaccination_date' => $this->request->getPost('vaccination_date'),
            'created_by' => session()->get('user_id') // Assuming you have user authentication
        ];
    
        $vaccinationModel = new AnimalVaccineModel();
        $vaccinationModel->insert($data);
    
        return redirect()->to('/vaccinations')->with('success', 'Vaccination added successfully.');
    }    }