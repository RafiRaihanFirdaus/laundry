<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petugas_model extends Model
{
    protected $table="petugas";
    protected $primarykey="id_petugas";
    public $timestamps=false;

    protected $fillable = [
        'id_petugas',
        'nama_petugas',
        'telp',
        'username',
        'password',
        'level'

    ];
}
