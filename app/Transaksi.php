<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Transaksi extends Model
{
    protected $table = "transaksi";

    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = ['kdbarang', 'kode_unit', 'tanggal', 'status', 'jenistransaksi', 'tambah', 'kurang'];
}