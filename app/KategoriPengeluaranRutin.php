<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriPengeluaranRutin extends Model
{
    protected $table = 'kategori_pengeluaran_rutin';

	protected $fillable = ['kode_kategori','kategori'];

	public function detail_pengeluaran()
    {
    	return $this->hasMany('App\DetailPengeluaran');
    }
     
	
}
