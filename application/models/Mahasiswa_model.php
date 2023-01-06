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
        return json_decode($response->getBody()->getContents(), true)['data'];
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
            return ($var['ID Prodi'] == $filterByProdi);
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

        return array($data1, $data2, $data3, $data4);
    }
    public function array_multidimensional_unique($input)
    {
        $output = array_map(
            "unserialize",
            array_unique(array_map("serialize", $input))
        );
        return $output;
    }

    public function maxIpkAll($ankatan)
    {
        $array_base = $this->getallipkMhs();
        // $maxipk = max(array_column($array_base, 'IPK'));
        // $ang2021 = array_filter($array_base, function ($var) use ($ankatan) {
        //     return ($var['Angkatan'] == $ankatan);
        // });
        // $namaProdi = array_values(array_unique(array_column($ang2021, 'Nama Prodi')));
        // $hasil = array_intersect_key($array_base, $namaProdi);
        if ($ankatan == '2019' || $ankatan == '2018') {

            $d3mp = 'D3 Manajemen Pemasaran';
            $d4mp = 'D4 Manajemen Perusahaan';
            $d4lb = 'D4 Logistik Bisnis';
            $D3ak = 'D3 Akuntansi';
            $D3al = 'D3 Administrasi Logistik';
            $D4ak = 'D4 Akuntansi Keuangan';
            $D3mi = 'D3 Manajemen Informatika';
            $d4ti = 'D4 Teknik Informatika';
            $d3ti = 'D3 Teknik Informatika';

            // 1. get max ipk for prodi d3 manajemen pemasaran
            $arrayd3mp = array_filter($array_base, function ($var) use ($d3mp, $ankatan) {
                return ($var['Nama Prodi'] == $d3mp and $var['Angkatan'] == $ankatan);
            });

            $maxd3mp = max(array_column($arrayd3mp, 'IPK'));
            $arrayd3mpmaxipk = array_filter($arrayd3mp, function ($var) use ($maxd3mp) {
                return ($var['IPK'] == $maxd3mp);
            });
            $prodid3mp = array_values($arrayd3mpmaxipk)[0];

            // 2. get max ipk for prodi d4 manajemen pemasaran
            $arrayd4mp = array_filter($array_base, function ($var) use ($d4mp, $ankatan) {
                return ($var['Nama Prodi'] == $d4mp and $var['Angkatan'] == $ankatan);
            });

            $maxd4mp = max(array_column($arrayd4mp, 'IPK'));
            $arrayd4mpmaxipk = array_filter($arrayd4mp, function ($var) use ($maxd4mp) {
                return ($var['IPK'] == $maxd4mp);
            });
            $prodid4mp = array_values($arrayd4mpmaxipk)[0];

            // 3. get max ipk for prodi d4 logistik bisnis
            $arrayd4lb = array_filter($array_base, function ($var) use ($d4lb, $ankatan) {
                return ($var['Nama Prodi'] == $d4lb and $var['Angkatan']);
            });

            $maxd4lb = max(array_column($arrayd4lb, 'IPK'));
            $arrayd4lbmaxipk = array_filter($arrayd4lb, function ($var) use ($maxd4lb) {
                return ($var['IPK'] == $maxd4lb);
            });
            $prodid4lb = array_values($arrayd4lbmaxipk)[0];

            // 4. get max ipk for prodi d3 akutansi
            $arrayd3ak = array_filter($array_base, function ($var) use ($D3ak, $ankatan) {
                return ($var['Nama Prodi'] == $D3ak and $var['Angkatan'] == $ankatan);
            });

            $maxd3ak = max(array_column($arrayd3ak, 'IPK'));
            $arrayd3akmaxipk = array_filter($array_base, function ($var) use ($maxd3ak) {
                return ($var['IPK'] == $maxd3ak);
            });
            $prodid3ak = array_values($arrayd3akmaxipk)[0];


            // 5. get max ipk for prodi D3 Administrasi Logistik
            $arrayd3al = array_filter($array_base, function ($var) use ($D3al, $ankatan) {
                return ($var['Nama Prodi'] == $D3al and $var['Angkatan'] == $ankatan);
            });

            $maxd3al = max(array_column($arrayd3al, 'IPK'));
            $arrayd3almaxipk = array_filter($arrayd3al, function ($var) use ($maxd3al) {
                return ($var['IPK'] == $maxd3al);
            });
            $prodid3al = array_values($arrayd3almaxipk)[0];


            // 6. get max ipk for prodi d3 manajemen informatika
            $arrayD3mi = array_filter($array_base, function ($var) use ($D3mi, $ankatan) {
                return ($var['Nama Prodi'] == $D3mi and $var['Angkatan'] == $ankatan);
            });

            $maxD3mi = max(array_column($arrayD3mi, 'IPK'));
            $arrayD3mimaxipk = array_filter($array_base, function ($var) use ($maxD3mi) {
                return ($var['IPK'] == $maxD3mi);
            });
            $prodid3mi = array_values($arrayD3mimaxipk)[0];


            // 7. get max ipk for prodi d4 teknik informat4ti
            $arrayd4ti = array_filter($array_base, function ($var) use ($d4ti, $ankatan) {
                return ($var['Nama Prodi'] == $d4ti and $var['Angkatan'] == $ankatan);
            });

            $maxd4ti = max(array_column($arrayd4ti, 'IPK'));
            $arrayd4timaxipk = array_filter($arrayd4ti, function ($var) use ($maxd4ti) {
                return ($var['IPK'] == $maxd4ti);
            });
            $prodid4ti = array_values($arrayd4timaxipk)[0];


            // 9. get max ipk for prodi D3 Teknik Informatiti
            $arrayd3ti = array_filter($array_base, function ($var) use ($d3ti, $ankatan) {
                return ($var['Nama Prodi'] == $d3ti and $var['Angkatan'] == $ankatan);
            });

            $maxd3ti = max(array_column($arrayd3ti, 'IPK'));
            $arrayd3timaxipk = array_filter($arrayd3ti, function ($var) use ($maxd3ti) {
                return ($var['IPK'] == $maxd3ti);
            });
            $prodid3ti = array_values($arrayd3timaxipk)[0];


            // 10. get max ipk for prodi D4 Akuntasi Keuangan
            $arrayd4ak = array_filter($array_base, function ($var) use ($D4ak, $ankatan) {
                return ($var['Nama Prodi'] == $D4ak and $var['Angkatan'] == $ankatan);
            });

            $maxd4ak = max(array_column($arrayd4ak, 'IPK'));
            $arrayd4akmaxipk = array_filter($arrayd4ak, function ($var) use ($maxd4ak) {
                return ($var['IPK'] == $maxd4ak);
            });
            $prodid4ak = array_values($arrayd4akmaxipk)[0];

            $hasil = array($prodid3ak, $prodid3al, $prodid3mi, $prodid3mp, $prodid3ti, $prodid4lb, $prodid4mp, $prodid4ti, $prodid4ak);
        } else {
            $d4ln = 'D4 Logistik Niaga';
            $d3mp = 'D3 Manajemen Pemasaran';
            $d4mp = 'D4 Manajemen Perusahaan';
            $d4lb = 'D4 Logistik Bisnis';
            $D3ak = 'D3 Akuntansi';
            $D3al = 'D3 Administrasi Logistik';
            $D4ak = 'D4 Akuntansi Keuangan';
            $D3mi = 'D3 Manajemen Informatika';
            $d4ti = 'D4 Teknik Informatika';
            $d3ti = 'D3 Teknik Informatika';

            // 1. get max ipk for prodi d3 manajemen pemasaran
            $arrayd3mp = array_filter($array_base, function ($var) use ($d3mp, $ankatan) {
                return ($var['Nama Prodi'] == $d3mp and $var['Angkatan'] == $ankatan);
            });

            $maxd3mp = max(array_column($arrayd3mp, 'IPK'));
            $arrayd3mpmaxipk = array_filter($arrayd3mp, function ($var) use ($maxd3mp) {
                return ($var['IPK'] == $maxd3mp);
            });
            $prodid3mp = array_values($arrayd3mpmaxipk)[0];

            // 2. get max ipk for prodi d4 manajemen pemasaran
            $arrayd4mp = array_filter($array_base, function ($var) use ($d4mp, $ankatan) {
                return ($var['Nama Prodi'] == $d4mp and $var['Angkatan'] == $ankatan);
            });

            $maxd4mp = max(array_column($arrayd4mp, 'IPK'));
            $arrayd4mpmaxipk = array_filter($arrayd4mp, function ($var) use ($maxd4mp) {
                return ($var['IPK'] == $maxd4mp);
            });
            $prodid4mp = array_values($arrayd4mpmaxipk)[0];

            // 3. get max ipk for prodi d4 logistik bisnis
            $arrayd4lb = array_filter($array_base, function ($var) use ($d4lb, $ankatan) {
                return ($var['Nama Prodi'] == $d4lb and $var['Angkatan']);
            });

            $maxd4lb = max(array_column($arrayd4lb, 'IPK'));
            $arrayd4lbmaxipk = array_filter($arrayd4lb, function ($var) use ($maxd4lb) {
                return ($var['IPK'] == $maxd4lb);
            });
            $prodid4lb = array_values($arrayd4lbmaxipk)[0];

            // 4. get max ipk for prodi d3 akutansi
            $arrayd3ak = array_filter($array_base, function ($var) use ($D3ak, $ankatan) {
                return ($var['Nama Prodi'] == $D3ak and $var['Angkatan'] == $ankatan);
            });

            $maxd3ak = max(array_column($arrayd3ak, 'IPK'));
            $arrayd3akmaxipk = array_filter($array_base, function ($var) use ($maxd3ak) {
                return ($var['IPK'] == $maxd3ak);
            });
            $prodid3ak = array_values($arrayd3akmaxipk)[0];


            // 5. get max ipk for prodi D3 Administrasi Logistik
            $arrayd3al = array_filter($array_base, function ($var) use ($D3al, $ankatan) {
                return ($var['Nama Prodi'] == $D3al and $var['Angkatan'] == $ankatan);
            });

            $maxd3al = max(array_column($arrayd3al, 'IPK'));
            $arrayd3almaxipk = array_filter($arrayd3al, function ($var) use ($maxd3al) {
                return ($var['IPK'] == $maxd3al);
            });
            $prodid3al = array_values($arrayd3almaxipk)[0];


            // 6. get max ipk for prodi d3 manajemen informatika
            $arrayD3mi = array_filter($array_base, function ($var) use ($D3mi, $ankatan) {
                return ($var['Nama Prodi'] == $D3mi and $var['Angkatan'] == $ankatan);
            });

            $maxD3mi = max(array_column($arrayD3mi, 'IPK'));
            $arrayD3mimaxipk = array_filter($array_base, function ($var) use ($maxD3mi) {
                return ($var['IPK'] == $maxD3mi);
            });
            $prodid3mi = array_values($arrayD3mimaxipk)[0];


            // 7. get max ipk for prodi d4 teknik informat4ti
            $arrayd4ti = array_filter($array_base, function ($var) use ($d4ti, $ankatan) {
                return ($var['Nama Prodi'] == $d4ti and $var['Angkatan'] == $ankatan);
            });

            $maxd4ti = max(array_column($arrayd4ti, 'IPK'));
            $arrayd4timaxipk = array_filter($arrayd4ti, function ($var) use ($maxd4ti) {
                return ($var['IPK'] == $maxd4ti);
            });
            $prodid4ti = array_values($arrayd4timaxipk)[0];


            // 9. get max ipk for prodi D3 Teknik Informatiti
            $arrayd3ti = array_filter($array_base, function ($var) use ($d3ti, $ankatan) {
                return ($var['Nama Prodi'] == $d3ti and $var['Angkatan'] == $ankatan);
            });

            $maxd3ti = max(array_column($arrayd3ti, 'IPK'));
            $arrayd3timaxipk = array_filter($arrayd3ti, function ($var) use ($maxd3ti) {
                return ($var['IPK'] == $maxd3ti);
            });
            $prodid3ti = array_values($arrayd3timaxipk)[0];


            // 10. get max ipk for prodi D4 Akuntasi Keuangan
            $arrayd4ak = array_filter($array_base, function ($var) use ($D4ak, $ankatan) {
                return ($var['Nama Prodi'] == $D4ak and $var['Angkatan'] == $ankatan);
            });

            $maxd4ak = max(array_column($arrayd4ak, 'IPK'));
            $arrayd4akmaxipk = array_filter($arrayd4ak, function ($var) use ($maxd4ak) {
                return ($var['IPK'] == $maxd4ak);
            });
            $prodid4ak = array_values($arrayd4akmaxipk)[0];

            // 8. get max ipk for prodi D4 Logisti Ni4ln
            $arrayd4ln = array_filter($array_base, function ($var) use ($d4ln, $ankatan) {
                return ($var['Nama Prodi'] == $d4ln and $var['Angkatan'] == $ankatan);
            });

            $maxd4ln = max(array_column($arrayd4ln, 'IPK'));
            $arrayd4lnmaxipk = array_filter($arrayd4ln, function ($var) use ($maxd4ln) {
                return ($var['IPK'] == $maxd4ln);
            });
            $prodid4ln = array_values($arrayd4lnmaxipk)[0];

            $hasil = array($prodid3ak, $prodid3al, $prodid3mi, $prodid3mp, $prodid3ti, $prodid4lb, $prodid4ln, $prodid4mp, $prodid4ti, $prodid4ak);
        }




        return $hasil;
    }

    public function maxipkAktif($status, $tahun)
    {

        $array_base = $this->getallipkMhs();
        $mhsAktif = array_filter($array_base, function ($var) use ($status, $tahun) {
            return ($var['Status Mahasiswa'] == $status and $var['Angkatan'] == $tahun);
        });
        if ($mhsAktif != null) {
            // $value = max(array_column($mhsAktif, 'IPK'));
            $value = '3.000000';
            $maxIPK = array_filter($mhsAktif, function ($var) use ($value) {
                return ($var['IPK'] > $value);
            });
        } else {
            $maxIPK = array(
                'IPK' => 0,
                'Nama Prodi' => 'Tidak Ada Mahasiswa Aktif',
                'Nama Mahasiswa' => 'Tidak Ada Mahasiswa Aktif Angkatan ' . $tahun
            );
        }
        return $maxIPK;
    }
    public function maxipkLulus($status, $tahun)
    {

        $array_base = $this->getallipkMhs();
        $mhsLulus = array_filter($array_base, function ($var) use ($status, $tahun) {
            return ($var['Status Mahasiswa'] == $status and $var['Angkatan'] == $tahun);
        });
        if ($mhsLulus != null) {
            $value = max(array_column($mhsLulus, 'IPK'));
            // $value = 3;
            $maxIPK = array_filter($mhsLulus, function ($var) use ($value) {
                return ($var['IPK'] == $value);
            });
        } else {
            $maxIPK = array(
                'IPK' => 0,
                'Nama Prodi' => 'Belum Ada Lulusan',
                'Nama Mahasiswa' => 'Belum Ada Mahasiswa Lulus Ankatan ' . $tahun
            );
        }
        return $maxIPK;
    }

    public function minipkAktif($status, $tahun)
    {
        $array_base = $this->getallipkMhs();
        $mhsAktif = array_filter($array_base, function ($var) use ($status, $tahun) {
            return ($var['Status Mahasiswa'] == $status and $var['Angkatan'] == $tahun);
        });
        if ($mhsAktif != null) {
            $value = min(array_column($mhsAktif, 'IPK'));
            $minIPK = array_filter($mhsAktif, function ($var) use ($value) {
                return ($var['IPK'] == $value);
            });
        } else {
            $minIPK = array(
                'IPK' => 0,
                'Nama Prodi' => 'Tidak Ada Mahasiswa Aktif',
                'Nama Mahasiswa' => 'Tidak Ada Mahasiswa Aktif Angkatan ' . $tahun
            );
        }
        return $minIPK;
    }
    public function minipkLulus($status, $tahun)
    {
        $array_base = $this->getallipkMhs();
        $mhsLulus = array_filter($array_base, function ($var) use ($status, $tahun) {
            return ($var['Status Mahasiswa'] == $status and $var['Angkatan'] == $tahun);
        });
        if ($mhsLulus != null) {
            $value = min(array_column($mhsLulus, 'IPK'));
            $minIPK = array_filter($mhsLulus, function ($var) use ($value) {
                return ($var['IPK'] == $value);
            });
        } else {
            $minIPK = array(
                'IPK' => 0,
                'Nama Prodi' => 'Belum Ada Lulusan',
                'Nama Mahasiswa' => 'Belum Ada Mahasiswa Lulus Ankatan ' . $tahun
            );
        }
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

    public function mhsAktifCount($filterByProdi, $status)
    {
        $angakatan2018 = '2018';
        $angakatan2019 = '2019';
        $angakatan2020 = '2020';
        $angakatan2021 = '2021';
        $array_base = $this->getallipkMhs();
        $new = array_filter($array_base, function ($var) use ($filterByProdi, $status) {
            return ($var['ID Prodi'] == $filterByProdi and $var['Status Mahasiswa'] == $status);
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
        $datapertumbuhan = array(
            '2018' => array('angkatan' => $angakatan2018, 'jumlahmhs' => count($ang2018), 'status' => $status),
            '2019' => array('angkatan' => $angakatan2019, 'jumlahmhs' => count($ang2019), 'status' => $status),
            '2020' => array('angkatan' => $angakatan2020, 'jumlahmhs' => count($ang2020), 'status' => $status),
            '2021' => array('angkatan' => $angakatan2021, 'jumlahmhs' => count($ang2021), 'status' => $status)
        );
        return array_values($datapertumbuhan);
    }
}
