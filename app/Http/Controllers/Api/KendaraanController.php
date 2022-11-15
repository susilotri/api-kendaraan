<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class KendaraanController extends Controller
{
    //
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index(){
        $data = Kendaraan::all();

        return response()->json([$data], 200);
    }
    public function store(Request $request){

        $kendaraan = Kendaraan::create([
            "tahun" => $request->tahun,
            "warna" => $request->warna,
            "harga" => $request->harga,
            "stock" => $request->stok,
            "type" => $request->tipe
        ]);

        return response()->json($kendaraan, 200);
    }

    public function find(Request $request){
        $data = Kendaraan::where('type.kendaraan', 'LIKE', '%'.$request->kendaraan.'%')->get();

        return response()->json($data, 200);
    }

    public function sell(Request $request){
        $kendaraan = Kendaraan::find($request->id);
        if($kendaraan):
            $kendaraan->stock = ((int)$kendaraan->stock - (int)$request->qty);
            $kendaraan->save();
            Kendaraan::create([
                "type" => 'Penjualan',
                "kendaraan" => $request->id,
                "qty" => $request->qty
            ]);
        endif;

        return response()->json($kendaraan, 200);
    }

    public function report(Request $request){
        $kendaraan = Kendaraan::find($request->id)->where('type', 'Penjualan')->get();

        return response()->json($kendaraan, 200);
    }

}
