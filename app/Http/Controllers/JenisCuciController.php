<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\JenisCuci_model;
use Auth;

class JenisCuciController extends Controller
{
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'nama_jenis'=>'required',
            'harga_per_kilo'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),
            400);
        }else{
            $insert=JenisCuci_model::insert([
                'nama_jenis'=>$request->nama_jenis,
                'harga_per_kilo'=>$request->harga_per_kilo
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
            'nama_jenis'=>'required',
            'harga_per_kilo'=>'required'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=JenisCuci_model::where('id', $id)->update([
            'nama_jenis'=>$req->nama_jenis,
            'harga_per_kilo'=>$req->harga_per_kilo
        ]);
        if($ubah){
            return Response()->json(['status'=>'Data berhasil diubah!']);
        }else{
            return Response()->json(['status'=>'Data gagal diubah!']);
        }
    }
    public function destroy($id)
    {
        $hapus=JenisCuci_model::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'Data berhasil dihapus!']);
        }else{
            return Response()->json(['status'=>'Data gagal dihapus!']);
        }
    }


    public function tampil_jenis()
    {
        $data_jenis=JenisCuci_model::get();
        return Response()->json($data_jenis);
    }
}
