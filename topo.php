<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="favicon.png" />
  <title>Ergovale - versão <?php echo VERSAO_APP;?></title>
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />
  <script src="https://cdn.zingchart.com/zingchart.min.js"></script>

  <meta name="description" content="Sistema para Ergonomia">
  <meta name="keywords" content="ergonomia, avaliação cinético funcional, funcionarios, fabricas, trabalho restrito, análise ergonômica do trabalho">
  <meta name="author" content="FSCommerce">

  <link rel="shortcut icon" href="assets/imgs/logo-mini.png" type="image/x-png" />
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/main.css">
  <!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/default.min.css"/>
</head>
<body>
  <a class="navbar-brand" href="https://www.ergovale.com.br">
    <img style='height: 40px' src="assets/imgs/logo.png" alt="">
  </a>
  <div id="spinner_ajax" style="position: fixed; z-index: 1000000; right: 0; top: 0; display: none; transition: all 1s;" class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-rolling"><div></div></div><style type="text/css">@keyframes lds-rolling {
    0% {
      -webkit-transform: translate(-50%, -50%) rotate(0deg);
      transform: translate(-50%, -50%) rotate(0deg);
    }
    100% {
      -webkit-transform: translate(-50%, -50%) rotate(360deg);
      transform: translate(-50%, -50%) rotate(360deg);
    }
  }
  @-webkit-keyframes lds-rolling {
    0% {
      -webkit-transform: translate(-50%, -50%) rotate(0deg);
      transform: translate(-50%, -50%) rotate(0deg);
    }
    100% {
      -webkit-transform: translate(-50%, -50%) rotate(360deg);
      transform: translate(-50%, -50%) rotate(360deg);
    }
  }
  .lds-rolling {
    position: relative;
  }
  .lds-rolling div,
  .lds-rolling div:after {
    position: absolute;
    width: 48px;
    height: 48px;
    border: 8px solid #ffffff;
    border-top-color: transparent;
    border-radius: 50%;
  }
  .lds-rolling div {
    -webkit-animation: lds-rolling 1s linear infinite;
    animation: lds-rolling 1s linear infinite;
    top: 100px;
    left: 100px;
  }
  .lds-rolling div:after {
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
  }
  .lds-rolling {
    width: 200px !important;
    height: 200px !important;
    -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
    transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
  }
</style></div>
