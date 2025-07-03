<?php
require_once('../config/database.php');
require_once('../config/autenticacao.php');
        if($_POST['op'] == 'a'){
          $sql_email = "SELECT email FROM usuarios WHERE email = \"".$_POST['email']."\"";
          if(mysqli_num_rows(executeQuery($sql_email))){
            die(json_encode("existe"));
          }else{
          	$empresa = isset($_POST['empresa']) && !empty($_POST['empresa']) ? $_POST['empresa'] : '0';
            $sql = "INSERT INTO `usuarios` (`email`, `senha`, `dt_cadastro`, `perfil`, `status`, `empresa`) VALUES ('".$_POST['email']."', '".password_hash($_POST['senha'], PASSWORD_DEFAULT)."', '".date('Y-m-d H:i:s')."', ".(isset($_POST['perfil']) ? $_POST['perfil'] : 2).", 'ativado', '{$empresa}');";
            if (executeQuery($sql)) {
              die(json_encode("Usuario criado com sucesso"));
            }else{
              die(json_encode("Error: " . $sql . "<br>" . mysqli_error()));
            }
          }
        }
        if($_POST['op'] == 'e'){
          $sql = "DELETE FROM usuarios WHERE id = ".$_POST['id'];
          if(executeQuery($sql)){
            die(json_encode("Usuario excluido com sucesso"));
          } else {
            die(json_encode("Error: " . $sql . "<br>" . mysqli_error()));
          }
        }
