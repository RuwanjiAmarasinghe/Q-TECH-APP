<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_questions()
	{
		$this->db->select('questions.*, users.username');
		$this->db->from('questions');
		$this->db->join('users', 'questions.user_id = users.id');
		$this->db->order_by('date_asked', 'DESC');
		$query = $this->db->get();

		$result = $query->result_array();

		if ($result === null) {
			return null;
		}
		return $result;
	}

	public function get_question($question_id)
	{
		$this->db->select('questions.*, users.username');
		$this->db->from('questions');
		$this->db->join('users', 'questions.user_id = users.id');
		$this->db->where('questions.id', $question_id);
		$question = $this->db->get()->row_array();


		$this->db->select('answers.*, users.username');
		$this->db->from('answers');
		$this->db->join('users', 'answers.user_id = users.id');
		$this->db->where('answers.question_id', $question_id);
		$answers = $this->db->get()->result_array();
		$question['answers'] = $answers;

		return $question;
	}


	public function obtainUserQuestions($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->order_by('date_asked', 'DESC');
		$result = $this->db->get('questions')->result_array();

		if ($result === null) {
			return null;
		}
		return $result;
	}

	public function ask_question($title, $description, $user_id)
	{
		$data = array(
			'title' => $title,
			'description' => $description,
			'user_id' => $user_id
		);
		return $this->db->insert('questions', $data);
	}

	public function solvedQuestion($question_id)
	{
		$this->db->where('id', $question_id);
		return $this->db->update('questions', array('solved' => 1));
	}

	public function Unsolvedquestion($question_id)
	{
		$this->db->where('id', $question_id);
		return $this->db->update('questions', array('is_solved' => 0));
	}
	public function deleteAnswerForId($question_id)
	{
	
		$this->db->select('id');
		$this->db->from('answers');
		$this->db->where('question_id', $question_id);
		$query = $this->db->get();
		$answer_ids = $query->result_array();
	
	
		foreach ($answer_ids as $answer_id) {
			$this->db->where('answer_id', $answer_id['id']);
			$this->db->delete('votes');
		}

		$this->db->where('question_id', $question_id);
		$this->db->delete('answers');
	}


	public function deleteUserQuestion($question_id)
	{
		$this->db->where('id', $question_id);
		return $this->db->delete('questions');

		$this->db->where('question_id', $question_id);
		$this->db->delete('answers');
	}


	public function obtainAnswerCount($question_id)
	{
		$this->db->where('question_id', $question_id);
		$query = $this->db->get('answers');

		return $query->num_rows();
	}

	
}
