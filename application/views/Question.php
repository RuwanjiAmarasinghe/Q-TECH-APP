<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title><?= $question['title'] ?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
</head>

<body>
	<?php $this->load->view('Header'); ?>

	<div class="container mt-5">
		<h2><?= $question['title'] ?></h2>
		<?php if ($question['is_solved'] == 1): ?>
			<span class="badge badge-success">Question Solved</span>
		<?php endif; ?>
		<p><?= $question['description'] ?></p>
		<p class="card-text text-right" style="font-size:small">asked by <span
				class="font-weight-bold"><?= ucfirst(strtolower($question['username'])) ?></span>
			<?= strtolower(timespan(strtotime($question['date_asked']), time(), 2)); ?> ago
		</p>

		<hr>

		<div class="row mb-3">
			<div class="col-md-6">
				<h5>Answers-given</h5>
			</div>



			<div class="col-md-6 text-right">
				<form action="<?php echo site_url('question/view/' . $question['id'] . '/viewTheAnswerForm') ?>"
					method="post">
					<button type="submit" name="answerButton" class="btn btn-success">Add an Answer</button>
				</form>
			</div>
		</div>



		<?php if ($showForm): ?>
			<div id="askForm">
				<?php echo validation_errors(); ?>
				<div class="form-group">

					<form action="<?php echo site_url('question/view/' . $question['id'] . '/answer/submit'); ?>"
						method="post">
						<div class="form-group">
							<textarea type="text" class="form-control" name="answer" placeholder="Enter your Answer here"></textarea>
						</div>

						<button type="submit" class="btn btn-primary">Submit-answer</button>
					</form>
				</div>
			</div>
		<?php endif; ?>

		<?php if (empty($question['answers'])): ?>
			<p>Nothing yet.</p>
		<?php else: ?>


			<?php foreach ($question['answers'] as $answer): ?>
				<div class="card mb-3">
					<div class="card-body d-flex align-items-start">
						<div class="mr-3">
							<a
								href="<?php echo site_url('question/' . $question['id'] . '/answer/' . $answer['id'] . '/vote/up'); ?>">
								<span>&#x2191;</span>
							</a>

							<div><?= $answer['vote_count'] ?></div>

							<a
								href="<?php echo site_url('question/' . $question['id'] . '/answer/' . $answer['id'] . '/vote/down'); ?>">
								<span>&#x2193;</span>
							</a>
						</div>
						<div class="w-100">
							<p class="card-text"><?= $answer['answer'] ?></p>
							<?php if ($this->session->userdata('user_id') == $question['user_id'] && !($answer['is_correct'])): ?>
								<form action="<?php echo site_url('answer/correctly_solved') ?>" method="post">
									<input type="hidden" name="answer_id" value="<?= $answer['id'] ?>">
									<input type="hidden" name="question_id" value="<?= $question['id'] ?>">
									<button type="submit" class="btn btn-success">Mark as Correct</button>
								</form>
							<?php endif; ?>
							<?php if ($answer['is_correct']): ?>
								<i class="fas fa-check text-success fa-2x"></i>
							<?php endif; ?>
							<p class="card-text text-right" style="font-size:small">answered by <span
									class="font-weight-bold"><?= ucfirst(strtolower($answer['username'])) ?></span>
								<?= strtolower(timespan(strtotime($answer['date_answered']), time(), 2)); ?> ago
							</p>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		<?php endif; ?>

	</div>

	<script>
        $(document).ready(function() {
            $('#showAnswerForm').click(function() {
                $('#answerForm').toggle();
            });

            var Answer = Backbone.Model.extend({
                urlRoot: '<?php echo site_url('question/view/' . $question['id'] . '/answer/submit'); ?>'
            });

            var AnswerView = Backbone.View.extend({
                el: '#addAnswerForm',
                events: {
                    'submit': 'submitForm'
                },
                submitForm: function(e) {
                    e.preventDefault();
                    var answer = this.$('textarea[name="answer"]').val();
                    var newAnswer = new Answer({ answer: answer });
                    newAnswer.save(null, {
                        success: function(model, response) {
                            window.location.reload();
                        },
                        error: function(model, response) {
                            console.error(response.responseText);
                        }
                    });
                }
            });

            var answerView = new AnswerView();
        });
    </script>

</body>

</html>