<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan_model extends Model
{
    protected $table="pelanggan";
    protected $primarykey="id";
    public $timestamps=false;
}
