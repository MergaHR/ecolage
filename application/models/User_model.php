<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function authenticate_admin($email, $password) {
        $this->db->where('Email_Administration', $email);
        $query = $this->db->get('administration');
        
        if ($query->num_rows() > 0) {
            $admin = $query->row();
            return password_verify($password, $admin->Mot_de_passe);
        }
        
        return false;
    }

    public function authenticate_user($email, $password) {
        $this->db->where('Adresse_Email', $email);
        $query = $this->db->get('compte');
        
        if ($query->num_rows() > 0) {
            $user = $query->row();
            return password_verify($password, $user->Mdp);
        }
        
        return false;
    }

    public function create_user($data) {
        if (isset($data['Mdp'])) {
            $data['Mdp'] = password_hash($data['Mdp'], PASSWORD_DEFAULT);
        }
        return $this->db->insert('compte', $data);
    }

    public function get_user_by_email($email) {
        $this->db->where('Adresse_Email', $email);
        $query = $this->db->get('compte');
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        return false;
    }

    public function get_user_type($email) {
        $this->db->select('Id_type_compte');
        $this->db->where('Adresse_Email', $email);
        $query = $this->db->get('compte');
        
        if ($query->num_rows() > 0) {
            return $query->row()->Id_type_compte;
        }
        
        return false;
    }

    public function get_all_users() {
        $query = $this->db->get('compte');
        return $query->result();
    }

    public function get_account_types() {
        $query = $this->db->get('type_compte');
        return $query->result();
    }

    public function delete_user($user_id) {
        $this->db->where('Id_compte', $user_id);
        return $this->db->delete('compte');
    }

    public function verify_current_password($user_id, $current_password) {
        $this->db->select('Mdp');
        $this->db->where('Id_compte', $user_id);
        $query = $this->db->get('compte');
        
        if ($query->num_rows() === 1) {
            $hashed_password = $query->row()->Mdp;
            return password_verify($current_password, $hashed_password);
        }
        
        return false;
    }

    public function update_password($user_id, $new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $data = array('Mdp' => $hashed_password);
        
        $this->db->where('Id_compte', $user_id);
        return $this->db->update('compte', $data);
    }
}
