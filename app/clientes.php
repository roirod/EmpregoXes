<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
	protected $table = 'clientes';
    protected $fillable = ['nomcli','apecli','dni','naf','email','tel1','tel2','tel3','sexo','direc','pobla','fenac','notas'];
    protected $primaryKey = 'idcli';
}
