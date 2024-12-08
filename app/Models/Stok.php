<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $guarded=[];
    protected $table="stoks";
    public function news()
    {
     return $this->hasMany(Newstok::class,"stok_id");
    }
    public function getBuyPriceAttribute()
    {
        return number_format($this->closing_price_today * 0.95, 2); // 5% تحت سعر الإغلاق اليومي
    }
    public function getSellPriceAttribute()
    {
        return number_format($this->closing_price_today * 1.05, 2); // 5% فوق سعر الإغلاق اليومي
    }
}
