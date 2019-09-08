<div class="container">
	<h3 class="panel-title">Login</h3>
	<div class="card">
		<div class="card-body">
			<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label for="login" class="sr-only">Username</label>
					<input type="text" id="login" name="username" class="form-control" placeholder="Username" value="<?php $_SERVER['PHP_SELF']; ?>">
					<span class="help-block"></span>
				</div>
				<div class="form-group">
					<label for="inputPassword" class="sr-only">Password</label>
					<input type="password" id="inputPassword" name="password"  class="form-control" placeholder="Password">
					<span class="help-block"></span>
				</div>
				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="Login" name="submit">              
				</div>
				<label>
					<span class="help-block"></span>
				</label>		
			</form>
		</div>
	</div>
</div>