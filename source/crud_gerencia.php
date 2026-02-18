<?php
require_once('../config/database.php');

if ($_POST['operacao'] == 'b_visao_geral_sub') {
    $q = executeQuery("SELECT s.risco, s.acomp, s.tem_analise_acomp FROM funcoes as f JOIN atividades as a ON f.id_funcao = a.id_funcao JOIN subatividade as s ON a.id_Atividades = s.id_atividade");
    $full = [];
    while($val = mysqli_fetch_assoc($q)){
        array_push($full, $val);
    }

    $risco_atual = [];
	for($i=0; $i<sizeof($full);$i++){
		if($full[$i]['tem_analise_acomp'] == '0'){
			array_push($risco_atual, $full[$i]['risco']);
		}else{
			array_push($risco_atual, $full[$i]['acomp']);
		}
	}

    die(json_encode($risco_atual));
}

if ($_POST['operacao'] == 'b_plano_melhoria') {
    $q = executeQuery("SELECT status FROM subatividade_melhoria");
    $full = [];
    while($val = mysqli_fetch_assoc($q)){
        array_push($full, $val);
    }

    die(json_encode($full));
}

if ($_POST['operacao'] == 'b_levantar_baixar') {
    $q = executeQuery("SELECT levantar FROM subatividade WHERE tem_analise_acomp = 0 AND levantar_avaliado = 1");
    $arr = [];
    while($val = mysqli_fetch_object($q)){
        $obj = json_decode($val->levantar);
        array_push($arr, $obj->indice_l);
    }

    $q_acomp = executeQuery("SELECT s.subatividade_id, s.levantar, r.MaxId FROM (SELECT subatividade_id, max(id) as MaxId FROM subatividade_analise_acomp GROUP BY subatividade_id) as r INNER JOIN subatividade_analise_acomp as s ON s.subatividade_id = r.subatividade_id AND s.id = r.MaxId WHERE levantar_avaliado = 1");
    while($val_acomp = mysqli_fetch_object($q_acomp)){
        $obj_acomp = json_decode($val_acomp->levantar);
        array_push($arr, $obj_acomp->indice_l);
    }

    die(json_encode($arr));
}

if ($_POST['operacao'] == 'b_emp') {
    $q = executeQuery("SELECT empurrar FROM subatividade WHERE tem_analise_acomp = 0");
    $arr = [];
    while($val = mysqli_fetch_object($q)){
        $obj = json_decode($val->empurrar);
        if($obj->forca_i_e_e != ""){
            array_push($arr, ['emp_val' => $obj->forca_i_e_e, 'emp_f' => $obj->forca_i_m]);
        }
    }

    $q_acomp = executeQuery("SELECT s.subatividade_id, s.empurrar, r.MaxId FROM (SELECT subatividade_id, max(id) as MaxId FROM subatividade_analise_acomp GROUP BY subatividade_id) as r INNER JOIN subatividade_analise_acomp as s ON s.subatividade_id = r.subatividade_id AND s.id = r.MaxId");
    while($val_acomp = mysqli_fetch_object($q_acomp)){
        $obj_acomp = json_decode($val_acomp->empurrar);
        if($obj_acomp->forca_i_e_e != ""){
            array_push($arr, ['emp_val' => $obj_acomp->forca_i_e_e, 'emp_f' => $obj_acomp->forca_i_m]);
        }
    }

    die(json_encode($arr));
}

if($_POST['operacao'] == 'b_all_subs') {
    $q = "SELECT e.razao as empresa, f.`Nome da Fabrica` as fabrica, s.descricao as descricao, c.nome as celula, carg.nome as cargo, func.nome as funcao, a.Nome as atividade, sub.nome as subatividade, sub.duracao as sub_duracao, sub.n_operadores as sub_operadores, sub.risco as sub_inicial, sub.proj as sub_proj, sub.acomp as sub_acomp, sub.avaliado as sub_avaliado, sub.tem_analise_acomp as sub_tem_acomp, sub.tem_analise_proj as sub_tem_proj FROM empresas as e JOIN fabricas as f ON e.id = f.id_empresa JOIN setor as s ON f.id_fabrica = s.id_fabrica JOIN celulas as c ON s.id_setor = c.id_setor JOIN cargo as carg ON c.id_celulas = carg.id_celula JOIN funcoes as func ON carg.id_cargo = func.id_cargo JOIN atividades as a ON func.id_funcao = a.id_funcao JOIN subatividade as sub ON a.id_Atividades = sub.id_atividade";
    $val = executeQuery($q);
    $all = [];
    while($dado = mysqli_fetch_object($val)){
        array_push($all, $dado);
    }
    $q = "SELECT id_subatividade FROM subatividade";
    $val = executeQuery($q);
    $sub_id = [];
    while($id = mysqli_fetch_object($val)){
        array_push($sub_id, $id->id_subatividade);
    }
    $tem_acomp;
    $all_levantar = [];
    $all_empurrar = [];
    $all_puxar = [];
    $all_transportar = [];
    $all_avaliacao = [];
    $all_causas_diretas = [];
    $all_melhorias = [];
    $all_melhorias_roi = [];

    foreach ($sub_id as $id) {
        $causa = mysqli_fetch_object(executeQuery("SELECT count(subatividade_id) as sub FROM subatividade_causas_diretas WHERE subatividade_id = ".$id))->sub;
        $causa_and = mysqli_fetch_object(executeQuery("SELECT count(subatividade_id) as sub_and FROM subatividade_causas_diretas WHERE subatividade_id = ".$id. " AND status = 2"))->sub_and;
        $melhoria = mysqli_fetch_object(executeQuery("SELECT count(subatividade_id) as m FROM subatividade_melhoria WHERE subatividade_id = ".$id))->m;
        $melhoria_con = mysqli_fetch_object(executeQuery("SELECT count(subatividade_id) as m_con FROM subatividade_melhoria WHERE subatividade_id = ".$id. " AND status = 3"))->m_con;
        array_push($all_causas_diretas, [$causa, $causa_and]);
        array_push($all_melhorias, [$melhoria, $melhoria_con]);
        $tem_acomp = mysqli_fetch_object(executeQuery("SELECT tem_analise_acomp FROM subatividade WHERE id_subatividade = ".$id))->tem_analise_acomp;
        $q8 =  mysqli_fetch_object(executeQuery("SELECT ROI, custo FROM subatividade_melhoria WHERE subatividade_id = ".$id." ORDER BY id DESC LIMIT 1"));
        if(sizeof($q8)  > 0){
            $melhoria_roi = json_decode($q8->ROI);
            array_push($all_melhorias_roi, ['melhoria' => $melhoria_roi, 'custo' => $q8->custo]);
        }
        if($tem_acomp == '0'){
            $q = mysqli_fetch_object(executeQuery("SELECT levantar, empurrar, puxar, transportar, avaliacao FROM subatividade WHERE id_subatividade = ".$id));
            $levantar = json_decode($q->levantar)->indice_l;
            $empurrar = json_decode($q->empurrar)->forca_i_m;
            $empurrar_m = json_decode($q->empurrar)->forca_i_e_e;
            $puxar = json_decode($q->puxar)->f_a_o_m;
            $puxar_m = json_decode($q->puxar)->forca_i_e_p;
            $transportar = json_decode($q->transportar)->p_m_a_c;
            $transportar_m = json_decode($q->transportar)->peso_i_e;
            $avaliacao['pontuacao_mao_esq'] = json_decode($q->avaliacao)->pontuacao->pontuacao_mao_esq;
            $avaliacao['pontuacao_mao_dir'] = json_decode($q->avaliacao)->pontuacao->pontuacao_mao_dir;
            $avaliacao['pontuacao_cotovelo_esq'] = json_decode($q->avaliacao)->pontuacao->pontuacao_cotovelo_esq;
            $avaliacao['pontuacao_cotovelo_dir'] = json_decode($q->avaliacao)->pontuacao->pontuacao_cotovelo_dir;
            $avaliacao['pontuacao_ombro_esq'] = json_decode($q->avaliacao)->pontuacao->pontuacao_ombro_esq;
            $avaliacao['pontuacao_ombro_dir'] = json_decode($q->avaliacao)->pontuacao->pontuacao_ombro_dir;
            $avaliacao['pontuacao_ombro_dir'] = json_decode($q->avaliacao)->pontuacao->pontuacao_ombro_dir;
            $avaliacao['pontuacao_pescoco'] = json_decode($q->avaliacao)->pontuacao->pontuacao_pescoco;
            $avaliacao['pontuacao_costa'] = json_decode($q->avaliacao)->pontuacao->pontuacao_costa;
            $avaliacao['pontuacao_perna'] = json_decode($q->avaliacao)->pontuacao->pontuacao_perna;
            $avaliacao['estressores']['estressor_vibracao'] = json_decode($q->avaliacao)->estressor_vibracao;
            $avaliacao['estressores']['estressor_baixas_temp'] = json_decode($q->avaliacao)->estressor_baixas_temp;
            $avaliacao['estressores']['estressor_compressao'] = json_decode($q->avaliacao)->estressor_compressao;
            $avaliacao['estressores']['estressor_impacto'] = json_decode($q->avaliacao)->estressor_impacto;
            $avaliacao['estressores']['estressor_luva'] = json_decode($q->avaliacao)->estressor_luva;
            array_push($all_levantar, [$levantar, '']);
            array_push($all_empurrar, [$empurrar, $empurrar_m, '', '']);
            array_push($all_puxar, [$puxar, $puxar_m, '', '']);
            array_push($all_transportar, [$transportar, $transportar_m, '', '']);
            array_push($all_avaliacao, $avaliacao);
        }else{
            $q1 = mysqli_fetch_object(executeQuery("SELECT levantar, empurrar, puxar, transportar FROM subatividade WHERE id_subatividade = ".$id));
            $q2 = mysqli_fetch_object(executeQuery("SELECT levantar, empurrar, puxar, transportar, avaliacao FROM subatividade_analise_acomp WHERE subatividade_id = ".$id." ORDER BY id DESC LIMIT 1"));
            $levantar1 = json_decode($q1->levantar)->indice_l;
            $empurrar1 = json_decode($q1->empurrar)->forca_i_m;
            $empurrar_m_1 = json_decode($q1->empurrar)->forca_i_e_e;
            $puxar1 = json_decode($q1->puxar)->f_a_o_m;
            $puxar_m_1 = json_decode($q1->puxar)->forca_i_e_p;
            $transportar1 = json_decode($q1->transportar)->p_m_a_c;
            $transportar_m_1 = json_decode($q1->transportar)->peso_i_e;
            $levantar2 = json_decode($q2->levantar)->indice_l;
            $empurrar2 = json_decode($q2->empurrar)->forca_i_m;
            $empurrar_m_2 = json_decode($q2->empurrar)->forca_i_e_e;
            $puxar2 = json_decode($q2->puxar)->f_a_o_m;
            $puxar_m_2 = json_decode($q2->puxar)->forca_i_e_p;
            $transportar2 = json_decode($q2->transportar)->p_m_a_c;
            $transportar_m_2 = json_decode($q2->transportar)->peso_i_e;
            $avaliacao['pontuacao_mao_esq'] = json_decode($q2->avaliacao)->pontuacao->pontuacao_mao_esq;
            $avaliacao['pontuacao_mao_dir'] = json_decode($q2->avaliacao)->pontuacao->pontuacao_mao_dir;
            $avaliacao['pontuacao_cotovelo_esq'] = json_decode($q2->avaliacao)->pontuacao->pontuacao_cotovelo_esq;
            $avaliacao['pontuacao_cotovelo_dir'] = json_decode($q2->avaliacao)->pontuacao->pontuacao_cotovelo_dir;
            $avaliacao['pontuacao_ombro_esq'] = json_decode($q2->avaliacao)->pontuacao->pontuacao_ombro_esq;
            $avaliacao['pontuacao_ombro_dir'] = json_decode($q2->avaliacao)->pontuacao->pontuacao_ombro_dir;
            $avaliacao['pontuacao_ombro_dir'] = json_decode($q2->avaliacao)->pontuacao->pontuacao_ombro_dir;
            $avaliacao['pontuacao_pescoco'] = json_decode($q2->avaliacao)->pontuacao->pontuacao_pescoco;
            $avaliacao['pontuacao_costa'] = json_decode($q2->avaliacao)->pontuacao->pontuacao_costa;
            $avaliacao['pontuacao_perna'] = json_decode($q2->avaliacao)->pontuacao->pontuacao_perna;
            $avaliacao['estressores']['estressor_vibracao'] = json_decode($q2->avaliacao)->estressor_vibracao;
            $avaliacao['estressores']['estressor_baixas_temp'] = json_decode($q2->avaliacao)->estressor_baixas_temp;
            $avaliacao['estressores']['estressor_compressao'] = json_decode($q2->avaliacao)->estressor_compressao;
            $avaliacao['estressores']['estressor_impacto'] = json_decode($q2->avaliacao)->estressor_impacto;
            $avaliacao['estressores']['estressor_luva'] = json_decode($q2->avaliacao)->estressor_luva;
            array_push($all_levantar, [$levantar1, $levantar2]);
            array_push($all_empurrar, [$empurrar1, $empurrar_m_1, $empurrar2, $empurrar_m_2]);
            array_push($all_puxar, [$puxar1, $puxar_m_1, $puxar2, $puxar_m_2]);
            array_push($all_transportar, [$transportar1, $transportar_m_1, $transportar2, $transportar_m_2]);
            array_push($all_avaliacao, $avaliacao);
        }
    }
    die(json_encode(['all_melhorias_roi' => $all_melhorias_roi, 'all_melhorias' => $all_melhorias, 'all_causas_diretas' => $all_causas_diretas, 'all_subs' => $all, 'all_levantar' => $all_levantar, 'all_empurrar' => $all_empurrar, 'all_puxar' => $all_puxar, 'all_transportar' => $all_transportar, 'all_avaliacao' => $all_avaliacao]));
}

function maior($arr){
    $maior = [];
    for($i=0; $i<sizeof($arr);$i++){
        if($arr[$i]['tem_analise_acomp'] == '0'){
            array_push($maior, $arr[$i]['risco']);
        }else{
            array_push($maior, $arr[$i]['acomp']);
        }
    }
    return max($maior);
}

if ($_POST['operacao'] == 'b_visao_geral_ativ') {
    $full = [];
    $teste = [];
    $id_all = executeQuery("SELECT id_Atividades FROM atividades");
    while($id = mysqli_fetch_object($id_all)){
        $q = executeQuery("SELECT s.risco, s.acomp, s.tem_analise_acomp FROM atividades as a JOIN subatividade as s ON a.id_Atividades = s.id_atividade WHERE a.id_Atividades = ".$id->id_Atividades);
        while($val = mysqli_fetch_assoc($q)){
            array_push($full, $val);
        }
        $completo = maior($full);
        array_push($teste, $completo);
        $full = [];
    }

    die(json_encode($teste));
}

if ($_POST['operacao'] == 'b_visao_geral_func') {
    $full = [];
    $teste = [];
    $id_all = executeQuery("SELECT id_funcao FROM funcoes");
    while($id = mysqli_fetch_object($id_all)){
        $q = executeQuery("SELECT s.risco, s.acomp, s.tem_analise_acomp FROM funcoes as f JOIN atividades as a ON f.id_funcao = a.id_funcao JOIN subatividade as s ON a.id_Atividades = s.id_atividade WHERE f.id_funcao = ".$id->id_funcao);
        while($val = mysqli_fetch_assoc($q)){
            array_push($full, $val);
        }
        $completo = maior($full);
        array_push($teste, $completo);
        $full = [];
    }

    die(json_encode($teste));
}