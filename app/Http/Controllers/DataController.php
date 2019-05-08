<?php

namespace App\Http\Controllers;

use App\Data;
use App\Imports\DataImport;
use App\Mail\EventSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Importer;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DataController extends Controller
{
    private $importer;

    public function __construct(Importer $importer)
    {
        $this->importer = $importer;
    }

    public function import(Request $request){
        if ($request->hasFile('sheet')){
            $this->importer->import(new DataImport, $request->file('sheet'));
            return redirect('/data');
        }
    }

    public function sendQr(){
        foreach (Data::all()->where('is_sent_email', false) as $data){
            Mail::to($data)->send(new EventSent($data));
            $data->is_sent_email = true;
            $data->save();
        }
    }

    public function verify(Request $request, $uuid){
        try{
            $data = Data::whereUuid($uuid)->first();
            if (!$data || count($data) < 1){
                throw new HttpException(406, 'User ID Not Found');
            } else {
                throw new HttpException(200, $data);
            }
        } catch (HttpException $exception){
            if ($exception->getStatusCode() === 406){
                return response()->json([
                    'status' => $exception->getStatusCode(),
                    'message' => $exception->getMessage()
                ], $exception->getStatusCode());
            }
            return response()->json([
                'status' => $exception->getStatusCode(),
                'message' => 'Code verified successfully',
                'data' => json_decode($exception->getMessage())
            ]);
        }
    }
    //
}
