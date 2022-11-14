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
        $kendaraan = new Kendaraan();
        $kendaraan->tahun = $request->tahun;
        $kendaraan->warna = $request->warna;
        $kendaraan->harga = $request->harga;
        $kendaraan->tipe = $request->tipe;
        $kendaraan->stock = $request->stok;
        $kendaraan->save();

        return response()->json([$kendaraan], 200);
    }

    public function find(Request $request){
        $data = Kendaraan::where('tipe.motor', 'LIKE', '%'.$request->search.'%')->get();

        return response()->json([$data], 200);
    }

    public function penjualan(Request $request){

    }
}
