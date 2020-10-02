<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survivor;

class SurvivorController extends Controller
{

    protected $survivor;

    function __construct(Survivor $survivor)
    {
        $this->survivor = $survivor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->survivor->find(1)->inventory()->get();
        return $this->survivor->isContaminated();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $survivor = $request->all() ?? null;

        $items = $survivor['items'];
        try {
            $survivor = $this->survivor->create($survivor);
            foreach ($items as $item) {
                $survivor->inventory()->attach([
                    $item['item_id'] => ['quantity' => $item['quantity']]
                ]);
            }
            return response()->json(['messagem' => 'Sobrevivente Cadastrado Com Sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
