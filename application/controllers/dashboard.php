<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Penelitian_model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Dosen_model');
    }

    public function index()
    {
        if (!$this->session->userdata('email')) {
            echo "<script>
            alert('ooops  Anda Belum Login!! Silahkan Login');
            window.location.href='auth';
            </script>";
        }

        $data['judul'] = 'Dashboard';
        $data['judul_halaman'] = '<strong>DASHBOARD MONITORING KINERJA PROGRAM STUDI </strong> ';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('index');
        $this->load->view('templates/footer');
    }

    public function penelitian()
    {
        if (!$this->session->userdata('email')) {
            echo "<script>
            alert('ooops  Anda Belum Login!! Silahkan Login');
            window.location.href='auth';
            </script>";
        }
        $data['judul'] = 'Penelitian';
        $data['judul_halaman'] = 'Publikasi Dosen';
        $data['minciation_dosen'] = $this->Penelitian_model->minciation_dosen();
        $data['maxciation_dosen'] = $this->Penelitian_model->maxciation_dosen();
        $data['minciation'] = $this->Penelitian_model->mincitation();
        $data['maxciation'] = $this->Penelitian_model->maxciation();
        $data['maxsinta3score'] = $this->Penelitian_model->maxsinta3score();
        $data['minsinta3score'] = $this->Penelitian_model->minsinta3score();
        $data['maxsinta3scoreproductif'] = $this->Penelitian_model->maxsinta3scoreproductif();
        $data['minsinta3scoreproductif'] = $this->Penelitian_model->minsinta3scoreproductif();
        $data['general'] = $this->Penelitian_model->minmaxbase();
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
        $data['dropdown_prodi'] = $nama_prodi;
        $data['dropdown_category'] = $dataCategory;
        $data['chartall'] = $datageneralarray;
        $data["nama_prodi"] = $this->Penelitian_model->getInfoPenelitianProdi($nama_prodi);
        $data['key'] = $this->Penelitian_model->getallkey();
        if ($nama_prodi == null) {
            $data['LabelCart'] = 'Silahkan Pilih Program Studi Terlebih dahulu';
        } else {
            $data['LabelCart'] = 'Penelitian Dosen dari Prodi ' . $nama_prodi;
        }
        if ($dataCategory == 'sinta_score_3_years') {
            $dataCategory = 'Sinta Score 3 Years';
        }
        if ($dataCategory == 'sinta_score_3_years_productivity') {
            $dataCategory = 'Sinta Score 3 Years Productivity';
        }
        if ($dataCategory == 'sinta_score_overall') {
            $dataCategory = 'Sinta Score Overall';
        }
        if ($dataCategory == 'sinta_score_overall_productivity') {
            $dataCategory = 'Sinta Score Overall Productivity';
        }

        $data['labelchartall'] = 'Perbandingan Jumlah Total Nilai ' . $dataCategory . ' Dari Penellitian';
        // echo "<pre>";
        // var_dump($this->Penelitian_model->maxciation_dosen());
        // echo "<pre>";
        // die;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('content/penelitian', $data);
        $this->load->view('templates/footer', $data);
    }

    public function mahasiswa()
    {
        if (!$this->session->userdata('email')) {
            echo "<script>
            alert('ooops  Anda Belum Login!! Silahkan Login');
            window.location.href='auth';
            </script>";
        }
        // if ($this->session->flashdata('maxIpkAktif') or $this->session->flashdata('maxIpkLulus') or $this->session->flashdata('minIPKaktif') or $this->session->flashdata('minIPKlulus')) {
        //     // $this->session->unset_flashdata('maxIpkAktif');
        //     // $this->session->unset_flashdata('maxIpkLulus');
        //     // $this->session->unset_flashdata('minIPKaktif');
        //     // $this->session->unset_flashdata('minIPKlulus');
        //     $this->session->sess_destroy();
        // }

        $nama_prodi = $this->input->post('prodi');
        $angkatan = $this->input->post('angkatan');
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
        if ($nama_prodi != '') {
            foreach ($data['nama_prodi'] as $equal) {
                if ($equal['ID Prodi'] == $nama_prodi) {
                    $fix_dropdown = $equal['Nama Prodi'];
                }
            }
        } else {
            $fix_dropdown = 'Pilih Program Studi';
        }
        $data['dropdown_angkatan'] = $angkatan;
        $data['dropdown_prodi'] = $fix_dropdown;
        $data['LabelCartall'] = 'Ipk Rata-Rata PerProdi ' . $angkatan;
        $data['labeltable'] = 'Data Tabel Ipk Tertinggi Dari Program Studi ' . $fix_dropdown . ' Angkatan ' . $angkatan;
        $data["ipk"] = $this->Mahasiswa_model->getipkbyprodi($nama_prodi, $status_mhs);
        $data['maxipkallprodi'] = $this->Mahasiswa_model->maxIpkAll($angkatan);
        $data['maxIpkAktif'] = $this->Mahasiswa_model->maxipkAktif('Aktif', $angkatan);
        $data['maxIpkLulus'] = $this->Mahasiswa_model->maxipkLulus('Lulus', $angkatan);
        $data['minIPKaktif'] = $this->Mahasiswa_model->minipkAktif('Aktif', $angkatan);
        $data['minIPKlulus'] = $this->Mahasiswa_model->minipkLulus('Lulus', $angkatan);

        if ($data["ipk"] != null) {
            if ($nama_prodi == null) {
                $data['LabelCart'] = 'Silahkan Pilih Program Studi Terlebih dahulu';
            } else {
                $data['LabelCart'] = 'Perkembangan IPK Tertinggi Prodi ' . $fix_dropdown;
            }
        } else {
            $data['LabelCart'] = 'Data Program Studi Angkatan ' . $angkatan . 'Tidak Ditemukan';
        }

        $this->session->set_flashdata('maxIpkAktif', $data['maxIpkAktif']);
        $this->session->set_flashdata('maxIpkLulus', $data['maxIpkLulus']);
        $this->session->set_flashdata('minIPKaktif', $data['minIPKaktif']);
        $this->session->set_flashdata('minIPKlulus', $data['minIPKlulus']);
        // echo "<pre>";
        // var_dump($data['maxIpkAktif']);
        // echo "<pre>";
        // die;
        // $this->maxipkAktif($tahun);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('templates/topbar');
        $this->load->view('content/mahasiswa', $data);
        $this->load->view('templates/footer', $data);
    }

    public function minipkaktif()
    {
        $data['minIPKaktif'] = $this->session->flashdata('minIPKaktif');
        $data['judul'] = 'IPK Terendah';
        $data['judul_halaman'] = 'Mahasiswa Aktif Dengan IPK Terendah';

        // echo "<pre>";
        // var_dump($data['minIPKaktif']);
        // echo "<pre>";
        // die;


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('templates/topbar');
        $this->load->view('content/minIpkAktif', $data);
        $this->load->view('templates/footer', $data);
    }
    public function minipklulus()
    {
        $data['minIPKlulus'] = $this->session->flashdata('minIPKlulus');
        $data['judul'] = 'IPK Terendah';
        $data['judul_halaman'] = 'Lulusan Dengan IPK Terendah';


        // echo "<pre>";
        // var_dump($data['minIPKlulus']);
        // echo "<pre>";
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('templates/topbar');
        $this->load->view('content/minIpkLulus', $data);
        $this->load->view('templates/footer', $data);
    }
    public function maxipkAktif()
    {
        $data['maxIpkAktif'] = $this->session->flashdata('maxIpkAktif');
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

        $data['maxIpkLulus'] = $this->session->flashdata('maxIpkLulus');
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
        $data['dropdown_tahunid'] = $filterBy;
        $data['dropdown_prodi'] = $filterByProdi;
        if ($tahunajaran == null) {
            $tahunajaran = '20211';
        }

        $data['dropdown_tahunajaran'] = $tahunajaran;
        $new = array_filter($array, function ($var) use ($tahunajaran) {
            return ($var['ID Tahun Akademik'] == $tahunajaran);
        });
        $maxtahunid = array_filter($array, function ($var) use ($tahunajaran) {
            return ($var['ID Tahun Akademik'] == $tahunajaran);
        });
        $new2 = array_filter($array, function ($var) use ($filterByProdi, $filterBy) {
            return ($var['ID Prodi'] == $filterByProdi and $var['ID Tahun Akademik'] == $filterBy);
        });

        $minsks = min(array_column($maxtahunid, 'Total SKS'));
        $maxsks = max(array_column($maxtahunid, 'Total SKS'));
        $minmaxsks = 12;
        $minsks_dosen = array_filter($array, function ($var) use ($minmaxsks, $tahunajaran) {
            return ($var['Total SKS'] < $minmaxsks and $var['ID Tahun Akademik'] == $tahunajaran);
        });
        $maxsks_dosen = array_filter($array, function ($var) use ($minmaxsks, $tahunajaran) {
            return ($var['Total SKS'] >= $minmaxsks and $var['ID Tahun Akademik'] == $tahunajaran);
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
        if (array_key_exists($filterByProdi, $prodi)) {
            $namaproditabel = $prodi[$filterByProdi]['Nama Prodi'];
        } else {
            $namaproditabel = '';
        }
        if ($tahunajaran != '') {
            foreach ($tahun as $equal) {
                if ($equal['ID Tahun Akademik'] == $tahunajaran) {
                    $fix_dropdown = $equal['Nama Tahun Akademik'];
                }
            }
        } else {
            $fix_dropdown = 'Pilih Program Studi';
        }

        $data['label_summary'] = $fix_dropdown;
        $data['labelgraphdosen'] = 'Grafik Beban Pengajaran Dosen Program Studi ' . $namaproditabel;
        $data['labeltabeldosen'] = 'Data Tabel Detail Beban Pengajaran Dosen Program Studi ' . $namaproditabel;
        $data['labeltable'] = 'Data Tabel Beban Pengajaran Dosen Program Studi ' . $namaproditabel;
        $data['labelgraph'] = 'Total SKS Tahun Ajaran ' . $fix_dropdown;
        $data['labelgraph_sksdosen'] = 'Total SKS Tahun Ajaran ' . $filterBy;
        $data['judul'] = 'Dashboard Dekanat';
        $data['judul_halaman'] = 'Beban Kinerja Pengajaran';
        $data['tahunID'] = $tahun;
        $data['sks_dosen'] = $new2;
        $data['prodisksterbanyak'] = $getmaxsksprodi;
        $data['prodisksterkecil'] = $getminsksprodi;
        $data['prodi'] = $total_sks;
        $data['Nama_Prodi'] = $prodi;
        $data['maxsksDosen'] = $maxsks_dosen;
        $data['minsksDosen'] = $minsks_dosen;
        // echo "<pre>";
        // var_dump($label_kartu);
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
        $maxsks = 29;
        $maxtahunid = array_filter($array, function ($var) use ($maxtahun) {
            return ($var['ID Tahun Akademik'] == $maxtahun);
        });


        $maxsks_dosen = array_filter($array, function ($var) use ($maxsks, $maxtahun) {
            return ($var['Total SKS'] >= $maxsks and $var['ID Tahun Akademik'] == $maxtahun);
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
        $minsks = 12;
        $minsks_dosen = array_filter($array, function ($var) use ($minsks, $maxtahun) {
            return ($var['Total SKS'] <= $minsks and $var['ID Tahun Akademik'] == $maxtahun);
        });
        $data['minsksDosen'] = $minsks_dosen;
        $data['judul'] = 'Dosen SKS Minimal';
        $data['judul_halaman'] = 'Jumlah Minimal SKS Dosen';


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('content/minDosen', $data);
        $this->load->view('templates/footer', $data);
    }

    public function pertumbuhanmahasiswa()
    {
        $data['judul'] = 'Pertumbuhan Mahasiswa';
        $data['judul_halaman'] = 'Pertumbuhan Mahasiswa';
        $prodi = $this->input->post('prodi');
        $angkatan = $this->input->post('angkatan');
        $data["nama_prodi"] = $this->Mahasiswa_model->getProdiName();
        if ($prodi != '') {
            foreach ($data['nama_prodi'] as $equal) {
                if ($equal['ID Prodi'] == $prodi) {
                    $fix_dropdown = $equal['Nama Prodi'];
                }
            }
        } else {
            $fix_dropdown = 'Pilih Program Studi';
            $data['LabelCartall'] = 'Silahkan Pilih Program Studi';
            $data['LabelCartlulus'] = 'Silahkan Pilih Program Studi';
        }
        $data['LabelCartlulus'] = 'Pertumbuhan Mahasiswa Lulus ' . $fix_dropdown;
        $data['LabelCartall'] = 'Pertumbuhan Mahasiswa Aktif ' . $fix_dropdown;
        $data['labeltable'] = 'Data Pertumbuhan Mahasiswa Aktif ' . $fix_dropdown;
        $data['labeltablelulus'] = 'Data Pertumbuhan Mahasiswa Lulus ' . $fix_dropdown;
        $data['dropdown_angkatan'] = $angkatan;
        $data['dropdown_prodi'] = $fix_dropdown;
        $datapertumbuhanaktif = $this->Mahasiswa_model->mhsAktifCount($prodi, 'Aktif');
        $datapertumbuhanlulus = $this->Mahasiswa_model->mhsAktifCount($prodi, 'Lulus');
        $data['datapertumbuhanlulus'] = $datapertumbuhanlulus;
        $data['datapertumbuhan'] = $datapertumbuhanaktif;
        // echo "<pre>";
        // var_dump($datapertumbuhanaktif);
        // echo "</pre>";
        // die;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('content/graph_mahasiswa');
        $this->load->view('templates/footer', $data);
    }
}
