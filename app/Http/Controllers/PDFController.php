<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//use Barryvdh\DomPDF\Facade;

class PDFController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}
	public function getPDF(){
		$pdf = PDF::loadView('pdf.invoice', $data);
		return $pdf->download('invoice.pdf');
	}
}
