<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lab extends Model
{
    use HasFactory;
    protected $table = 'lab';
    protected $fillable = ['nama','satuan','nn','harga'];
    public $primarykey = 'id';
}
