<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extlog extends Model
{
    //
    protected $table = 'extlog';
    protected $guarded = [];

    public function setTargetAttribute($target){
        $this->attributes['target'] = $target ?: null;
        }
}
