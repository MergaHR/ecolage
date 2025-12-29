<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Payment_model');
        $this->load->model('Student_model');
        $this->load->library('session');
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['payment_methods'] = $this->Payment_model->get_payment_methods();
        $data['payment_records'] = $this->Payment_model->get_student_payment_records();
        $data['verifications'] = $this->Payment_model->get_verification_records();
        
        $this->load->view('payement', $data);
    }

    public function student_payment() {
        $data['payment_methods'] = $this->Payment_model->get_payment_methods();
        $data['payment_records'] = $this->Payment_model->get_student_payment_records();
        
        $this->load->view('payementEtu', $data);
    }

    public function create_payment() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('Numero_Matricule', 'Matricule', 'required');
        $this->form_validation->set_rules('Montant', 'Amount', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('Mode_payement', 'Payment Method', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('payments');
        } else {
            $matricule = $this->input->post('Numero_Matricule');
            $amount = $this->input->post('Montant');
            
            $data = array(
                'Numero_Matricule' => $matricule,
                'Montant' => $amount,
                'Mode_payement' => $this->input->post('Mode_payement'),
                'Date_payement' => date('Y-m-d H:i:s')
            );

            if ($this->Payment_model->create_payment($data)) {
                $this->session->set_flashdata('success', 'Payment recorded successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to record payment');
            }
            redirect('payments');
        }
    }

    public function validate_payment() {
        $data['payment_methods'] = $this->Payment_model->get_payment_methods();
        $data['payment_records'] = $this->Payment_model->get_student_payment_records();
        
        $this->load->view('validerPay', $data);
    }

    public function process_validation() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('payment_id', 'Payment ID', 'required');
        $this->form_validation->set_rules('validation_status', 'Validation Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('payments/validate_payment');
        } else {
            $payment_id = $this->input->post('payment_id');
            $status = $this->input->post('validation_status');
            
            $data = array(
                'validation_status' => $status,
                'validated_by' => $this->session->userdata('email'),
                'validation_date' => date('Y-m-d H:i:s')
            );

            if ($this->Payment_model->update_payment_validation($payment_id, $data)) {
                $this->session->set_flashdata('success', 'Payment validated successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to validate payment');
            }
            redirect('payments');
        }
    }

    public function receipt($payment_id) {
        $data['payment'] = $this->Payment_model->get_payment_by_id($payment_id);
        $this->load->view('recu', $data);
    }

    public function delete_payment_record($record_id) {
        if ($this->Payment_model->delete_student_payment_record($record_id)) {
            $this->session->set_flashdata('success', 'Payment record deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete payment record');
        }
        redirect('payments');
    }
}
