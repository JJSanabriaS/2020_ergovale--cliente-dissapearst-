<?php
require_once('../config/database.php');
    if ($_POST['operacao'] == 'n') {
        $insert = 'INSERT INTO `fabricas`
            (`id_empresa`,
            `Nome da Fabrica`)
            VALUES
            ('.$_POST['id_empresa'].',
             "'.$_POST['nome'].'"
            )';

        if (executeQuery($insert)) {
            die("Novo fábrica cadastrado com sucesso");
        } else {
            die("Error: " . $insert . "<br>" . mysqli_error());
        }
    }
    if ($_POST['operacao'] == 'b') {
        $select = 'SELECT * FROM fabricas WHERE id_fabrica = '.$_POST['id_fabrica'];

        $result = executeQuery($select);

        if ($result) {
            $return['sucesso'] = true;
            $return['info'] = $result->fetch_assoc();
            die(json_encode($return));
        } else {
            echo mysqli_error();
            die(json_encode($result['sucesso'] = false));
        }
    }
    if ($_POST['operacao'] == 'e') {
        $update = 'UPDATE `fabricas`
                    SET
                    `Nome da Fabrica` = "'.$_POST['nome'].'"
                    WHERE `id_fabrica` = '.$_POST['id_fabrica'];

        if (executeQuery($update)) {
            die(json_encode(true));
        } else {
            die(json_encode(false));
        }
    }
    if ($_POST['operacao'] == 'd') {
          $sql = "SELECT id_setor FROM setor WHERE id_fabrica = ".$_POST['id_empresa'];
          $res = executeQuery($sql);
          while($setor = mysqli_fetch_object($res)){
            executeQuery("DELETE FROM setor WHERE id_setor = ".$setor->id_setor);
            $sql = "SELECT id_celulas FROM celulas WHERE id_setor = ".$setor->id_setor;
            $res = executeQuery($sql);
            while($celula = mysqli_fetch_object($res)){
              $sql = "SELECT id_cargo FROM cargo WHERE id_celula = ".$celula->id_celulas;
              $res = executeQuery($sql);
                while($cargo = mysqli_fetch_object($res)){
                  $sql = "SELECT id_funcionario FROM funcionarios WHERE id_cargo = ".$cargo->id_cargo;
                  $res = executeQuery($sql);
                    while($funcionario = mysqli_fetch_object($res)){
                      $sql = "SELECT id_funcao FROM funcoes WHERE id_funcionario = ".$funcionario->id_funcionario;
                      $res = executeQuery($sql);
                      while($funcao = mysqli_fetch_object($res)){
                        $sql = "SELECT id_Atividades FROM atividades WHERE id_funcao = ".$funcao->id_funcao;
                        $res = executeQuery($sql);
                          while($atividade = mysqli_fetch_object($res)){
                            executeQuery("DELETE FROM subatividade WHERE id_atividade = ".$atividade->id_Atividades);
                            executeQuery("DELETE FROM atividades WHERE id_Atividades = ".$atividade->id_Atividades);
                          }
                        executeQuery("DELETE FROM funcoes WHERE id_funcao = ".$funcao->id_funcao);
                      }
                    }
                  executeQuery("DELETE FROM funcionarios WHERE id_cargo = ".$cargo->id_cargo);
                }
              executeQuery("DELETE FROM cargo WHERE id_celula = ".$celula->id_celulas);
            }
          }
          executeQuery("DELETE FROM fabricas WHERE id_fabrica = ".$_POST['id_empresa']);
        die(json_encode(true));
    }
