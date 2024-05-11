<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Q&TECH</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/minty/bootstrap.min.css" integrity="sha384-H4X+4tKc7b8s4GoMrylmy2ssQYpDHoqzPa9aKXbDwPoPUA3Ra8PA5dGzijN+ePnH" crossorigin="anonymous">
	<style>
		.question-list {
			height: 400px;
			overflow-y: auto;
		}
	</style>
</head>

<body>
	<?php $this->load->view('Header'); ?>
	<div class="container">

		<div class=" mt-3 mb-5">
			<input type="text" class="form-control" placeholder="Search questions...">
		</div>
		


		<!-- Welcome Message -->
        <div class="text-center mb-3"> 
			<h5>Welcome to</h5><h1>Q&TECH</h1>
			<div class="row justify-content-center">
				<div class="col-md-8"> 
					<p class="text-justify">This is a platform where you can ask technical questions and get answers from the community. Feel free to ask any question or answer the questions asked by others. Let's help each other grow!</p>
					<p class="text-justify mb-3">In our quest to foster a thriving technical community, we've built this platform to serve as a hub for knowledge exchange and problem-solving. Whether you're a seasoned developer seeking insight or a newcomer grappling with a coding challenge, our goal is to provide a welcoming space where everyone can contribute and benefit. By facilitating discussions, sharing expertise, and collaborating on solutions, we aim to empower individuals to overcome obstacles and expand their technical prowess.</p>
				</div>
			</div>
		</div>




		<!-- Ask Question button -->
		<div class="text-center mb-3">
			<form action="<?php echo $this->session->userdata('user_id') ? site_url('question/ask_question') : site_url('user/login'); ?>" method="post">
				<button type="submit" name="askButton" class="btn btn-success">Ask a Question</button>
			</form>
		</div>

		
	</div>

</body>

</html>
