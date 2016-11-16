<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
//use Maatwebsite\Excel\ExcelServiceProvider;
//use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}
	public function getUserExcel(){
		$users = User::select('id', 'first_name', 'last_name','email', 'created_at')->get();

		Excel::create('users', function($excel) use($users) {
			$excel->sheet('Sheet 1', function($sheet) use($users) {
				$sheet->fromArray($users);
			});
		})->export('xls');
	}
	
}
