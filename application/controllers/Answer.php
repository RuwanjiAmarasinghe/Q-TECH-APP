<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Answer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Answer_model');
	}

	
	public function marked_correct()
	{
			if (!$this->session->userdata('user_id')) {
				redirect('login');
			}
			$answer_id = $this->input->post('answer_id');
			$question_id = $this->input->post('question_id');
			$this->Answer_model->marked_correct($answer_id, $question_id, $this->session->userdata('user_id'));
			redirect('question/view/' . $question_id);
	}



	public function delete_answer()
	{
		if (!$this->session->userdata('user_id')) {
		
			redirect('home');
		}
	
		$this->load->model('Answer_model');

		// Get answer id from post data
		$answer_id = $this->input->post('answer_id');
		$question_id = $this->input->post('question_id');

		$this->db->where('answer_id', $answer_id);
		$this->db->delete('votes');

		// Delete the answer
		$this->db->where('id', $answer_id);
		$this->db->delete('answers');
	
		redirect('profile');

		
	}

	public function before_page_url()
	{
		$this->session->set_userdata('previous_url', current_url());
	}
}

