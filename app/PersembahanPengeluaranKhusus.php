<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersembahanPengeluaranKhusus extends Model
{
	protected $table = "persembahan_pengeluaran_khusus";
	protected $dates = ['tanggal'];

	protected $fillable = ["nama_pengguna","kode_persembahan_pengeluaran_khusus", "tanggal","kategori_id","cover","nominal","status","keterangan"];

	public function detail_kategori()
	{
		return $this->belongsTo('App\DetailKategori','kategori_id');
	}

	public function user()
    {
       return $this->belongsTo(User::class);
    }

	public function kategori_pengeluaran()
	{
		return $this->belongsTo('App\DetailPengeluaran','detail_pengeluaran');
	}
}
