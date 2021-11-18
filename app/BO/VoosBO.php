<?php
namespace App\BO;

use App\Services\Api123MilhasService;

class VoosBO
{
    private $voos;
    private $voosAgrupadosPorTarifa;
    private $maisBarato = ['id' => null,'preco' => 99];
    private $voosVolta;
    private $voosIda;
    private $arrRetorno;

    public function listarVoos()
    {
        return (new Api123MilhasService())->buscarVoos();
    }

    public function agruparVoos()
    {
        $this->voos = collect($this->listarVoos());
        $this->voosAgrupadosPorTarifa = $this->voos->groupBy('fare');

        return $this->agruparVoosPorTipoVooEPreco();
    }

    private function agruparVoosPorTipoVooEPreco()
    {
        $grupos         = collect();
        $maisBarato=(object)['idGrupo'=>null,'preco'=>999];

        $value = null;
        $this->voosAgrupadosPorTarifa->each(
            function($voos) use($grupos, $maisBarato)
            {
                $voosVolta  =  $voos->where('inbound',1)->groupBy('price');
                $voosIda    =  $voos->where('outbound',1)->groupBy('price');

                $voosVolta->map(function($voosVolta) use ($grupos,$voosIda,$maisBarato)
                {
                    $voosIda->map(function($voosIda) use ($grupos,$voosVolta,$maisBarato)
                    {
                        $id=uniqid();
                        $total = $voosVolta->first()->price+$voosIda->first()->price;

                        $grupos->add([
                            'uniqueId'=>$id,
                            'totalPrice'=>$total,
                            'inbounds'=>$voosVolta,
                            'outbounds'=>$voosIda
                        ]);

                        if($maisBarato->preco > $total)
                        {
                            $maisBarato->idGrupo    =   $id;
                            $maisBarato->preco      =   $total;
                        }
                    });
                });
            }
        );

        return [
            'flights'=>$this->voos,
            'groups'=>$grupos->sortBy('totalPrice'),
            'totalGroups'=>$grupos->count(),
            'totalFlights'=>$this->voos->count(),
            'cheapestPrice'=>$maisBarato->preco,
            'cheapestGroup'=>$maisBarato->idGrupo,
        ];
    }
}
