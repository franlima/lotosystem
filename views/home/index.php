
<div class="ui middle aligned center aligned grid">
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
		<div class="column">
			<h1>Bem vindo ao Lotosystem</h1>
			<p class="lead">Por favor selecione a operação do menu</p>
			<a class="ui large orange button" href="<?php echo ROOT_URL;?>operations/add">Adicionar operação</a>
		</div>
	<?php else : ?>
		<div class="column">
			<h1>Bem vindo ao Lotosystem</h1>
			<p class="lead">Para acessar o sistema, precisa de login</p>
			<a class="ui large orange button" href="<?php echo ROOT_URL;?>users/login">Acessar sistema</a>
		</div>
	<?php endif; ?>
</div>