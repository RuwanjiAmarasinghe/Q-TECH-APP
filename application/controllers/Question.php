<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question extends CI_Controller
{
	protected $data = [];
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->data['user_id'] = $this->session->userdata('user_id');
		$this->data['username'] = $this->session->userdata('username');
		$this->load->helper('url');
		$this->load->model('Question_model');
		$this->load->helper('date');
		date_default_timezone_set('Asia/Colombo');
		$this->data['showForm'] = false;
		$this->load->database();
	}



	public function viewTheAnswerForm($question_id)
	{
		
		if (!$this->session->userdata('user_id')) {
			
			$this->before_page_url();
			redirect('login');
		}

		$this->data['question_id'] = $question_id;

		$question = $this->Question_model->get_question($question_id);
		$this->data['question'] = $question;


		$this->data['showForm'] = true;
		$this->load->view('question', $this->data);
	}

	public function answer_question($question_id)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('answer', 'Answer', 'required');

		$answer = $this->input->post('answer');

		if ($this->form_validation->run() == FALSE) {
			$this->viewTheAnswerForm($question_id);
		} else {
			$this->load->model('Answer_model');

			$user_id = $this->session->userdata('user_id');

			$this->Answer_model->answer_question($answer, $question_id, $user_id);

			redirect('question/view/' . $question_id);
		}
	}

	public function view_question($id)
	{

		$question = $this->Question_model->get_question($id);
		$this->data['question'] = $question;

		$this->load->view('question', $this->data);
	}

	public function solved_question()
	{

		if (!$this->session->userdata('user_id')) {
			
			redirect('home');
		}
	
		$this->load->model('Question_model');

		$question_id = $this->input->post('question_id');

		$this->Question_model->solvedQuestion($question_id);
		log_message('debug','its marked as solved');
	}


	public function delete_user_Question()
	{
		if (!$this->session->userdata('user_id')) {
			
			redirect('home');
		}
	
		$question_id = $this->input->post('question_id');
	
		$this->load->model('Question_model');

		$this->Question_model->deleteAnswerForId($question_id);
	
		$this->Question_model->deleteUserQuestion($question_id);
		log_message('debug', 'Question Deleted');
	
		redirect('profile');
	}


	public function before_page_url()
	{
		$this->session->set_userdata('previous_url', current_url());
	}
}