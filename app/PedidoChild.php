<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoChild extends Model
{
    protected $fillable = [
        "pedido_id",
        "pizza_id",
    ];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class, "pizza_id");
    }

}
