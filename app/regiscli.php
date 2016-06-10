<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class regiscli extends Model
{
	protected $table = 'regiscli';
    protected $fillable = ['idcli','idasu','fech','notas'];
    protected $primaryKey = 'idregcli';
}