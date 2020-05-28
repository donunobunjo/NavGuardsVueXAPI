<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['item','quantity','price','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
