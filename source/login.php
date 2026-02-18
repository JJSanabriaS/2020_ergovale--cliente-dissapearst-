
<?php require_once('topo.php');
?>
<div class="container">
  <div class="col-md-4" style="margin: auto">
    <?php
    if($_GET['di']){
      echo "<div class=' alert alert-danger'>
      Você foi deslogado por inatividade, por favor se autentique novamente.
      </div>";
    }
    ?>
    <form action="?page=autenticacao" method="POST">
      <div class="form-group">
        <label>Login</label>
        <input class="form-control" id="form-login" name="Login" type="text" />
      </div>
      <div class="form-group">
        <label>Senha</label>
        <input class="form-control" id="form-senha" name="Senha" type="password" />
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Autenticar</button>
        <button type="reset" class="btn btn-default">Resetar</button>
      </div>
    </form>
  </div>
</div>
<?php require('rodape.php') ?>
