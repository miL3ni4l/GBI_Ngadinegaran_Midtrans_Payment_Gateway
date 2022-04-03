<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ibadah extends Model
{
    protected $table = "ibadah";

	protected $fillable = ["kode_ibadah","ibadah","keterangan"];

	public function pemasukan_rutins()
    {
    	return $this->hasMany(pemasukan_rutin::class);
    }
    public function pemasukan_rutin()
    {
    	return $this->hasManyThrough(PemasukanRutin::class);
    }
	
}
