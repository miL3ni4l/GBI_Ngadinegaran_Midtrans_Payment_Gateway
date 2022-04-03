<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailKategori extends Model
{
    protected $table = 'detail_kategori';

	protected $fillable = ['petugas_id','kategori_id','kategori','jenis', 'kode_kategori', 'keterangan'];

    public function user()
    {
        return $this->belongsTo('App\User','petugas_id');
    }
	public function petugas()
    {
    	return $this->belongsTo('App\Petugas','petugas_id');
    }
    public function nama_kategori()
    {
    	return $this->belongsTo('App\Kategori','kategori_id');
    }
    public function transaksi()
    {
    	return $this->hasManyThrough(Transaksi::class);
    }
    public function donasi()
    {
    	return $this->hasManyThrough(Donation::class);
    }
    public function pemasukan_khusus()
    {
    	return $this->hasManyThrough(PemasukanKhusus::class);
    }
	public function pengeluaran_khusus()
    {
    	return $this->hasManyThrough(PengeluaranKhusus::class);
    }
    public function detail_kategori()
    {
    	return $this->hasMany('App\DetailKategori');
    }
	
}
