<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index(){
        $data['title'] = 'WPU Login Page';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function registration(){

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.mail]', [
            'is_unique' => "This email has already registered!"
        ]);

        $this->form_validation->set_rules('password','Password', 'required|trim|min_lenght[3]|matches[password2]',[
            'matches' => 'Password dont match!',
            'min_length'=>'Password to short!'
        ]);

        $this->form_validation->set_rules('password2' , 'Password2' , 'required|trim|matches[password]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'WPU User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        }else{
            $data = [
                'name' => htmlspecialchars($this->input->post('name',true)),
                'email' => htmlspecialchars($this->input->post('email',true)),
                'image' => 'default.png',
                'email'=>password_hash(htmlspecialchars($this->input->post('password')),PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created'=>time(),
            ];

            $this->db->insert('user',$data);
            
        }
    }
}
