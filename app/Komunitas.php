<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komunitas extends Model
{
   
    protected $table = "komunitas";
	protected $fillable = ["nama_komunitas","deskripsi", "pj","kontak", "status", "cover"];
}
