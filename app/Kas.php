<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = "kas";

	protected $fillable = ["kas","keterangan"];


	public function transaksi()
    {
    	return $this->hasMany(Transaksi::class);
    }
    public function pemasukan_khusus()
    {
    	return $this->hasManyThrough(PemasukanKhusus::class);
    }
    public function pengeluaran_khusus()
    {
    	return $this->hasManyThrough(PengeluaranKhusus::class);
    }
	
}
