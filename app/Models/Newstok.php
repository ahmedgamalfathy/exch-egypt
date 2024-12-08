<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Guard;

class Newstok extends Model
{
    protected $table = "news";
    protected $guarded=[];
    public function stok()
    {
        return $this->belongsTo(Stok::class,'stok_id');
    }
}
