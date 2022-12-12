<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penelitian_Model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Dosen_model');
    }

    public function index()
    {

        $data['judul'] = 'Dashboard';
        $data['judul_halaman'] = 'WELCOME TO <strong>DEKANAT</strong> DASHBOARD';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('index');
        $this->load->view('templates/footer');
    }

    public function penelitian()
    {
        $data['judul'] = 'Penelitian';
        $data['judul_halaman'] = 'Penelitian Dosen';
        $data['maxsinta3score'] = $this->Penelitian_Model->maxsinta3score();
        $data['minsinta3score'] = $this->Penelitian_Model->minsinta3score();
        $data['maxsinta3scoreproductif'] = $this->Penelitian_Model->maxsinta3scoreproductif();
        $data['minsinta3scoreproductif'] = $this->Penelitian_Model->minsinta3scoreproductif();
        $data['general'] = $this->Penelitian_Model->minmaxbase();
        $data['category'] = array_keys($data['general'][0]);


        $nama_prodi = $this->input->post('prodi');
        $dataCategory = $this->input->post('category');
        if ($dataCategory == null) {
            $dataCategory = 'sinta_score_3_years';
        } else {
            $dataCategory = $dataCategory;
        }
        foreach ($data['general'] as $keyword) {
            $datageneralarray[] = array($keyword[$dataCategory], $keyword["nama"]);
        }
        if ($nama_prodi == null) {
            $nama_prodi = 'D3 Akuntansi';
        } else {
            $nama_prodi = $nama_prodi;
        }
        $data['chartall'] = $datageneralarray;
        $data["nama_prodi"] = $this->Penelitian_Model->getInfoPenelitianProdi($nama_prodi);
        $data['key'] = $this->Penelitian_Model->getallkey();
        if ($nama_prodi == null) {
            $data['LabelCart'] = 'Silahkan Pilih Program Studi Terlebih dahulu';
        } else {
            $data['LabelCart'] = 'Penelitian Dosen dari Prodi ' . $nama_prodi;
        }
        $data['labelchartall'] = 'Perbandingan Jumlah Total Nilai ' . $dataCategory . ' Dari Penellitian';
        // echo "<pre>";
        // // var_dump($this->Penelitian_Model->minmaxbase());
        // var_dump($datageneralarray);
        // echo "<pre>";
        // die;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('content/penelitian', $data);
        $this->load->view('templates/footer', $data);
    }

    public function mahasiswa()
    {
        $nama_prodi = $this->input->post('prodi');
        $angkatan = $this->input->post('angkatan');
        $tahun = $this->input->post('tahun');
        $status_mhs = 'Aktif';
        $data['judul'] = 'Mahasiswa';
        $data['judul_halaman'] = 'Grafik IPK Tertinggi Prodi Dari Setiap Angkatan';
        $data["nama_prodi"] = $this->Mahasiswa_model->getProdiName();
        $data["angkatan"] = $this->Mahasiswa_model->getAngkatan();
        if ($angkatan == null) {
            $angkatan = '2021';
        } else {
            $angkatan = $angkatan;
        }
        if ($nama_prodi == null) {
            $data['LabelCart'] = 'Silahkan Pilih Program Studi Terlebih dahulu';
        } else {
            $data['LabelCart'] = 'Perkembangan IPK Tertinggi Prodi ' . $nama_prodi;
        }
        if ($tahun == null) {
            $tahun = '2021';
        }
        $data['LabelCartall'] = 'Ipk Tertinggi Dari Semua Prodi Angkatan ' . $angkatan;
        $data["ipk"] = $this->Mahasiswa_model->getipkbyprodi($nama_prodi, $status_mhs);
        $data['maxipkallprodi'] = $this->Mahasiswa_model->maxIpkAll($angkatan);
        $data['maxIpkAktif'] = $this->Mahasiswa_model->maxipkAktif('Aktif', $tahun);
        $data['maxIpkLulus'] = $this->Mahasiswa_model->maxipkLulus('Lulus', $tahun);
        $data['minIPKaktif'] = $this->Mahasiswa_model->minipkAktif('Aktif', $tahun);
        $data['minIPKlulus'] = $this->Mahasiswa_model->minipkLulus('Lulus', $tahun);
        // echo "<pre>";
        // var_dump($data["ipk"][0]);
        // echo "<pre>";
        // die;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('templates/topbar');
        $this->load->view('content/mahasiswa', $data);
        $this->load->view('templates/footer', $data);
    }

    public function minipkaktif()
    {
        $data['minIPKaktif'] = $this->Mahasiswa_model->minipkAktif('Aktif');
        $data['judul'] = 'IPK Terendah';
        $data['judul_halaman'] = 'Mahasiswa Aktif Dengan IPK Terendah';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('templates/topbar');
        $this->load->view('content/minIpkAktif', $data);
        $this->load->view('templates/footer', $data);
    }
    public function minipklulus()
    {
        $data['minIPKlulus'] = $this->Mahasiswa_model->minipkLulus('Lulus');
        $data['judul'] = 'IPK Terendah';
        $data['judul_halaman'] = 'Lulusan Dengan IPK Terendah';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('templates/topbar');
        $this->load->view('content/minIpkLulus', $data);
        $this->load->view('templates/footer', $data);
    }
    public function maxipkAktif()
    {
        $data['maxIpkAktif'] = $this->Mahasiswa_model->maxipkAktif('Aktif');
        $data['judul'] = 'IPK Tertinggi';
        $data['judul_halaman'] = 'Mahasiswa Aktif Dengan IPK Tertinggi';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('templates/topbar');
        $this->load->view('content/maxIpkAktif', $data);
        $this->load->view('templates/footer', $data);
    }

    public function maxipkLulus()
    {

        $data['maxIpkLulus'] = $this->Mahasiswa_model->maxipkLulus('Lulus');
        $data['judul'] = 'IPK Tertinggi';
        $data['judul_halaman'] = 'Lulusan Dengan IPK Tertinggi';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('templates/topbar');
        $this->load->view('content/maxIpkLulus', $data);
        $this->load->view('templates/footer', $data);
    }
    public function dosen()
    {
        $array = $this->Dosen_model->getalldosen();
        $tahunajaran = $this->input->post('tahunajaran'); // or Finance etc.
        $filterBy = $this->input->post('tahunID'); // or Finance etc.
        $filterByProdi = $this->input->post('prodiID');
        if ($tahunajaran == null) {
            $tahunajaran = '20211';
        }

        $new = array_filter($array, function ($var) use ($filterBy) {
            return ($var['ID Tahun Akademik'] == $filterBy);
        });
        $maxtahunid = array_filter($array, function ($var) use ($tahunajaran) {
            return ($var['ID Tahun Akademik'] == $tahunajaran);
        });
        $new2 = array_filter($array, function ($var) use ($filterByProdi, $filterBy) {
            return ($var['ID Prodi'] == $filterByProdi and $var['ID Tahun Akademik'] == $filterBy);
        });

        $minsks = min(array_column($maxtahunid, 'Total SKS'));
        $maxsks = max(array_column($maxtahunid, 'Total SKS'));
        $minsks_dosen = array_filter($array, function ($var) use ($minsks, $tahunajaran) {
            return ($var['Total SKS'] == $minsks and $var['ID Tahun Akademik'] == $tahunajaran);
        });
        $maxsks_dosen = array_filter($array, function ($var) use ($maxsks, $tahunajaran) {
            return ($var['Total SKS'] == $maxsks and $var['ID Tahun Akademik'] == $tahunajaran);
        });
        $total_sks = array_reduce($new, function ($carry, $item) {
            if (!isset($carry[$item['ID Prodi']])) {
                $carry[$item['ID Prodi']] = ['Nama Prodi' => $item['Nama Prodi'], 'Total SKS' => $item['Total SKS'], 'Nama Tahun Akademik' => $item['Nama Tahun Akademik']];
            } else {
                $carry[$item['ID Prodi']]['Total SKS'] += $item['Total SKS'];
            }
            return $carry;
        });
        // ambil array prodi berdasarkan taunid terbaru
        $total_sks_prodi = array_reduce($maxtahunid, function ($carry, $item) {
            if (!isset($carry[$item['ID Prodi']])) {
                $carry[$item['ID Prodi']] = ['Nama Prodi' => $item['Nama Prodi'], 'Total SKS' => $item['Total SKS'], 'Nama Tahun Akademik' => $item['Nama Tahun Akademik']];
            } else {
                $carry[$item['ID Prodi']]['Total SKS'] += $item['Total SKS'];
            }
            return $carry;
        });
        // ambil nilai sks prodi 
        $minsks_prodi = min(array_column($total_sks_prodi, 'Total SKS'));
        $getminsksprodi = array_filter($total_sks_prodi, function ($var) use ($minsks_prodi) {
            return ($var['Total SKS'] == $minsks_prodi);
        });

        // ambil nilai max sks prodi berdasarkan tahunid terbaru 
        $maxsks_prodi = max(array_column($total_sks_prodi, 'Total SKS'));
        $getmaxsksprodi = array_filter($total_sks_prodi, function ($var) use ($maxsks_prodi) {
            return ($var['Total SKS'] == $maxsks_prodi);
        });


        $tahun = array_reduce($array, function ($carry, $item) {
            if (!isset($carry[$item['ID Tahun Akademik']])) {
                $carry[$item['ID Tahun Akademik']] = ['ID Tahun Akademik' => $item['ID Tahun Akademik'], 'Nama Tahun Akademik' => $item['Nama Tahun Akademik']];
            }
            return $carry;
        });

        $prodi = array_reduce($array, function ($carry, $item) {
            if (!isset($carry[$item['Nama Prodi']])) {
                $carry[$item['ID Prodi']] = ['ID Prodi' => $item['ID Prodi'], 'Nama Prodi' => $item['Nama Prodi']];
            }
            return $carry;
        });

        $data['labelgraph'] = 'Beban Pengajaran Tahun Akademik ' . $filterBy;
        $data['labelgraph_sksdosen'] = 'Beban Pengajaran Tahun Akademik ' . $filterBy;
        $data['judul'] = 'Dashboard Dekanat';
        $data['judul_halaman'] = 'Jumlah Beban Pengajaran Dosen';
        $data['tahunID'] = $tahun;
        $data['sks_dosen'] = $new2;
        $data['prodisksterbanyak'] = $getmaxsksprodi;
        $data['prodisksterkecil'] = $getminsksprodi;
        $data['prodi'] = $total_sks;
        $data['Nama_Prodi'] = $prodi;
        $data['maxsksDosen'] = $maxsks_dosen;
        $data['minsksDosen'] = $minsks_dosen;
        // echo "<pre>";
        // var_dump($data['maxsksDosen']);
        // echo "<pre>";
        // die;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('content/dosen', $data);
        $this->load->view('templates/footer', $data);
    }

    public function maxsksDosen()
    {
        $array = $this->Dosen_model->getalldosen();
        $maxtahun = max(array_column($array, 'ID Tahun Akademik'));
        $maxtahunid = array_filter($array, function ($var) use ($maxtahun) {
            return ($var['ID Tahun Akademik'] == $maxtahun);
        });
        $maxsks = max(array_column($maxtahunid, 'Total SKS'));
        $maxtahunid = array_filter($array, function ($var) use ($maxtahun) {
            return ($var['ID Tahun Akademik'] == $maxtahun);
        });


        $maxsks_dosen = array_filter($array, function ($var) use ($maxsks, $maxtahun) {
            return ($var['Total SKS'] == $maxsks and $var['ID Tahun Akademik'] == $maxtahun);
        });
        $data['maxsksDosen'] = $maxsks_dosen;
        $data['judul'] = 'Dosen SKS Maximal';
        $data['judul_halaman'] = 'Jumlah Maximal SKS Dosen';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('content/maxDosen', $data);
        $this->load->view('templates/footer', $data);
    }

    public function misksDosen()
    {
        $array = $this->Dosen_model->getalldosen();
        $maxtahun = max(array_column($array, 'ID Tahun Akademik'));
        $maxtahunid = array_filter($array, function ($var) use ($maxtahun) {
            return ($var['ID Tahun Akademik'] == $maxtahun);
        });
        $minsks = min(array_column($maxtahunid, 'Total SKS'));
        $minsks_dosen = array_filter($array, function ($var) use ($minsks, $maxtahun) {
            return ($var['Total SKS'] == $minsks and $var['ID Tahun Akademik'] == $maxtahun);
        });
        $data['minsksDosen'] = $minsks_dosen;
        $data['judul'] = 'Dosen SKS Minimal';
        $data['judul_halaman'] = 'Jumlah Minimal SKS Dosen';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('content/minDosen', $data);
        $this->load->view('templates/footer', $data);
    }
}
