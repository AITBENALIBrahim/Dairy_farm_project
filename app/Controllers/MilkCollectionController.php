<?php
namespace App\Controllers;

use App\Models\MilkCollectionModel;
use App\Models\CowModel;
use App\Models\UserModel;

class MilkCollectionController extends BaseController
{

public function index(): string
{
    $milkCollectionModel = new MilkCollectionModel();
    $milkCollections = $milkCollectionModel->findAll();
    $userModel = new \App\Models\UserModel();

    $user = $userModel->asObject()
    ->where('username', session()->get('username'))
    ->orWhere('email', session()->get('email'))
    ->first();

    
    // Pass the data to the view
    return view('layout', ['content' => view('pages/milk_collection', ['user' => $user,'milk_collections' => $milkCollections])]);
}        

public function addMilkCollection()
{
    // Validation rules
    $rules = [
        'cow_id' => 'required|integer',
        'quantity' => 'required|numeric',
        'milk_type' => 'required|in_list[cow, buffalo]',
        'employee_id' => 'required|integer'
    ];

    if (!$this->validate($rules)) {
        // Validation failed, return to the form with error messages
        return view('pages/milk_collection', ['validation' => $this->validator]);
    }

    $data = [
        'cow_id' => $this->request->getPost('cow_id'),
        'quantity' => $this->request->getPost('quantity'),
        'milk_type' => $this->request->getPost('milk_type'),
        'employee_id' => $this->request->getPost('employee_id'),
        'created_by' => session()->get('user_id') // Assuming you have user authentication
    ];

    $model = new MilkCollectionModel();
    $model->insert($data);

    // Redirect to a success page or back to the form with a success message
    return redirect()->to('milk-collection')->with('success', 'Milk collection added successfully.');
    $cowModel = new CowModel();
if (!$cowModel->find($this->request->getPost('cow_id'))) {
    // Handle error, e.g., redirect back to the form with an error message
    return redirect()->back()->with('error', 'Cow ID not found.');
}


}





}

?>