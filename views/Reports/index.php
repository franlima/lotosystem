<div class="ui fluid">
	<div class="ui horizontal list">
		<a class="item">
			<h1 class="ui teal inverted header">Relatórios de caixa</h1>
		</a>
		<a class="item">
			<a class="ui orange circular button" href="./new">Novo</a>
		</a>
	</div>
	<?php foreach($viewmodel as $item) : ?>
	<div class="ui orange segment">
		<a class="item" href="./day/<?php echo $item['id']; ?>">
			<div class="ui top attached label">
				<i class="calendar icon"></i>
				<?php echo $item['created']; ?>
			</div>
			<div class="ui horizontal list">
				<div class="item">
					<div class="content">
						<div class="header">Total Caixa</div>
						<div class="ui teal label">
							R$ <?php echo $item['totalcaixa']; ?>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<div class="header">Total TFL</div>
						<div class="ui teal label">
							R$ <?php echo $item['totalreport']; ?>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="content">
						<div class="header">Quebra de Caixa</div>
						<?php if($item['quebradecaixa'] >= 0) : ?>
							<div class="ui green label">
						<?php else : ?>
							<div class="ui red label">
						<?php endif; ?>
								R$ <?php echo $item['quebradecaixa']; ?>
							</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<?php endforeach; ?>
</div>