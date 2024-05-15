<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css">
</head>

<body>
	<?php $this->load->view('header'); ?>
	<div class="container" style="padding-top: 4%;">
	<h5 class="text-center" style="margin-bottom: 50px; font-size: 20px; font-weight: bold;">Login to Q&TECH</h5>
		<div class="row justify-content-center">
			<div class="col-md-6">

				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger">
						<?= $this->session->flashdata('error') ?>
					</div>
				<?php endif; ?>
				<form action="<?= site_url('login') ?>" method="post">
					<div class="form-group mb-3 text-center">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" required style="max-width: 300px; margin: 0 auto;">
					</div>
					<div class="form-group mb-4 text-center">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" required style="max-width: 300px; margin: 0 auto;">
					</div>
					<div class="form-group mb-5 text-center"> 
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
					<div class="mb-5"></div> 
					<p class="text-center">Don't have an account?</p>
					<div class="mb-4"></div> 
					<div class="form-group text-center"> 
						<a href="<?= site_url('register') ?>" class="btn btn-dark">Sign Up</a> 
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>