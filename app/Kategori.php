<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

	protected $fillable = ['kategori','kode_kategori'];

	public function detail_kategori()
    {
    	return $this->hasMany('App\DetailKategori');
    }
	
}
