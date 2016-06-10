<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class programas extends Model
{
	protected $table = 'programas';
    protected $fillable = ['nomprog','feini','fefin','notas'];
    protected $primaryKey = 'idprog';
}