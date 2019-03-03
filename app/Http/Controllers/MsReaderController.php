<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MsReaderController extends Controller
{
    //
    public function index(){

      $doc_url = \request('p');


        return view('msreader.index',compact('doc_url'));
    }
}
