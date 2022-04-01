<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ibadah extends Model
{
    protected $table = "ibadah";

	protected $fillable = ["kode_ibadah","ibadah","keterangan"];

	public function transaksi()
    {
    	return $this->hasMany(Transaksi::class);
    }
    public function pemasukan_rutin()
    {
    	return $this->hasManyThrough(PemasukanRutin::class);
    }
	
}
