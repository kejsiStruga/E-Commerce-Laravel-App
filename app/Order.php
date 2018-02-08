<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    public $cart = null, $user=0;
    public $address_id = null;
    public $payment_id = null;
    
    public function __construct($cart, $user)
    {
        if($cart)
        {
            $this->cart = $cart;
            $this->user = $user;
        }
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cart()
    {
        return $this->hasOne('App\Cart');
    }
}
