<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Barang extends Model
{
    //

        protected $primaryKey = 'kode';
    public $incrementing =false;

    public function kat(){
    	return $this->belongsTo('App\Kategori','kategori');

    }

    public function rua(){
        return $this->belongsTo('App\Ruangan','ruangan');
    }

}
