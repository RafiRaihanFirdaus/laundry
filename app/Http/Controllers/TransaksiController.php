<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Transaksi_model;
use App\Detail_model;
use Auth;
use DB;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id_pelanggan'=>'required',
            'id_petugas'=>'required',
            'tgl_transaksi'=>'required',
            'tgl_selesai'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),
            400);
        }else{
            $insert=Transaksi_model::insert([
                'id_pelanggan'=>$request->id_pelanggan,
                'id_petugas'=>$request->id_petugas,
                'tgl_transaksi'=>$request->tgl_transaksi,
                'tgl_selesai'=>$request->tgl_selesai
            ]);
            if($insert){
                $status="Sukses menambahkan data!";
            }else{
                $status="Gagal menambahkan data!";
            }
            return response()->json(compact('status'));
        }
    }

    public function tampil_transaksi(Request $req)
    {
        $transaksi=DB::table('transaksi')->join('pelanggan', 'pelanggan.id', 'transaksi.id_pelanggan')
                                         ->where('transaksi.tgl_transaksi','>=',$req->tgl_transaksi)
                                         ->where('transaksi.tgl_transaksi','<=',$req->tgl_selesai)
                                         ->select('nama_pelanggan','telp','alamat','transaksi.id','tgl_transaksi','tgl_selesai')
                                         ->get();

        if($transaksi->count() > 0){
            $data_transaksi = array();


        foreach ($transaksi as $t){
            $grand = DB::table('detail_transaksi')->where('id_transaksi','=',$t->id)
            ->groupBy('id_transaksi')
            ->select(DB::raw('sum(subtotal) as grandtotal'))
            ->first();

            $detail = DB::table('detail_transaksi')->join('jenis_cuci','detail_transaksi.id_jenis','=','jenis_cuci.id')
            ->where('id_transaksi','=',$t->id)
            ->get();

            $data_transaksi = array(
                'tgl' => $t->tgl_transaksi,
                'nama pelanggan' => $t->nama_pelanggan,
                'alamat' => $t->alamat,
                'telp' => $t->telp,
                'tanggal ambil' => $t->tgl_selesai,
                'grand total' => $grand,
                'detail' => $detail,
            );
        }
        return Response()->json($data_transaksi);
    }else{
        $status = 'tidak ada transaksi antara tanggal '.$req->tgl_transaksi.' sampai dengan tanggal'.$req->tgl_selesai;
        return response()->json(compact('status'));
    }
    }
}
