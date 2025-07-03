<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <?php
       require_once('database.php');
       require_once('autenticacao.php');
//require_once('../config/database.php');
//require_once('../config/autenticacao.php');-->
    if ($_POST['operacao'] == 'n') {
        $character = array(".", "/", "-");
        $_POST['cnpj_empresa'] = str_replace($character, "", $_POST['cnpj_empresa']);
        $insert = 'INSERT INTO `empresas`
            (`cnpj`,
            `razao`,
            `data_cadastro`,
            `cnae`,
            `graurisco`,
            `cep`,
            `logradouro`,
            `numero`,
            `estado`,
            `cidade`,
            `atividadeprincipal`,
            `website`,
            `telefone`)
            VALUES
            ('.$_POST['cnpj_empresa'].',
            "'.$_POST['razao_empresa'].'",
            CURRENT_TIMESTAMP(6),
            "'.$_POST['cnae_empresa'].'",
            "'.$_POST['risco_empresa'].'",
            "'.$_POST['cep_empresa'].'",
            "'.$_POST['log_empresa'].'",
            "'.$_POST['numero_empresa'].'",
            "'.$_POST['estado_empresa'].'",
            "'.$_POST['cidade_empresa'].'",
            "'.$_POST['atv_empresa'].'",
            "'.$_POST['site_empresa'].'",
            "'.$_POST['tel_empresa'].'");';
        if (executeQuery($insert)) {
            $empresaid['select'] = 'SELECT id FROM empresas WHERE cnpj = '.$_POST['cnpj_empresa'];
            $empresaid['query'] = executeQuery($empresaid['select']);
            $empresaid['id'] = $empresaid['query']->fetch_assoc();
            $insertid['select'] = 'INSERT INTO empresa_usuario VALUES ('.$_SESSION['id'].', '.$empresaid['id']['id'].')';
            $insertid['query'] = executeQuery($insertid['select']);
            $insertid['result'] = $empresaid['query']->fetch_assoc();
            die(json_encode("Nova empresa cadastrada com sucesso"));
        } else {
            die(json_encode("Error: " . $insert . "<br>" . mysqli_error()));
        }
    }
    if ($_POST['operacao'] == 'b') {
        $select = 'SELECT * FROM empresas WHERE id = '.$_POST['id_empresa'];

        $result = executeQuery($select);

        if ($result) {
            $return['sucesso'] = true;
            $return['info'] = $result->fetch_assoc();
            die(json_encode($return));
        } else {
            die($result['sucesso'] = false);
        }
    }
    if ($_POST['operacao'] == 'e') {
        $update = 'UPDATE `empresas`
                    SET
                    `cnpj` = "'.$_POST['cnpj_empresa'].'",
                    `razao` = "'.$_POST['razao_empresa'].'",
                    `cnae` = "'.$_POST['cnae_empresa'].'",
                    `graurisco` = "'.$_POST['risco_empresa'].'",
                    `cep` = "'.$_POST['cep_empresa'].'",
                    `logradouro` = "'.$_POST['log_empresa'].'",
                    `numero` = "'.$_POST['numero_empresa'].'",
                    `estado` = "'.$_POST['estado_empresa'].'",
                    `cidade` = "'.$_POST['cidade_empresa'].'",
                    `atividadeprincipal` = "'.$_POST['atv_empresa'].'",
                    `website` = "'.$_POST['site_empresa'].'",
                    `telefone` = "'.$_POST['tel_empresa'].'"
                    WHERE `id` = '.$_POST['id_empresa'];

        if (executeQuery($update)) {
            die(json_encode(true));
        } else {
            die(json_encode(false));
        }
    }
    if ($_POST['operacao'] == 'd') {
        $select['fabrica'] = "SELECT id_fabrica FROM fabricas WHERE id_empresa = ".$_POST['id_empresa'];
        $fabricas = executeQuery($select['fabrica']);
        while($fabrica = mysqli_fetch_object($fabricas)){
          //exclui todos os setores da empresa Xpto
          $select['setor'] = "SELECT id_setor FROM setor WHERE id_fabrica = ".$fabrica->id_fabrica;
          $setores = executeQuery($select['setor']);
          while($setor = mysqli_fetch_object($setores)){
            executeQuery("delete from setor where id_setor={$setor->id_setor}");
            $sql = "SELECT * from celulas where id_setor={$setor->id_setor}";
            $res = executeQuery($sql);
            while($celulas = mysqli_fetch_object($res)){
              executeQuery("DELETE from cargo where id_celula={$celulas->id_celulas}");
            }
            executeQuery("delete from celulas where id_setor={$setor->id_setor}");
          }
        }

        //pega todos os funcionarios da empresa xpto e deleta
        $sql = "select id_funcionario from funcionarios where empresa_id={$_POST['id_empresa']}";
        $res = executeQuery($sql);
        while($funcionario = mysqli_fetch_object($res)){
          executeQuery("delete from cargo where id_cargo = {$funcionario->id_cargo}");
          $sql = "select id_funcao from funcoes where id_funcionario = {$funcionario->id_funcionario}";
          $res = executeQuery($sql);
          while($funcoes = mysqli_fetch_object($res)){
            $sql = "select * from atividades where id_funcao = $funcoes->id_funcao";
            $res = executeQuery($sql);
            while($atividade = mysqli_fetch_object($res)){
              executeQuery("DELETE from subatividade WHERE id_atividade = $atividade->id_Atividades");
            }
            executeQuery("DELETE from atividades where id_funcao = $funcoes->id_funcao");
          }
          executeQuery("DELETE from funcoes where id_funcionario = $funcionario->id_funcionario");
        }
        executeQuery("delete from funcionarios where empresa_id={$_POST['id_empresa']}");
        executeQuery("DELETE FROM fabricas WHERE id_empresa = ".$_POST['id_empresa']);
        executeQuery("DELETE from empresas WHERE id = {$_POST['id_empresa']}");
        executeQuery("DELETE from empresa_usuario where id_empresa = {$_POST['id_empresa']}");
        die(json_encode(true));
    }
?>
    </body>
</html>
