<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DataController extends Controller
{
    public function index(){
        $data = Data::all();
        return view('welcome', ['data' => $data]);
    }
    public function store(Request $request){
        $data = new Data;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->save();
        return back();
    }
    public function generate ($id)
    {
        $data = Data::findOrFail($id);
        $qrcode = QrCode::size(400)->generate($data->email);
        return view('qrcode',compact('qrcode'));
    }
}
