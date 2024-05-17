<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Vote_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function vote_answer($answer_id, $user_id, $vote_type)
	{
		
		$this->db->where('user_id', $user_id);
		$this->db->where('answer_id', $answer_id);

		$query = $this->db->get('votes');

		if ($query->num_rows() > 0) {
	
			$existing_vote = $query->row();
			log_message('info', 'A vote exists');
			log_message('info', 'Existing vote type: ' . $existing_vote->vote_type);
			if ($existing_vote->vote_type == $vote_type) {
		
				$this->db->where('answer_id', $answer_id);
				$this->db->where('user_id', $user_id);
				$this->db->delete('votes');

				if ($vote_type == 'up') {
					$this->db->set('vote_count', 'vote_count-1', FALSE);
				} else if ($vote_type == 'down') {
					$this->db->set('vote_count', 'vote_count+1', FALSE);
				}
				$this->db->where('id', $answer_id);
				$this->db->update('answers');
			} else {
		
				$this->db->where('answer_id', $answer_id);
				$this->db->where('user_id', $user_id);
				$this->db->update('votes', array('vote_type' => $vote_type));

	
				if ($vote_type == 'up' && $existing_vote->vote_type == 'down') {
			
					$this->db->set('vote_count', 'vote_count+2', FALSE);
				} else if ($vote_type == 'down' && $existing_vote->vote_type == 'up') {
				
					$this->db->set('vote_count', 'vote_count-2', FALSE);
				}
				$this->db->where('id', $answer_id);
				$this->db->update('answers');
			}
			return $existing_vote;
		} else {
		
			$data = array(
				'answer_id' => $answer_id,
				'user_id' => $user_id,
				'vote_type' => $vote_type
			);
			$this->db->insert('votes', $data);

			if ($vote_type == 'up') {
				$this->db->set('vote_count', 'vote_count+1', FALSE);
			} else if ($vote_type == 'down') {
				$this->db->set('vote_count', 'vote_count-1', FALSE);
			}
			$this->db->where('id', $answer_id);
			$this->db->update('answers');
		}
	}


	

	public function getTotalUserVotes($user_id)
	{
		
		$this->db->select('votes.vote_type');
		$this->db->from('votes');
		$this->db->join('answers', 'votes.answer_id = answers.id');


		$this->db->where('answers.user_id', $user_id);

	
		$query = $this->db->get();


		$up_votes = 0;
		$down_votes = 0;
		foreach ($query->result() as $row) {
			if ($row->vote_type == 'up') {
				$up_votes++;
			} else if ($row->vote_type == 'down') {
				$down_votes++;
			}
		}


		$final_count = $up_votes - $down_votes;


		return $final_count;
	}
}

