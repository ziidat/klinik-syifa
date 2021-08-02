<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obat extends Model
{
    use HasFactory;
    protected $table = 'obat';
    protected $fillable = ['nama','jenis','dosis','satuan','stok','harga'];
    public $primarykey = 'id';
}
