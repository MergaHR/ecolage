<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('Login');
    }

    public function authenticate() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if (empty($email) || empty($password)) {
            $this->session->set_flashdata('error', 'Email and password are required');
            redirect('auth/login');
        }

        if ($this->User_model->authenticate_admin($email, $password)) {
            $session_data = array(
                'email' => $email,
                'user_type' => 'admin',
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect('dashboard');
        } elseif ($this->User_model->authenticate_user($email, $password)) {
            $user_type = $this->User_model->get_user_type($email);
            $session_data = array(
                'email' => $email,
                'user_type' => $user_type,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('auth/login');
        }
    }

    public function register() {
        $this->load->view('inscrire');
    }

    public function create_account() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[compte.Adresse_Email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('user_type', 'User Type', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/register');
        } else {
            $data = array(
                'Adresse_Email' => $this->input->post('email'),
                'Mdp' => $this->input->post('password'),
                'Id_type_compte' => $this->input->post('user_type')
            );

            if ($this->User_model->create_user($data)) {
                $this->session->set_flashdata('success', 'Account created successfully');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Failed to create account');
                redirect('auth/register');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
