<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

        /* Styling for question cards */
        .question-card .card-body {
            background-color: #343a40; /* Dark background */
        }

        .question-card .card-title,
        .question-card .card-text {
            color: #fff; /* White text */
        }

        .question-card.mb-3 {
            margin-bottom: 20px; /* Space between question cards */
        }

        /* Remove the outline */
        .card-outline {
            border: none;
        }
    </style>
</head>

<body>
    <?php $this->load->view('header'); ?>
    <div class="container mt-3" style="padding-top: 4%;">
        <h5 class="text-center" style="margin-bottom: 35px; font-size: 35px; font-weight: bold;">Your Profile</h5>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <!-- User details -->
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Username: <?= $username ?></h5>
                        <p class="card-text">Email: <?= $email ?></p>
                        <p class="card-text">Questions: <?= $num_questions ?></p>
                        <p class="card-text">Correct answers: <?= $num_correct_answers ?></p>
                        <p class="card-text">Votes Recieved: <?= $total_votes ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="mb-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="questions-tab" data-toggle="tab" href="#questions"
                                role="tab">Questions Asked</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="answers-tab" data-toggle="tab" href="#answers" role="tab">Answers
                                Given</a>
                        </li>
                    </ul>
                </div>


                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="questions" role="tabpanel">
                        <div class="question-list">
                            <?php if (empty($questions)): ?>
                                <div class="alert alert-info" role="alert">
                                    No questions found.
                                </div>
                            <?php endif; ?>
                            <?php foreach ($questions as $question): ?>
                                <a href="<?php echo site_url('question/view/' . $question['id']); ?>"
                                    class="text-decoration-none" style="color:black; ">
                                    <div class="card mb-3 question-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">

                                                <h5 class="card-title"><?= $question['title'] ?></h5>
                                                <p class="card-text text-right" style="font-size:small">
                                                    <?= strtolower(timespan(strtotime($question['date_asked']), time(), 2)); ?>
                                                    ago
                                                </p>
                                            </div>

                                            <p class="card-text"><?= $question['description'] ?></p>
                                            <p class="card-text">Answers:
                                                <?= $this->Question_model->get_answer_count($question['id']) ?>
                                            </p>
                                            <?php if ($question['user_id'] == $user_id): ?>
                                                <form action="<?php echo site_url('question/deleteQuestion'); ?>" method="post">
                                                    <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                                                    <input type="hidden" name="question_id" value="<?= $question['id']; ?>">
                                                    <button type="submit" class="btn btn-danger float-right">Delete</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </a>

                            <?php endforeach; ?>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="answers" role="tabpanel">
                        <div class="question-list">
                            <?php if (empty($questions)): ?>
                                <div class="alert alert-info" role="alert">
                                    No questions found.
                                </div>
                            <?php endif; ?>

                            <?php foreach ($answers as $answer): ?>
                                <a href="<?php echo site_url('question/view/' . $answer['question_id']); ?>"
                                    class="text-decoration-none" style="color:black; ">
                                    <div class="card mb-3 question-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">

                                                <h5 class="card-title"><?= $answer['question_title'] ?></h5>
                                                <p class="card-text text-right" style="font-size:small">
                                                    <?= strtolower(timespan(strtotime($answer['date_answered']), time(), 2)); ?> ago
                                                    
                                                </p>
                                            </div>
                                            <p class="card-text"><?= $answer['answer'] ?></p>
                                            <?php if ($user_id && $user_id == $answer['user_id']): ?>
                                                <form action="<?= site_url('answer/delete_answer'); ?>" method="post">
                                                    <input type="hidden" name="answer_id" value="<?= $answer['id']; ?>">
                                                    <input type="hidden" name="question_id" value="<?= $question['id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm float-right">Delete</button>
                                                </form>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </a>

                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(function () {
            $('.nav-tabs a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
</body>

</html>