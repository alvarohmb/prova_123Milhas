<?php
namespace App\BO;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\VoosRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Voos;


use Illuminate\Support\Facades\Storage;
use Log;

use App\Services\Api123MilhasService;

class VoosBO
{
    private $prosseguir;
    private $voos;
    private $voosAgrupadosPorTipoTarifa;
    private $request;
    private $indiceRetorno = 0;
    private $arrRetorno;
    private $retorno;

    public function listarVoos()
    {
        return (new Api123MilhasService())->buscarVoos();
    }

    public function agruparVoos()
    {
        $this->voos = (new Api123MilhasService())->buscarVoos();
        $arrVoosPorTarifa = [];

        if($this->voos)
        {
            $this->prosseguir = true;

            $this->agruparVoosPorTipoDeTarifa()
                 ->agruparVoosPorPreco()
                 ->traitDadosParaRetorno()
                 ;

            return $this->retorno;
        }
    }

    private function agruparVoosPorTipoDeTarifa()
    {
        if($this->prosseguir)
        {
            $this->prosseguir = false;
            foreach($this->voos as $voo)
            {
                !(isset($arrVoosPorTarifa[$voo->fare])) ? $arrVoosPorTarifa[$voo->fare] = [] : '';
                $arrVoosPorTarifa[$voo->fare][] = $voo;
            }
            $this->voosAgrupadosPorTipoTarifa = $arrVoosPorTarifa;
            $this->prosseguir = true;
        }
        return $this;
    }

    private function agruparVoosPorPreco()
    {
        if($this->prosseguir && count($this->voosAgrupadosPorTipoTarifa) > 0)
        {
            $this->prosseguir = false;

            foreach($this->voosAgrupadosPorTipoTarifa as $VooPorTarifa)
            {
                $this->montarGrupos($VooPorTarifa);
            }

            $this->prosseguir = true;
        }

        return $this;
    }

    private function montarGrupos($arrVoosPorTarifa)
    {
        $tarifa = $arrVoosPorTarifa[0]->fare;
        $arrVoosOrganizado = $this->organizarArrayPorTipoVoo($arrVoosPorTarifa);
        $arrVoosOrganizado = $this->organizarArrayPorValores($arrVoosOrganizado,$tarifa);
        return $this;
    }

    private function organizarArrayPorTipoVoo($arrVoosPorTarifa)
    {
        foreach( $arrVoosPorTarifa as $arr)
        {
            $arr->outbound
                ? $voosIda[] = [ 'id_voo' => $arr->id, 'preco' => $arr->price ]
                : $voosVolta[] = [ 'id_voo' => $arr->id, 'preco' => $arr->price ];
        }

        $arrayRetorno = [
            'ida' => $voosIda,
            'volta' => $voosVolta
        ];
        return $arrayRetorno;
    }

    private function organizarArrayPorValores($arrVoosOrganizado, $tarifa)
    {
        foreach( $arrVoosOrganizado['volta'] as $dadosVolta )
        {
            $valor = 0;
            $arrIda = [];
            foreach($arrVoosOrganizado['ida'] as $dadosIda )
            {
                if($valor == 0)
                {
                    $valor = $dadosVolta['preco']+$dadosIda['preco'];
                    $arrIda[] = 'Voo - '.$dadosIda['id_voo'];
                }
                else
                {
                    if($dadosVolta['preco']+$dadosIda['preco'] == $valor)
                    {
                        $arrIda[] = 'Voo - '.$dadosIda['id_voo'];
                    }
                }
            }

            $this->arrRetorno[$this->indiceRetorno] = [
                'tarifa' => $tarifa,
                'valorTotal' => $valor,
                'idas' => $arrIda,
                'voltas' => ['Voo - '.$dadosVolta['id_voo']]
            ];
            $this->indiceRetorno++;
        }
        return $this->arrRetorno;
    }

    private function traitDadosParaRetorno()
    {
        if($this->prosseguir)
        {
            $this->indiceRetorno = 1;
            $this->prosseguir = false;

            $retorno = [];
            $retorno['flights'] = $this->voos;
            $arrGrupos = $this->agruparArrayPorValor();

            foreach($arrGrupos as $grupo)
            {
                $arr=[];
                $arr['uniqueId'] = $this->indiceRetorno++;
                $arr['totalPrice'] = $grupo['valorTotal'];
                $arr['outbound'] = $grupo['idas'];
                $arr['inbound'] = $grupo['voltas'];
                $retorno['groups'][] = $arr;
            }

            $retorno['totalGroups'] = count($arrGrupos);
            $retorno['totalFlights'] = count($this->voos);
            $retorno['cheapestPrice'] = $retorno['groups'][0]['totalPrice'];
            $retorno['cheapestGroup'] = $retorno['groups'][count($arrGrupos)-1]['totalPrice'];

            $this->retorno = $retorno;
            $this->prosseguir = true;
        }
        return $this;
    }

    private function agruparArrayPorValor($v = null)
    {
        $arrGrupos = [];
        foreach($this->arrRetorno as $arr )
        {
            $valor = $arr['valorTotal'];
            $tipoTarifa = $arr['tarifa'];
            foreach($this->arrRetorno as $arr2)
            {
                if( ($tipoTarifa == $arr2['tarifa']) && ($valor == $arr2['valorTotal']) )
                {
                    $key = array_search($arr2['voltas'][0], $arr['voltas']);
                    if($key === false)
                    {
                        $arr['voltas'][] = $arr2['voltas'][0];
                    }
                }
            }
            $arrGrupos[$valor] = $arr;
        }
        return $arrGrupos;
    }
}
