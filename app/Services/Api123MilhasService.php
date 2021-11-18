<?php
namespace App\Services;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\Http\Requests;
use Cache;

class Api123MilhasService
{
    private $request;
    private $prosseguir;
    private $urlApi;
    private $header;

    public function __construct(Request $request = null)
    {
        $this->urlApi = env('URL_API_FLIGHT');
        $this->client = new Client(['base_uri' => $this->urlApi]);
    }

    public function buscarVoos()
    {
        try
        {
            $response = $this->client->request('GET', 'flights');

            if ($response->getStatusCode() === 200) {
                return json_decode($response->getBody());
            }
        }
        catch (\Exception $e)
        {
            return abort(config('httpstatus.client_error.bad_request'), $e->getMessage());
        }
    }
}
