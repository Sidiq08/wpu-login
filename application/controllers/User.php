<?php
defined('BASEPATH') or exit('No direct script access allowed');

class  User extends CI_Controller{
    public function index(){
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header' , $data);
        $this->load->view('templates/sidebar' , $data);
        $this->load->view('templates/topbar' , $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer' , $data);
    }

    public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
                redirect('auth');
    }
}