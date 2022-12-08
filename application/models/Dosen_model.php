<?php

use GuzzleHttp\Client;

class Dosen_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://iteung.poltekpos.ac.id/api/dosen/'
        ]);
    }

    public function getalldosen()
    {
        $response = $this->_client->request('GET', 'sks');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }
}
