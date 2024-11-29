<?php

namespace App\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;


use App\Models\SalesModel;
use App\Models\UserModel;

class MilkSalesController extends BaseController
{
    private $salesModel; // Declare the model property

    public function __construct()
    {
        // Initialize the SalesModel
        $this->salesModel = new SalesModel();
    }

    public function index()
    {
        $sales = $this->salesModel->findAll();
        $userModel = new UserModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();

        return view('layout', [
            'content' => view('pages/milk_sales', [
                'user' => $user,
                'sales' => $sales,
            ]),
        ]);
    }

    public function addSale()
    {
        $rules = [
            'sale_type' => 'required|in_list[wholesale,retail]',
            'animal_id' => 'required|integer',
            'sale_date' => 'required|valid_date',
            'quantity_liters' => 'required|numeric',
            'price_per_liter' => 'required|numeric',
            'buyer_name' => 'required',
            'invoice_number' => 'required',
            'payment_status' => 'required|in_list[pending,partially_paid,fully_paid]',
        ];

        if (!$this->validate($rules)) {
            return view('pages/add_sale', ['validation_errors' => $this->validator->getErrors()]);
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
            'created_by' => session()->get('user_id'),
        ];

        $this->salesModel->insert($data);

        return redirect()->to('milk-sales')->with('success', 'Sale added successfully.');
    }

    public function editSale($id)
    {
        $sale = $this->salesModel->find($id);

        if (!$sale) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Sale not found');
        }

        return view('pages/edit_sale', ['sale' => $sale]);
    }

    public function updateSale($id)
    {
        $rules = [
            'sale_type' => 'required|in_list[wholesale,retail]',
            'animal_id' => 'required|integer',
            'sale_date' => 'required|valid_date',
            'quantity_liters' => 'required|numeric',
            'price_per_liter' => 'required|numeric',
            'buyer_name' => 'required',
            'invoice_number' => 'required',
            'payment_status' => 'required|in_list[pending,partially_paid,fully_paid]',
        ];

        if (!$this->validate($rules)) {
            return view('pages/edit_sale', ['validation_errors' => $this->validator->listErrors()]);
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
        ];

        $this->salesModel->update($id, $data);

        return redirect()->to('milk-sales')->with('success', 'Sale updated successfully.');
    }

    public function deleteSale($id)
    {
        $this->salesModel->delete($id);

        return redirect()->to('milk-sales')->with('success', 'Sale deleted successfully.');
    }

    public function download_invoice($sale_id) {
        // Fetch sale data from the database
        $sale = $this->salesModel->find($sale_id);
    
        if (!$sale) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Sale not found.');
        }
    
        // Create HTML content with all relevant fields
        $html = "<h1>Invoice</h1>";
        $html .= "<p><strong>Invoice Number:</strong> " . $sale['invoice_number'] . "</p>";
        $html .= "<p><strong>Sale Type:</strong> " . $sale['sale_type'] . "</p>";
        $html .= "<p><strong>Animal ID:</strong> " . $sale['animal_id'] . "</p>";
        $html .= "<p><strong>Sale Date:</strong> " . date('Y-m-d', strtotime($sale['sale_date'])) . "</p>";
        $html .= "<p><strong>Quantity (liters):</strong> " . $sale['quantity_liters'] . "</p>";
        $html .= "<p><strong>Price per Liter:</strong> " . $sale['price_per_liter'] . "</p>";
        $html .= "<p><strong>Total Sale Price:</strong> " . $sale['sale_price'] . "</p>";
        $html .= "<p><strong>Customer Name:</strong> " . $sale['buyer_name'] . "</p>";
        $html .= "<p><strong>Payment Status:</strong> " . $sale['payment_status'] . "</p>";
    
        // Initialize DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
    
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
    
        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
    
        // Render PDF (first pass)
        $dompdf->render();
    
        // Output the generated PDF (force download)
        $dompdf->stream('invoice_' . $sale_id . '.pdf', array("Attachment" => 1));
    }
            }
