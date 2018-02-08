<?php
namespace App;

class Cart
{
    public $images = null, $totQuantity=0, $totPrice=0;

    public function __construct($c)
    {
        if($c)
        {
            $this->images = $c->images;
            $this->totQuantity = $c->totQuantity;
            $this->totPrice = $c->totPrice;
        }
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function addImage($image)
    {
        $cartImage  = ['qty' => 0, 'price'=>$image->price, 'image'=>$image];
        if($this->images)
        {
            if(array_key_exists($image->id, $this->images))
            {
                $cartImage = $this->images[$image->id];
            }
        }
        $cartImage['qty']++;
        $cartImage['price'] = $image->price * $cartImage['qty'];
        $this->images[$image->id] = $cartImage;
        $this->totQuantity++;
        $this->totPrice += $image->price;
    }

    public function decreaseQty($id)
    {
        // qty of that item
        $this->images[$id]['qty']--;
        $this->images[$id]['price'] -= $this->images[$id]['image']['price'];
        $this->totQuantity--;
        $this->totPrice -= $this->images[$id]['image']['price'];

        if($this->images[$id]['qty']<=0)
        {
            unset($this->images[$id]);
        }
    } 

    
    public function increaseQty($id)
    {
        // qty of that item
        $this->images[$id]['qty']++;
        $this->images[$id]['price'] += $this->images[$id]['image']['price'];
        $this->totQuantity++;
        $this->totPrice += $this->images[$id]['image']['price'];
    } 

    public function removeImage($id) 
    {
        //  unset and adjust the totals
        $this->totQuantity -= $this->images[$id]['qty'];
        $this->totPrice -= $this->images[$id]['price'];
        unset($this->images[$id]);
    }
}