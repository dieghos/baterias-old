<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function dependence()
    {
        return $this->belongsTo('App\Dependence');
    }

    public function products(){
        return $this->belongsToMany('App\Product', 'order_detail')
        ->withPivot(['quantity']);
    }

}
