<?php if(isset($_SESSION['is_logged_in'])) : ?>
<div class="ui middle aligned center aligned grid">
	<div class="column">
		<h1>Bem vindo ao Lotosystem</h1>
		<p class="lead">Por favor selecione a operação do menu</p>
		<a class="ui large teal button" href="<?php echo ROOT_URL;?>operations/add">Log operation</a>
	</div>
	<?php else : ?>
	<div class="column">
		<h1>Bem vindo ao Lotosystem</h1>
		<p class="lead">Para acessar o sistema, precisa de login</p>
		<a class="ui large teal button" href="<?php echo ROOT_URL;?>users/login">Login</a>
	</div>
</div>
<?php endif; ?>