<?php
namespace App\Http\Controllers\Annotations;

use OpenApi\Annotations AS OA;

trait VoosAnnotations
{
    /**
    * @OA\Response(
    *     response="sucessoListarVoos",
    *     description="Serão disponibilizadas as rotas da api123milhas",
    *     @OA\JsonContent(
    *        @OA\Property(
    *            property="data",
    *            @OA\Property(property="id", type="number"),
    *            @OA\Property(property="cia", type="string"),
    *            @OA\Property(property="fare", type="string"),
    *            @OA\Property(property="flightNumber", type="string"),
    *            @OA\Property(property="origin", type="string"),
    *            @OA\Property(property="destination", type="string"),
    *            @OA\Property(property="departureDate", type="string"),
    *            @OA\Property(property="arrivalDate", type="string"),
    *            @OA\Property(property="departureTime", type="string"),
    *            @OA\Property(property="arrivalTime", type="string"),
    *            @OA\Property(property="classService", type="number"),
    *            @OA\Property(property="price", type="number"),
    *            @OA\Property(property="tax", type="number"),
    *            @OA\Property(property="outbound", type="boolean"),
    *            @OA\Property(property="inbound", type="boolean"),
    *            @OA\Property(property="duration", type="string")
    *       ),
    *        @OA\Property(property="message",type="string"),
    *     )
    * ),
    */

    /**
    * @OA\Response(
    *     response="sucessoAgruparVoos",
    *     description="Será disponibilizo o retorno do desafio",
    *     @OA\JsonContent(
    *        @OA\Property(
    *            property="data",
    *            @OA\Property(
    *                property="flights",
    *                type="array",
    *                @OA\Items(
    *                   @OA\Property(property="id", type="number"),
    *                   @OA\Property(property="cia", type="string"),
    *                   @OA\Property(property="fare", type="string"),
    *                   @OA\Property(property="flightNumber", type="string"),
    *                   @OA\Property(property="origin", type="string"),
    *                   @OA\Property(property="destination", type="string"),
    *                   @OA\Property(property="departureDate", type="string"),
    *                   @OA\Property(property="arrivalDate", type="string"),
    *                   @OA\Property(property="departureTime", type="string"),
    *                   @OA\Property(property="arrivalTime", type="string"),
    *                   @OA\Property(property="classService", type="number"),
    *                   @OA\Property(property="price", type="number"),
    *                   @OA\Property(property="tax", type="number"),
    *                   @OA\Property(property="outbound", type="boolean"),
    *                   @OA\Property(property="inbound", type="boolean"),
    *                   @OA\Property(property="duration", type="string")
    *                )
    *            ),
    *            @OA\Property(
    *                property="groups",
    *                type="array",
    *                @OA\Items(
    *                    @OA\Property(property="uniqueId", type="number"),
    *                    @OA\Property(property="totalPrice", type="number"),
    *                    @OA\Property(
    *                        property="outbound",
    *                        type="array",
    *                        @OA\Items(
    *                            @OA\Property(property="Voo", type="string")
    *                        )
    *                    ),
    *                    @OA\Property(
    *                        property="inbound",
    *                        type="array",
    *                        @OA\Items(
    *                            @OA\Property(property="Voo", type="string")
    *                        )
    *                    ),
    *                )
    *            ),
    *            @OA\Property(property="totalGroups", type="number"),
    *            @OA\Property(property="totalFlights", type="number"),
    *            @OA\Property(property="cheapestPrice", type="number"),
    *            @OA\Property(property="cheapestGroup", type="number")
    *       ),
    *        @OA\Property(property="message",type="string"),
    *     )
    * ),
    */

}
