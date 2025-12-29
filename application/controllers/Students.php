<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->library('session');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['students'] = $this->Student_model->get_all_students();
        $this->load->view('etudiant', $data);
    }

    public function create() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('Numero_Matricule', 'Matricule', 'required|is_unique[etudiant.Numero_Matricule]');
        $this->form_validation->set_rules('Nom_Etudiant', 'Name', 'required');
        $this->form_validation->set_rules('Prenom_Etudiant', 'First Name', 'required');
        $this->form_validation->set_rules('Niveau', 'Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('dashboard');
        } else {
            $data = array(
                'Numero_Matricule' => $this->input->post('Numero_Matricule'),
                'Nom_Etudiant' => $this->input->post('Nom_Etudiant'),
                'Prenom_Etudiant' => $this->input->post('Prenom_Etudiant'),
                'Niveau' => $this->input->post('Niveau')
            );

            if ($this->Student_model->create_student($data)) {
                $this->session->set_flashdata('success', 'Student created successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to create student');
            }
            redirect('dashboard');
        }
    }

    public function edit($matricule) {
        $data['student'] = $this->Student_model->get_student_by_id($matricule);
        $this->load->view('edit_student', $data);
    }

    public function update($matricule) {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('Nom_Etudiant', 'Name', 'required');
        $this->form_validation->set_rules('Prenom_Etudiant', 'First Name', 'required');
        $this->form_validation->set_rules('Niveau', 'Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('students/edit/' . $matricule);
        } else {
            $data = array(
                'Nom_Etudiant' => $this->input->post('Nom_Etudiant'),
                'Prenom_Etudiant' => $this->input->post('Prenom_Etudiant'),
                'Niveau' => $this->input->post('Niveau')
            );

            if ($this->Student_model->update_student($matricule, $data)) {
                $this->session->set_flashdata('success', 'Student updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to update student');
            }
            redirect('dashboard');
        }
    }

    public function delete($matricule) {
        if ($this->Student_model->delete_student($matricule)) {
            $this->session->set_flashdata('success', 'Student deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete student');
        }
        redirect('dashboard');
    }

    public function payment_history($matricule) {
        $this->load->model('Payment_model');
        $data['payments'] = $this->Payment_model->get_student_payments($matricule);
        $data['student'] = $this->Student_model->get_student_by_id($matricule);
        $this->load->view('historique', $data);
    }
}
