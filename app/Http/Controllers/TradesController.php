<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Survivor;



class TradesController extends Controller
{

    protected $items;
    protected $survivor;


    function __construct(Items $items, Survivor $survivor)
    {
        $this->items = $items;
        $this->survivor = $survivor;
    }


      public function negotiate(Request $request)
    {
        $firstSurvivor = $request->firstSurvivor ?? null;
        $secondSurvivor = $request->secondSurvivor ?? null;

       $firstSurvivorItems = $firstSurvivor['items'];
        $secondSurvivorItems = $secondSurvivor['items'];
        
        $firstSurvivor = $this->survivor->find($firstSurvivor->id);
   
        foreach ($firstSurvivorItems as $item) {

            if($firstSurvivor->inventory()->item) {}


            $firstSurvivor->inventory()->attach([
                $item['item_id'] => ['quantity' => $item['quantity']]
            ]);
        }
        

        return 'Hello oi!';
    }
}
