<?php

use PharIo\Manifest\Email;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    public function index()
    {
        $data['judul'] = 'Login Dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('auth/auth');
    }

    public function process_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $email_ori = 'dekanatvokasi@gmail.com';
        $pass_ori = '12345678';
        if ($email == $email_ori) {
            if ($password == $pass_ori) {
                $userinfo = array(
                    'email' => $email
                );
                $this->session->set_userdata($userinfo);
                redirect('index.php/dashboard');
            } else {
                $errmsg = array(
                    'passError' => 'Password Yang Anda Gunakan Salah !!'
                );
                $this->session->set_flashdata($errmsg);
                redirect('index.php/auth');
            }
        } else {
            $errmsg = array(
                'emailError' => 'email yang anda gunakan tidak valid'
            );
            $this->session->set_flashdata($errmsg);
            redirect('index.php/auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('index.php/auth');
    }
}
