<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class clientes extends Model
{
    use SoftDeletes;

	protected $table = 'clientes';
	protected $dates = ['deleted_at'];
    protected $fillable = ['nomcli','apecli','dni','naf','email','tel1','tel2','tel3','sexo','direc','pobla','fenac','notas'];
    protected $primaryKey = 'idcli';
}
