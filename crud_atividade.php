<?php
require_once('../config/database.php');
require_once('../helper/FileUpload.php');

    if ($_POST['operacao'] == 'n') {
        $foto = upload($_FILES['foto_atividade'], '../uploads/')['arquivo'];
        $insert = 'INSERT INTO `atividades`
            (`Nome`,
            `Tempo`,
            `Descricao`,
            `Youtube`,
            `Foto`,
            `id_funcao`)
            VALUES
            ("'.$_POST['nome_atividade'].'",
             "'.$_POST['tempo_atividade'].'",
             "'.$_POST['descricao_atividade'].'",
             "'.$_POST['youtube_atividade'].'",
             "'.$foto.'",
             '.$_POST['hidden_funcao_atividade'].'
            )';

        if (executeQuery($insert)) {
            die(true);
        } else {
            die(false);
        }
    }
    if ($_POST['operacao'] == 'b') {
        $select = 'SELECT * FROM atividades WHERE id_Atividades = '.$_POST['id_atividade'];

        $result = executeQuery($select);

        if ($result) {
            $return['sucesso'] = true;
            $return['info'] = $result->fetch_assoc();
            die(json_encode($return));
        } else {
            die(json_encode($result['sucesso'] = false));
        }
    }
    if ($_POST['operacao'] == 'e') {
        $update = 'UPDATE `atividades`
                    SET
                    `Nome` = "'.$_POST['nome_atividade'].'",
                    `Tempo` = "'.$_POST['tempo_atividade'].'",
                    `Descricao` = "'.$_POST['descricao_atividade'].'",
                    `Youtube` = "'.$_POST['youtube_atividade'].'"
                    WHERE `id_Atividades` = '.$_POST['hidden_id_atividade'];
        if (executeQuery($update)) {
            if(sizeof($_FILES)>0){
              $foto = upload($_FILES['foto_atividade'], '../uploads/')['arquivo'];
              $sql = "UPDATE atividades SET Foto = \"".$foto."\" WHERE id_Atividades = ".$_POST['hidden_id_atividade'];
              executeQuery($sql);
            }
            die(true);
        } else {
            die(false);
        }
    }
    if ($_POST['operacao'] == 'd') {
        $sql_foto = "SELECT Foto FROM atividades WHERE id_Atividades = ".$_POST['id_empresa'];
        $consulta_foto = executeQuery($sql_foto);
        $foto = mysqli_fetch_object($consulta_foto)->Foto;
        if($foto != ""){
          unlink($foto);
        }
        executeQuery("DELETE FROM subatividade WHERE id_atividade = ".$_POST['id_empresa']);
        executeQuery("DELETE FROM atividades WHERE id_Atividades = ".$_POST['id_empresa']);
        die(json_encode(true));
    }
