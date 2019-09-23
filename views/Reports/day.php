<div class="ui middle aligned aligned grid">
	<div class="column">
		<h2 class="ui inverted centered header">Relatório de Caixa</h2>
			<div class="ui horizontal segments">
				<div class="ui segment">
					<a class="ui large icon label">
						<i class="user icon"></i>
						<?php echo $_SESSION['user_data']['username']?>
					</a>
				</div>
				<div class="ui segment">
					<a class="ui large icon label">
						<i class="calendar icon"></i>
						<?php echo $_SESSION['user_data']['date']?>
					</a>
				</div>
			</div>
			<div class="ui orange segment">
				<h4>Operações no TFL</h4>
				<table class="ui unstackable table"">
					<thead>
						<tr>
							<th>#</th>
							<th>Nome</th>
							<th>Valor</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($viewmodel["operations"] as $key => $item) : ?>
						<?php if (intval($item['idop']) > 6 ) : ?>
							<tr style="display:none;">
						<?php else : ?>
							<tr>
						<?php endif ; ?>
							<td><?php echo $item['id'] ?></td>
							<td><?php echo $item['name'] ?></td>
							<td id="<?php echo $item['name'] ?>"><?php echo $item['value'] ?></td>
							<?php if($item['status'] == '1') : ?>
								<td><i class="ui green inverted check circle icon"></i></td>
							<?php else : ?>
								<td><i class="ui red circle icon"></i></td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
					</tbody>
					<tfoot class="full-width">
						<tr>
						<th></th>
						<th colspan="4">
							<a class="ui orange right floated small icon button" href="<?php echo ROOT_URL;?>operations/add">
								<i class="cogs icon"></i> Adicionar
							</a>
						</th>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="ui orange segment">
				<h4>TOTALS</h4>
				<table class="ui unstackable table"">
					<thead>
						<tr>
							<th>Ação</th>
							<th>Subtotal</th>
						</tr>
					</thead>
					<tbody id="total">
					<?php foreach($viewmodel["totals"] as $key => $item) : ?>
						<tr>
							<td><?php echo $key ?></td>
							<td><a class="ui tag label"><?php echo $item ?></a></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
					<?php if ($_SESSION['user_data']['idtype'] == '1' ) : ?>
					<tfoot class="full-width">
						<tr>
							<th></th>
							<th colspan="4">
								<a class="ui orange right floated small icon button" href="<?php echo ROOT_URL;?>operations/total">
									<i class="calculator icon"></i> Total
								</a>
							</th>
						</tr>
					</tfoot>
					<?php endif ; ?>
					<script>
							var nameofclass = '';
							var array = {};
							var value = parseFloat('0');
							$(function () {
								$('.data').each(function () {
									nameofclass = $(this).attr('id');
									value = parseFloat($(this).text());
									if (array[nameofclass] == null)
										array[nameofclass] = value;
									else
										array[nameofclass] = parseFloat(array[nameofclass]) + value;
								});
								$.each(array, function(key, value){
									$('#total').append('<tr><td>' + key + '</td><td id="' + key + '"><a class="ui tag label">' + value + '</a></td></tr>');
								});
							});
					</script>
				</table>
		</div>
	</div>
</div>