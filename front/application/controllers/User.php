
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
			$data	  = array('error' => 'error'); 
			$content  = $this->load->view('user/c_home.php', $data , TRUE);
			$data 	  = array(
				'content'	=>	$content,
			); 
			$this->load->view('templates/c_template.php', $data); 
			return; 
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
			$content  = $this->load->view('user/registration.php', '', TRUE);
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

	/**
		Traite le formulaire d'inscription. L'inscription du user se passe ici. 
	*/	
	public function register()
	{
		if ( ($this->session->userdata('user') !== null )&& ($this->session->userdata('type') == "AFRICASH-USER")) 
		{
			redirect ('/', 'location'); 
		}
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
		$this->form_validation->set_rules('town', 'La ville d\'adresse', 'trim|required',
			array('required'	=>	'%s ne peut pas être vide.',				      
		));
		$this->form_validation->set_rules('phone_number', 'Le numéro de téléphone', 
			'trim|required|numeric|callback_validate_phone_number',
			array('required'	=>	'%s ne peut pas être vide.',				      
			'numeric'		=>	'%s doit contenir que des chiffres.',				      
			'validate_phone_number'		=>	'%s est déjà utilisé.',
		));
		$this->form_validation->set_rules('address', 'L\'adresse ', 'trim|required',
			array('required'	=>	'%s ne peut pas être vide.',				      
		));
		if ($this->form_validation->run() == FALSE)
		{
			$content  = $this->load->view('user/registration.php', '', TRUE);
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
				'town'		=>	$town, 				
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
				$data 	  = array(
					'status'	=>	"success",
				); 
				$content  = $this->load->view('user/registration_confirm.php', $data , TRUE);
				$data 	  = array(
					'content'	=>	$content,
					'title'		=>	"Africash -- Confirmation d'inscription"
				); 
				$this->load->view('templates/nc_template.php', $data); 
				return;
			}
		}

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
                $this->session->set_userdata('first_name', $customer->first_name);
                $this->session->set_userdata('email', $customer->email);
                $this->session->set_userdata('adress', $customer->address);
                $this->session->set_userdata('category', $customer->password);
                $this->session->set_userdata('category', $customer->town);
                $this->session->set_userdata('category', $customer->phone_number);
        }

	/*
		Validation du numéro de téléphone. Un seul numéro par pays. 
	*/
	public function validate_phone_number($number)
	{
		if ( $this->user_model->phone_number_already_user($number, $this->input->post('town')))
		{
			return FALSE; 
		}else
		{
			return TRUE; 
		}
	}

	public function deconnexion()
	{
		$this->session->sess_destroy(); 
		redirect('/', 'location'); 
	}

}
