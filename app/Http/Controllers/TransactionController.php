<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transaction = NULL;

        // Validate data
        $validator = Validator::make($request->all(), [
            'hash' => 'required'
        ]);

        if (!$validator->fails()) {
            $data = $validator->valid();

            // Prepare URL
            $url = 'https://blockchain.info/rawtx/' . $data['hash'];

            // Blockchain API call
            $client = new Client();
            try {
                $response = $client->request('GET', $url);
                if ($response->getStatusCode() == 200) { // 200 OK
                    $transaction = json_decode($response->getBody(), true);
                } else {
                    $validator->errors()->add('hash', "Something went wrong");
                }
            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    $response = $e->getResponse();
                    $validator->errors()->add('hash', (string) $response->getBody());
                }
            }
        }

        return view('home', ['transaction' => $transaction])->withErrors($validator);
    }
}
