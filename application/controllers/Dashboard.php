<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->model('Academic_model');
        $this->load->library('session');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data = array();
        $data['students'] = $this->Student_model->get_all_students();
        $data['levels'] = $this->Academic_model->get_all_levels();
        $data['mentions'] = $this->Academic_model->get_all_mentions();
        
        $this->load->view('index', $data);
    }

    public function statistics() {
        $data = array();
        $data['students'] = $this->Student_model->get_all_students();
        $data['levels'] = $this->Academic_model->get_all_levels();
        $data['mentions'] = $this->Academic_model->get_all_mentions();
        $data['verifications'] = $this->Academic_model->get_verification_records();
        
        $this->load->view('statistique', $data);
    }

    public function search_students() {
        $keyword = $this->input->post('keyword');
        
        if (empty($keyword)) {
            $data['students'] = $this->Student_model->get_all_students();
        } else {
            $data['students'] = $this->Student_model->search_students($keyword);
        }
        
        $this->load->view('etudiant', $data);
    }
}
