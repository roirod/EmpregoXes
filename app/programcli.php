<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class programcli extends Model
{
	protected $table = 'programcli';
    protected $fillable = ['idcli','idprog','idesp','feini','fefin','notas'];
    protected $primaryKey = 'idprocli';
}