<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vote extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}
	public function votes_given()
	{

		if (!$this->session->userdata('user_id')) {
			$this->before_page_url();
	
			redirect('login');
		} else {
			
			$this->load->model('Vote_model');

	
			$user_id = $this->session->userdata('user_id');

			$question_id = $this->uri->segment(2);
			$answer_id = $this->uri->segment(4);
			$vote_type = $this->uri->segment(6);
			echo $question_id;
			echo $answer_id;
			echo $vote_type;


			$this->Vote_model->vote_answer($answer_id, $user_id, $vote_type);

			log_message('debug', 'Voted answer');
	
			redirect('question/view/' . $question_id);

		}
	}

	public function before_page_url()
	{
		$this->session->set_userdata('previous_url', current_url());
	}

}



