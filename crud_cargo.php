<?php
require_once('../config/database.php');
    if ($_POST['operacao'] == 'n') {
        $insert = 'INSERT INTO `cargo`
            (`nome`,
            `id_celula`)
            VALUES
            ("'.$_POST['nome'].'",
             '.$_POST['id_celula'].')';

        if (executeQuery($insert)) {
            die("Novo Cargo cadastrada com sucesso");
        } else {
            die("Error: " . $insert . "<br>" . mysqli_error());
        }
    }
    if ($_POST['operacao'] == 'b') {
        $select = 'SELECT * FROM cargo WHERE id_cargo = '.$_POST['id_celula'];

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
        $update = 'UPDATE `cargo`
                    SET
                    `nome` = "'.$_POST['nome'].'"
                    WHERE `id_cargo` = '.$_POST['id_celula'];

        if (executeQuery($update)) {
            die(json_encode(true));
        } else {
            die(json_encode(false));
        }
    }
    if ($_POST['operacao'] == 'd') {
        executeQuery("UPDATE funcionarios SET id_cargo=-1 WHERE id_cargo = ".$_POST['id_empresa']);
        $sql = "SELECT id_funcao FROM funcoes WHERE id_cargo = ".$_POST['id_empresa'];
        $res = executeQuery($sql);
        while($funcoes = mysqli_fetch_object($res)){
          $sql = "SELECT id_Atividades FROM atividades WHERE id_funcao = ".$funcoes->id_funcao;
          $res = executeQuery($sql);
            while($atividades = mysqli_fetch_object($res)){
              executeQuery("DELETE FROM subatividade WHERE id_atividade = ".$atividades->id_Atividades);
              executeQuery("DELETE FROM atividades WHERE id_Atividades = ".$atividades->id_Atividades);
            }
          executeQuery("DELETE FROM funcoes WHERE id_funcao = ".$funcoes->id_funcao);
        }
        executeQuery("DELETE FROM cargo WHERE id_cargo = ".$_POST['id_empresa']);

        die(json_encode(true));
    }
