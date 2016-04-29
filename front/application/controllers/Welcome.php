
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
		$this->load->library('session');
		$this->load->database();
		$this->load->model('user_model'); 
		$this->load->model('country_model'); 
		$this->load->helper('functions'); 
	}


	public function index()
	{
		if ( ($this->session->userdata('user') == null )&& ($this->session->userdata('type') != "AFRICASH-USER")) 
		{
			$this->session->sess_destroy(); 
			$send_countries = $this->country_model->get_all_countries_send_money();
			$receive_countries = $this->country_model->get_all_countries_send_receive();
			
			$content  = $this->load->view('user/nc_home.php', array('send_countries' => $send_countries, 'receive_countries' => $receive_countries), TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- Envoyez de l'aregent à vos proches en un click"
			); 
			$this->load->view('templates/nc_template.php', $data); 
		}else
		{
			$transferts = $this->user_model->get_user_nb_transferts($this->session->userdata('user'), 0, 3);
			$recipients = $this->user_model->get_user_nb_recipients($this->session->userdata('user'), 0, 3);
			$send_countries = $this->country_model->get_all_countries_send_money();
			$receive_countries = $this->country_model->get_all_countries_send_receive();
			$data	  = array('error' => 'error', 'transferts' => $transferts, 'recipients' => $recipients, 
					  'send_countries' => $send_countries, 'receive_countries' => $receive_countries); 
			$content  = $this->load->view('user/c_home.php', $data , TRUE);
			$data 	  = array(
				'content'	=>	$content,
				'title'		=>	"Africash -- "
			); 
			$this->load->view('templates/c_template.php', $data); 
			return; 
		}
	}
}
