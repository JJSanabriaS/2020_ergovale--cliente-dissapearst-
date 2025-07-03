<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="assets/mandala.css?v=2.13.1">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
</head>
<style media="screen">
.btn {
  float: right;
  display: inline-block;
  padding: 9px 12px;
  padding-top: 7px;
  margin-bottom: 0;
  font-size: 14px;
  line-height: 20px;
  color: #5e5e5e;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  background-color: #d1dade;
  -webkit-border-radius: 3px;
  -webkit-border-radius: 3px;
  -webkit-border-radius: 3px;
  background-image: none !important;
  border: none;
  text-shadow: none;
  box-shadow: none;
  transition: all 0.12s linear 0s !important;
  font: 14px/20px "Helvetica Neue",Helvetica,Arial,sans-serif;
}

.btn-danger {
  color: #fff;
  background-color: #d9534f;
  border-color: #d43f3a;
  margin-right: 10px;
}
body{
  margin: 5px 0.3px;
}
</style>
<body>
  <a class="navbar-brand" href="https://www.ergovale.com.br">
    <img style='height: 40px' src="assets/imgs/logo.png" alt="">
  </a>
  <button type="button" class="btn btn-danger" style="margin-left:11px" onClick="location.href='?page=logout'"><i class="fa fa-close" aria-hidden="true"></i> Sair </i></button>
  <div class="bola12">
  </div>
  <div id="bola1" class="bola1">
    <div id="bola1-container">
      <img src="assets/imgs/logo-mandala.png" alt="Gestão em ergonomia">
      <p>GESTÃO EM ERGONOMIA</p>
    </div>
  </div>
  <div onClick="location.href='?page=main'" id="bola2" class="bola2">
    <img src="assets/imgs/aet.png" alt="Análise ergonômica do trabalho">
  </div>
  <div id="bola2-msg" class="msg-container">
    <p>ANÁLISE<br /> ERGONÔMICA<br /> DO TRABALHO</p>
  </div>
  <div id="bola3" class="bola3">
    <img src="assets/imgs/acf.png" alt="Avaliação cinético funcional">
  </div>
  <div id="bola3-msg" class="msg-container">
    <p>AVALIAÇÃO CINÉTICO FUNCIONAL</p>
  </div>
  <div onClick="location.href='?page=funcionarios&empresa=-1'" id="bola4" class="bola4">
    <img src="assets/imgs/fa.png" alt="Funcionários ativos">
  </div>
  <div id="bola4-msg" class="msg-container">
    <p>FUNCIONÁRIOS ATIVOS</p>
  </div>
  <div id="bola5" class="bola5">
    <img src="assets/imgs/tr.png" alt="Trabalho restrito">
  </div>
  <div id="bola5-msg" class="msg-container">
    <p>TRABALHO<br /> RESTRITO</p>
  </div>
  <?php if($_SESSION['perfil'] == LEVEL_ADMIN){ ?>

  <div onClick="location.href='?page=empresas'" id="bola6" class="bola6">
    <img src="assets/imgs/emp.jpg" alt="EMPRESAS">
  </div>
  <div id="bola6-msg" class="msg-container">
    <p>CADASTRO <br>DE <br>EMPRESAS</p>
  </div>
  <?php } ?>

<?php require_once('scripts.php') ?>
<script>
  $(".bola12").hover(function() {
    $("#bola2").addClass('show1');
    $("#bola3").addClass('show2');
    $("#bola4").addClass('show3');
    $("#bola5").addClass('show4');
    $("#bola6").addClass('show5');
  });

  $("#bola2").hover(function(){
    $("#bola1-container").toggleClass('hide');
    $("#bola2-msg").toggleClass('show-msg');
  });

  $("#bola3").hover(function(){
    $("#bola1-container").toggleClass('hide');
    $("#bola3-msg").toggleClass('show-msg');
  });

  $("#bola4").hover(function(){
    $("#bola1-container").toggleClass('hide');
    $("#bola4-msg").toggleClass('show-msg');
  });

  $("#bola5").hover(function(){
    $("#bola1-container").toggleClass('hide');
    $("#bola5-msg").toggleClass('show-msg');
  });

  $("#bola6").hover(function(){
    $("#bola1-container").toggleClass('hide');
    $("#bola6-msg").toggleClass('show-msg');
  });

  $("#bola2, #bola3, #bola4, #bola5, #bola6").mouseleave(function(){
    $("#bola2").removeClass('show1');
    $("#bola3").removeClass('show2');
    $("#bola4").removeClass('show3');
    $("#bola5").removeClass('show4');
    $("#bola6").removeClass('show5');
  });
</script>
</body>
</html>