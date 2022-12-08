<?php

use GuzzleHttp\Client;

class Penelitian_Model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://iteung.poltekpos.ac.id/api/prodi-dosen/'
        ]);
    }

    public function getallkey()
    {
        $response = $this->_client->request('GET', 'sinta');
        $result = json_decode($response->getBody()->getContents(), true);
        return array_keys($result);
    }
    // and $var['Status Mahasiswa'] == $status
    public function getInfoPenelitianProdi($filterByProdi)
    {
        $response = $this->_client->request('GET', 'sinta');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result[$filterByProdi]['prodi'];
    }
    public function minmaxbase()
    {
        $response = $this->_client->request('GET', 'sinta');
        $result = json_decode($response->getBody()->getContents(), true);
        $prodi = $this->getallkey();

        for ($i = 0; $i < count($prodi); $i++) {
            $data[] = $result[$prodi[$i]]['prodi'];
        }
        return $data;
    }
    public function maxsinta3score()
    {
        $datamentah = $this->minmaxbase();
        $value = max(array_column($datamentah, 'sinta_score_3_years'));
        $sintascore = array_filter($datamentah, function ($var) use ($value) {
            return ($var['sinta_score_3_years'] == $value);
        });
        return $sintascore;
    }
    public function minsinta3score()
    {
        $datamentah = $this->minmaxbase();
        $value = min(array_column($datamentah, 'sinta_score_3_years'));
        $sintascore = array_filter($datamentah, function ($var) use ($value) {
            return ($var['sinta_score_3_years'] == $value);
        });
        return $sintascore;
    }
    public function maxsinta3scoreproductif()
    {
        $datamentah = $this->minmaxbase();
        $value = max(array_column($datamentah, 'sinta_score_3_years_productivity'));
        $sintaproductif = array_filter($datamentah, function ($var) use ($value) {
            return ($var['sinta_score_3_years_productivity'] == $value);
        });
        return $sintaproductif;
    }
    public function minsinta3scoreproductif()
    {
        $datamentah = $this->minmaxbase();
        $value = min(array_column($datamentah, 'sinta_score_3_years_productivity'));
        $sintaproductif = array_filter($datamentah, function ($var) use ($value) {
            return ($var['sinta_score_3_years_productivity'] == $value);
        });
        return $sintaproductif;
    }
    public function maxsintaoverall()
    {
        $datamentah = $this->minmaxbase();
        $value = max(array_column($datamentah, 'sinta_score_overall'));
        $sintaoverall = array_filter($datamentah, function ($var) use ($value) {
            return ($var['sinta_score_overall'] == $value);
        });
        return $sintaoverall;
    }
    public function minsintaoverall()
    {
        $datamentah = $this->minmaxbase();
        $value = min(array_column($datamentah, 'sinta_score_overall'));
        $sintaoverall = array_filter($datamentah, function ($var) use ($value) {
            return ($var['sinta_score_overall'] == $value);
        });
        return $sintaoverall;
    }
    // public function getProdiName()
    // {
    //     $array_base = $this->getallipkMhs();
    //     $namaProdi = array_unique(array_column($array_base, 'Nama Prodi'));
    //     $hasil = array_intersect_key($array_base, $namaProdi);
    //     return $hasil;
    // }
    // public function getAngkatan()
    // {
    //     $array_base = $this->getallipkMhs();
    //     $angkatan = array_unique(array_column($array_base, 'Angkatan'));
    //     $hasil = array_intersect_key($array_base, $angkatan);
    //     return $hasil;
    // }
}
