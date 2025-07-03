<?php
require_once('../config/database.php');
require_once('../helper/FileUpload.php');

session_start();

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'b_melhoria_roi'){
    $r = mysqli_fetch_object(executeQuery("SELECT custo, ROI FROM subatividade_melhoria WHERE id = ".$_POST['id']));
    die(json_encode(['custo' => $r->custo, 'roi' => json_decode($r->ROI)]));
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_melhoria_roi'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade_melhoria SET ROI = '".$data."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'excluir_analise_proj'){
   $qr = executeQuery("SELECT id, risco FROM subatividade_analise_proj WHERE subatividade_id = ".$_POST['sub_id']." ORDER BY id DESC");
   if(mysqli_num_rows($qr) > 2){
     $risco = array();
     while($row = mysqli_fetch_object($qr)) {
       array_push($risco, $row->risco);
     }
     executeQuery("UPDATE subatividade SET proj = ".$risco[1]." WHERE id_subatividade = ".$_POST['sub_id']);
   }else{
     executeQuery("UPDATE subatividade SET proj = 0, tem_analise_proj = 0 WHERE id_subatividade = ".$_POST['sub_id']);
   }
    executeQuery("DELETE FROM subatividade_analise_proj WHERE id = ".$_POST['id']);
    executeQuery("DELETE FROM subatividade_analise_proj_midia WHERE subatividade_analise_proj_id = ".$_POST['id']);
    die(true);
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'excluir_analise_acomp'){
   $qr = executeQuery("SELECT id, risco FROM subatividade_analise_acomp WHERE subatividade_id = ".$_POST['sub_id']." ORDER BY id DESC");
   if(mysqli_num_rows($qr) > 2){
     $risco = array();
     while($row = mysqli_fetch_object($qr)) {
       array_push($risco, $row->risco);
     }
     executeQuery("UPDATE subatividade SET acomp = ".$risco[1]." WHERE id_subatividade = ".$_POST['sub_id']);
   }else{
     executeQuery("UPDATE subatividade SET acomp = 0, tem_analise_acomp = 0 WHERE id_subatividade = ".$_POST['sub_id']);
   }
    executeQuery("DELETE FROM subatividade_analise_acomp WHERE id = ".$_POST['id']);
    executeQuery("DELETE FROM subatividade_analise_acomp_midia WHERE subatividade_analise_acomp_id = ".$_POST['id']);
    die(true);
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_acomp_transportar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade_analise_acomp SET transportar = '".$data."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_proj_transportar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade_analise_proj SET transportar = '".$data."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_proj_puxar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade_analise_proj SET puxar = '".$data."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_acomp_puxar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade_analise_acomp SET puxar = '".$data."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_acomp_empurrar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade_analise_acomp SET empurrar = '".$data."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_proj_empurrar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade_analise_proj SET empurrar = '".$data."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_proj_levantar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade_analise_proj SET levantar = '".$data."', levantar_avaliado = 1 WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_acomp_levantar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade_analise_acomp SET levantar = '".$data."', levantar_avaliado = 1 WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_a_acomp'){
    executeQuery("UPDATE subatividade_analise_acomp SET duracao = ".$_POST['duracao']." WHERE id = ".$_POST['id']);
    $val = executeQuery("SELECT duracao FROM subatividade_analise_acomp WHERE id = ".$_POST['id']);
    $duracao = intval(mysqli_fetch_object($val)->duracao);
    if($duracao==1){
        $duracao = 0.4;
    }
    if($duracao==2){
        $duracao = 0.8;
    }
    if($duracao==3){
        $duracao = 1;
    }
    if($duracao==4){
        $duracao = 1.25;
    }
    $points = $_POST['save']['pontuacao'];
    $total = 0;
    foreach ($points as $point) {
        if($point==1){
            $total+=1;
        }else if($point==2){
            $total+=3;
        }else if($point==3){
            $total+=5;
        }else if($point==4){
            $total+=10;
        }else{
            $total+=0;
        }
    }
    $ex = 0;
    if($_POST['save']['estressor_vibracao']){
        $ex+=2;
    }
    if($_POST['save']['estressor_baixas_temp']){
        $ex+=2;
    }
    if($_POST['save']['estressor_compressao']){
        $ex+=2;
    }
    if($_POST['save']['estressor_impacto']){
        $ex+=2;
    }
    if($_POST['save']['estressor_luva']){
        $ex+=2;
    }
    $risco = floatval(($total+$ex)*$duracao);
    $data = json_encode($_POST['save'], true);
    $id = mysqli_fetch_object(executeQuery("SELECT id FROM subatividade_analise_acomp WHERE subatividade_id = ".$_POST['sub_id']." ORDER BY id DESC LIMIT 1"))->id;
    if($id == $_POST['id']){
      executeQuery("UPDATE subatividade SET acomp = ".$risco." WHERE 	id_subatividade = ".$_POST['sub_id']);
    }
    $insert = "UPDATE subatividade_analise_acomp SET avaliacao = '".$data."', risco = ".$risco.", avaliado = 1 WHERE id = ".$_POST['id'];
    if(executeQuery($insert)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_a_proj'){
    executeQuery("UPDATE subatividade_analise_proj SET duracao = ".$_POST['duracao']." WHERE id = ".$_POST['id']);
    $val = executeQuery("SELECT duracao FROM subatividade_analise_proj WHERE id = ".$_POST['id']);
    $duracao = intval(mysqli_fetch_object($val)->duracao);
    if($duracao==1){
        $duracao = 0.4;
    }
    if($duracao==2){
        $duracao = 0.8;
    }
    if($duracao==3){
        $duracao = 1;
    }
    if($duracao==4){
        $duracao = 1.25;
    }
    $points = $_POST['save']['pontuacao'];
    $total = 0;
    foreach ($points as $point) {
        if($point==1){
            $total+=1;
        }else if($point==2){
            $total+=3;
        }else if($point==3){
            $total+=5;
        }else if($point==4){
            $total+=10;
        }else{
            $total+=0;
        }
    }
    $ex = 0;
    if($_POST['save']['estressor_vibracao']){
        $ex+=2;
    }
    if($_POST['save']['estressor_baixas_temp']){
        $ex+=2;
    }
    if($_POST['save']['estressor_compressao']){
        $ex+=2;
    }
    if($_POST['save']['estressor_impacto']){
        $ex+=2;
    }
    if($_POST['save']['estressor_luva']){
        $ex+=2;
    }
    $risco = floatval(($total+$ex)*$duracao);
    $data = json_encode($_POST['save'], true);
    $id = mysqli_fetch_object(executeQuery("SELECT id FROM subatividade_analise_proj WHERE subatividade_id = ".$_POST['sub_id']." ORDER BY id DESC LIMIT 1"))->id;
    if($id == $_POST['id']){
      executeQuery("UPDATE subatividade SET proj = ".$risco." WHERE id_subatividade = ".$_POST['sub_id']);
    }
    $insert = "UPDATE subatividade_analise_proj SET avaliacao = '".$data."', risco = ".$risco.", avaliado = 1 WHERE id = ".$_POST['id'];
    if(executeQuery($insert)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'n_analise_proj_subatividade_inicial'){
    if($_POST['x'] == '1'){
        $q = mysqli_fetch_object(executeQuery("SELECT nome, risco, avaliacao, levantar, empurrar, puxar, transportar, comentario, avaliado, duracao, levantar_avaliado FROM subatividade_analise_proj WHERE id = ".$_POST['id']));
        $nome = $q->nome;
    }else if($_POST['x'] == '2'){
        $q = mysqli_fetch_object(executeQuery("SELECT nome, risco, avaliacao, levantar, empurrar, puxar, transportar, comentario, avaliado, duracao, levantar_avaliado FROM subatividade_analise_acomp WHERE subatividade_id = ".$_POST['sub_id']." ORDER BY id DESC LIMIT 1"));
        $nome = $q->nome;
    }
    $insert = 'INSERT INTO `subatividade_analise_proj`
    (`subatividade_id`,
    `nome`,
    `risco`,
    `avaliacao`,
    `levantar`,
    `empurrar`,
    `puxar`,
    `transportar`,
    `comentario`,
    `avaliado`,
    `duracao`,
    `levantar_avaliado`)
    VALUES
    ('.$_POST['sub_id'].',
    "'.$nome.'",
    '.$q->risco.',
    \''.$q->avaliacao.'\', \''.$q->levantar.'\', \''.$q->empurrar.'\', \''.$q->puxar.'\', \''.$q->transportar.'\', \''.$q->comentario.'\', '.$q->avaliado.', '.$q->duracao.', '.$q->levantar_avaliado.'
    )';
    executeQuery("UPDATE subatividade SET proj = ".$q->risco." WHERE id_subatividade = ".$_POST['sub_id']);
    $id = executeQuery("SELECT id FROM subatividade_analise_proj WHERE subatividade_id = ".$_POST['sub_id']);
    if(mysqli_num_rows($id)==0){
      executeQuery("UPDATE subatividade SET tem_analise_proj = 1 WHERE id_subatividade = ".$_POST['sub_id']);
    }
    if(executeQuery($insert)){
        die(json_encode(['info' => true]));
    }else{
        die(json_encode(['info' => false]));
    }
}

if($_POST['operacao_sub'] == 'n_analise_proj'){
    $nome = mysqli_fetch_object(executeQuery("SELECT nome FROM subatividade WHERE id_subatividade = ".$_POST['sub_id']))->nome;
    $avaliar = json_encode($_POST['avaliar'], true);
    $levantar = json_encode($_POST['levantar'], true);
    $empurrar = json_encode($_POST['empurrar'], true);
    $puxar = json_encode($_POST['puxar'], true);
    $transportar = json_encode($_POST['transportar'], true);
    $insert = 'INSERT INTO `subatividade_analise_proj`
    (`subatividade_id`,
    `nome`,
    `risco`,
    `avaliacao`,
    `levantar`,
    `empurrar`,
    `puxar`,
    `transportar`,
    `comentario`,
    `avaliado`,
    `duracao`,
    `levantar_avaliado`)
    VALUES
    ('.$_POST['sub_id'].',
    "'.$nome.'",
    0,
    \''.$avaliar.'\', \''.$levantar.'\', \''.$empurrar.'\', \''.$puxar.'\', \''.$transportar.'\', "", 0, 0, 0
    )';
    executeQuery("UPDATE subatividade SET proj = 0 WHERE id_subatividade = ".$_POST['sub_id']);
    $id = executeQuery("SELECT id FROM subatividade_analise_proj WHERE subatividade_id = ".$_POST['sub_id']);
    if(mysqli_num_rows($id)==0){
      executeQuery("UPDATE subatividade SET	tem_analise_proj = 1 WHERE id_subatividade = ".$_POST['sub_id']);
    }
    if(executeQuery($insert)){
        die(json_encode(['info' => true]));
    }else{
        die(json_encode(['info' => false]));
    }
}

if($_POST['operacao_sub'] == 'n_analise_acomp_subatividade_inicial'){
    if($_POST['x'] == '1'){
        $q = mysqli_fetch_object(executeQuery("SELECT nome, risco, avaliacao, levantar, empurrar, puxar, transportar, comentario, avaliado, duracao, levantar_avaliado FROM subatividade_analise_acomp WHERE id = ".$_POST['id']));
        $nome = $q->nome;
    }else{
        $q = mysqli_fetch_object(executeQuery("SELECT nome, risco, avaliacao, levantar, empurrar, puxar, transportar, comentario, avaliado, duracao, levantar_avaliado FROM subatividade WHERE id_subatividade = ".$_POST['sub_id']));
        $nome = $q->nome;
    }
    $insert = 'INSERT INTO `subatividade_analise_acomp`
    (`subatividade_id`,
    `nome`,
    `risco`,
    `avaliacao`,
    `levantar`,
    `empurrar`,
    `puxar`,
    `transportar`,
    `comentario`,
    `avaliado`,
    `duracao`,
    `levantar_avaliado`)
    VALUES
    ('.$_POST['sub_id'].',
    "'.$nome.'",
    '.$q->risco.',
    \''.$q->avaliacao.'\', \''.$q->levantar.'\', \''.$q->empurrar.'\', \''.$q->puxar.'\', \''.$q->transportar.'\', \''.$q->comentario.'\', '.$q->avaliado.', '.$q->duracao.', '.$q->levantar_avaliado.'
    )';
    executeQuery("UPDATE subatividade SET acomp = ".$q->risco." WHERE id_subatividade = ".$_POST['sub_id']);
    $id = executeQuery("SELECT id FROM subatividade_analise_acomp WHERE subatividade_id = ".$_POST['sub_id']);
    if(mysqli_num_rows($id)==0){
      executeQuery("UPDATE subatividade SET 	tem_analise_acomp = 1 WHERE id_subatividade = ".$_POST['sub_id']);
    }
    if(executeQuery($insert)){
        die(json_encode(['info' => true]));
    }else{
        die(json_encode(['info' => false]));
    }
}

if($_POST['operacao_sub'] == 'n_analise_acomp'){
    $nome = mysqli_fetch_object(executeQuery("SELECT nome FROM subatividade WHERE id_subatividade = ".$_POST['sub_id']))->nome;
    $avaliar = json_encode($_POST['avaliar'], true);
    $levantar = json_encode($_POST['levantar'], true);
    $empurrar = json_encode($_POST['empurrar'], true);
    $puxar = json_encode($_POST['puxar'], true);
    $transportar = json_encode($_POST['transportar'], true);
    $insert = 'INSERT INTO `subatividade_analise_acomp`
    (`subatividade_id`,
    `nome`,
    `risco`,
    `avaliacao`,
    `levantar`,
    `empurrar`,
    `puxar`,
    `transportar`,
    `comentario`,
    `avaliado`,
    `duracao`,
    `levantar_avaliado`)
    VALUES
    ('.$_POST['sub_id'].',
    "'.$nome.'",
    0,
    \''.$avaliar.'\', \''.$levantar.'\', \''.$empurrar.'\', \''.$puxar.'\', \''.$transportar.'\', "", 0, 0, 0
    )';
    executeQuery("UPDATE subatividade SET acomp = 0 WHERE id_subatividade = ".$_POST['sub_id']);
    $id = executeQuery("SELECT id FROM subatividade_analise_acomp WHERE subatividade_id = ".$_POST['sub_id']);
    if(mysqli_num_rows($id)==0){
      executeQuery("UPDATE subatividade SET 	tem_analise_acomp = 1 WHERE id_subatividade = ".$_POST['sub_id']);
    }
    if(executeQuery($insert)){
        die(json_encode(['info' => true]));
    }else{
        die(json_encode(['info' => false]));
    }
}

if($_POST['operacao_sub'] == 'limpar_transportar'){
    $transportar = json_encode($_POST['transportar'], true);
    $q = "UPDATE subatividade SET transportar = '".$transportar."'";
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'limpar_puxar'){
    $puxar = json_encode($_POST['puxar'], true);
    $q = "UPDATE subatividade SET puxar = '".$puxar."'";
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'limpar_levantar'){
    $save = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade SET levantar_avaliado = 0, levantar = '".$save."'";
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'limpar_empurrar'){
    $empurrar = json_encode($_POST['empurrar'], true);
    $q = "UPDATE subatividade SET empurrar = '".$empurrar."'";
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'limpar_acomp_levantar'){
    $save = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade_analise_acomp SET levantar_avaliado = 0, levantar = '".$save."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'limpar_acomp_empurrar'){
    $empurrar = json_encode($_POST['empurrar'], true);
    $q = "UPDATE subatividade_analise_acomp SET empurrar = '".$empurrar."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'limpar_proj_empurrar'){
    $empurrar = json_encode($_POST['empurrar'], true);
    $q = "UPDATE subatividade_analise_proj SET empurrar = '".$empurrar."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'limpar_proj_levantar'){
    $save = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade_analise_proj SET levantar_avaliado = 0, levantar = '".$save."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'limpar_proj_puxar'){
    $puxar = json_encode($_POST['puxar'], true);
    $q = "UPDATE subatividade_analise_proj SET puxar = '".$puxar."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'limpar_acomp_puxar'){
    $puxar = json_encode($_POST['puxar'], true);
    $q = "UPDATE subatividade_analise_acomp SET puxar = '".$puxar."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'limpar_proj_transportar'){
    $transportar = json_encode($_POST['transportar'], true);
    $q = "UPDATE subatividade_analise_proj SET transportar = '".$transportar."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if($_POST['operacao_sub'] == 'limpar_acomp_transportar'){
    $transportar = json_encode($_POST['transportar'], true);
    $q = "UPDATE subatividade_analise_acomp SET transportar = '".$transportar."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'e-melhoria'){
    $data = json_encode($_POST['causas'], true);
    $insert = "UPDATE subatividade_melhoria SET subatividade_id = ".$_POST['sub_id'].", controle = ".$_POST['controle'].", status = ".$_POST['status'].", titulo = '".$_POST['titulo']."', descricao = '".$_POST['descricao']."', causas = '".$data."', data_objetivo = '".$_POST['data_objetivo']."', data_conclusao = '".$_POST['data_conclusao']."', responsavel = '".$_POST['responsavel']."', email = '".$_POST['email']."', fornecedor = '".$_POST['fornecedor']."', custo = '".$_POST['custo']."' WHERE id = ".$_POST['id'];
    $roi = json_decode(mysqli_fetch_object(executeQuery("SELECT ROI from subatividade_melhoria WHERE id = ".$_POST['id']))->ROI, true);
    $pop = floatval(str_replace(',', '.', $roi['fer'])) + floatval(str_replace(',', '.', $roi['fun'])) + floatval(str_replace(',', '.', $roi['prod'])) + floatval(str_replace(',', '.', $roi['qual']));
    $custo = number_format((float)str_replace(",", ".", str_replace(".", "", $_POST['custo'])), 2, '.', '');
    $proj = (($pop - $custo)/$custo) * 100;
    $conserv = (($pop - $custo)/$custo) * 65;
    $save = ['con' => (int)$conserv.' %', 'fer' => $roi['fer'], 'fun' => $roi['fun'], 'poup' => "$ ".number_format($pop, 2, ',', ''), 'prod' => $roi['prod'], 'proj' => (int)$proj." %", 'qual' => $roi['qual'], 'text' => $roi['text']];
    executeQuery("UPDATE subatividade_melhoria SET ROI = '".json_encode($save)."' WHERE id = ".$_POST['id']);
    $causas = preg_split("/, /", $_POST['causas'][0], -1, PREG_SPLIT_NO_EMPTY);
    foreach ($causas as $causa) {
        executeQuery("UPDATE subatividade_causas_diretas SET status = ".$_POST['status']." WHERE id = ".$causa);
    }
    if(executeQuery($insert)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'b-melhoria'){
    $q = "SELECT * FROM subatividade_melhoria WHERE id = ".$_POST['id'];
    if($data = mysqli_fetch_object(executeQuery($q))){
        $c = [];
        $causas = preg_split("/, /", json_decode($data->causas)[0], -1, PREG_SPLIT_NO_EMPTY);
        $all_causas = executeQuery("SELECT * FROM subatividade_causas_diretas");
        while($causa = mysqli_fetch_object($all_causas)){
            if(causa_find($causas, $causa)){
                $causa->check = "checked";
                array_push($c, $causa);
            }else{
                array_push($c, $causa);
            }
        }
        die(json_encode(['melhoria' => $data, 'causas' => $c]));
    }else{
        die(false);
    }
}

function causa_find($causas, $causa){
    foreach ($causas as $c) {
        if($c == $causa->id){
            return true;
        }
    }
    return false;
}

if ($_POST['operacao_sub'] == 'excluir-melhoria') {
    if(executeQuery("DELETE FROM subatividade_melhoria WHERE id = ".$_POST['id'])){
        die(true);
    }else{
        die(false);
    }

}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n-melhoria'){
    $data = json_encode($_POST['causas'], true);
    $roi = json_encode($_POST['save'], true);
    if($_POST['data_conclusao'] != ''){
      $insert = "INSERT INTO subatividade_melhoria(subatividade_id, controle, status, titulo, descricao, causas, data_objetivo, data_conclusao, responsavel, email, fornecedor, custo, ROI) VALUES (".$_POST['sub_id'].", ".$_POST['controle'].", ".$_POST['status'].", '".$_POST['titulo']."', '".$_POST['descricao']."', '".$data."', '".$_POST['data_objetivo']."', '".$_POST['data_conclusao']."', '".$_POST['responsavel']."', '".$_POST['email']."', '".$_POST['fornecedor']."', '".$_POST['custo']."', '".$roi."')";
    }else{
      $insert = "INSERT INTO subatividade_melhoria(subatividade_id, controle, status, titulo, descricao, causas, data_objetivo, responsavel, email, fornecedor, custo, ROI) VALUES (".$_POST['sub_id'].", ".$_POST['controle'].", ".$_POST['status'].", '".$_POST['titulo']."', '".$_POST['descricao']."', '".$data."', '".$_POST['data_objetivo']."', '".$_POST['responsavel']."', '".$_POST['email']."', '".$_POST['fornecedor']."', '".$_POST['custo']."', '".$roi."')";
    }
    $causas = preg_split("/, /", $_POST['causas'][0], -1, PREG_SPLIT_NO_EMPTY);
    foreach ($causas as $causa) {
        executeQuery("UPDATE subatividade_causas_diretas SET status = ".$_POST['status']." WHERE id = ".$causa);
    }
    if(executeQuery($insert)){
        $r = executeQuery("SELECT id FROM subatividade_melhoria WHERE subatividade_id = ".$_POST['sub_id']." ORDER BY id DESC LIMIT 1");
        $id = mysqli_fetch_object($r)->id;
        die(json_encode(['info' => true, 'id' => $id, 'titulo' => $_POST['titulo'], 'responsavel' => $_POST['responsavel'], 'custo' => $_POST['custo'], 'data_objetivo' => $_POST['data_objetivo'], 'status' => $_POST['status']]));
    }else{
        die(json_encode(['info' => false]));
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'e-causas-diretas'){
    $q = "UPDATE subatividade_causas_diretas SET descricao = '".$_POST['desc']."', categoria = ".$_POST['cat']." WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'b-causas-diretas'){
    $s = "SELECT * FROM subatividade_causas_diretas WHERE id = ".$_POST['id'];
    if($r = mysqli_fetch_object(executeQuery($s))){
        die(json_encode(['info' => true, 'desc' => $r->descricao, 'cat' => $r->categoria, 'status' => $r->status]));
    }else{
        die(json_encode(['info' => flase]));
    }
}

if ($_POST['operacao_sub'] == 'excluir-causas-diretas') {
    if(executeQuery("DELETE FROM subatividade_causas_diretas WHERE id = ".$_POST['id'])){
        die(true);
    }else{
        die(false);
    }

}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n-causas-diretas'){
    $insert = "INSERT INTO subatividade_causas_diretas(subatividade_id, descricao, categoria, status) VALUES (".$_POST['sub_id'].", '".$_POST['desc']."', ".$_POST['cat'].", ".$_POST['status'].")";
    if(executeQuery($insert)){
        $r = executeQuery("SELECT id FROM subatividade_causas_diretas WHERE subatividade_id = ".$_POST['sub_id']." ORDER BY id DESC LIMIT 1");
        $id = mysqli_fetch_object($r)->id;
        die(json_encode(['info' => true, 'id' => $id]));
    }else{
        die(json_encode(['info' => false]));
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'arquivo'){
    if($_POST['operacao_sub_acomp'] == 1){
        if(move_uploaded_file($_FILES['sub_arquivo']['tmp_name'], '../uploads/'.$_FILES['sub_arquivo']['name'])){
            $sql_midia2 = "SELECT type FROM subatividade_analise_acomp_midia WHERE subatividade_analise_acomp_id = ".$_POST['sub_id']." AND type = 'arquivo'";
            $consulta_midia2 = mysqli_num_rows(executeQuery($sql_midia2));
            $insert = "INSERT INTO subatividade_analise_acomp_midia(subatividade_analise_acomp_id, type, midia) VALUES (".$_POST['sub_id'].", 'arquivo', '../uploads/".$_FILES['sub_arquivo']['name']."')";
            if(executeQuery($insert)){
                $r = executeQuery("SELECT id FROM subatividade_analise_acomp_midia WHERE subatividade_analise_acomp_id = ".$_POST['sub_id']." ORDER BY id DESC LIMIT 1");
                $id = mysqli_fetch_object($r)->id;
                die(json_encode(['info' => true, 'nome' => $_FILES['sub_arquivo']['name'], 'id' => $id, 'db_clear' => $consulta_midia2]));
            }else{
                die(json_encode(['info' => false]));
            }
        }else{
            die(json_encode(['info' => false]));
        }
    }else if($_POST['operacao_sub_proj'] == 1){
        if(move_uploaded_file($_FILES['sub_arquivo']['tmp_name'], '../uploads/'.$_FILES['sub_arquivo']['name'])){
            $sql_midia2 = "SELECT type FROM subatividade_analise_proj_midia WHERE subatividade_analise_proj_id = ".$_POST['sub_id']." AND type = 'arquivo'";
            $consulta_midia2 = mysqli_num_rows(executeQuery($sql_midia2));
            $insert = "INSERT INTO subatividade_analise_proj_midia(subatividade_analise_proj_id, type, midia) VALUES (".$_POST['sub_id'].", 'arquivo', '../uploads/".$_FILES['sub_arquivo']['name']."')";
            if(executeQuery($insert)){
                $r = executeQuery("SELECT id FROM subatividade_analise_proj_midia WHERE subatividade_analise_proj_id = ".$_POST['sub_id']." ORDER BY id DESC LIMIT 1");
                $id = mysqli_fetch_object($r)->id;
                die(json_encode(['info' => true, 'nome' => $_FILES['sub_arquivo']['name'], 'id' => $id, 'db_clear' => $consulta_midia2]));
            }else{
                die(json_encode(['info' => false]));
            }
        }else{
            die(json_encode(['info' => false]));
        }
    }else{
        if(move_uploaded_file($_FILES['sub_arquivo']['tmp_name'], '../uploads/'.$_FILES['sub_arquivo']['name'])){
            $sql_midia2 = "SELECT type FROM subatividade_midia WHERE subatividade_id = ".$_POST['sub_id']." AND type = 'arquivo'";
            $consulta_midia2 = mysqli_num_rows(executeQuery($sql_midia2));
            $insert = "INSERT INTO subatividade_midia(subatividade_id, type, midia) VALUES (".$_POST['sub_id'].", 'arquivo', '../uploads/".$_FILES['sub_arquivo']['name']."')";
            if(executeQuery($insert)){
                $r = executeQuery("SELECT id FROM subatividade_midia WHERE subatividade_id = ".$_POST['sub_id']." ORDER BY id DESC LIMIT 1");
                $id = mysqli_fetch_object($r)->id;
                die(json_encode(['info' => true, 'nome' => $_FILES['sub_arquivo']['name'], 'id' => $id, 'db_clear' => $consulta_midia2]));
            }else{
                die(json_encode(['info' => false]));
            }
        }else{
            die(json_encode(['info' => false]));
        }
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n-comentario'){
    $q = "UPDATE subatividade SET comentario = '".$_POST['data']."' WHERE id_subatividade = ".$_POST['sub_id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_acomp_comentario'){
    $q = "UPDATE subatividade_analise_acomp SET comentario = '".$_POST['data']."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n_proj_comentario'){
    $q = "UPDATE subatividade_analise_proj SET comentario = '".$_POST['data']."' WHERE id = ".$_POST['id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n-transportar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade SET transportar = '".$data."' WHERE id_subatividade = ".$_POST['sub_id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n-puxar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade SET puxar = '".$data."' WHERE id_subatividade = ".$_POST['sub_id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n-empurrar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade SET empurrar = '".$data."' WHERE id_subatividade = ".$_POST['sub_id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n-levantar'){
    $data = json_encode($_POST['save'], true);
    $q = "UPDATE subatividade SET levantar = '".$data."', levantar_avaliado = 1 WHERE id_subatividade = ".$_POST['sub_id'];
    if(executeQuery($q)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'n-a'){
    executeQuery("UPDATE subatividade SET duracao = ".$_POST['duracao']." WHERE id_subatividade = ".$_POST['sub_id']);
    $val = executeQuery("SELECT duracao FROM subatividade WHERE id_subatividade = ".$_POST['sub_id']);
    $duracao = intval(mysqli_fetch_object($val)->duracao);
    if($duracao==1){
        $duracao = 0.4;
    }
    if($duracao==2){
        $duracao = 0.8;
    }
    if($duracao==3){
        $duracao = 1;
    }
    if($duracao==4){
        $duracao = 1.25;
    }
    $points = $_POST['save']['pontuacao'];
    $total = 0;
    foreach ($points as $point) {
        if($point==1){
            $total+=1;
        }else if($point==2){
            $total+=3;
        }else if($point==3){
            $total+=5;
        }else if($point==4){
            $total+=10;
        }else{
            $total+=0;
        }
    }
    $ex = 0;
    if($_POST['save']['estressor_vibracao']){
        $ex+=2;
    }
    if($_POST['save']['estressor_baixas_temp']){
        $ex+=2;
    }
    if($_POST['save']['estressor_compressao']){
        $ex+=2;
    }
    if($_POST['save']['estressor_impacto']){
        $ex+=2;
    }
    if($_POST['save']['estressor_luva']){
        $ex+=2;
    }
    $risco = floatval(($total+$ex)*$duracao);
    $data = json_encode($_POST['save'], true);
    $insert = "UPDATE subatividade SET avaliacao = '".$data."', risco = ".$risco.", avaliado = 1 WHERE id_subatividade = ".$_POST['sub_id'];
    if(executeQuery($insert)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'img'){
    if($_POST['operacao_sub_acomp'] == 1){
        $foto = upload($_FILES['sub_img'], '../uploads/')['arquivo'];
        $insert = "INSERT INTO subatividade_analise_acomp_midia(subatividade_analise_acomp_id, type, midia) VALUES (".$_POST['sub_id'].", 'foto', '".$foto."')";
        if(executeQuery($insert)){
            die(true);
        }else{
            die(false);
        }
    }else if($_POST['operacao_sub_proj'] == 1){
        $foto = upload($_FILES['sub_img'], '../uploads/')['arquivo'];
        $insert = "INSERT INTO subatividade_analise_proj_midia(subatividade_analise_proj_id, type, midia) VALUES (".$_POST['sub_id'].", 'foto', '".$foto."')";
        if(executeQuery($insert)){
            die(true);
        }else{
            die(false);
        }
    }else{
        $foto = upload($_FILES['sub_img'], '../uploads/')['arquivo'];
        $insert = "INSERT INTO subatividade_midia(subatividade_id, type, midia) VALUES (".$_POST['sub_id'].", 'foto', '".$foto."')";
        if(executeQuery($insert)){
            die(true);
        }else{
            die(false);
        }
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'img'){
    $foto = upload($_FILES['sub_img'], '../uploads/')['arquivo'];
    $insert = "INSERT INTO subatividade_midia(subatividade_id, type, midia) VALUES (".$_POST['sub_id'].", 'foto', '".$foto."')";
    if(executeQuery($insert)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'vd_proj'){
    $insert = "INSERT INTO subatividade_analise_proj_midia(subatividade_analise_proj_id, type, midia) VALUES (".$_POST['id'].", 'video', '".$_POST['url']."')";
    if(executeQuery($insert)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'vd_acomp'){
    $insert = "INSERT INTO subatividade_analise_acomp_midia(subatividade_analise_acomp_id, type, midia) VALUES (".$_POST['id'].", 'video', '".$_POST['url']."')";
    if(executeQuery($insert)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'vd'){
    $insert = "INSERT INTO subatividade_midia(subatividade_id, type, midia) VALUES (".$_POST['sub_id'].", 'video', '".$_POST['url']."')";
    if(executeQuery($insert)){
        die(true);
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'midia-excluir'){
    $sql_midia = "SELECT type, midia FROM subatividade_midia WHERE id = ".$_POST['id'];
    $consulta_midia = executeQuery($sql_midia);
    $midia = mysqli_fetch_object($consulta_midia);
    if($midia != ""){
        if($midia->type == "foto"){
            if(unlink($midia->midia)){
                executeQuery("DELETE FROM subatividade_midia WHERE id = ".$_POST['id']);
                die(true);
            }else{
                die(false);
            }
        }else if($midia->type == "video"){
            if(executeQuery("DELETE FROM subatividade_midia WHERE id = ".$_POST['id'])){
                die(true);
            }else{
                die(false);
            }
        }else if($midia->type == "arquivo"){
            if(unlink($midia->midia)){
                executeQuery("DELETE FROM subatividade_midia WHERE id = ".$_POST['id']);
                $sql_midia2 = "SELECT type FROM subatividade_midia WHERE subatividade_id = ".$_POST['sub_id']." AND type = 'arquivo'";
                $consulta_midia2 = mysqli_num_rows(executeQuery($sql_midia2));
                die(json_encode(['info' => true, 'db_clear' => $consulta_midia2]));
            }else{
                die(json_encode(['info' => false]));
            }
        }else{
            die(false);
        }
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'midia_acomp_excluir'){
    $sql_midia = "SELECT type, midia FROM subatividade_analise_acomp_midia WHERE id = ".$_POST['id'];
    $consulta_midia = executeQuery($sql_midia);
    $midia = mysqli_fetch_object($consulta_midia);
    if($midia != ""){
        if($midia->type == "foto"){
            if(unlink($midia->midia)){
                executeQuery("DELETE FROM subatividade_analise_acomp_midia WHERE id = ".$_POST['id']);
                die(true);
            }else{
                die(false);
            }
        }else if($midia->type == "video"){
            if(executeQuery("DELETE FROM subatividade_analise_acomp_midia WHERE id = ".$_POST['id'])){
                die(true);
            }else{
                die(false);
            }
        }else if($midia->type == "arquivo"){
            if(unlink($midia->midia)){
                executeQuery("DELETE FROM subatividade_analise_acomp_midia WHERE id = ".$_POST['id']);
                $sql_midia2 = "SELECT type FROM subatividade_analise_acomp_midia WHERE subatividade_analise_acomp_id = ".$_POST['sub_id']." AND type = 'arquivo'";
                $consulta_midia2 = mysqli_num_rows(executeQuery($sql_midia2));
                die(json_encode(['info' => true, 'db_clear' => $consulta_midia2]));
            }else{
                die(json_encode(['info' => false]));
            }
        }else{
            die(false);
        }
    }else{
        die(false);
    }
}

if(isset($_POST['operacao_sub']) && $_POST['operacao_sub'] == 'midia_proj_excluir'){
    $sql_midia = "SELECT type, midia FROM subatividade_analise_proj_midia WHERE id = ".$_POST['id'];
    $consulta_midia = executeQuery($sql_midia);
    $midia = mysqli_fetch_object($consulta_midia);
    if($midia != ""){
        if($midia->type == "foto"){
            if(unlink($midia->midia)){
                executeQuery("DELETE FROM subatividade_analise_proj_midia WHERE id = ".$_POST['id']);
                die(true);
            }else{
                die(false);
            }
        }else if($midia->type == "video"){
            if(executeQuery("DELETE FROM subatividade_analise_proj_midia WHERE id = ".$_POST['id'])){
                die(true);
            }else{
                die(false);
            }
        }else if($midia->type == "arquivo"){
            if(unlink($midia->midia)){
                executeQuery("DELETE FROM subatividade_analise_proj_midia WHERE id = ".$_POST['id']);
                $sql_midia2 = "SELECT type FROM subatividade_analise_proj_midia WHERE subatividade_analise_proj_id = ".$_POST['sub_id']." AND type = 'arquivo'";
                $consulta_midia2 = mysqli_num_rows(executeQuery($sql_midia2));
                die(json_encode(['info' => true, 'db_clear' => $consulta_midia2]));
            }else{
                die(json_encode(['info' => false]));
            }
        }else{
            die(false);
        }
    }else{
        die(false);
    }
}

if ($_POST['operacao_sub'] == 'n') {
    $data = json_encode($_POST['save'], true);
    $levantar = json_encode($_POST['levantar'], true);
    $empurrar = json_encode($_POST['empurrar'], true);
    $puxar = json_encode($_POST['puxar'], true);
    $transportar = json_encode($_POST['transportar'], true);
    $username = 'SELECT email FROM usuarios WHERE id = '.$_SESSION['id'];
    $result = executeQuery($username);
    $user = mysqli_fetch_object($result);
    $insert = 'INSERT INTO `subatividade`
    (`nome`,
    `descricao`,
    `risco`,
    `proj`,
    `acomp`,
    `duracao`,
    `n_operadores`,
    `q_turnos`,
    `avaliacao`,
    `avaliado`,
    `levantar`,
    `levantar_avaliado`,
    `empurrar`,
    `puxar`,
    `transportar`,
    `comentario`,
    `id_atividade`,
    `data_criar`,
    `usuario_criar`,
    `tem_analise_acomp`,
    `tem_analise_proj`)
    VALUES
    ("'.$_POST['nome'].'",
    "'.$_POST['descricao'].'",
    0, 0, 0,
    '.$_POST['duracao'].',
    '.$_POST['n_operadores'].',
    '.$_POST['q_turnos'].',
    \''.$data.'\',
    0, \''.$levantar.'\', 0, \''.$empurrar.'\', \''.$puxar.'\', \''.$transportar.'\', "",
    '.$_POST['id_atividade'].',
    CURRENT_TIMESTAMP(6), "'.$user->email.'", 0, 0
)';

if (executeQuery($insert)) {
    die("Nova Sub-Atividade cadastrada com sucesso");
} else {
    die("Error: " . $insert . "<br>" . mysqli_error());
}
}
if ($_POST['operacao_sub'] == 'b') {
    $select = 'SELECT * FROM subatividade WHERE id_subatividade = '.$_POST['id_subatividade'];

    $result = executeQuery($select);

    if ($result) {
        $return['sucesso'] = true;
        $return['info'] = $result->fetch_assoc();
        die(json_encode($return));
    } else {
        die($result['sucesso'] = false);
    }
}
if ($_POST['operacao_sub'] == 'e') {
    $update = 'UPDATE `subatividade`
    SET
    `nome` = "'.$_POST['nome'].'",
    `descricao` = "'.$_POST['descricao'].'",
    `n_operadores` = '.$_POST['n_operadores'].',
    `q_turnos` = '.$_POST['q_turnos'].'
    WHERE `id_subatividade` = '.$_POST['id_subatividade'];

    if (executeQuery($update)) {
        die(json_encode("Sucesso ao editar a subatividade"));
    } else {
        die(json_encode("Erro ao editar a subatividade"));
    }
}
if ($_POST['operacao'] == 'd') {
    executeQuery("DELETE FROM subatividade WHERE id_subatividade = ".$_POST['id_empresa']);
    executeQuery("DELETE FROM subatividade_midia WHERE subatividade_id = ".$_POST['id_empresa']);
    executeQuery("DELETE FROM subatividade_causas_diretas WHERE subatividade_id = ".$_POST['id_empresa']);
    die(true);
}
