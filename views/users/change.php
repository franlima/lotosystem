<?php if(isset($_SESSION['is_logged_in'])&&(1 == $_SESSION['user_data']['idtype'])) : ?>
<div class="ui fluid">
	<h1 class="ui inverted header">Selecione o usuário</h1>
	<form class="ui form segment" method="post" action="<?php echo ROOT_URL; ?>reports/day">
		<div class="field">
			<select class="ui fluid normal dropdown" name="selectusername">
				<option selected hidden>Choose here</option>
					<?php foreach($viewmodel as $item) : ?>
						<option value="<?php echo $item['id']. ',' .$item['idtype']. ',' .$item['username'] ?>"><?php echo $item['username'] ?></option>
					<?php endforeach; ?>
			</select>
			<span class="help-block"></span>
		</div>
		<div class="field">
			<div class="ui left icon input">
				<i class="calendar icon"></i>
				<input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d', strtotime('-5 day', time())); ?>" max="<?php echo date('Y-m-d'); ?>">
			</div>
			<span class="help-block"></span>
		</div>
		<div class="field">
			<input class="ui fluid large orange submit button" type="submit" value="Submit" name="submit">              
		</div>
		<label>
			<span class="help-block"></span>
		</label>		
	</form>
</div>
<?php else :
	header('Location: '.ROOT_URL.'reports/day');
endif; ?>