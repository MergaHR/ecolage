<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Academic_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_levels() {
        $query = $this->db->get('niveau');
        return $query->result();
    }

    public function get_level_by_id($level_id) {
        $this->db->where('Code_Niveau', $level_id);
        $query = $this->db->get('niveau');
        return $query->result();
    }

    public function create_level($data) {
        return $this->db->insert('niveau', $data);
    }

    public function update_level($level_id, $data) {
        $this->db->where('Code_Niveau', $level_id);
        return $this->db->update('niveau', $data);
    }

    public function delete_level($level_id) {
        $this->db->where('Code_Niveau', $level_id);
        return $this->db->delete('niveau');
    }

    public function get_all_mentions() {
        $query = $this->db->get('mention');
        return $query->result();
    }

    public function get_mention_by_id($mention_id) {
        $this->db->where('Code_Mention', $mention_id);
        $query = $this->db->get('mention');
        return $query->result();
    }

    public function create_mention($data) {
        return $this->db->insert('mention', $data);
    }

    public function update_mention($mention_id, $data) {
        $this->db->where('Code_Mention', $mention_id);
        return $this->db->update('mention', $data);
    }

    public function delete_mention($mention_id) {
        $this->db->where('Code_Mention', $mention_id);
        return $this->db->delete('mention');
    }

    public function get_verification_records() {
        $query = $this->db->get('verification');
        return $query->result();
    }
}
