<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/minty/bootstrap.min.css" integrity="sha384-H4X+4tKc7b8s4GoMrylmy2ssQYpDHoqzPa9aKXbDwPoPUA3Ra8PA5dGzijN+ePnH" crossorigin="anonymous">

</head>

<body>
	<?php $this->load->view('header'); ?>
	<div class="container" style="padding-top: 8%;">
		<div class="row justify-content-center">
			<div class="col-md-6">

				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger">
						<?= $this->session->flashdata('error') ?>
					</div>
				<?php endif; ?>
				<form action="<?= site_url('user/login') ?>" method="post">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" required>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
