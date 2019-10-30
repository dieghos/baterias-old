<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependence extends Model
{
    protected $fillable = ['code','name'];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}
