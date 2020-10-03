<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survivor;
use Illuminate\Support\Facades\DB;

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
        try {
            $survivor = $this->survivor->where('contaminated_count', '>=', 3)->get();
            return response()->json($survivor, 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Algo deu errado. Confira se as informações estão corretas!'], 400);
        }
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

        DB::beginTransaction();
        try {
            $survivor = $this->survivor->create($survivor);
            foreach ($items as $item) {
                $survivor->inventory()->attach([
                    $item['item_id'] => ['quantity' => $item['quantity']]
                ]);
            }
            DB::commit();
            return response()->json(['messagem' => 'Sobrevivente Cadastrado Com Sucesso!'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Algo deu errado. Confira se as informações estão corretas!'], 400);
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
        $location = $request->only(['latitude', 'longitude']);
        try {
            $this->survivor->find($id)->update($location);
            return response()->json(['messagem' => 'Localização Atualizada Com Sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Algo deu errado. Confira se as informações estão corretas!'], 400);
        }
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

    public function notifyInfected(Request $request, $id)
    {
        $notifier_id = $request->notifier_id ?? null;
        $notifications = new \App\Models\InfectedNotification();

        try {

            $notifier = $this->survivor->find($notifier_id);   // Poderia ser pego da sessão de tivesse autenticação! 
            $survivor = $this->survivor->find($id);


            if (is_null($notifier)) {
                return response()->json(['error' => 'OPS! Identifique primeiro.'], 404);
            }

            if (is_null($survivor)) {
                return response()->json(['error' => 'OPS! Não encontramos esse sobrevivente nos registros.'], 404);
            }

            $notifications = $notifications->where('infected_id', '=', $survivor->id)->where('notifier_id', '=', $notifier_id)->first();

            if (!is_null($notifications)) {
                return response()->json(['message' => 'Você já marcou esse sobrevivente como infectado!'], 200);
            }

            $notifier->notifications()->attach($survivor->id);
            $survivor->update(['contaminated_count' => ++$survivor->contaminated_count]);

            return response()->json(['message' => 'Você marcou ' . $survivor->name . ' como infectado!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Algo deu errado. Confira se as informações estão corretas!'], 400);
        }
    }
}
