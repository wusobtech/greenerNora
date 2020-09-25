<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestPDF extends Controller
{
    public function generate(){
        return view('pdf.demo');
    }
}
