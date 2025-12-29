<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_payments() {
        $query = $this->db->get('payement');
        return $query->result();
    }

    public function get_student_payments($matricule) {
        $this->db->where('Numero_Matricule', $matricule);
        $this->db->order_by('Numero_Matricule', 'asc');
        $query = $this->db->get('payement');
        return $query->result();
    }

    public function get_payment_by_id($payment_id) {
        $this->db->where('N', $payment_id);
        $query = $this->db->get('payement');
        return $query->result();
    }

    public function create_payment($data) {
        return $this->db->insert('payement', $data);
    }

    public function get_payment_methods() {
        $query = $this->db->get('modepayement');
        return $query->result();
    }

    public function get_student_payment_records() {
        $query = $this->db->get('payementetu');
        return $query->result();
    }

    public function create_student_payment_record($data) {
        return $this->db->insert('payementetu', $data);
    }

    public function delete_student_payment_record($record_id) {
        $this->db->where('N', $record_id);
        return $this->db->delete('payementetu');
    }

    public function get_level_cost($matricule) {
        $this->db->select('Cout_niveau');
        $this->db->from('niveau');
        $this->db->join('etudiant', 'etudiant.Niveau = niveau.Grade');
        $this->db->where('etudiant.Numero_Matricule', $matricule);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->Cout_niveau;
        }
        
        return 0;
    }

    public function update_remaining_amount($matricule, $new_amount) {
        $level = $this->get_student_level($matricule);
        if ($level) {
            $this->db->set('Cout_niveau', $new_amount);
            $this->db->where('Grade', $level);
            return $this->db->update('niveau');
        }
        return false;
    }

    public function update_payment_validation($payment_id, $data) {
        $this->db->where('N', $payment_id);
        return $this->db->update('payement', $data);
    }

    private function get_student_level($matricule) {
        $this->db->select('Niveau');
        $this->db->where('Numero_Matricule', $matricule);
        $query = $this->db->get('etudiant');
        
        if ($query->num_rows() > 0) {
            return $query->row()->Niveau;
        }
        
        return null;
    }
}
