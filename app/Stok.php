<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;



class Stok extends Model
{
    //
    public function barang(){
    	return $this->belongsTo('App\Barang','kode_barang');
    }
}
