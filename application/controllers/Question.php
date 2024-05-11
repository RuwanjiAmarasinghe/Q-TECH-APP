<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('date');
		$this->load->model('Question_model');
		date_default_timezone_set('Asia/Colombo');
		$this->data['user_id'] = $this->session->userdata('user_id');
		$this->data['username'] = $this->session->userdata('username');
		$this->data['title'] = 'Home';
		$this->data['questions'] = $this->Question_model->get_questions();

	}
	
    
    
   
    public function ask_question()
    {

        // Check if the user is logged in
        if (!$this->session->userdata('user_id')) {
        // User is not logged in, redirect to login
        redirect('login');
        }

        // Load the Form Validation Library
        $this->load->library('form_validation');

        // Load the Question_model
        $this->load->model('Question_model');

        // If the form is submitted
        if ($this->input->post('askButton')) {
            // Get user input
            $title = $this->input->post('title');
            $description = $this->input->post('description');

            // Get user id from session
            $user_id = $this->session->userdata('user_id');

            // Ask the question
            $this->Question_model->ask_question($title, $description, $user_id);
        }

        // Get user id and username from session
        $data['user_id'] = $this->session->userdata('user_id');
        $data['username'] = $this->session->userdata('username');

        // Get questions from the database
        $data['questions'] = $this->Question_model->get_questions();

        // Load the Header view with the user id and username
        $this->load->view('Header', array('title' => 'Ask Question', 'user_id' => $data['user_id'], 'username' => $data['username']));

        // Load the ask_question view with the questions
        $this->load->view('ask_question', $data);
    }

    

    public function mark_as_solved()
    {

		if (!$this->session->userdata('user_id')) {
			// If the user is not logged in, redirect to the home page
			redirect('home');
		}
        // Load the Question_model
        $this->load->model('Question_model');

        // Get question id from post data
        $question_id = $this->input->post('question_id');

        // Mark the question as solved
        $this->Question_model->mark_as_solved($question_id);
    }

    public function delete_question()
    {
		if (!$this->session->userdata('user_id')) {
			// If the user is not logged in, redirect to the home page
			redirect('home');
		}
        // Load the Question_model
        $this->load->model('Question_model');

        // Get question id from post data
        $question_id = $this->input->post('question_id');

        // Delete the question
        $this->Question_model->delete_question($question_id);
    }

    
    public function show_ask_form()
    {
        if (!$this->session->userdata('user_id')) {
            // If the user is not logged in, redirect to the login page
            redirect('login');
        }

        // Load the Form Validation Library
        $this->load->library('form_validation');

        // Load the Question_model
        $this->load->model('Question_model');

        // Fetch the questions
        $questions = $this->Question_model->get_questions();

        // Load the Date Helper
        $this->load->helper('date');

        // Load the ask_question view and pass the questions
        $this->load->view('ask_question', array('questions' => $questions));
    }




    
    public function submit_question()
    {
        // Load the Form Validation Library
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            // If validation fails, show the form again
            $this->show_ask_form();
        } else {
            // If validation passes, insert the new question into the database
            $this->load->model('Question_model');
            $this->Question_model->ask_question($this->input->post('title'), $this->input->post('description'), $this->session->userdata('user_id'));


            // Redirect back to the ask_question view
            redirect('question/ask_question');

        }
        
  
    }



}
/* End of file Question.php and path \application\controllers\Question.php */
