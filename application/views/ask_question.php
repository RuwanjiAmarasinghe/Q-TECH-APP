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

        <!-- ask_question.php -->
        <div class="container mt-4">
            <h5 class="text-center">Ask a Question</h5>
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
        </div>
    </div>

</body>

</html>