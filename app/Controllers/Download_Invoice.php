<?php

namespace App\Controllers;

use App\Models\SalesModel;
use TCPDF;

class Download_Invoice extends BaseController
{
    private $salesModel;

    public function __construct()
    {
        $this->salesModel = new SalesModel(); // Initialize SalesModel
    }

    public function generate($sale_id)
    {
        $sale = $this->salesModel->find($sale_id);

        if (!$sale) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Sale not found');
        }

        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);

        $pdf->Cell(0, 10, 'Milk Sale Invoice', 0, 1, 'C');
        foreach ($sale as $key => $value) {
            $pdf->Cell(50, 10, ucfirst(str_replace('_', ' ', $key)) . ':', 1);
            $pdf->Cell(0, 10, $value, 1, 1);
        }

        $pdf->Output('invoice_' . $sale_id . '.pdf', 'I');
    }
}


?>