<?php if(isset($_SESSION['is_logged_in'])) : ?>
<div class="ui fluid">
	<h1 class="ui header">Adicione operação</h1>
	<form class="ui form segment" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<div class="field">
			<label for="operationid">Seleccione operação</label>
			<select id="operationid" name="operationid" class="ui fluid normal dropdown">
				<option selected hidden>Choose here</option>
					<?php foreach($viewmodel as $item) : ?>
						<option value="<?php echo $item['id']?>"><?php echo $item['name'] ?></option>
					<?php endforeach; ?>
			</select>
			<span class="help-block"></span>
		</div>
		<div class="field">
			<label for="value">Valor</label>
			<div class="ui left icon input">
				<i class="money icon"></i>
				<input type="number" id="value" name="value" step="0.01" placeholder="0.00">
			</div>
			<span class="help-block"></span>
		</div>
		<div class="field">
			<input class="ui fluid large teal submit button" type="submit" value="Submit" name="submit">              
		</div>
		<label>
			<span class="help-block"></span>
		</label>		
	</form>
</div>
<?php endif; ?>