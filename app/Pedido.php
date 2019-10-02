<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        "numero",
        "total",
        "user_id",
    ];

    public function hijos()
    {
        return $this->hasMany(PedidoChild::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
