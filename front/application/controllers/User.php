
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();

		$this->load->helper('functions');
		$this->load->helper('security');

		$this->load->model('user_model'); 
		$this->load->model('country_model'); 
	}

	/*
		Affiche le formulaire d'inscription ou 
		si le user est connecté sa page d'accueil.
	*/

	public function index()
	{
		if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') != "AFRICASH-USER")) 
		{
			$this->session->sess_destroy(); 
			$data	  = array('error' => ''); 
			$content  = $this->load->view('user/login.php', $data , TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- Envoyez de l'aregent à vos proches en un click"
			); 
			$this->load->view('templates/nc_template.php', $data); 
		}else
		{
			$transferts = $this->user_model->get_user_nb_transferts($this->session->userdata('user'), 0, 3);
			$recipients = $this->user_model->get_user_nb_recipients($this->session->userdata('user'), 0, 3);
			$data	  = array('error' => 'error', 'transferts' => $transferts, 'recipients' => $recipients); 
			$content  = $this->load->view('user/c_home.php', $data , TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- "
			); 
			$this->load->view('templates/c_template.php', $data); 
			return; 
		}
	}

	public function simulator($step=null)
	{
		if ( $step == "connexion" ) {
			if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') != "AFRICASH-USER")) 
			{
				$this->session->set_userdata('simulator_amount', xss_clean($this->input->post('amount')));
				$this->session->set_userdata('simulator_country_from', xss_clean($this->input->post('country_from')));
				$this->session->set_userdata('simulator_country_to', xss_clean($this->input->post('country_to')));

				$data	  = array('error' => ''); 			
				$content  = $this->load->view('user/simulator_login.php', $data , TRUE);
				$data 	  = array(
					'content'	=>	$content,
					'title'		=>	"Africash -- Envoyez de l'aregent à vos proches en un click"
				); 
				$this->load->view('templates/nc_template.php', $data); 
				return; 
			}
		}
			

		if ( $step == "registration" ) {
			if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') != "AFRICASH-USER")) 
			{
				$countries = $this->country_model->get_all_countries_send_money();
				$content  = $this->load->view('user/simulator_registration.php', array('countries' => $countries), TRUE);
				$data 	  = array(
					'content'	=>	$content,
					'title'		=>	"Africash -- Inscrivez vous!"
				); 
				$this->load->view('templates/nc_template.php', $data); 
				return; 
			}
		}	
		if ( $step == "register" ) {
			if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') != "AFRICASH-USER")) 
			{
				$this->_treat_registration("simulator_");
			}
		}
			
		if ( $step == "recipient" ) {
			$this->_treat_recipient_create("simulator_");
		}
				
		if ( $step == "connect" ) {
			$this->load->library('form_validation');
				$this->load->helper('security');
		
				$email		=	xss_clean($this->input->post('email', TRUE));
				$password	=	xss_clean($this->input->post('password', TRUE));
		
				print_r($this->session->userdata()); 	
				$this->form_validation->set_rules('email', 'L\'adresse email', 'trim|required|valid_email', 
	 				array('required'	=>	'%s ne peut pas être vide.',
	  			      'valid_email'	=>	'%s doit être du bon format d\'email.'));
	 
				$this->form_validation->set_rules('password', 'Le mot de passe', 'trim|required|min_length[8]', 
					array('required'	=>	'%s ne peut pas être vide.',
					'min_length'		=>	'%s doit contenir au moins %s caractères.'
				));
		

				if ($this->form_validation->run() == FALSE)
				{
					$data	  = array('error' => ''); 
					$content  = $this->load->view('user/simulator_login.php', $data , TRUE);
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- Envoyez de l'aregent à vos proches en un click"
					); 
					$this->load->view('templates/nc_template.php', $data); 
					return; 
				}
				$password	=	hash('sha512', $password);
				if ( $this->user_model->exists($email, $password) == TRUE) 
				{
					$this->_create_session($email, $password); 
					

					$recipients = $this->user_model->get_user_recipients($this->session->userdata('user')); 
					$data	  = array('error' => '', 'datas' => $this->input->post(), 'recipients' => $recipients); 
					$content  = $this->load->view('user/simulator_transfert_recipient_choose.php', $data , TRUE);
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- Envoyez de l'aregent à vos proches en un click"
					); 
					$this->load->view('templates/c_template.php', $data); 
					return; 
				}else {
					$data	  = array('error' => 'error'); 
					$content  = $this->load->view('user/simulator_login.php', $data , TRUE);
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- Connexion"
					); 
					$this->load->view('templates/nc_template.php', $data); 
					return; 
				}
			}

	}
	/**
		Affiche lapage d'incription seulemùent. Sans traiter le formulaire.
	*/	
	public function registration($step = null)
	{
		if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') != "AFRICASH-USER")) 
		{
			$this->session->sess_destroy(); 
			$countries = $this->country_model->get_all_countries_send_money();
			$content  = $this->load->view('user/registration.php', array('countries' => $countries), TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- Inscrivez vous!"
			); 
			$this->load->view('templates/nc_template.php', $data); 
		}else
		{
			redirect ('/', 'location'); 
		}
	}

	public function show_transferts($page=null)
	{
		if ( $page == null || $page == 0 ) 
		{
			$transferts = $this->user_model->get_user_nb_transferts($this->session->userdata('user'), 0, 10); 
			$all_transferts = $this->user_model->get_user_transferts($this->session->userdata('user')); 
			$content  = $this->load->view('user/c_transferts.php', array ('status'	=> '', 'transferts' => $transferts, 'page' => 0, 'all_transferts' => $all_transferts), TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- "
			); 
			$this->load->view('templates/c_template.php', $data); 
		}else if ( intval($page) > 0 ) {
			$all_transferts = $this->user_model->get_user_transferts($this->session->userdata('user')); 
			$transferts = $this->user_model->get_user_nb_transferts($this->session->userdata('user'),((10*intval($page))-1),10); 
			$content  = $this->load->view('user/c_transferts.php', array ('status'	=> '', 'transferts' => $transferts, 'page' => $page, 'all_transferts' => $all_transferts), TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- "
			); 
			$this->load->view('templates/c_template.php', $data); 
		}else {
			$all_transferts = $this->user_model->get_user_transferts($this->session->userdata('user')); 
			$transferts = $this->user_model->get_user_nb_transferts($this->session->userdata('user'), 0, 10); 
			$content  = $this->load->view('user/c_transferts.php', array ('status'	=> '', 'transferts' => $transferts, 'page' => 0, 'all_transferts' => $all_transferts), TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- "
			); 
			$this->load->view('templates/c_template.php', $data); 
		}
			
	}

	/**
		Traite le formulaire d'inscription. L'inscription du user se passe ici. 
	*/	
	public function register()
	{
		if ( ($this->session->userdata('user') !== null )&& ($this->session->userdata('type') == "AFRICASH-USER")) 
		{
			redirect ('/', 'location'); 
		}
		$this->_treat_registration("");

	}
	
	public function connexion()
	{
		if ( ($this->session->userdata('user') !== null )&& ($this->session->userdata('type') == "AFRICASH-USER")) 
		{
			redirect ('/', 'location'); 
		}
		/*
			Ici si session existe
		*/
		$this->load->library('form_validation');
		$this->load->helper('security');
	
		$email		=	xss_clean($this->input->post('email', TRUE));
		$password	=	xss_clean($this->input->post('password', TRUE));
		

		$this->form_validation->set_rules('email', 'L\'adresse email', 'trim|required|valid_email', 
			array('required'	=>	'%s ne peut pas être vide.',
			      'valid_email'	=>	'%s doit être du bon format d\'email.'));

		$this->form_validation->set_rules('password', 'Le mot de passe', 'trim|required|min_length[8]', 
			array('required'	=>	'%s ne peut pas être vide.',
			'min_length'		=>	'%s doit contenir au moins %s caractères.'
		));
		

		if ($this->form_validation->run() == FALSE)
		{
			$data	  = array('error' => ''); 
			$content  = $this->load->view('user/login.php', $data , TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- Envoyez de l'aregent à vos proches en un click"
			); 
			$this->load->view('templates/nc_template.php', $data); 
			return; 
		}
		$password	=	hash('sha512', $password);
		if ( $this->user_model->exists($email, $password) == TRUE) 
		{
			$this->_create_session($email, $password); 
			redirect ('/', 'location'); 
		}else {
			$data	  = array('error' => 'error'); 
			$content  = $this->load->view('user/login.php', $data , TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- Connexion"
			); 
			$this->load->view('templates/nc_template.php', $data); 
			return; 
		}
	}

	/**
		Création de la session.
	*/
	function _create_session($email, $password)
        {
                $customer = $this->user_model->get($email, $password);
                $this->session->set_userdata('type', "AFRICASH-USER");
                $this->session->set_userdata('user', $customer->id);
                $this->session->set_userdata('name', $customer->name);
                $this->session->set_userdata('first_name', $customer->firstname);
                $this->session->set_userdata('email', $customer->email);
                $this->session->set_userdata('adress', $customer->address);
                $this->session->set_userdata('pasword', $customer->password);
                $this->session->set_userdata('country', $customer->country);
                $this->session->set_userdata('phone_number', $customer->phone_number);
        }



	public function card_paiement($reference)
	{
		if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') !== "AFRICASH-USER")) 
		{
			redirect ('/', 'location'); 
		}
		$this->load->library('form_validation');
		$this->load->helper('security');
		$name		=	xss_clean($this->input->post('name', TRUE));
		$card_number	=	xss_clean($this->input->post('card_number', TRUE));
		$expiration_date=	xss_clean($this->input->post('expiration_date', TRUE));
		$cvv		=	xss_clean($this->input->post('cvv', TRUE));
		$this->form_validation->set_rules('name', 'Le nom du titulaire de la carte ', 
			'trim|required',
			array('required'	=>	'%s ne peut pas être vide.',				      
		));
		$this->form_validation->set_rules('card_number', 'Le moyen de paiement ', 
			'trim|required|numeric|min_length[16]|max_length[16]',
			array(	'required'	=>	'Vous devez renseigner votre numéro de carte bleu.',				      
				'numeric'	=>	'%s doit contenir que des chiffres.',				      
				'min_length'	=>	'Il manque des caractères dns le numéro de carte.',				      
				'max_length'	=>	'Le numéro de carte contient des caractères en plus.',				      
			));
		$this->form_validation->set_rules('expiration_date', 'La date d\'expiration ', 
#		'trim|required|min_length[5]|max_length[5]|regex_match[/0[1-9]|1[1-2][1-9][1-9]/]',
		'trim|required|min_length[5]|max_length[5]|callback_validate_card_expiration_date',
		array(	'required'	=>	'Vous devez renseigner la date d\'expiration votre numéro de carte bleu.',
				'min_length'	=>	'%s doit être dans le format mm/aa.',				      
				'max_length'	=>	'%s doit être dans le format mm/aa.',				      
				'validate_card_expiration_date'	=>	'%s doit être dans le format mm/aa.',				      
		));
		$this->form_validation->set_rules('cvv', 'Le code au dos de votre carte ', 
			'trim|required|numeric|min_length[3]|max_length[3]',
		array(	'required'	=>	'%s ne peut pas être vide.',				      
			'numeric'	=>	'%s doit contenir que des chiffres.',				      
			'min_length'	=>	'%s doit contenir 3 chiffres.',				      
			'max_length'	=>	'Le doit contenir 3 chiffres..',				      
		));
		if ($this->form_validation->run() == FALSE)
		{
			$recipients = $this->user_model->get_user_recipients($this->session->userdata('user')); 
			$content  = $this->load->view('user/c_card_paiement.php', array ('status'	=> '', 'reference' => $reference), TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- "
			); 
			$this->load->view('templates/c_template.php', $data); 
			return; 
		}
		/* Envoie dela requete ) la banque */
		echo "Envoi requête à la banque:";		
		echo "<br/>";
		echo "Nom: $name, numéro de carte: $card_number, date d'expiration:$expiration_date, cvv:$cvv";
	}

	public function paiement($type, $reference)
	{
		if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') !== "AFRICASH-USER")) 
		{
			redirect ('/', 'location'); 
		}
		if ( $type == "bank_transfer" )
		{
			$transfert	=	$this->user_model->get_transfert_by_reference($reference);
			$change		=	$this->country_model->get_change(
						$transfert->transfert_currency, $transfert->receive_currency);	
			$amount 	= 	$transfert->amount; 	
			$cost		=	(round(intval($amount)/50)*2.50); 

			$id	  = $this->user_model->get_transfert_id_by_reference($reference); 
			$content  = $this->load->view('user/c_transfert_paiement.php', 
				array ('status'    => 'success', 'reference' => $reference, 'id' => $id, 'amount' => $amount, 'cost' => $cost, 'transfert' => $transfert), TRUE);		
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- "
			); 
			$this->load->view('templates/c_template.php', $data); 
			return; 
		}
		if ( $type == "bank_card" )
		{
			$transfert	=	$this->user_model->get_transfert_by_reference($reference);
			$change		=	$this->country_model->get_change(
						$transfert->transfert_currency, $transfert->receive_currency);	
			$amount 	= 	$transfert->amount; 	
			$cost		=	(round(intval($amount)/50)*2.50); 
			
			$id	  = $this->user_model->get_transfert_id_by_reference(strtolower($reference)); 
			$content  = $this->load->view('user/c_card_paiement.php', 
				array ('status'    => 'success', 'reference' => $reference, 'id' => $id, 'amount' => $amount, 'cost' => $cost, 'transfert' => $transfert), TRUE);		
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- "
			); 
			$this->load->view('templates/c_template.php', $data); 
			return; 
		}
	}
	public function transfert($onglet=null, $recipient=null, $page=null)
	{
		if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') != "AFRICASH-USER")) 
		{
			redirect ('/', 'location'); 
		}
		else {
			if ($onglet == "recipient" ) {
				$recipients = $this->user_model->get_user_recipients($this->session->userdata('user')); 
				$content  = $this->load->view('user/c_transfert_recipient_choose.php', 
					array ('status'	=> '', 'recipients' => $recipients, $recipient => $recipient), TRUE);
				$data 	  = array(
					'content'	=>	$content,
					'title'		=>	"Africash -- "
				); 
				$this->load->view('templates/c_template.php', $data); 
				return;
			}
			else if ($onglet == "new" ) {
				$recipient_object = $this->user_model->get_recipient($recipient);
				$content  = $this->load->view('user/c_transfert_create.php', 
					array ('status'	=> '', 'recipient' => $recipient, 'recipient_object' => $recipient_object), TRUE);
				$data 	  = array(
					'content'	=>	$content,
					'title'		=>	"Africash -- "
				); 
				$this->load->view('templates/c_template.php', $data); 
				return;
			}
			if ($onglet == "create" ) {
				$this->load->library('form_validation');
				$this->load->helper('security');

				$recipient = xss_clean($this->input->post('recipient'));
				$amount		=	xss_clean($this->input->post('amount', TRUE));
				$paiement_mean	=	xss_clean($this->input->post('paiement_means', TRUE));

				$this->form_validation->set_rules('amount', 'Le montant du transfert ', 
					'trim|required|numeric',
					array('required'	=>	'%s ne peut pas être vide.',				      
						'numeric'		=>	'%s doit contenir que des chiffres.',				      
				));
				$this->form_validation->set_rules('paiement_means', 'Le moyen de paiement ', 
					'trim|required|numeric',
					array('required'	=>	'Vous devez choisir un moyen de paiement.',				      
				));
				if ($this->form_validation->run() == FALSE)
				{
					$recipients = $this->user_model->get_user_recipients($this->session->userdata('user')); 
					$content  = $this->load->view('user/c_transfert_create.php', array ('status'	=> '', 'recipients' => $recipients), TRUE);
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- "
					); 
					$this->load->view('templates/c_template.php', $data); 
					return; 
				}
				if ( $paiement_mean == 1 ) // PAIEMENT PAR CARTE
				{
					$cont = "bank_card"; 
				}
				if ( $paiement_mean == 2 ) // VRIEMENT
				{
					$cont = "bank_transfer"; 
				}
				if ( $paiement_mean == 3 ) 
				{
					$cont = "paypal"; 
				}
				$reference		=	uniqid();	
				// Création du transfert
				$recipient_object	=	$this->user_model->get_recipient($recipient);
				$data	=	array (
					'customer'		=>	$this->session->userdata('user'),
					'recipient'		=>	$recipient,
					'amount'		=>	$amount,
					'transfert_currency'	=>	$this->country_model->get_country_currency($this->session->userdata('country')),
					'receive_currency'	=>	$this->country_model->get_country_currency($recipient_object->country),
					'paiement_mean'		=>	$paiement_mean,
					'reference'		=>	$reference,
					'state'			=>	"WAIT_PAIEMENT"
				);

				if ( $this->user_model->create_transfert($data) == 0 ) 
				{
					$transferts = $this->user_model->get_user_transferts($this->session->userdata('user')); 
					$content  = $this->load->view($cont, array ('status'    => 'error', 'reference' => $reference, 'recipient' => $recipient_object), TRUE);					
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- "
					); 
					$this->load->view('templates/c_template.php', $data); 
					return; 
				}
				else
				{
					//$ref	  = $this->user_model->get_transfert_id_by_reference($reference); 
					redirect("user/paiement/$cont/" . strtoupper($reference), 'location');
				}					
			}
			else {
				$transferts = $this->user_model->get_user_nb_transferts($this->session->userdata('user'), 0, 10); 
				$all_transferts = $this->user_model->get_user_transferts($this->session->userdata('user')); 
				$content  = $this->load->view('user/c_transferts.php', array ('status'	=> '', 'transferts' => $transferts, 'page' => 0, 'all_transferts' => $all_transferts), TRUE);
				$data 	  = array(
					'content'	=>	$content,
					'title'		=>	"Africash -- "
				); 
				$this->load->view('templates/c_template.php', $data); 
				
			}
		}
	
	}


	public function summary($reference)
	{
		if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') != "AFRICASH-USER")) 
		{
			redirect ('/', 'location'); 
		}
		$transfert = $this->user_model->get_transfert_by_reference($reference);
		$recipient = $this->user_model->get_transfert_recipient_by_reference($reference); 
		$cost		=	(round(intval($transfert->amount)/50)*2.50); 
		$transfert_cost = 	$this->country_model->get_country_transfert_cost($recipient->country);
		$change         =       $this->country_model->get_change(
                        $transfert->transfert_currency, $transfert->receive_currency);
		$send_currency	=	$this->country_model->get_country_currency_sign($transfert->transfert_currency);
		$receive_currency	=	$this->country_model->get_country_currency_sign($transfert->receive_currency);
		$content  = $this->load->view('user/c_transfert_summary.php', 
			array ( 'status'		=> '', 
				'transfert'		=> $transfert, 
				'recipient' 		=> $recipient, 
				'change' 		=> $change, 
				'send_currency'		=> $send_currency, 
				'receive_currency' 	=> $receive_currency, 
				'transfert_cost' 	=> $transfert_cost, 
				'cost' 			=> $cost
			), 
		TRUE);
		$data 	  = array(
			'content'	=>	$content,
			'title'		=>	"Africash -- "
		); 
		$this->load->view('templates/c_template.php', $data); 
		return;

	}


	public function recipient($onglet = null, $recipient = null, $action = null)
	{
		/** Aucune session n'existe */
		if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') != "AFRICASH-USER")) 
		{
			
			redirect('/', 'location'); 
		}else
		{
			/* Traitement du formulaire*/
			if ( $onglet == "create" ) 
			{ 
				$this->_treat_recipient_create("c_");
			}			
			else if ( $onglet == "update" ) 
			{
				if ( $action == null )
				{
					$recipient_object	=	$this->user_model->get_recipient($recipient); 
					$countries = $this->country_model->get_all_countries_receive_money();
					$data 	  = array(
						'error'	=>	"",
						'recipient'	=>	$recipient_object,
						'countries'	=>	$countries
					); 
					$content  = $this->load->view('user/c_recipient_update.php', $data , TRUE);
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- ."
					); 
					$this->load->view('templates/c_template.php', $data); 
					return;
					
				}
				else if ( $action == "update" )
				{
					$this->load->library('form_validation');
					$this->load->helper('security');
	
	
					$this->form_validation->set_rules('name', 'Le nom de famille', 'trim|required|min_length[2]',
						array('required'	=>	'%s ne peut pas être vide.',				      
						'min_length'		=>	'%s doit contenir au moins %s caractères.'
					));	
					$this->form_validation->set_rules('firstname', 'Le prénom', 'trim|required|min_length[2]',
						array('required'	=>	'%s ne peut pas être vide.',				      
						'min_length'		=>	'%s doit contenir au moins %s caractères.'
					));
					$this->form_validation->set_rules('country', 'Le pays d\'adresse', 'trim|required',
						array('required'	=>	'%s ne peut pas être vide.',				      
						'alpha_dash'		=>	'Vous devez choisir un pays d\'adresse.',				      
					));	
/*					$this->form_validation->set_rules('town', 'La ville d\'adresse', 'trim|required',
						array('required'	=>	'%s ne peut pas être vide.',				      
					));	*/
					$this->form_validation->set_rules('phone_number', 'Le numéro de téléphone', 
						'trim|required|numeric|callback_validate_phone_number',
						array('required'	=>	'%s ne peut pas être vide.',				      
						'numeric'		=>	'%s doit contenir que des chiffres.',
						'validate_phone_number'			=>	'%s doit être du bon format.',
					));
					$recipient_object	=	$this->user_model->get_recipient($recipient); 
					if ($this->form_validation->run() == FALSE)
					{	
						$countries = $this->country_model->get_all_countries_receive_money();
						$data 	  = array(
							'error'	=>	"",
							'recipient'	=>	$recipient_object,
							'countries'	=> 	$countries
						); 
						// Formulaire mal rempli
						$content  = $this->load->view('user/c_recipient_update.php', $data, TRUE);
						$data 	  = array(
							'content'	=>	$content,
							'title'		=>	"Africash -- Vos bénéficiaires"
						); 
						$this->load->view('templates/c_template.php', $data); 
						return; 
					}
					else
					{
	
						$name		=	xss_clean($this->input->post('name', TRUE));
						$firstname	=	xss_clean($this->input->post('firstname', TRUE));
	
						$country	=	xss_clean($this->input->post('country', TRUE));
						$phone_number	=	xss_clean($this->input->post('phone_number', TRUE));
						
						if ( $recipient_object->name == $name && $recipient_object->firstname == $firstname && 
						$recipient_object->country == $country && $recipient_object->phone_number == $phone_number ) 
						{
							$countries = $this->country_model->get_all_countries_receive_money();
							$data 	  = array(
								'error'	=>	"update_error",
								'recipient'	=>	$recipient_object,
								'countries'	=> $countries
							); 
							// Formulaire mal rempli
							$content  = $this->load->view('user/c_recipient_update.php', $data, TRUE);
							$data 	  = array(
								'content'	=>	$content,
								'title'		=>	"Africash -- Vos bénéficiaires"
							); 
							$this->load->view('templates/c_template.php', $data); 							
							return; 
						}
						else
						{
							if ( ($recipient_object->phone_number == $phone_number && $recipient_object->country == $country) || ($this->validate_phone_number_recipient($phone_number, $country) == FALSE))
							{
								$countries = $this->country_model->get_all_countries_receive_money();
								$recipient	=	$this->user_model->get_recipient($recipient); 
								$data 	  = array(
									'error'	=>	"phone_already_use",
									'recipient'	=>	$recipient,
									'countries'	=>	$countries
								); 
								// Formulaire mal rempli
								$content  = $this->load->view('user/c_recipient_update.php', $data, TRUE);
								$data 	  = array(
									'content'	=>	$content,
									'title'		=>	"Africash -- Vos bénéficiaires"
								); 
								$this->load->view('templates/c_template.php', $data); 							
								return; 
							}
							else
							{
								if ( $this->user_model->update_user_recipient($this->session->userdata('user'), $recipient, $name, $firstname, $country, $phone_number) == 1) 
								{	
									$data 	  = array(
										'status'	=>	"success",
									); 
									$content  = $this->load->view('user/recipient_update_confirm.php', $data , TRUE);
									$data 	  = array(
										'content'	=>	$content,
										'title'		=>	"Africash -- Confirmation d'inscription"
									); 
									$this->load->view('templates/c_template.php', $data); 
									return;
								}else
								{
									$data 	  = array(
										'status'	=>	"error",
									); 
									$content  = $this->load->view('user/recipient_update_confirm.php', $data , TRUE);
									$data 	  = array(
										'content'	=>	$content,
										'title'		=>	"Africash -- Confirmation d'inscription"
									); 
									$this->load->view('templates/c_template.php', $data); 
									return;
								}
								
							}
						}
					}
				}
			}
			else if ($onglet == "delete" )
			{
				if ( $this->user_model->delete_user_recipient($recipient, $this->session->userdata('user')) )
				{	
					$data 	  = array(
						'status'	=>	"success",
					); 
					$content  = $this->load->view('user/recipient_delete_confirm.php', $data , TRUE);
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- Confirmation d'inscription"
					); 
					$this->load->view('templates/c_template.php', $data); 
					return;
				}else
				{
					$data 	  = array(
						'status'	=>	"error",
					); 
					$content  = $this->load->view('user/recipient_delete_confirm.php', $data , TRUE);
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- Confirmation d'inscription"
					); 
					$this->load->view('templates/c_template.php', $data); 
					return;
				}
		
			}
			else
			{
				$recipients = $this->user_model->get_user_recipients($this->session->userdata('user')); 
				$content  = $this->load->view('user/c_recipients.php', array ('status'	=> '', 'recipients' => $recipients), TRUE);
				$data 	  = array(
					'content'	=>	$content,
					'title'		=>	"Africash -- "
				); 
				$this->load->view('templates/c_template.php', $data); 
				
			}
		}
	}

	public function validate_phone_number_no_use($number)
	{
		if ( $this->user_model->phone_number_already_user($number, $this->input->post('country')))
		{
			return FALSE; 
		}
		else return TRUE;
	}
	

	public function validate_phone_number($number)
	{
		$country	=	xss_clean($this->input->post('country', TRUE));
		if ( $country == "") return FALSE; 
		$regex		=	$this->country_model->get_country_regex($country);
		$matches = null;
		if (preg_match("/^" . $regex . "/", $number, $matches, PREG_OFFSET_CAPTURE, 0)) {
			return TRUE; 
		}
		else{
			return FALSE; 
		}
	}
	
	public function validate_phone_number_recipient($number)
	{
		$country	=	xss_clean($this->input->post('country', TRUE));
		if ( $this->user_model->recipient_exists($this->session->userdata('user'), $number, $country))
		{
			return FALSE; 
		}else
		{
			return TRUE; 
		}
	}

	public function validate_card_expiration_date($date)
	{
		$date_tab	=	explode('/', $date); 
		$month = date('m'); 
		$year  = substr(date('Y'), 2, 3);
		if ( $date_tab[0] == null || $date_tab[1] == null) {
			return FALSE; 
		}
		if ( intval($date_tab[0]) == 0 ){
			return FALSE; 
		}
		else
		{
			if ( intval($date_tab[0]) < 1 || intval($date_tab[0]) > 12 || ($date_tab[1] == $year && $date_tab[0] < $month))
			{
				return FALSE; 
			}
		}		
		if ( intval($year) > intval($date_tab[1]) )
			return FALSE; 
		return TRUE; 	
	}
	


	public function deconnexion()
	{
		$this->session->sess_destroy(); 
		redirect('/', 'location'); 
	}


	public function country_values()
	{
		$country	=	xss_clean($this->input->post('country'));
		$count		=	$this->country_model->get_country($country); 
		$currency	=	$this->country_model->get_country_currency_sign($country);
		$currency_sn	=	$this->country_model->get_country_currency_short_name($country);
		echo $count->id . "&" . $count->phone_code . "&" . $currency . "&" . $currency_sn; 		
	}




	public function amount_change()
	{
		$country_from	=	xss_clean($this->input->post('country_from'));
		$country_to	=	xss_clean($this->input->post('country_to'));
		$amount_st	=	xss_clean($this->input->post('amount'));
		$transfert_cost = 	$this->country_model->get_country_transfert_cost($country_to);
		$change		=	$this->country_model->get_change(
			$this->country_model->get_country_currency($country_from), $this->country_model->get_country_currency($country_to));	
		$amount 	= 	((intval($change->amount) * intval($amount_st)) - (intval($transfert_cost))); 	
		$cost		=	(round(intval($amount_st)/50)*2.50); 
		$currency_sn	=	$this->country_model->get_country_currency_sign($country_from);
		$currency_sn2	=	$this->country_model->get_country_currency_sign($country_to);
		echo number_format($amount) . "&" . $cost  . "&" . $currency_sn . "&" . $change->amount 
		. "&" . $transfert_cost . "&" . $currency_sn2;	
	}
	
	private function _treat_recipient_create($prefix)
	{
		$this->load->library('form_validation');
		$this->load->helper('security');


		$this->form_validation->set_rules('name', 'Le nom de famille', 'trim|required|min_length[2]',
			array('required'	=>	'%s ne peut pas être vide.',				      
			'min_length'		=>	'%s doit contenir au moins %s caractères.'
		));	
		$this->form_validation->set_rules('firstname', 'Le prénom', 'trim|required|min_length[2]',
			array('required'	=>	'%s ne peut pas être vide.',				      
			'min_length'		=>	'%s doit contenir au moins %s caractères.'
		));
		$this->form_validation->set_rules('country', 'Le pays d\'adresse', 'trim|required',
			array('required'	=>	'%s ne peut pas être vide.',				      
			'alpha_dash'		=>	'Vous devez choisir un pays d\'adresse.',				      
		));	
/*				$this->form_validation->set_rules('town', 'La ville d\'adresse', 'trim|required',
					array('required'	=>	'%s ne peut pas être vide.',				      
				));	*/
		$this->form_validation->set_rules('phone_number', 'Le numéro de téléphone', 
			'trim|required|numeric|callback_validate_phone_number_recipient|callback_validate_phone_number',
			array('required'			=>	'%s ne peut pas être vide.',
				'numeric'				=>	'%s doit contenir que des chiffres.',
				'validate_phone_number_recipient'	=>	'%s est déjà utilisé.',
				'validate_phone_number'			=>	'%s doit être du bon format.',
		));
		if ($this->form_validation->run() == FALSE)
		{
			$countries	=	$this->country_model->get_all_countries_receive_money();
			$data 	  = array(
				'countries'	=>	$countries,
				'error'	=>	"",
			); 
			// Formulaire mal rempli
			$content  = $this->load->view("user/$prefix" . "recipient_create.php", $data, TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- Inscrivez vous!"
			); 
			$this->load->view('templates/c_template.php', $data); 
		}
		else {
			// Formulaire bien rempli
			$name		=	xss_clean($this->input->post('name', TRUE));
			$firstname	=	xss_clean($this->input->post('firstname', TRUE));
			$country	=	xss_clean($this->input->post('country', TRUE));
			$phone_number	=	xss_clean($this->input->post('phone_number', TRUE));
					
			$data 	=	array (
				'customer'	=>	$this->session->userdata('user'),
				'name'		=>	$name, 
				'firstname'	=>	$firstname, 
				'country'		=>	$country, 				
				'phone_number'	=>	$phone_number
			); 
			//  création du recipient
			$creation = $this->user_model->create_recipient($data);
			if ( $creation == 0 ) 
			{
				// On ne peut pas créer le recipient, numéro déjà utilisé pour un autre recipient, ou transaction annulé
				$data 	  = array(
					'status'	=>	"error",
				); 
				$content  = $this->load->view('user/recipient_create_confirm.php', $data , TRUE);
				$data 	  = array(
					'content'	=>	$content,
					'title'		=>	"Africash -- Confirmation de création de votre destinataire."
				); 
				$this->load->view('templates/c_template.php', $data); 
				return;															
			}	
			else	
			{
				$recipient  = $creation;
				// Le recipient a bien été enregistré
				$data 	  = array(
					'status'	=>	"success",
				); 
				if ( $prefix != "simulator_" ) {
					$content  = $this->load->view('user/recipient_create_confirm.php', $data , TRUE);
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- Confirmation de création de votre destinataire."
					); 
					$this->load->view('templates/c_template.php', $data); 
					return;
				}
				else {
			/*		$recipient_object = $this->user_model->get_recipient($recipient);
					$content  = $this->load->view('user/simulator_transfert_create.php', 
						array ('status'	=> '', 'recipient' => $recipient, 'recipient_object' => $recipient_object)
						, TRUE);
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- "
					); 
					$this->load->view('templates/c_template.php', $data); 
					return;
/*					redirect('user/recipient/create/', 'location');*/
					redirect("user/transfert/new/$recipient/");
					return;
				}
			}					
		}
	}

	private function _treat_registration($prefix_dest)
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		
		$email		=	xss_clean($this->input->post('email', TRUE));
		$password	=	xss_clean($this->input->post('password', TRUE));
		$password_conf	=	xss_clean($this->input->post('password_conf', TRUE));

		$name		=	xss_clean($this->input->post('name', TRUE));
		$firstname	=	xss_clean($this->input->post('firstname', TRUE));

		$country	=	xss_clean($this->input->post('country', TRUE));
		$address	=	xss_clean($this->input->post('address', TRUE));
		$line2		=	xss_clean($this->input->post('address_line2', TRUE));
		$town		=	xss_clean($this->input->post('town', TRUE));
		$phone_number	=	xss_clean($this->input->post('phone_number', TRUE));

		$this->form_validation->set_rules('email', 'L\'adresse email', 'trim|required|valid_email|is_unique[customer.email]', 
			array('required'	=>	'%s ne peut pas être vide.',
			      'is_unique'	=>	'%s que vous avez choisie est déjà utilisé',
			      'valid_email'	=>	'%s doit être du bon format d\'email.'));
		$this->form_validation->set_rules('password', 'Le mot de passe', 'trim|required|min_length[8]', 
			array('required'	=>	'%s ne peut pas être vide.',
			'min_length'		=>	'%s doit contenir au moins %s caractères.'
		));
		$this->form_validation->set_rules('password_conf', 'La confirmation du mot de passe', 'trim|matches[password]|required', 
			array('matches'		=>	'Les deux mot de passe ne sont pas équivalent.',				      
			'required'	=>	'%s ne peut pas être vide.',				      
		));
		$this->form_validation->set_rules('name', 'Le nom de famille', 'trim|required|min_length[2]',
			array('required'	=>	'%s ne peut pas être vide.',				      
			'min_length'		=>	'%s doit contenir au moins %s caractères.'
		));
		$this->form_validation->set_rules('firstname', 'Le prénom', 'trim|required|min_length[2]',
			array('required'	=>	'%s ne peut pas être vide.',				      
			'min_length'		=>	'%s doit contenir au moins %s caractères.'
		));
		$this->form_validation->set_rules('country', 'Le pays d\'adresse', 'trim|required',
			array('required'	=>	'%s ne peut pas être vide.',				      
			'alpha_dash'		=>	'Vous devez choisir un pays d\'adresse.',				      
		));
		/*$this->form_validation->set_rules('town', 'La ville d\'adresse', 'trim|required',
			array('required'	=>	'%s ne peut pas être vide.',				      
		));*/
		$this->form_validation->set_rules('phone_number', 'Le numéro de téléphone', 
			'trim|required|numeric|callback_validate_phone_number_no_use|callback_validate_phone_number',
			array('required'			=>	'%s ne peut pas être vide.',				      
			'numeric'				=>	'%s doit contenir que des chiffres.',				      
			'validate_phone_number'			=>	'%s doit être du bon format.',
			'validate_phone_number_no_use'		=>	'%s est déjà utilisé.',
		));
		$this->form_validation->set_rules('address', 'L\'adresse ', 'trim|required',
			array('required'	=>	'%s ne peut pas être vide.',				      
		));
		if ($this->form_validation->run() == FALSE)
		{
			$countries = $this->country_model->get_all_countries_send_money();
			$phone_code = ($country == "" ) ? "" : $this->country_model->get_country_code($country);
			$content  = $this->load->view("user/$prefix_dest" . "registration.php", 
			array('countries' => $countries, 'phone_code' => $phone_code), TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- Inscrivez vous!"
			); 
			$this->load->view('templates/nc_template.php', $data); 
		}
		else
		{
			$password	=	hash('sha512', $password);
			// All data's correct
			$data 	=	array (
				'email'		=>	$email, 
				'password'	=>	$password, 
				'name'		=>	$name, 
				'firstname'	=>	$firstname, 
				'address'	=>	$address, 
				'country'		=>	$country, 				
				'phone_number'	=>	$phone_number
			); 
			if ( $this->user_model->create_user($data) == 0 ) 
			{				
				$data 	  = array(
					'status'	=>	"error",
				); 
				$content  = $this->load->view('user/registration_confirm.php', $data , TRUE);
				$data 	  = array(
					'content'	=>	$content,
					'title'		=>	"Africash -- Confirmation d'inscription"
				); 
				$this->load->view('templates/nc_template.php', $data); 
				return;
			}
			else
			{
				$this->_create_session($email, $password);
				$data 	  = array(
					'status'	=>	"success",
				); 
				if ( $prefix_dest != "simulator_" ) {
					$content  = $this->load->view('user/registration_confirm.php', $data , TRUE);
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- Confirmation d'inscription"
					); 
					$this->load->view('templates/nc_template.php', $data); 
					return;
				}
				else {
					
					$countries	=	$this->country_model->get_all_countries_receive_money();
					$data 	  = array(
						'countries'	=>	$countries,
						'error'	=>	"",
					); 
					// Formulaire mal rempli
					$content  = $this->load->view('user/simulator_recipient_create.php', $data, TRUE);
					$data 	  = array(
						'content'	=>	$content,
						'title'		=>	"Africash -- Inscrivez vous!"
					); 
					$this->load->view('templates/c_template.php', $data); 
/*					redirect('user/recipient/create/', 'location');
					return;*/
				}
			}
		}
		
	}

}
