<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Q&TECH - Qs for Techies</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/minty/bootstrap.min.css" integrity="sha384-H4X+4tKc7b8s4GoMrylmy2ssQYpDHoqzPa9aKXbDwPoPUA3Ra8PA5dGzijN+ePnH" crossorigin="anonymous">
	<style>
		.question-list {
			height: 400px;
			overflow-y: auto;
		}
	</style>
</head>

<body>
    <div class="container mt-4">
    <h2>Share your question</h2>

    <div id="askForm">
        <?php echo validation_errors(); ?>
        <form action="<?php echo site_url('question/submit_question'); ?>" method="post">
            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="title" placeholder="Title of the Question">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <textarea class="form-control" name="description" rows="4" placeholder="Question Description"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 text-right">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <!-- List of questions -->
	<div class="question-list">

        <?php foreach ($questions as $question): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title"><?= $question['title'] ?></h5>
                        <p class="card-text text-right" style="font-size:small">by <span
                                class="font-weight-bold"><?= ucfirst(strtolower($question['username'])) ?></span>
                            <?= strtolower(timespan(strtotime($question['date_asked']), time(), 2)); ?> ago
                        </p>
                    </div>


                    <p class="card-text"><?= $question['description'] ?></p>
                    <p class="card-text">Answers: <?= $this->Question_model->get_answer_count($question['id']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    </div>

</body>

</html>
