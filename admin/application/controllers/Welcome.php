<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->model('employe_model');
		$this->load->library('session');
	}


	public function index()
	{
		if ( ($this->session->userdata('employe') == null )&& ($this->session->userdata('type') != "3615-admin")) 
		{
			$this->session->sess_destroy(); 
			$this->load->view('login.php');
		}else
		{
        		$this->load->view('dashboard.php');
		}
	}

	public function deconnexion()
	{
		$this->session->sess_destroy(); 
		redirect('/', 'location'); 
	}

	public function connexion()
	{
		$this->load->library('form_validation');
	
		$email		=	$this->input->post('email', TRUE);
		$password	=	$this->input->post('password', TRUE);
		
		$this->form_validation->set_rules('email', 'L\'adresse email', 'required|valid_email', 
				array('required'	=>	'%s ne peut pas être vide.',
				      'valid_email'	=>	'%s doit être du bon format d\'email'));
		$this->form_validation->set_rules('password', 'Le mot de passe', 'required', 
				array('required'	=>	'%s ne peut pas être vide.',
				));
		if ($this->form_validation->run() == FALSE)
		{
        		$this->load->view('login.php');
		}
		$password	=	hash('sha512', $password);
		if ( $this->employe_model->exists($email, $password) == TRUE) 
		{
			$this->_create_session($email, $password);
        		redirect('/', 'location'); 
		}else {
			$data	=	array (
				"error"		=>	"Aucun compte n'existe avec ce mail et ce mot de passe"
			);
        		$this->load->view('login.php', $data);
		}
	}

	/**
		Création de la session une fois qu'on sait que l'mployé peut se connecter
		On ne fait qu'initialiser les données de session ici.
	*/
	function _create_session($email, $password)
	{
		$employe = $this->employe_model->get($email, $password); 
		$this->session->set_userdata('type', "3615-admin"); 
		$this->session->set_userdata('employe', $employe->id); 
		$this->session->set_userdata('name', $employe->name); 
		$this->session->set_userdata('first_name', $employe->first_name); 
		$this->session->set_userdata('email', $employe->email); 
		$this->session->set_userdata('adress', $employe->adress); 
		$this->session->set_userdata('category', $employe->category); 
		//$this->session->set_userdata($employe);
	}
}
