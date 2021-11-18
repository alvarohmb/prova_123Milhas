<?php
namespace App\Http\Requests;

use App\Http\Requests\CustomRulesRequest;

class VoosRequest extends CustomRulesRequest
{
    /**
     * @return  Array
     */
    public function validateToListarVoos(): Array
    {
        return [
            //
        ];
    }

    /**
     * @return  Array
     */
    public function validateToAgruparVoos(): Array
    {
        return [
            //
        ];
    }
}
