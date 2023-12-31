<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class TallyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        // Create a Guzzle client instance
        $client = new Client();

        // Define the API endpoint
        $url = 'http://127.0.0.1:9000/';
        $xmlData = '<ENVELOPE>

        <HEADER>

               <VERSION>1</VERSION>

               <TALLYREQUEST>EXPORT</TALLYREQUEST>

               <TYPE>COLLECTION</TYPE>
               <ID >List of Groups</ID>

        </HEADER>

        <BODY>

        <DESC>

            <STATICVARIABLES>
            <SVEXPORTFORMAT>$$SysName:HTML</SVEXPORTFORMAT>
            </STATICVARIABLES>
        </DESC>
        </BODY>

 </ENVELOPE>'; // Your XML data here

        try {
            // Send a POST request with XML data
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/html',
                ],
                'body' => $xmlData,
            ]);

            // Get response body or other data if needed
            $body = $response->getBody();
            return $body;
            // $xml = simplexml_load_string( $body );

            // // Convert SimpleXMLElement to JSON
            // $json = json_encode($xml);
            // $data = json_decode($json);
            // foreach($data->BODY->DATA->COLLECTION->LEDGER  as $key=> $item){
            //     echo $item->{'LANGUAGENAME.LIST'}->{'NAME.LIST'}->NAME;
            // }
            // Return JSON response
            //return dd($data->body);
           // return $data->BODY->DATA->COLLECTION->LEDGER;

            // Process the response as needed
        } catch (GuzzleHttp\Exception\RequestException $e) {
            // Handle exceptions if the request fails
            echo 'Request failed: ' . $e->getMessage();
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
