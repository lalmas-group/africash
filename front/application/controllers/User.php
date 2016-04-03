
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
	}

	public function index()
	{
		if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') != "user")) 
		{
			$this->session->sess_destroy(); 
			$content  = $this->load->view('user/login.php', '', TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Afro Money Express  -- Envoyez de l'aregent à vos proches en un click"
			); 
			$this->load->view('templates/nc_template.php', $data); 
		}else
		{
        		$this->load->view('c_home.php');
		}
	}

	
	public function registration($step = null)
	{
		if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') != "user")) 
		{
			$this->session->sess_destroy(); 
			$content  = $this->load->view('user/registration.php', '', TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Afro Money Express  -- Envoyez de l'aregent à vos proches en un click"
			); 
			$this->load->view('templates/nc_template.php', $data); 
		}else
		{
		}
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

}
