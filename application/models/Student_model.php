<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_students() {
        $query = $this->db->get('etudiant');
        return $query->result();
    }

    public function get_student_by_id($matricule) {
        $this->db->where('Numero_Matricule', $matricule);
        $query = $this->db->get('etudiant');
        return $query->result();
    }

    public function create_student($data) {
        return $this->db->insert('etudiant', $data);
    }

    public function update_student($matricule, $data) {
        $this->db->where('Numero_Matricule', $matricule);
        return $this->db->update('etudiant', $data);
    }

    public function delete_student($matricule) {
        $this->db->where('Numero_Matricule', $matricule);
        return $this->db->delete('etudiant');
    }

    public function search_students($keyword) {
        $this->db->like('Nom_Etudiant', $keyword);
        $this->db->or_like('Prenom_Etudiant', $keyword);
        $query = $this->db->get('etudiant');
        return $query->result();
    }

    public function get_student_level($matricule) {
        $this->db->select('Niveau');
        $this->db->where('Numero_Matricule', $matricule);
        $query = $this->db->get('etudiant');
        
        if ($query->num_rows() > 0) {
            return $query->row()->Niveau;
        }
        
        return null;
    }
}
