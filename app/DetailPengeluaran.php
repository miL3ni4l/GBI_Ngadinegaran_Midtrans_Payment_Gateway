<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPengeluaran extends Model
{
    protected $table = 'detail_pengeluaran';

	protected $fillable = ['petugas_id','kategori_id','kategori', 'keterangan'];

	public function petugas()
    {
    	return $this->belongsTo('App\Petugas','petugas_id');
    }
    public function nama_kategori()
    {
    	return $this->belongsTo('App\KategoriPengeluaranRutin','kategori_id');
    }
    public function transaksi()
    {
    	return $this->hasManyThrough(Transaksi::class);
    }
    public function pemasukan_khusus()
    {
    	return $this->hasManyThrough(PemasukanKhusus::class);
    }
	public function pengeluaran_khusus()
    {
    	return $this->hasManyThrough(PengeluaranKhusus::class);
    }
    public function detail_pengeluaran()
    {
    	return $this->hasMany('App\DetailPengeluaran');
    }
    
	
}
