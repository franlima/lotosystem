<div class="container">
	<div class="panel panel-info">
		<h3 style="text-align: center;">TFL REPORT DATA</h3>
		<div class="panel-heading">
			<h4>INFORMATION
				<a class="btn btn-info btn-sm" href="<?php echo ROOT_URL;?>reports">Change
					<img src="<?php echo ROOT_URL; ?>assets/icons/si-glyph-edit.svg" style="width: 20px; heigth: 20px; color: green;" />					
				</a>
			</h4>
			<table class="table table-light table-bordered table-sm">
				<tbody>
					<tr>
						<th>Name: <?php echo $_SESSION['current_user']['username']?>
						</th>
					</tr>
					<tr>
						<th>Date: <?php echo $_SESSION['current_user']['date']?></th>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="panel-body">
			<h4>OPERATIONS
			<a class="btn btn-info btn-sm" href="<?php echo ROOT_URL;?>operations/add">Add
				<img src="<?php echo ROOT_URL; ?>/assets/icons/si-glyph-button-plus.svg" style="width: 20px; heigth: 20px; color: green;" />
			</a>
			</h4>
			<table class="table table-light table-bordered table-hover">
				<thead class="thead-light">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Name</th>
						<th scope="col">Value</th>
						<th scope="col">
							<span class="badge badge-success"><img src="<?php echo ROOT_URL; ?>assets/icons/si-glyph-checked.svg" style="width: 16px; heigth: 16px;" /></span> or
							<span class="badge badge-danger"><img src="<?php echo ROOT_URL; ?>assets/icons/si-glyph-button-error.svg" style="width: 16px; heigth: 16px;" /></span>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($viewmodel as $item) : ?>
				<?php if (intval($item['idop']) > 6 ) : ?>
					<tr style="display:none;">
				<?php else : ?>
					<tr>
				<?php endif ; ?>
						<th scope="row"><?php echo $item['id'] ?></th>
						<td><?php echo $item['name'] ?></td>
						<td id="<?php echo $item['name'] ?>" class="data"><?php echo $item['value'] ?></td>
						<?php if($item['status'] == '1') : ?>
							<td><span class="badge badge-success"><img src="<?php echo ROOT_URL; ?>assets/icons/si-glyph-checked.svg" style="width: 16px; heigth: 16px;" /></span></td>
						<?php else : ?>
							<td><span class="badge badge-danger"><img src="<?php echo ROOT_URL; ?>assets/icons/si-glyph-button-error.svg" style="width: 16px; heigth: 16px;" /></span></td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<h4>TOTALS
			<?php if ($_SESSION['user_data']['idtype'] == '1' ) : ?>
				<a class="btn btn-info btn-sm" href="<?php echo ROOT_URL;?>operations/total">Add
					<img src="<?php echo ROOT_URL; ?>assets/icons/si-glyph-button-plus.svg" style="width: 20px; heigth: 20px; color: green;" />
				</a>
			<?php endif ; ?>
			</h4>
			<table class="table table-light table-bordered table-hover">
				<thead class="thead-light">
					<tr>
						<th scope="col">Action</th>
						<th scope="col">Subtotal</th>
					</tr>
				</thead>
				<tbody id="total">
				</tbody>
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
								$('#total').append('<tr><td>' + key + '</td><td id="' + key + '">' + value + '</td></tr>');
							});
						});
				</script>
			</table>
		</div>
	</div>
</div>