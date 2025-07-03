<?php
require_once('../config/database.php');

    if($_POST['operacao'] == 'n-risco'){
      $risco_amb = json_encode($_POST['risco_amb'], true);
      $risco_org = json_encode($_POST['risco_org'], true);
      $risco_psci_cog = json_encode($_POST['risco_psci_cog'], true);
      $update = "UPDATE funcoes SET risco_ambiental = '".$risco_amb."',   risco_organizacional = '".$risco_org."', risco_psci_cog = '".$risco_psci_cog."' WHERE id_funcao = ".$_POST['func_id'];
      if(executeQuery($update)){
            die(true);
        }else{
            die(false);
        }
    }

    if ($_POST['operacao'] == 'n') {
        $risco_amb = json_encode($_POST['risco_amb'], true);
        $risco_org = json_encode($_POST['risco_org'], true);
        $risco_psci_cog = json_encode($_POST['risco_psci_cog'], true);
        $insert = "INSERT INTO funcoes
            (`nome`,
            `area`,
            `desc_atividade`,
            `vlProducao`,
            `rodizio`,
            `frequencia`,
            `inicioTurno`,
            `fimTurno`,
            `inicioAlmoco`,
            `fimAlmoco`,
            `pausa`,
            `maquinasEquipamentos`,
            `ferramentas`,
            `materiaisCargasManuseadas`,
            `episutilizados`,
            `borg`,
            `tipo`,
            `id_cargo`,
            `ghe`,
            `risco_ambiental`,
            `risco_organizacional`,
            `risco_psci_cog`)
            VALUES
            ('".$_POST['nome']."',
             '".$_POST['area']."',
             '".$_POST['descricao']."',
             '".$_POST['volume']."',
             '".$_POST['rodizio']."',
             '".$_POST['frequencia']."',
             '".$_POST['ini_turno']."',
             '".$_POST['fim_turno']."',
             '".$_POST['ini_almoco']."',
             '".$_POST['fim_almoco']."',
             '".$_POST['pausa']."',
             '".$_POST['maquina']."',
             '".$_POST['ferramentas']."',
             '".$_POST['materiais']."',
             '".$_POST['epis']."',
             '".$_POST['borg']."',
             '".$_POST['tipo']."',
             '".$_POST['id_cargo']."',
             '".$_POST['ghe']."',
             '".$risco_amb."',
             '".$risco_org."',
             '".$risco_psci_cog."'
            )";

        if (executeQuery($insert)) {
            die("Nova Função cadastrada com sucesso");
        }
    }
    if ($_POST['operacao'] == 'b') {
        $select = 'SELECT * FROM funcoes WHERE id_funcao = '.$_POST['id_funcao'];

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
        $update = 'UPDATE funcoes
                    SET
                    `nome` = "'.$_POST['nome'].'",
                    `area` = "'.$_POST['area'].'",
                    `desc_atividade` = "'.$_POST['descricao'].'",
                    `vlProducao` = "'.$_POST['volume'].'",
                    `rodizio` = "'.$_POST['rodizio'].'",
                    `frequencia` = "'.$_POST['frequencia'].'",
                    `inicioTurno` = "'.$_POST['ini_turno'].'",
                    `fimTurno` = "'.$_POST['fim_turno'].'",
                    `inicioAlmoco` = "'.$_POST['ini_almoco'].'",
                    `fimAlmoco` = "'.$_POST['fim_almoco'].'",
                    `pausa` = "'.$_POST['pausa'].'",
                    `maquinasEquipamentos` = "'.$_POST['ferramentas'].'",
                    `ferramentas` = "'.$_POST['nome'].'",
                    `materiaisCargasManuseadas` = "'.$_POST['materiais'].'",
                    `episutilizados` = "'.$_POST['epis'].'",
                    `borg` = "'.$_POST['borg'].'",
                    `tipo` = "'.$_POST['tipo'].'",
                    `ghe` = "'.$_POST['ghe'].'"
                    WHERE `id_funcao` = '.$_POST['id_funcao'];

        if (executeQuery($update)) {
            die(json_encode("Função atualizada com sucesso"));
        } else {
            die(json_encode(false));
        }
    }
    if ($_POST['operacao'] == 'd') {
          $sql = "SELECT id_Atividades FROM atividades WHERE id_funcao = ".$_POST['id_empresa'];
          $res = executeQuery($sql);
            while($atividade = mysqli_fetch_object($res)){
              executeQuery("DELETE FROM subatividade WHERE id_atividade = ".$atividade->id_Atividades);
              executeQuery("DELETE FROM atividades WHERE id_Atividades = ".$atividade->id_Atividades);
            }
          executeQuery("DELETE FROM funcoes WHERE id_funcao = ".$_POST['id_empresa']);
          die(json_encode(true));
    }
