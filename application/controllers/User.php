<?php
defined('BASEPATH') or exit('No direct script access allowed');

class  User extends CI_Controller{
    public function index(){
        $data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
        echo 'Selamat Datang ' . $data['user']['name'];
    }

    public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
                redirect('auth');
    }
}