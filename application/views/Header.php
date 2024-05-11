<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- header.php -->
<div class="container">
	<div class="d-flex justify-content-between align-items-baseline mt-5">
		<div class="d-flex align-items-baseline">
		<h1><a href="<?php echo site_url('home'); ?>" style="text-decoration: none; color: inherit; font-size: 1.5em; font-weight: bold; color: #ff6347;">Q&Tech</a></h1>
			</h1>
			<h4 style="margin-left: 10px;"><?= $title ?></h4>
		</div>

		<div>
			<?php if (isset($user_id) && $user_id): ?>
				<div class="d-flex ">
					<h3>Welcome, <a href="<?php echo site_url('user/profile'); ?>"><?= $username ?></a></h3>
					<?php if ($title == 'Profile'|| $title == 'Ask Question'): ?>
						<div class="ml-3">

							<form action="<?php echo site_url('user/logout'); ?>" method="post">
								<button type="submit" class="btn btn-danger">Logout</button>
							</form>
						</div>
					<?php endif; ?>
				</div>

			<?php elseif ($title != 'Ask Question'): ?>
				<a href="<?php echo site_url('user/login'); ?>">
					<button class="btn btn-primary">Login</button></a>
				<a href="<?php echo site_url('user/register'); ?>">
					<button class="btn btn-secondary">Sign Up</button>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>
