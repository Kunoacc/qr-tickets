<?php

namespace App\Http\Controllers;

use App\Data;
use App\Imports\DataImport;
use App\Mail\EventSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Importer;

class DataController extends Controller
{
    private $importer;

    public function __construct(Importer $importer)
    {
        $this->importer = $importer;
    }

    public function import(Request $request){
        if ($request->hasFile('sheet')){
            if (Data::all()->count() > 0){
                Data::truncate();
            }
            $this->importer->import(new DataImport, $request->file('sheet'));
            return redirect('/data');
        }
    }

    public function sendQr(){
        foreach (Data::all() as $data){
            Mail::to($data)->send(new EventSent($data));
        }
    }
    //
}
