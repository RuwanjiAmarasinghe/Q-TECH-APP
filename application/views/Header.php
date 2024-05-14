<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css">
	<style>
        body {
            font-size: 1.0rem; /* Adjust this value to increase or decrease the font size */
        }
		.navbar {
            font-size: 1.0rem; /* Adjust this value to increase or decrease the font size of the navbar */
        }
		.navbar-brand {
            font-size: 1.5rem; /* Adjust this value to increase or decrease the font size of the navbar brand */
        }
		
    </style>
</head>
<body>
<!-- header.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" data-bs-theme="dark">
    <a class="navbar-brand" href="<?php echo site_url('home'); ?>">Q&TECH</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
				<a class="navbar-brand"><?= isset($title) ? $title : '' ?></a>
            </li>
        </ul>
        <?php if (isset($show_welcome) && $show_welcome && isset($username)): ?>
            <div class="navbar-text" style="margin-right: 15px;">
                Welcome, <a href="<?php echo site_url('user/profile'); ?>"><?= $username ?></a>
            </div>
        <?php endif; ?>
        <?php if (isset($user_id) && $user_id): ?>
            <div class="navbar-text" style="margin-right: 15px;">
                Welcome, <a href="<?php echo site_url('user/profile'); ?>"><?= $username ?></a>
            </div>
            <?php if (isset($title) && ($title == 'Profile')): ?>
                <form class="form-inline" action="<?php echo site_url('user/logout'); ?>" method="post">
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            <?php endif; ?>
			<?php elseif ($this->uri->segment(1) != 'login' && $this->uri->segment(1) != 'register' && $this->uri->segment(1) != 'ask_question'): ?>
            <div class="form-inline">
                <a href="<?php echo site_url('login'); ?>" class="btn btn-dark">Login</a>
                <a href="<?php echo site_url('register'); ?>" class="btn btn-dark">Sign Up</a>
            </div>
        <?php endif; ?>
    </div>
</nav>
</body>
</html>