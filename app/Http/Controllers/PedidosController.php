<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\PedidoChild;
use Auth;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {

        //$pedidos = Pedido::all();
        $pedidos = Pedido::with('usuario', "hijos")->with('hijos.pizza')->get();

        return response()->json(['pedidos' => $pedidos]);

    }

    public function store(Request $request)
    {

        $items = $request->data["items"];
        $total = $request->data["total"];

        try {

            \DB::beginTransaction();

            $crearPedido = Pedido::create([
                "numero"  => uniqid(),
                "total"   => $total,
                "user_id" => Auth::id(),
            ]);

            foreach ($items as $key => $item) {
                PedidoChild::create([
                    "pedido_id" => $crearPedido->id,
                    "pizza_id"  => $item["id"],
                ]);
            }

            \DB::commit();

            $op      = true;
            $err_msg = null;

        } catch (\Exception $e) {

            \DB::rollback();

            $op      = false;
            $err_msg = $e;

        }

        return response()->json(['registro' => $op, 'err_msg' => $err_msg]);
    }
}
