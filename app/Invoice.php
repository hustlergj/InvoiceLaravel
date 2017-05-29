<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    protected $fillable = ['inv_name', 'inv_item', 'sub_total', 'tax', 'total'];

    public function item()
    {
    	return $this->hasMany(Item::class);
    }
}
