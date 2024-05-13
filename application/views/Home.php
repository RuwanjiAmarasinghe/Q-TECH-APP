<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Q&TECH</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css">
	<style>
		.question-list {
			height: 400px;
			overflow-y: auto;
		}

		.question-card {
			transition: transform .5s;
		}

		.question-card:hover {
			color: grey;
		}

		.question-card:active {
			transform: scale(0.99);
			color: grey;
		}
		.form-control:focus {
            background-color: #808080;
            color: #fff; 
        }
	</style>
</head>

<body>
	<?php $this->load->view('Header'); ?>
	<div class="container">
		<div class="row mt-3 mb-3">
			<div class="col">
				<form class="form-inline" action="<?php echo site_url('home/search'); ?>" method="get">
					<div class="input-group w-100">
						<input class="form-control mr-sm-2" type="search" placeholder="Search Questions..."
							aria-label="Search" name="search"
							value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
						<div class="input-group-append">
							<button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- Welcome Message -->
        <div class="container mt-4">
			<h5 class="text-center">Welcome to</h5>
    		<h1 style="font-size: 3.1rem; text-align: center; font-weight: 2000 !important;">Q&TECH</h1>
			<div class="row justify-content-center">
				<div class="col-md-8"> 
					<p class="text-center">This is a platform where you can ask technical questions and get answers from the community. Feel free to ask any question or answer the questions asked by others. Let's help each other grow!</p>
					
				</div>
			</div>
		</div>

		<?php if (!$showForm): ?>
			<div class="d-flex justify-content-center align-items-center" style="height: 15vh;">
				<?php if ($this->session->userdata('logged_in')): ?>
					<a href="<?php echo site_url('ask_question'); ?>" class="btn btn-success">Ask a Question</a>
				<?php else: ?>
					<a href="<?php echo site_url('login'); ?>" class="btn btn-success">Ask a Question</a>
				<?php endif; ?>
			</div>
		<?php else: ?>
			<hr>
			<h5>Ask a Question</h5>
			<div id="askForm">
				<?php echo validation_errors(); ?>
				<div class="form-group w-100">
					<form action="<?php echo site_url('home/ask_question'); ?>" method="post">
						<input type="text" class="form-control mb-3" name="title" placeholder="Question Title">
						<textarea type="text" class="form-control mb-3" name="description"
							placeholder="Question Description" rows="5"></textarea>
							<div class="text-right">
                				<button type="submit" class="btn btn-primary">Submit</button>
            				</div>
					</form>
				</div>
			</div>
		<?php endif; ?>
		<div style="height: 70px;"></div>

		<?php if (isset($_GET['search']) && !empty($questions)): ?>
			<h2 class="text-center" style="margin-bottom: 40px;">Search Results</h2>
		<?php elseif (!isset($_GET['search'])): ?>
			<h2 class="text-center" style="margin-bottom: 40px;">Latest Questions</h2>
		<?php endif; ?>

		<!-- List of questions -->
		<div class="question-list">
			<?php if (empty($questions)): ?>
				<div class="alert alert-info" role="alert">
					No questions found.
				</div>
			<?php endif; ?>
			<?php foreach ($questions as $question): ?>
				<a href="<?php echo site_url('question/view/' . $question['id']); ?>" class="text-decoration-none"
					style="color:black; ">
					<div class="card mb-3 question-card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">

								<h5 class="card-title"><?= $question['title'] ?></h5>
								<p class="card-text text-right" style="font-size:small">by <span
										class="font-weight-bold"><?= ucfirst(strtolower($question['username'])) ?></span>
									<?= strtolower(timespan(strtotime($question['date_asked']), time(), 2)); ?> ago
								</p>
							</div>

							<p class="card-text"><?= $question['description'] ?></p>
							<p class="card-text">Answers: <?= $this->Question_model->get_answer_count($question['id']) ?>
							</p>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>

</body>

</html>