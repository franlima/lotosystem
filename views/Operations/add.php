<?php if(isset($_SESSION['is_logged_in'])) : ?>
<div class="container">
    <h3 class="panel-title">Add operation</h3>
	<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
			<label for="operationid" class="sr-only">Select operation</label>
			<select id="operationid" name="operationid" class="form-control form-control-lg">
				<option selected hidden>Choose here</option>
					<?php foreach($viewmodel as $item) : ?>
						<option value="<?php echo $item['id']?>"><?php echo $item['name'] ?></option>
					<?php endforeach; ?>
			</select>
			<span class="help-block"></span>
		</div>
		<div class="form-group">
			<label for="value" class="sr-only">Value</label>
			<input type="number" id="value" name="value" class="form-control form-control-lg"  step="0.01" placeholder="0.00">
			<span class="help-block"></span>
		</div>
		<div class="form-group">
			<input class="btn btn-primary" type="submit" value="Submit" name="submit">              
		</div>
		<label>
			<span class="help-block"></span>
		</label>		
	</form>
</div>
<?php endif; ?>