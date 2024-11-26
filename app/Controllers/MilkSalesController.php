<?php
namespace App\Controllers;

use App\Models\MilkCollectionModel;
use App\Models\CowModel;
use App\Models\UserModel;
use App\Models\SalesModel;

class MilkSalesController extends BaseController
{

    public function index()
    {
        $salesModel = new SalesModel();
        $sales = $salesModel->findAll();
        $userModel = new UserModel();
        $user = $userModel->asObject()
        ->where('username', session()->get('username'))
        ->orWhere('email', session()->get('email'))
        ->first();
    
    
        return view('layout', ['content' => view('pages/milk_sales', ['user' => $user,'sales' => $sales])]);
    }

    public function addSale()
{
    // Validation rules
    $rules = [
        'sale_type' => 'required|in_list[wholesale,retail]',
        'animal_id' => 'required|integer',
        'sale_date' => 'required|valid_date',
        'quantity_liters' => 'required|numeric',
        'price_per_liter' => 'required|numeric',
        'buyer_name' => 'required',
        'invoice_number' => 'required',
        'payment_status' => 'required|in_list[pending,partially_paid,fully_paid]'
    ];

    if (!$this->validate($rules)) {
        return view('milk_sales', ['validation_errors' => $this->validator->listErrors()]);
    }

    $data = [
        'sale_type' => $this->request->getPost('sale_type'),
        'animal_id' => $this->request->getPost('animal_id'),
        'sale_date' => $this->request->getPost('sale_date'),
        'quantity_liters' => $this->request->getPost('quantity_liters'),
        'price_per_liter' => $this->request->getPost('price_per_liter'),
        'total_sale_price' => $this->request->getPost('quantity_liters') * $this->request->getPost('price_per_liter'),
        'buyer_name' => $this->request->getPost('buyer_name'),
        'invoice_number' => $this->request->getPost('invoice_number'),
        'payment_status' => $this->request->getPost('payment_status'),
        'created_by' => session()->get('user_id') // Assuming you have user authentication
    ];

    $salesModel = new SalesModel();
    $salesModel->insert($data);

    return redirect()->to('milk-sales')->with('success', 'Sale added successfully.');
}


}

?>