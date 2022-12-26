<?php

use GuzzleHttp\Client;

class Penelitian_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://iteung.poltekpos.ac.id/api/prodi-dosen/'
        ]);
    }

    public function basedata()
    {
        $response = $this->_client->request('GET', 'sinta');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
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
    public function countCitationBase()
    {
        $response = $this->_client->request('GET', 'sinta');
        $result = json_decode($response->getBody()->getContents(), true);
        $prodi = $this->getallkey();

        for ($i = 0; $i < count($prodi); $i++) {
            $data[] = $result[$prodi[$i]]['dosen'];
        }
        return $data;
    }
    public function countCitation()
    {

        $database = $this->minmaxbase();
        $datamentah = $this->countCitationBase();
        // $count_result = array_filter($datamentah, function ($var) use ($value) {
        //     return ($var['gscholar_citation'] == $value);
        // });
        for ($i = 0; $i < count($datamentah); $i++) {
            $maxcitasiprodi = max(array_column($datamentah[$i], 'gscholar_citation'));
            $mincitasiprodi = min(array_column($datamentah[$i], 'gscholar_citation'));
            $citasi_dosen_up[] = array_values(array_filter($datamentah[$i], function ($var) use ($maxcitasiprodi) {
                return ($var['gscholar_citation'] == $maxcitasiprodi);
            }));
            $citasi_dosen_down[] = array_values(array_filter($datamentah[$i], function ($var) use ($mincitasiprodi) {
                return ($var['gscholar_citation'] == $mincitasiprodi);
            }));

            $nama_dosen = $citasi_dosen_up;
            $data[] = array(
                'total_gscholar_citation_prodi' => array_sum(array_column($datamentah[$i], 'gscholar_citation')),
                'authors' => $database[$i]['authors'],
                'max_citasi_prodi' =>  $maxcitasiprodi,
                'min_citasi_prodi' =>  $mincitasiprodi,
                'max_citasi_prodi_nama_dosen' => $nama_dosen[$i][0]['nama'],
                'max_citasi_prodi_per_dosen' =>  max(array_column($datamentah[$i], 'gscholar_citation')),
                'min_citasi_prodi_nama_dosen' => $citasi_dosen_down[$i][0]['nama'],
                'min_citasi_prodi_per_dosen' =>  min(array_column($datamentah[$i], 'gscholar_citation')),
                'id' => $database[$i]['id'],
                'nama' => $database[$i]['nama'],
                'sinta_score_3_years' => $database[$i]['sinta_score_3_years'],
                'sinta_score_3_years_productivity' => $database[$i]['sinta_score_3_years_productivity'],
                'sinta_score_overall' => $database[$i]['sinta_score_overall'],
                'sinta_score_overall_productivity' => $database[$i]['sinta_score_overall_productivity'],
            );
        }
        for ($i = 0; $i < count($nama_dosen); $i++) {
            $nama[] = array(
                'nama_dosen' => $nama_dosen[$i][0]['nama'],
                'nama' => $database[$i]['nama'],

            );
        }

        return $data;
    }
    public function mincitation()
    {
        $datamentah = $this->countCitation();
        $value = min(array_column($datamentah, 'total_gscholar_citation_prodi'));
        $sintascore = array_filter($datamentah, function ($var) use ($value) {
            return ($var['total_gscholar_citation_prodi'] == $value);
        });
        return $sintascore;
    }
    public function maxciation()
    {
        $datamentah = $this->countCitation();
        $value = max(array_column($datamentah, 'total_gscholar_citation_prodi'));
        $sintascore = array_filter($datamentah, function ($var) use ($value) {
            return ($var['total_gscholar_citation_prodi'] == $value);
        });
        return $sintascore;
    }
    public function maxciation_dosen()
    {
        $datamentah = $this->countCitation();
        $value = max(array_column($datamentah, 'max_citasi_prodi_per_dosen'));
        $sintascore = array_filter($datamentah, function ($var) use ($value) {
            return ($var['max_citasi_prodi_per_dosen'] == $value);
        });
        return $sintascore;
    }
    public function minciation_dosen()
    {
        $datamentah = $this->countCitation();
        $value = min(array_column($datamentah, 'max_citasi_prodi_per_dosen'));
        $sintascore = array_filter($datamentah, function ($var) use ($value) {
            return ($var['max_citasi_prodi_per_dosen'] == $value);
        });
        return $sintascore;
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
