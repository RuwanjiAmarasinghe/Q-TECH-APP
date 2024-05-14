<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css">
</head>

<body>
	<?php $this->load->view('header'); ?>
	<div class="container" style="padding-top:4%;">
	<h5 class="text-center" style="margin-bottom: 50px; font-size: 20px; font-weight: bold;">Register to Q&TECH</h5>
		<div class="row justify-content-center">
			<div class="col-md-6">
				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger">
						<?= $this->session->flashdata('error') ?>
					</div>
				<?php endif; ?>
				<form action="<?= site_url('user/register') ?>" method="post">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary">Register</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
