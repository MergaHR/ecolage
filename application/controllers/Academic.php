<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Academic extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Academic_model');
        $this->load->library('session');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function levels() {
        $data['levels'] = $this->Academic_model->get_all_levels();
        $this->load->view('niveaux', $data);
    }

    public function create_level() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('Code_Niveau', 'Level Code', 'required|is_unique[niveau.Code_Niveau]');
        $this->form_validation->set_rules('Grade', 'Grade', 'required');
        $this->form_validation->set_rules('Cout_niveau', 'Cost', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('academic/levels');
        } else {
            $data = array(
                'Code_Niveau' => $this->input->post('Code_Niveau'),
                'Grade' => $this->input->post('Grade'),
                'Cout_niveau' => $this->input->post('Cout_niveau')
            );

            if ($this->Academic_model->create_level($data)) {
                $this->session->set_flashdata('success', 'Level created successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to create level');
            }
            redirect('academic/levels');
        }
    }

    public function edit_level($level_id) {
        $data['level'] = $this->Academic_model->get_level_by_id($level_id);
        $this->load->view('edit_level', $data);
    }

    public function update_level($level_id) {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('Grade', 'Grade', 'required');
        $this->form_validation->set_rules('Cout_niveau', 'Cost', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('academic/edit_level/' . $level_id);
        } else {
            $data = array(
                'Grade' => $this->input->post('Grade'),
                'Cout_niveau' => $this->input->post('Cout_niveau')
            );

            if ($this->Academic_model->update_level($level_id, $data)) {
                $this->session->set_flashdata('success', 'Level updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to update level');
            }
            redirect('academic/levels');
        }
    }

    public function delete_level($level_id) {
        if ($this->Academic_model->delete_level($level_id)) {
            $this->session->set_flashdata('success', 'Level deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete level');
        }
        redirect('academic/levels');
    }

    public function mentions() {
        $data['mentions'] = $this->Academic_model->get_all_mentions();
        $this->load->view('mentions', $data);
    }

    public function create_mention() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('Code_Mention', 'Mention Code', 'required|is_unique[mention.Code_Mention]');
        $this->form_validation->set_rules('Nom_Mention', 'Mention Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('academic/mentions');
        } else {
            $data = array(
                'Code_Mention' => $this->input->post('Code_Mention'),
                'Nom_Mention' => $this->input->post('Nom_Mention')
            );

            if ($this->Academic_model->create_mention($data)) {
                $this->session->set_flashdata('success', 'Mention created successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to create mention');
            }
            redirect('academic/mentions');
        }
    }

    public function edit_mention($mention_id) {
        $data['mention'] = $this->Academic_model->get_mention_by_id($mention_id);
        $this->load->view('edit_mention', $data);
    }

    public function update_mention($mention_id) {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('Nom_Mention', 'Mention Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('academic/edit_mention/' . $mention_id);
        } else {
            $data = array(
                'Nom_Mention' => $this->input->post('Nom_Mention')
            );

            if ($this->Academic_model->update_mention($mention_id, $data)) {
                $this->session->set_flashdata('success', 'Mention updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to update mention');
            }
            redirect('academic/mentions');
        }
    }

    public function delete_mention($mention_id) {
        if ($this->Academic_model->delete_mention($mention_id)) {
            $this->session->set_flashdata('success', 'Mention deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete mention');
        }
        redirect('academic/mentions');
    }
}
