<?php if(isset($_SESSION['is_logged_in'])) : ?>
<div class="container">
	<div class="text-center">
		<h1>Welcome to Lotosystem</h1>
		<p class="lead">Please select an action from above menu to start.</p>
		<a class="btn btn-primary text-center" href="<?php echo ROOT_URL;?>operations/add">Log operation</a>
	</div>
	<?php else : ?>
	<div class="text-center">
		<h1>Welcome to Lotosystem</h1>
		<p class="lead">To access the system please login.</p>
		<a class="btn btn-primary text-center" href="<?php echo ROOT_URL;?>users/login">Login</a>
	</div>
</div>
<?php endif; ?>