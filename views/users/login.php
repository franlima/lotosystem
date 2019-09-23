<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui inverted image header">
      <!--<img src="assets/images/logo.png" class="image">-->
      <div class="content">
        Login
      </div>
    </h2>
    <form class="ui large form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" id="login" name="username"  value="<?php $_SERVER['PHP_SELF']; ?>" placeholder="Usuário" >
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" id="inputPassword" name="password" value="<?php $_SERVER['PHP_SELF']; ?>" placeholder="senha">
          </div>
        </div>
        <input class="ui fluid large orange submit button" type="submit" name="submit" value="Login">
      </div>
      <div class="ui error message"></div>
    </form>
    <div class="ui message">
      Necessita de acesso? <a href="">Solicitar</a>
    </div>
  </div>
</div>