<?php

use GuzzleHttp\Client;

class Mahasiswa_model extends CI_Model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'https://iteung.poltekpos.ac.id/api/mahasiswa/'
        ]);
    }

    public function getallipkMhs()
    {
        $response = $this->_client->request('GET', 'ipk');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }
    // and $var['Status Mahasiswa'] == $status
    public function getipkbyprodi($filterByProdi)
    {
        $angakatan2018 = '2018';
        $angakatan2019 = '2019';
        $angakatan2020 = '2020';
        $angakatan2021 = '2021';
        $array_base = $this->getallipkMhs();
        $new = array_filter($array_base, function ($var) use ($filterByProdi) {
            return ($var['Nama Prodi'] == $filterByProdi);
        });
        $ang2018 = array_filter($new, function ($var) use ($angakatan2018) {
            return ($var['Angkatan'] == $angakatan2018);
        });

        $ang2019 = array_filter($new, function ($var) use ($angakatan2019) {
            return ($var['Angkatan'] == $angakatan2019);
        });

        $ang2020 = array_filter($new, function ($var) use ($angakatan2020) {
            return ($var['Angkatan'] == $angakatan2020);
        });

        $ang2021 = array_filter($new, function ($var) use ($angakatan2021) {
            return ($var['Angkatan'] == $angakatan2021);
        });


        $data1 = array_reduce($ang2018, function ($a, $b) {
            return @$a['IPK'] > $b['IPK'] ? $a : $b;
        });

        $data2 = array_reduce($ang2019, function ($a, $b) {
            return @$a['IPK'] > $b['IPK'] ? $a : $b;
        });

        $data3 = array_reduce($ang2020, function ($a, $b) {
            return @$a['IPK'] > $b['IPK'] ? $a : $b;
        });

        $data4 = array_reduce($ang2021, function ($a, $b) {
            return @$a['IPK'] > $b['IPK'] ? $a : $b;
        });

        $hasil = array($data1, $data2, $data3, $data4);
        return $hasil;
    }

    public function maxIpkAll($ankatan)
    {
        $array_base = $this->getallipkMhs();
        $ang2021 = array_filter($array_base, function ($var) use ($ankatan) {
            return ($var['Angkatan'] == $ankatan);
        });
        $namaProdi = array_unique(array_column($ang2021, 'Nama Prodi'));
        $hasil = array_intersect_key($array_base, $namaProdi);
        return $hasil;
    }

    public function maxipkAktif($status, $tahun)
    {

        $array_base = $this->getallipkMhs();
        $mhsAktif = array_filter($array_base, function ($var) use ($status, $tahun) {
            return ($var['Status Mahasiswa'] == $status and $var['Angkatan'] == $tahun);
        });
        $value = max(array_column($mhsAktif, 'IPK'));
        $maxIPK = array_filter($mhsAktif, function ($var) use ($value) {
            return ($var['IPK'] == $value);
        });
        return $maxIPK;
    }
    public function maxipkLulus($status, $tahun)
    {

        $array_base = $this->getallipkMhs();
        $mhsAktif = array_filter($array_base, function ($var) use ($status, $tahun) {
            return ($var['Status Mahasiswa'] == $status and $var['Angkatan'] == $tahun);
        });
        $value = max(array_column($mhsAktif, 'IPK'));
        $maxIPK = array_filter($mhsAktif, function ($var) use ($value) {
            return ($var['IPK'] == $value);
        });
        return $maxIPK;
    }

    public function minipkAktif($status, $tahun)
    {
        $array_base = $this->getallipkMhs();
        $mhsAktif = array_filter($array_base, function ($var) use ($status, $tahun) {
            return ($var['Status Mahasiswa'] == $status and $var['Angkatan'] == $tahun);
        });
        $value = min(array_column($mhsAktif, 'IPK'));
        $minIPK = array_filter($mhsAktif, function ($var) use ($value) {
            return ($var['IPK'] == $value);
        });
        return $minIPK;
    }
    public function minipkLulus($status, $tahun)
    {
        $array_base = $this->getallipkMhs();
        $mhsAktif = array_filter($array_base, function ($var) use ($status, $tahun) {
            return ($var['Status Mahasiswa'] == $status and $var['Angkatan'] == $tahun);
        });
        $value = min(array_column($mhsAktif, 'IPK'));
        $minIPK = array_filter($mhsAktif, function ($var) use ($value) {
            return ($var['IPK'] == $value);
        });
        return $minIPK;
    }

    public function getProdiName()
    {
        $array_base = $this->getallipkMhs();
        $namaProdi = array_unique(array_column($array_base, 'Nama Prodi'));
        $hasil = array_intersect_key($array_base, $namaProdi);
        return $hasil;
    }
    public function getAngkatan()
    {
        $array_base = $this->getallipkMhs();
        $angkatan = array_unique(array_column($array_base, 'Angkatan'));
        $hasil = array_intersect_key($array_base, $angkatan);
        return $hasil;
    }
}
