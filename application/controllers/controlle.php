<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'dompdf/autoload.inc.php');
use Dompdf\Dompdf;


class controlle extends CI_Controller {

	public function login()
	{
		$this->load->view('Login');
	}
	public function inscrire()
	{
		$this->load->view('inscrire');
		
	}
	public function GererCompte()
	{
		$matGr['modtype']=$this->mode->get_typeCompte('type_compte');
		$matGr['modGr']=$this->mode->get_Empl('compte');
		$this->load->view('gererCompte',$matGr);
		
	}
	public function GererEmp()
	{
		$matGr['modtype']=$this->mode->get_typeCompte('type_compte');
		$matGr['modGr']=$this->mode->get_Empl('compte');
		$this->load->view('gererEmployer',$matGr);
		
	}
	
	public function Logout()
	{
		//On detruit la session et on redirige vers la page de login
		$this->session->sess_destroy();
		redirect('/controlle/Login');
	}

	public function index()
	{
		$matindex['modniv'] = $this->mode->get_Niveau('niveau');
		$matindex['modmen'] = $this->mode->get_Mention('mention');
		$matindex['mod'] = $this->mode->get_Etudiant('etudiant');
		$matindex['modniv'] = $this->mode->get_Niveau('niveau');
	
		$this->load->view('index',$matindex);
	}
	public function statistique()
	{$matniv['modver']=$this->mode->get_verification('verification');
		$matniv['modniv'] = $this->mode->get_Niveau('niveau');
		$matniv['modmen'] = $this->mode->get_Mention('mention');
		$matniv['mod'] = $this->mode->get_Etudiant('etudiant');
		$matniv['modniv'] = $this->mode->get_Niveau('niveau');
		$this->load->view('statistique',$matniv);
	}
	public function payement()
	{	$matpay['modver']=$this->mode->get_verification('verification');
		$matpay['modpay']=$this->mode->get_Mdpayement('modepayement');
		$matpay['modpayetu']=$this->mode->get_payementetu('payementetu');
		$this->load->view('payement',$matpay);
	}
	public function payementEtu()
	{	$matpay['modpay']=$this->mode->get_Mdpayement('modepayement');
		$matpay['modpayetu']=$this->mode->get_payementetu('payementetu');
		$this->load->view('payementEtu',$matpay);
	}
	public function validerPay()
	{	$matpay['modpay']=$this->mode->get_Mdpayement('modepayement');
		$matpay['modpayetu']=$this->mode->get_payementetu('payementetu');
		$this->load->view('validerPay',$matpay);
	}
	public function valPay()
	{	$matpay['modpay']=$this->mode->get_Mdpayement('modepayement');
		$matpay['modpayetu']=$this->mode->get_payementetu('payementetu');
		$this->load->view('validerEffect',$matpay);
	}
	public function verification()
	{	
		$matver['modver']=$this->mode->get_verification('verification');
		$this->load->view('verification',$matver);
	}
	public function recu()
{
    $data['modrecu'] = $this->mode->getRecu('payement');
    $this->load->view('recu', $data);
}


	public function search_keyword()
	{
		$keyword = $this->input->post('keyword');
		$data=array();
		$data['mod']=$this->mode->searchKey($keyword);
		$this->load->view('etudiant',$data);
	}
	public function historique($Numero_Matricule)
{
    $data = array();
    $data['modhistopay'] = $this->mode->searchKeyhisto($Numero_Matricule);
    $this->load->view('historique', $data);
}



	public function etudiant()
	{ 
		$mat['modniv'] = $this->mode->get_Niveau('niveau');
		$mat['modmen'] = $this->mode->get_Mention('mention');
		$mat['mod'] = $this->mode->get_Etudiant('etudiant');

		/*$this->load->library('pagination_bootstrap');

		$perPage=10;
		$config['base_url'] = base_url();
		$page=0;

		if($this->input->get('page'))
		{
			$page = $this->input->get('page');
		}
		$start_index=0;
		if($page!=0)
		{
			$start_index = $perPage * ($page - 1);
		}
		$total_rows=0;
		if($this->input->get('search_text')!=null)
		{
			$search_text=$this->input->get('search_text');
			$this->data['etudiant']=$this->mode->get_searchEtudiant($perPage,$start_index,$search_text,$is_count=0);
			$total_rows=$this->mode->get_searchEtudiant(null,null,$search_text,$is_count=1);
		}
		else
		{
			$this->data['etudiant']=$this->mode->get_searchEtudiant($perPage,$start_index,null,$is_count=0);
			$total_rows=$this->mode->get_searchEtudiant(null,null,null,$is_count=1);
		}
		$config['total_rows']=$total_rows;

		$config['per_page']=$perPage;
		$config['enable_query_strings']=true;
		$config['use_page_numbers']=true;
		$config['page_query_string']=true;
		$config['page_query_segment']='page';
		$config['reuse_query_string']=true;
		$config['full_tag_open']='<ul class="pagination">';
		$config['full_tag_close']='</ul'>
		$config['first_link']='First';
		$config['last_link']='Last';
		$config['first_tag_open']='<li class="page-item"><span class="page-link">';
		$config['last_tag_close']='<span></li>';
		$config['prev_link']='&lanquo';
		$config['prev_tag_open']='<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']='<span></li>';
		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item><span class="page-link">';
		$config['next_tag_close']='</span></li>';
		$config['last_tag_open']='<li class="page-item><span class="page-link">';
		$config['last_tag_close']='</span></li>';
		$config['cur_tag_open']='<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close']='</a></li>';
		$config['num_tag_open']='<li class="page-item"><span class="page-link">';
		$config['num_tag_close']='</span></li>';

		$this->pagination->initialize($config);
		$this->data['page']=$page;
		$this->data['links']=$this->pagination->create_links(); 

		*/$this->load->view('etudiant',$mat);		
	}
	public function mention()
	{
		$matmen['modmen'] = $this->mode->get_Mention('mention');
		$this->load->view('mention',$matmen);
	}
	public function niveau()
	{		
		$matniv['modniv'] = $this->mode->get_Niveau('niveau');
		$this->load->view('niveau',$matniv);
	}
	public function insertionCompte() {
				
		// Définition des règles de validation de formulaire
		$this->form_validation->set_rules('Nom_utilisateur', 'Nom_utilisateur', 'required');
		$this->form_validation->set_rules('Adresse_Email', 'Adresse_Email', 'required');
		$this->form_validation->set_rules('Mdp', 'Mdp', 'required');
		$this->form_validation->set_rules('conf_Mdp', 'conf_Mdp', 'required');
		$this->form_validation->set_rules('type', 'type', 'required');
		
		// Exécution de la validation de formulaire
		if ($this->form_validation->run() == FALSE) {
		   // Si la validation échoue, afficher le formulaire à nouveau avec les erreurs
		   // Si la validation échoue, afficher une alerte d'erreur
		   $alerte = "<script>alert('Votre inscription a échoué. Veuillez vérifier vos entrées.')</script>";
		   $this->session->set_flashdata('alerte', $alerte);
		   $this->load->view('inscrire');
		} else {
		   // Si la validation réussit, insérer les données dans la base de données
		   $data = array(
			  'Nom_utilisateur' => $this->input->post('Nom_utilisateur'),
			  'Adresse_Email' => $this->input->post('Adresse_Email'),
			  'Mdp' =>$this->input->post('Mdp'), 
			  'Id_type_compte' =>$this->input->post('type')
		   );
		   $this->mode->insertUtilisateur($data);
		   // Afficher une alerte de succès
		   $alerte = "<script>alert('Le compte a été créé avec succès.')</script>";
		   $this->session->set_flashdata('alerte', $alerte);
		   // Rediriger vers une page de succès
		   redirect('controlle/Login');
		}
	 }
	 public function insertionCompteEmp() {
				
		// Définition des règles de validation de formulaire
		$this->form_validation->set_rules('Nom_utilisateur', 'Nom_utilisateur', 'required');
		$this->form_validation->set_rules('Adresse_Email', 'Adresse_Email', 'required');
		$this->form_validation->set_rules('Mdp', 'Mdp', 'required');
		$this->form_validation->set_rules('Role', 'Role', 'required');
		
		// Exécution de la validation de formulaire
		if ($this->form_validation->run() == FALSE) {
		   // Si la validation échoue, afficher le formulaire à nouveau avec les erreurs
		   // Si la validation échoue, afficher une alerte d'erreur
		   $alerte = "<script>alert('Votre inscription a échoué. Veuillez vérifier vos entrées.')</script>";
		   $this->session->set_flashdata('alerte', $alerte);
		   $this->load->view('gererEmployer');
		} else {
		   // Si la validation réussit, insérer les données dans la base de données
		   $data = array(
			  'Nom_utilisateur' => $this->input->post('Nom_utilisateur'),
			  'Adresse_Email' => $this->input->post('Adresse_Email'),
			  'Mdp' =>$this->input->post('Mdp'), 
			  'Id_type_compte' =>$this->input->post('Role')
		   );
		   $this->mode->insertUtilisateur($data);
		   // Afficher une alerte de succès
		   $alerte = "<script>alert('Le compte a été créé avec succès.')</script>";
		   $this->session->set_flashdata('alerte', $alerte);
		   // Rediriger vers une page de succès
		   redirect('controlle/GererEmp');
		}
	 }
	
	
	 public function authentification()
	 {
		 $email = $this->input->post('Email_Administration');
		 $password = $this->input->post('Mot_de_passe');
	 
		 $admin_data = $this->mode->get_admin_data($email);
	 
		 if ($admin_data !== false && $this->mode->Login_Utilisateur($email, $password)) {
			 $session_data = array(
				 'go' => TRUE,
				 'admin_id' => $admin_data->Id_compte,
				 'admin_name' => $admin_data->Nom_utilisateur,
				 'admin_email' => $admin_data->Adresse_Email,
				 'type_compte' => $admin_data->Id_type_compte, // Ajout de la variable 'type_compte'
			 );
	 
			 $this->session->set_userdata($session_data);
	 
			 if ($this->session->userdata('type_compte') == 3) {
				 // Code pour le type_compte égal à 3
			 } elseif ($this->session->userdata('type_compte') == 2) {
				 // Code pour le type_compte égal à 2
			 } elseif ($this->session->userdata('type_compte') == 1) {
				 // Code pour le type_compte égal à 1
			 }redirect('controlle/index');
		 } else {
			 $this->session->set_flashdata('error', 'Mot de passe incorrect ou administrateur non trouvé');
			 redirect('controlle/login');
		 }
	 }
	 
	 public function inscrirEtudiant() {
				
		// Définition des règles de validation de formulaire
		$this->form_validation->set_rules('Nom', 'Nom', 'required');
		$this->form_validation->set_rules('Prenom', 'Prenom', 'required');
		$this->form_validation->set_rules('Datenaissance', 'Date de naissance', 'required');
		$this->form_validation->set_rules('Sexe', 'Sexe', 'required');
		$this->form_validation->set_rules('Adresse', 'Adresse', 'required');
		$this->form_validation->set_rules('Telephone', 'Telephone', 'required');
		$this->form_validation->set_rules('Email', 'Email', 'required');
		$this->form_validation->set_rules('Mention', 'Mention', 'required');
		$this->form_validation->set_rules('Niveau', 'Niveau', 'required');
		$this->form_validation->set_rules('responsable', 'Responsable', 'required');
		$this->form_validation->set_rules('Fonction', 'Fonction', 'required');
		$this->form_validation->set_rules('Emailresponsable', 'Email_resp', 'required');

		// Exécution de la validation de formulaire
		if ($this->form_validation->run() == FALSE) {
		   // Si la validation échoue, afficher le formulaire à nouveau avec les erreurs
		   // Si la validation échoue, afficher une alerte d'erreur
		   $alerte = "<script>alert('Votre inscription a échoué. Veuillez vérifier tous les informations sur l'etudiant.')</script>";
		   $this->session->set_flashdata('alerte', $alerte);
		   $this->load->view('etudiant');
		} else {
		   // Si la validation réussit, insérer les données dans la base de données
		   $data = array(
			  'Nom_Etudiant' => $this->input->post('Nom'),
			  'Prenom_Etudiant' => $this->input->post('Prenom'),
			  'Date_Naissance' =>$this->input->post('Datenaissance'), 
			  'Sexe' => $this->input->post('Sexe'),
			  'Adresse' => $this->input->post('Adresse'),
			  'Numero_telephone' => $this->input->post('Telephone'),
			  'Email' => $this->input->post('Email'),
			  'Mention' => $this->input->post('Mention'),
			  'Niveau' => $this->input->post('Niveau'),
			  'Responsable' =>$this->input->post('responsable'),
			  'Fonction' =>$this->input->post('Fonction'),
			  'Email_Responsable' =>$this->input->post('Emailresponsable')
		   );
		   $this->mode->insertEtudiant($data);
	   // Afficher une alerte de succès
	   $alerte = "<script>alert('L'information sur l'Etudiant a été enregistrer avec succès.')</script>";
	   $this->session->set_flashdata('alerte', $alerte);
	   // Rediriger vers une page de succès
	   redirect('controlle/etudiant');
		}
	 }

	 public function ajoutNiveau() {
				
		// Définition des règles de validation de formulaire
		
		$this->form_validation->set_rules('grade', 'grade', 'required');
		$this->form_validation->set_rules('cout_niveau', 'cout_niveau', 'required');

		// Exécution de la validation de formulaire
		if ($this->form_validation->run() == FALSE) {
		   // Si la validation échoue, afficher le formulaire à nouveau avec les erreurs
		   // Si la validation échoue, afficher une alerte d'erreur
		   $alerte = "<script>alert('Votre ajout a échoué. Veuillez vérifier vos donnée.')</script>";
		   $this->session->set_flashdata('alerte', $alerte);
		   $this->load->view('niveau');
		} else {
		   // Si la validation réussit, insérer les données dans la base de données
		   $data = array(			
			'Grade' => $this->input->post('grade'),
			'Cout_niveau' =>$this->input->post('cout_niveau')
		   );
		   $this->mode->insertNiveau($data);
	   // Afficher une alerte de succès
	   $alerte = "<script>alert('L'insertion d'ume nouvelle niveau a été ajouté avec succès.')</script>";
	   $this->session->set_flashdata('alerte', $alerte);
	   // Rediriger vers une page de succès
	   redirect('controlle/niveau');
		}
	}	
	public function ajoutMention() {
				
		// Définition des règles de validation de formulaire
		
		$this->form_validation->set_rules('AjoutMention', 'AjoutMention', 'required');
		// Exécution de la validation de formulaire
		if ($this->form_validation->run() == FALSE) {
		   // Si la validation échoue, afficher le formulaire à nouveau avec les erreurs
		   // Si la validation échoue, afficher une alerte d'erreur
		   $alerte = "<script>alert('Votre ajout a échoué. Veuillez vérifier vos donnée.')</script>";
		   $this->session->set_flashdata('alerte', $alerte);
		   $this->load->view('mention');
		} else {
		   // Si la validation réussit, insérer les données dans la base de données
		   $data = array(			
			'Nom_Mention' => $this->input->post('AjoutMention')
		   );
		   $this->mode->insertMention($data);
	   // Afficher une alerte de succès
	   $alerte = "<script>alert('L'insertion d'ume nouvelle mention a été ajouté avec succès.')</script>";
	   $this->session->set_flashdata('alerte', $alerte);
	   // Rediriger vers une page de succès
	   redirect('controlle/mention');
		}
	}	
	public function Payer() {
				
		// Définition des règles de validation de formulaire
		
		$this->form_validation->set_rules('Matricule', 'Matricule', 'required');
		$this->form_validation->set_rules('DatePayer', 'DatePayer', 'required');
		$this->form_validation->set_rules('ModePayer', 'ModePayer', 'required');
		$this->form_validation->set_rules('Motif', 'Motif', 'required');
		$this->form_validation->set_rules('Montant', 'Montant', 'required');
		

		// Exécution de la validation de formulaire
		if ($this->form_validation->run() == FALSE) {
		   // Si la validation échoue, afficher le formulaire à nouveau avec les erreurs
		   // Si la validation échoue, afficher une alerte d'erreur
		   $alerte = "<script>alert('Votre payement a échoué. Veuillez vérifier vos donnée.')</script>";
		   $this->session->set_flashdata('alerte', $alerte);
		   $this->load->view('payement');
		} else {
		   // Si la validation réussit, insérer les données dans la base de données
		   $data = array(			
			'Numero_Matricule' => $this->input->post('Matricule'),
			'DatePayement' => $this->input->post('DatePayer'),
			'Modepayer' => $this->input->post('ModePayer'),
			'Motif' => $this->input->post('Motif'),
			'Montant' =>$this->input->post('Montant')
		   );
		    // Récupérer le montant restant (RestePayer) du niveau associé au Numero_Matricule
			$montantRestant = $this->mode->getMontantRestant($this->input->post('Matricule'));

			// Soustraire le montant du paiement du montant restant
			$nouveauMontantRestant = $montantRestant - $this->input->post('Montant');
	
			// Mettre à jour le champ RestePayer dans la table niveau
			$this->mode->updateRestePayer($this->input->post('Matricule'), $nouveauMontantRestant);
	
		   $this->mode->Payement($data);
		 // Afficher une alerte de succès
	   $alerte = "<script>alert('Le paiement a été effectué avec succès.')</script>";
	   $this->session->set_flashdata('alerte', $alerte);
	   // Rediriger vers une page de succès
	   redirect('controlle/recu/');
		}
	}
	public function valPayer() {
				
		// Définition des règles de validation de formulaire
		
		$this->form_validation->set_rules('Matricule', 'Matricule', 'required');
		$this->form_validation->set_rules('DatePayer', 'DatePayer', 'required');
		$this->form_validation->set_rules('ModePayer', 'ModePayer', 'required');
		$this->form_validation->set_rules('Motif', 'Motif', 'required');
		$this->form_validation->set_rules('Montant', 'Montant', 'required');
		

		// Exécution de la validation de formulaire
		if ($this->form_validation->run() == FALSE) {
		   // Si la validation échoue, afficher le formulaire à nouveau avec les erreurs
		   // Si la validation échoue, afficher une alerte d'erreur
		   $alerte = "<script>alert('Votre payement a échoué. Veuillez vérifier vos donnée.')</script>";
		   $this->session->set_flashdata('alerte', $alerte);
		   $this->load->view('payement');
		} else {
		   // Si la validation réussit, insérer les données dans la base de données
		   $data = array(			
			'Numero_Matricule' => $this->input->post('Matricule'),
			'DatePayement' => $this->input->post('DatePayer'),
			'Modepayer' => $this->input->post('ModePayer'),
			'Motif' => $this->input->post('Motif'),
			'Montant' =>$this->input->post('Montant')
		   );
		   $this->mode->Payement($data);
		 // Afficher une alerte de succès
	   $alerte = "<script>alert('Le paiement a été effectué avec succès.')</script>";
	   $this->session->set_flashdata('alerte', $alerte);
	   // Rediriger vers une page de succès
	   redirect('controlle/valPay/'.$payementetu->N);
		}
	}
	public function PayerEtu() {
				
		// Définition des règles de validation de formulaire
		
		$this->form_validation->set_rules('Matricule', 'Matricule', 'required');
		$this->form_validation->set_rules('DatePayer', 'DatePayer', 'required');
		$this->form_validation->set_rules('ModePayer', 'ModePayer', 'required');
		$this->form_validation->set_rules('Motif', 'Motif', 'required');
		$this->form_validation->set_rules('Montant', 'Montant', 'required');
		$this->form_validation->set_rules('Preuve', 'Preuve', 'required');
		

		// Exécution de la validation de formulaire
		if ($this->form_validation->run() == FALSE) {
		   // Si la validation échoue, afficher le formulaire à nouveau avec les erreurs
		   // Si la validation échoue, afficher une alerte d'erreur
		   $alerte = "<script>alert('Votre payement a échoué. Veuillez vérifier vos donnée.')</script>";
		   $this->session->set_flashdata('alerte', $alerte);
		   $this->load->view('payement');
		} else {
		   // Si la validation réussit, insérer les données dans la base de données
		   $data = array(			
			'Numero_Matricule' => $this->input->post('Matricule'),
			'DatePayement' => $this->input->post('DatePayer'),
			'Modepayer' => $this->input->post('ModePayer'),
			'Motif' => $this->input->post('Motif'),
			'Montant' =>$this->input->post('Montant'),
			'Preuve' => $this->input->post('Preuve')
		   );
		   $this->mode->Payementetu($data);
		 // Afficher une alerte de succès
	   $alerte = "<script>alert('Le paiement a été effectué avec succès.')</script>";
	   $this->session->set_flashdata('alerte', $alerte);
	   // Rediriger vers une page de succès
	   redirect('controlle/payement/');
		}
	}	
	public function supprimerNiveau($Code_Niveau) {
			
		// Charger le modèle pour accéder à la base de données et supprimer l'offre
		$this->mode->supprimerNiveau($Code_Niveau);
		//$link = base_url('index.php/controle/index');
		// Rediriger vers la page d'origine
		redirect('controlle/niveau');
	}
	public function supprimerMention($Code_Mention) {
			
		// Charger le modèle pour accéder à la base de données et supprimer l'offre
		$this->mode->supprimerMention($Code_Mention);
		//$link = base_url('index.php/controle/index');
		// Rediriger vers la page d'origine
		redirect('controlle/mention');
	}
	public function supprimerEtudiant($Numero_Matricule) {
			
		// Charger le modèle pour accéder à la base de données et supprimer l'offre
		$this->mode->supprimerEtudiant($Numero_Matricule);
		//$link = base_url('index.php/controle/index');
		// Rediriger vers la page d'origine
		redirect('controlle/etudiant');
	}
	public function supprimerPayementetu($N) {
			
		// Charger le modèle pour accéder à la base de données et supprimer l'offre
		$this->mode->supprimerPayetu($N);
		//$link = base_url('index.php/controle/index');
		// Rediriger vers la page d'origine
		redirect('controlle/payement');
	}
	public function ModifierNiveau() {
		// Récupérer les données du formulaire
		$Code_Niveau = $this->input->post('Code');
		$data = array(
			'Grade'=>$this->input->post('Grade'),
			'Cout_niveau'=>$this->input->post('Cout_niveau')
		);
		// Charger le modèle pour accéder à la base de données
		$this->mode->modifier_Niveau($Code_Niveau, $data);
					
		// Rediriger vers la page d'origine
		redirect('controlle/niveau');
	}
	public function ModifierMention() {
		// Récupérer les données du formulaire
		$Code_Mention = $this->input->post('Codemention');
		$data = array(
			'Nom_Mention' => $this->input->post('mention')
		);
		// Charger le modèle pour accéder à la base de données
		$this->mode->modifier_Mention($Code_Mention, $data);
					
		// Rediriger vers la page d'origine
		redirect('controlle/mention');
	}
	public function ModifierEtudiant() {
		// Récupérer les données du formulaire
		$Numero_Matricule = $this->input->post('Matricule');
		$data = array(
			'Nom_Etudiant' => $this->input->post('Nom'),
			  'Prenom_Etudiant' => $this->input->post('Prenom'),
			  'Date_Naissance' =>$this->input->post('Datenaissance'), 
			  'Adresse' => $this->input->post('Adresse'),
			  'Numero_telephone' => $this->input->post('Telephone'),
			  'Email' => $this->input->post('Email'),
			  
			  'Niveau' => $this->input->post('Niveau'),
			  'Responsable' =>$this->input->post('responsable'),
			  'Fonction' =>$this->input->post('Fonction'),
			  'Email_Responsable' =>$this->input->post('Emailresponsable')
		);
		// Charger le modèle pour accéder à la base de données
		$this->mode->modifier_Etudiant($Numero_Matricule, $data);
					
		// Rediriger vers la page d'origine
		redirect('controlle/etudiant');
	}
	/*
	public function ModifierNiveau() {
		// Validation des champs
		$this->form_validation->set_rules('Grade', 'Grade', 'required');
		$this->form_validation->set_rules('Cout_niveau', 'Cout_niveau', 'required');
	
		if ($this->form_validation->run() === FALSE) {
			// Gérer les erreurs de validation (redirection, affichage des messages d'erreur, etc.)
		} else {
			// Récupérer les données du formulaire
			$Code_Niveau = $this->input->post('Code');
			$data = array(
				'Grade' => $this->input->post('Grade'),
				'Cout_niveau' => $this->input->post('Cout_niveau')
			);
	
			// Charger le modèle pour accéder à la base de données
			$result = $this->mode->modifier_Niveau($Code_Niveau, $data);
	
			if ($result) {
				// Mise à jour réussie - rediriger vers la page d'origine
				redirect('controlle/niveau');
			} else {
				// Gérer les erreurs de mise à jour (redirection, affichage des messages d'erreur, etc.)
			}
		}
	}*/
	public function supprimerEmp($Id_compte) {
			
		// Charger le modèle pour accéder à la base de données et supprimer l'offre
		$this->mode->supprimerEmpl($Id_compte);
		//$link = base_url('index.php/controle/index');
		// Rediriger vers la page d'origine
		redirect('controlle/GererEmp');
	}
	public function supprimerCompte($Id_compte) {
			
		// Charger le modèle pour accéder à la base de données et supprimer l'offre
		$this->mode->supprimerEmpl($Id_compte);
		//$link = base_url('index.php/controle/index');
		// Rediriger vers la page d'origine
		redirect('controlle/GererCompte');
	}

	public function __construct() {
		parent::__construct();
		// Chargez les bibliothèques et modèles nécessaires ici
	}
	
	public function generate_pdf() {
		// Récupérez les données du formulaire
		$name = $this->input->post('name');
		$amount = $this->input->post('amount');
		$purpose = $this->input->post('purpose');
		$class = $this->input->post('class');
		$date = $this->input->post('date');
	
		// Chargez la bibliothèque Dompdf
		$this->load->library('dompdf_library');
	
		// Commencez à générer le PDF
		$html = '<h1>PDF Content Here</h1>'; // Remplacez par le contenu réel de votre PDF
		$this->dompdf_library->loadHtml($html);
	
		// (Optionnel) Configurez Dompdf selon vos besoins
	
		// Générez le PDF
		$this->dompdf_library->render();
	
		// Obtenez le contenu du PDF généré
		$output = $this->dompdf_library->output();
	
		// Enregistrez le PDF sur le serveur ou envoyez-le en sortie selon vos besoins
		$pdfFilePath = FCPATH . 'assets/generated_pdfs/' . 'recu.pdf';
		file_put_contents($pdfFilePath, $output);
	
		// Envoyez une réponse au client (facultatif)
		echo json_encode(array('status' => 'success', 'message' => 'PDF generated successfully', 'pdf_path' => base_url('assets/generated_pdfs/recu.pdf')));
	}
	public function change_password() {
		// Valider le formulaire
		$this->form_validation->set_rules('ancien', 'Ancien mot de passe', 'required');
		$this->form_validation->set_rules('nouveau', 'Nouveau mot de passe', 'required');
		$this->form_validation->set_rules('confirme', 'Confirmation du mot de passe', 'required|matches[nouveau]');
	
		if ($this->form_validation->run() == FALSE) {
			// Validation du formulaire échouée, réafficher le formulaire
			$this->load->view('statistique');
		} else {
			// Validation du formulaire réussie, procéder au changement de mot de passe
			$ancien_mot_de_passe = $this->input->post('ancien');
			$nouveau_mot_de_passe =$this->input->post('nouveau');
	
			// Récupérer l'identifiant du compte à partir de la session (ajustez cela en fonction de votre logique)
			$Id_compte = $this->session->userdata('Id_compte');
	
			// Vérifier l'ancien mot de passe
			if ($this->mode->verify_password($Id_compte, $ancien_mot_de_passe)) {
				// Mettre à jour le mot de passe
				$this->mode->update_password($Id_compte, $nouveau_mot_de_passe);
	
				// Rediriger ou afficher un message de succès
				redirect('controlle/login');
			} else {
				// Afficher un message d'erreur si l'ancien mot de passe est incorrect
				$data['error'] = 'L\'ancien mot de passe est incorrect.';
				$this->load->view('statistique', $data);
			}
		}
	}
	

	}
