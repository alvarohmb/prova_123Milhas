<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voos;
use App\Http\Requests\VoosRequest;
use App\BO\VoosBO;
use OpenApi\Annotations AS OA;

class VoosController extends Controller
{
    private $return;
    private $code;
    private $message;

    /**
     * Set default values to return in
     */
    public function __construct()
    {
        $this->return  = false;
        $this->code    = config('httpstatus.success.ok');
        $this->message = null;
    }

    /**
     * @OA\Post(
     *     path="/listar-voos",
     *     tags={"ListarVoos"},
     *     security={{"bearer":{}}},
     *     description="Resultado da consulta na rota de voos da api 123milhas",
     *     @OA\RequestBody(ref="#components/requestBodies/listarVoos"),
     *     @OA\Response(response="200", ref="#components/responses/sucessoListarVoos")
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function listarVoos(VoosRequest $request)
    {
        $this->code = config('httpstatus.success.ok');
        $this->return = (new VoosBO())->listarVoos();

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao buscar base de voos";
        }

        return collection($this->return, $this->code, $this->message);
    }

    /**
     * @OA\Post(
     *     path="/agrupar-voos",
     *     tags={"AgruparVoos"},
     *     security={{"bearer":{}}},
     *     description="Resultado do agrupamento dos voos da api 123milhas",
     *     @OA\RequestBody(ref="#components/requestBodies/agruparVoos"),
     *     @OA\Response(response="200", ref="#components/responses/sucessoAgruparVoos")
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function agruparVoos()
    {
        $this->code = config('httpstatus.success.ok');
        $this->return = (new VoosBO())->agruparVoos();

        if (!$this->return)
        {
            $this->code    = config('httpstatus.server_error.internal_server_error');
            $this->message = "Erro ao agrupar voos";
        }

        return collection($this->return, $this->code, $this->message);
    }
}
