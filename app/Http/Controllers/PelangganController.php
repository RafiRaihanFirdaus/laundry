<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Pelanggan_model;
use Auth;

class PelangganController extends Controller
{
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'nama_pelanggan'=>'required',
            'alamat'=>'required',
            'telp'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),
            400);
        }else{
            $insert=Pelanggan_model::insert([
                'nama_pelanggan'=>$request->nama_pelanggan,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp
            ]);
            if($insert){
                $status="Sukses menambahkan data!";
            }else{
                $status="Gagal menambahkan data!";
            }
            return response()->json(compact('status'));
        }
    }

    public function update($id,Request $req)
    {
        $validator=Validator::make($req->all(),
        [
            'nama_pelanggan'=>'required',
            'alamat'=>'required',
            'telp'=>'required'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=Pelanggan_model::where('id', $id)->update([
            'nama_pelanggan'=>$req->nama_pelanggan,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp
        ]);
        if($ubah){
            return Response()->json(['status'=>'Data berhasil diubah!']);
        }else{
            return Response()->json(['status'=>'Data gagal diubah!']);
        }
    }
    public function destroy($id)
    {
        $hapus=Pelanggan_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'Data berhasil dihapus!']);
        }else{
            return Response()->json(['status'=>'Data gagal dihapus!']);
        }
    }

    public function tampil_pelanggan()
    {
        $data_pelanggan=Pelanggan_model::get();
        return Response()->json($data_pelanggan);
    }
}
