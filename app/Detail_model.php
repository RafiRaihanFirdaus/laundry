<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_model extends Model
{
    protected $table="detail_transaksi";
    protected $primarykey="id";
    public $timestamps=false;
}
