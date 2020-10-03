<?php

namespace App\Http\Controllers;

use App\Models\Survivor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
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
    public function percentageSurvivors(Request $request)
    {
        $infected = $request->infected ?? 0;
        // ( $parcial * 100 ) / $total;



        try {
            //Legal é Criar Um Repository para separar a Persistencia do Controller 
            //mas vou deixar assim dessa vez
            $result =   $this->survivor->select(DB::raw('
            round(((select count(contaminated_count) from survivors where contaminated_count<3) * 
            100) / count(contaminated_count),2) infecteds,
            round(((select count(contaminated_count) from survivors where contaminated_count>=3) * 
            100) / count(contaminated_count),2) noInfecteds'))->first();

            if ($infected == 0) {
                $noInfecteds =  $result->noInfecteds;
                return response()->json(['count' => $noInfecteds], 200);
            }

            $infecteds = $result->infecteds;
            return response()->json(['count' => $infecteds], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Algo deu errado. Tente novamente mais tarde!'], 500);
        }
    }
}