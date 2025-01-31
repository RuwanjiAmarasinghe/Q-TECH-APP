<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	protected $data = [];
	protected $questions = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('date');
		date_default_timezone_set('Asia/Colombo');
		$this->load->model('Question_model');
		$this->data['user_id'] = $this->session->userdata('user_id');
		$this->data['username'] = $this->session->userdata('username');
		$this->data['title'] = 'Home';
		$this->questions = $this->Question_model->get_questions();
		$this->data['questions'] = $this->questions;
		$this->data['showForm'] = false;
	}

	public function index()
	{
		$this->load->view('home', $this->data);
	}



	public function show_ask_form()
	{
		
		if (!$this->session->userdata('user_id')) {
			$this->before_page_url();
			redirect('login');
		}

		$this->load->library('form_validation');

		$this->data['showForm'] = true;
		$this->load->view('home', $this->data);
	}

	
	
	

	public function ask_question() 
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE) {
			
			$this->load->view('ask_question');
		} else {
		
			$title = $this->input->post('title');
			$description = $this->input->post('description');

			$user_id = $this->session->userdata('user_id');

			$this->Question_model->ask_question($title, $description, $user_id);
			log_message('debug', 'Question asked');			
			redirect('home');
		}
	}


	

	public function search()
	{

		$search = trim($this->input->get('search'));

		if (empty($search)) {
			redirect('home');
		} else {
		
			$search_words = explode(' ', $search);
			$filtered_questions = [];
			foreach ($search_words as $word) {

				$filtered = array_filter($this->questions, function ($question) use ($word) {
					return strpos(strtolower($question['title']), strtolower($word)) !== false;
				});
				$filtered_questions = array_merge($filtered_questions, $filtered);
			}
			$filtered_questions = array_unique($filtered_questions, SORT_REGULAR);

			usort($filtered_questions, function ($a, $b) {
				return strtotime($b['date_asked']) - strtotime($a['date_asked']);
			});

			$this->data['questions'] = $filtered_questions;
			$this->load->view('home', $this->data);
		}
	}



	public function before_page_url()
	{
		$this->session->set_userdata('previous_url', current_url());
	}



}
