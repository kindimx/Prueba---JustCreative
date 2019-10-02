<?php

use App\Pizza;
use Illuminate\Database\Seeder;

class PizzasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Pizza::create([
            'nombre' => "Hawaiana",
            'tamaño' => 1,
            'img'    => 'hawaiana.png',
            'precio' => 99,
        ]);

        Pizza::create([
            'nombre' => "Hawaiana",
            'tamaño' => 2,
            'img'    => 'hawaiana.png',
            'precio' => 129,
        ]);

        Pizza::create([
            'nombre' => "Hawaiana",
            'tamaño' => 3,
            'img'    => 'hawaiana.png',
            'precio' => 200,
        ]);

        Pizza::create([
            'nombre' => "Pepperoni",
            'tamaño' => 1,
            'img'    => 'peperoni.png',
            'precio' => 99,
        ]);

        Pizza::create([
            'nombre' => "Pepperoni",
            'tamaño' => 2,
            'img'    => 'peperoni.png',
            'precio' => 129,
        ]);

        Pizza::create([
            'nombre' => "Pepperoni",
            'tamaño' => 3,
            'img'    => 'peperoni.png',
            'precio' => 200,
        ]);

        Pizza::create([
            'nombre' => "Mexicana",
            'tamaño' => 1,
            'img'    => 'mexicana.png',
            'precio' => 99,
        ]);

        Pizza::create([
            'nombre' => "Mexicana",
            'tamaño' => 2,
            'img'    => 'mexicana.png',
            'precio' => 129,
        ]);

        Pizza::create([
            'nombre' => "Mexicana",
            'tamaño' => 3,
            'img'    => 'mexicana.png',
            'precio' => 200,
        ]);

    }
}
