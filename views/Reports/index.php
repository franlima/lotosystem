<div class="container">
    <h3 class="panel-title">Daily TFL Report</h3>
	<form method="post" action="<?php echo ROOT_URL; ?>reports/day">
		<div class="form-group">
			<label for="selectusername" class="sr-only">Select username</label>
			<select class="form-control form-control-lg" name="selectusername">
				<option selected hidden>Choose here</option>
					<?php foreach($viewmodel as $item) : ?>
						<option value="<?php echo $item['id']. ',' .$item['idtype']. ',' .$item['username'] ?>"><?php echo $item['username'] ?></option>
					<?php endforeach; ?>
			</select>
			<span class="help-block"></span>
		</div>
		<div class="form-group">
			<label for="date" class="sr-only">Select date:</label>
			<input type="Date" id="date" name="date" class="form-control form-control-lg" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d', strtotime('-5 day', time())); ?>" max="<?php echo date('Y-m-d'); ?>">
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