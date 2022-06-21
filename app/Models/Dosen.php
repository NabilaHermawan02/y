<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_dosen';
    protected $primaryKey = 'nip';
    protected $fillable = ['nidn', 'nama', 'telpon', 'keahlian', 'username', 'password'];
}
