<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Q&TECH</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>

    <style>
        .form-control:focus {
            background-color: #808080;
            color: #fff;
        }

        .strong {
            font-weight: bold;
            font-size: 25px;
        }
    </style>
</head>

<body>
    <?php 
    $title = 'Ask Question';
    $data['username'] = $this->session->userdata('username');
    $data['show_welcome'] = true; 
    $data['title'] = $title;
    $this->load->view('Header', $data); 
    ?>

    <div class="container">

        <div class="container" style="padding-top: 4%;">
            <h5 class="text-center" style="margin-bottom: 30px; font-size: 35px; font-weight: bold;">Ask a Public
                Question</h5>
            <div id="askForm">
                <?php echo validation_errors(); ?>
                <div class="form-group w-100">
                    <form id="askQuestionForm" method="post">

                        <label for="title" class="strong">Title</label>
                        <p class="text-body-tertiary">Be specific and imagine you’re asking a question to another
                            person.</p>
                        <input type="text" class="form-control mb-4" name="title" id="title"
                            placeholder="Question Title" style="border: 1px solid #ccc;">

                        <label for="description" class="strong">Description</label>
                        <p class="text-body-tertiary">Introduce the problem and expand on what you put in the
                            title.</p>
                        <textarea type="text" class="form-control mb-3" name="description" id="description"
                            placeholder="Question Description" rows="5"
                            style="border: 1px solid #ccc;"></textarea>

                        <div class="text-center">
                            <button type="button" id="submitBtn" class="btn btn-primary"
                                style="font-size: 20px; padding: 10px 20px;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
    
            $('#submitBtn').click(function() {
               
                var formData = {
                    title: $('#title').val(),
                    description: $('#description').val()
                };

  
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('home/ask_question'); ?>',
                    data: formData,
                    success: function(response) {
             
                        console.log('Question saved successfully');
                        window.location.href = '<?php echo site_url('home'); ?>';
                    },
                    error: function(xhr, status, error) {
                      
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
