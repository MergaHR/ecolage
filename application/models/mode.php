<?php

class mode extends CI_Model {
    //Recuperer element de la table
    public function recupererEtudiant() {
        $query = $this->db->get('etudiant');
        return $query->result();
    }
    public function recupererMention() {
        $query = $this->db->get('mention');
        return $query->result();
    }
    public function recupererNiveau() {
        $query = $this->db->get('niveau');
        return $query->result();
    }
    function Login_Admin($email, $password) {
        $this->db->where('Email_Administration',$email);
        $query = $this->db->get('administration');
            if ($query->num_rows()>0) {
                foreach($query->result() as $row)
                {
                    if ($password == $row->Mot_de_passe) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
            }
        return false;
    }
    public function insertUtilisateur($data) {
        $this->db->insert('compte',$data);  //parametre le data eto
    }

    function Login_Utilisateur($email, $password) {
        $this->db->where('Adresse_Email',$email);
        $query = $this->db->get('compte');
            if ($query->num_rows() > 0) {
                foreach($query->result() as $row)
                {
                    if ($password == $row->Mdp) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
            }
        return $query->result();
    }
    function type_compte($email){
        $this->db->where('Adresse_Email',$email);
        return $this->db->get('compte')->row()->Id_type_compte;
    }

    public function get_admin_data($email)
{
    $this->db->where('Adresse_Email', $email);
    $query = $this->db->get('compte');

    if ($query->num_rows() > 0) {
        return $query->row();
    }

    return false;
}
/*
public function update_password($admin_id, $new_password)
{
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $data = array(
        'Mot_de_passe' => $new_password,
    );
    $this->db->where('Id_Administration', $admin_id);
    $this->db->update('administration', $data);
    return $this->db->affected_rows() > 0;
}

public function verify_current_password($Id_compte, $current_password)
{
    $this->db->select('Mdp');
    $this->db->from('compte');
    $this->db->where('Id_compte', $Id_compte);
    $query = $this->db->get();

    if ($query->num_rows() === 1) {
        $hashed_password = $query->row()->Mdp;

        // Utilisation de password_verify avec une comparaison stricte (===)
        return password_verify($current_password, $hashed_password);
    }

    return false;
}
*/

public function get_typeCompte() {
    $query = $this->db->get('type_compte');
    return $query->result();
}    
public function get_Empl() {
    $query = $this->db->get('compte');
    return $query->result();
}
    public function get_Etudiant() {
        $query = $this->db->get('etudiant');
        return $query->result();
    }
    public function get_Mention() {
        $query = $this->db->get('mention');
        return $query->result();
    }
    public function get_Niveau() {
        $query = $this->db->get('niveau');
        return $query->result();
    }
    public function get_Mdpayement() {
        $query = $this->db->get('modepayement');
        return $query->result();
    }
    public function get_payement() {
        $query = $this->db->get('payement');
        return $query->result();
    }
    public function get_payementetu() {
        $query = $this->db->get('payementetu');
        return $query->result();
    }
    public function get_verification() {
        $query = $this->db->get('verification');
        return $query->result();
    }
    public function searchKey($keyword) {
        $query = $this->db->like('Nom_Etudiant',$keyword);
        $query = $this->db->or_like('Prenom_Etudiant',$keyword);
        $query= $this->db->get('etudiant');
        return $query->result();
    }
    public function searchKeyhisto($Numero_Matricule) {
        $this->db->where('Numero_Matricule', $Numero_Matricule);
        $this->db->order_by('Numero_Matricule', 'asc'); // Tri ascendant par le numéro de matricule
        $query = $this->db->get('payement');
        return $query->result();
    }
    
    /*
    public function get_searchEtudiant($perPage,$start_index,$search_text=null,$is_count=0)
    {
        if($perPage !='' && $start_index!='')
        {
            $this->db->limit($perPage,$start_index);
        }
        if($search_text!=null)
        {
            $this->db->like('Nom_Etudiant',$search_text,'both');
            $this->db->or_like('Prenom_Etudiant',$search_text,'both');
        }
        if($is_count==1)
        {
            $query=$this->db->get('etudiant');
            return $query->num_rows();
        }
        else
        {
            $query=$this->db->get('etudiant');
            return $query->result_array();
        }
        $query = $this->db->get('etudiant');
        return $query->result();
    }*/
    public function insertEtudiant($data) {
        $this->db->insert('etudiant',$data);
         //parametre le data eto
    }
    public function insertNiveau($data) {
        $this->db->insert('niveau',$data);
    }
    public function insertMention($data) {
        $this->db->insert('mention',$data);
    }
    public function Payement($data) {
        $this->db->insert('payement',$data);
    }
    public function Payementetu($data) {
        $this->db->insert('payementetu',$data);
    }
    public function supprimerNiveau($Code_Niveau) {
        $this->db->where('Code_Niveau',$Code_Niveau);
        $result = $this->db->delete('niveau');
        return $result; // retourne TRUE si la suppression est réussie, FALSE sinon
    }
    public function supprimerMention($Code_Mention) {
        $this->db->where('Code_Mention',$Code_Mention);
        $result = $this->db->delete('mention');
        return $result; // retourne TRUE si la suppression est réussie, FALSE sinon
    }
    public function supprimerEtudiant($Numero_Matricule) {
        $this->db->where('Numero_Matricule',$Numero_Matricule);
        $result = $this->db->delete('etudiant');
        return $result; // retourne TRUE si la suppression est réussie, FALSE sinon
    
    }
    public function supprimerPayetu($N) {
        $this->db->where('N',$N);
        $result = $this->db->delete('payementetu');
        return $result; // retourne TRUE si la suppression est réussie, FALSE sinon
    
    }
    public function supprimerEmpl($Id_compte) {
        $this->db->where('Id_compte',$Id_compte);
        $result = $this->db->delete('compte');
        return $result; // retourne TRUE si la suppression est réussie, FALSE sinon
    }
    
    public function modifier_Niveau($Code_Niveau, $data) {
        $this->db->where('Code_Niveau', $Code_Niveau);
        $this->db->update('niveau', $data);
    }
    public function getNiveau($Code_Niveau) {
        return $this->db->get_where('niveau', array('Code_Niveau' => $Code_Niveau))->result();
    }
    
    public function modifier_Mention($Code_Mention, $data) {
        $this->db->where('Code_Mention', $Code_Mention);
        return $this->db->update('mention', $data);
    }
    public function getMention($Code_Mention){
        $this->db->where('Code_Mention', $Code_Mention);
        $query = $this->db->get('mention');
        return $query->result();
    }
    public function modifier_Etudiant($Numero_Matricule, $data) {
        $this->db->where('Numero_Matricule', $Numero_Matricule);
        return $this->db->update('etudiant', $data);
    }
    public function getEtudiant($Numero_Matricule){
        $this->db->where('Numero_Matricule', $Numero_Matricule);
        $query = $this->db->get('etudiant');
        return $query->result();
    }
    public function getRecu($N){
        $this->db->where('N', $N);
        $query = $this->db->get('payement');
        return $query->result();
    }
    public function verify_password($Id_compte, $ancien_mot_de_passe) {
        $this->db->select('Mdp');
        $this->db->from('compte');
        $this->db->where('Id_compte', $Id_compte);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $hashed_password = $row->Mdp;
    
            // Vérifier si l'ancien mot de passe correspond au mot de passe haché enregistré
            return password_verify($ancien_mot_de_passe, $hashed_password);
        } else {
            // Gérer l'erreur d'une manière appropriée (par exemple, enregistrer les erreurs dans un journal)
            log_message('error', 'Compte non trouvé lors de la vérification du mot de passe.');
            return FALSE;
        }
    }
    
    public function update_password($Id_compte, $nouveau_mot_de_passe) {
        $hashed_password = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);
        $data = array('Mdp' => $hashed_password);
        $this->db->where('Id_compte', $Id_compte);
    
        // Vérifier si la mise à jour a réussi
        if ($this->db->update('compte', $data)) {
            return TRUE;
        } else {
            // Gérer l'erreur d'une manière appropriée (par exemple, enregistrer les erreurs dans un journal)
            log_message('error', 'Erreur lors de la mise à jour du mot de passe.');
            return FALSE;
        }
    }

    public function getMontantRestant($numeroMatricule) {
        // Récupérer le montant restant (RestePayer) du niveau associé au Numero_Matricule
        $this->db->select('Cout_niveau');
        $this->db->from('niveau');
        $this->db->join('etudiant', 'etudiant.Niveau = niveau.Grade');
        $this->db->where('etudiant.Numero_Matricule', $numeroMatricule);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->Cout_niveau;
        } else {
            return 0; // ou une valeur par défaut selon votre besoin
        }
    }
    public function updateRestePayer($numeroMatricule, $nouveauMontantRestant) {
        // Mettre à jour le champ RestePayer dans la table niveau
        $this->db->set('Cout_niveau', $nouveauMontantRestant);
        $this->db->where('Grade', $this->getNiveauByNumeroMatricule($numeroMatricule));
        $this->db->update('niveau');
    }
    public function getNiveauByNumeroMatricule($numeroMatricule) {
        $this->db->select('Niveau');
        $this->db->from('etudiant');
        $this->db->where('Numero_Matricule', $numeroMatricule);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->Niveau;
        } else {
            return null; // ou une valeur par défaut selon votre besoin
        }
    }
    

    }
?>