<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class titucli extends Model
{
	protected $table = 'titucli';
    protected $fillable = ['idcli','idtit'];
    protected $primaryKey = 'idtitcli';
}
