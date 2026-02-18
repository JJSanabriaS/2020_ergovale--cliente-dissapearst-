<button type="button" class="btn btn-sm btn-info" onclick="location.href='index.php'" style="margin-left:15px"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</button>
<?php
if(0 && $_SESSION['perfil'] == LEVEL_ADMIN){ //esconder menu ?>
<button type="button" id='btn_nova_empresa-menu' class="btn btn-sm btn-success" style="margin-left:10px" onClick="abrir_empresa('n',-1)"><i class="fa fa-building-o" aria-hidden="true"></i> Nova Empresa</button>
<?php } ?>

<button type="button" class="btn btn-sm btn-secondary" style="margin-left:10px" onclick="location.href='?page=gerencia'"><i class="fa fa-pie-chart" aria-hidden="true"></i> Gerenciamento</button>
<?php if($_SESSION['perfil'] == LEVEL_ADMIN){
  echo '<button type="button" class="btn btn-sm btn-primary" style="margin-left:10px" id="btnUsuarios"><i class="fa fa-users" aria-hidden="true"></i> Usuários</i></button>';
} ?>
