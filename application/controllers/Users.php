<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $data['account_types'] = $this->User_model->get_account_types();
        $this->load->view('gererCompte', $data);
    }

    public function manage_accounts() {
        $data['users'] = $this->User_model->get_all_users();
        $data['account_types'] = $this->User_model->get_account_types();
        $this->load->view('gererEmployer', $data);
    }

    public function create_user() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[compte.Adresse_Email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('account_type', 'Account Type', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('users');
        } else {
            $data = array(
                'Adresse_Email' => $this->input->post('email'),
                'Mdp' => $this->input->post('password'),
                'Id_type_compte' => $this->input->post('account_type')
            );

            if ($this->User_model->create_user($data)) {
                $this->session->set_flashdata('success', 'User created successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to create user');
            }
            redirect('users');
        }
    }

    public function delete_user($user_id) {
        if ($this->User_model->delete_user($user_id)) {
            $this->session->set_flashdata('success', 'User deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete user');
        }
        redirect('users');
    }

    public function profile() {
        $email = $this->session->userdata('email');
        $data['user'] = $this->User_model->get_user_by_email($email);
        $this->load->view('profile', $data);
    }

    public function change_password() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('users/profile');
        } else {
            $email = $this->session->userdata('email');
            $user = $this->User_model->get_user_by_email($email);
            
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            if ($this->User_model->verify_current_password($user->Id_compte, $current_password)) {
                if ($this->User_model->update_password($user->Id_compte, $new_password)) {
                    $this->session->set_flashdata('success', 'Password changed successfully');
                } else {
                    $this->session->set_flashdata('error', 'Failed to change password');
                }
            } else {
                $this->session->set_flashdata('error', 'Current password is incorrect');
            }
            redirect('users/profile');
        }
    }
}
