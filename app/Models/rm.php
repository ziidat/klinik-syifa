<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rm extends Model
{
    use HasFactory;
    protected $table = 'rm';
    protected $fillable = [
        'keluhan',
        'anamnesis',
        'cekfisik',
        'lab',
        'hasil',
        'diagnosis',
        'resep',
        'jumlah',
        'aturan',
        'dokter'];
    public $primarykey = 'id';
}
