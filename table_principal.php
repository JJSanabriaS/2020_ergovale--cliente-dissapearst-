	<?php
		if($_SESSION['perfil'] != LEVEL_ADMIN){
			$select_empresa = "SELECT * FROM empresas WHERE id = ".$_SESSION['empresa'];
		}else{
			$select_empresa = "SELECT * FROM empresas";
		}
    $select_fabricas = "SELECT * FROM fabricas WHERE id_empresa = ";
    $select_setor = "SELECT * FROM setor WHERE id_fabrica = ";
    $select_celula = "SELECT * FROM celulas WHERE id_setor = ";
    $select_funcao= "SELECT * FROM funcoes WHERE id_cargo = ";
    $select_atividade= "SELECT * FROM atividades WHERE id_funcao = ";
    $select_subatividade= "SELECT * FROM subatividade WHERE id_atividade = ";
    $select_cargo = 'SELECT * FROM cargo WHERE id_celula = ';

    //// SELECT EMPRESAS
    $result_empresa = executeQuery($select_empresa);
    $indice_empresa = 0;

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

    while ($empresa = $result_empresa->fetch_assoc()) {
        $dados[$indice_empresa]['nome'] = $empresa['razao'];
        $dados[$indice_empresa]['id'] = $empresa['id'];
        $dados[$indice_empresa]['risco'] = $empresa['graurisco'];
        $dados[$indice_empresa]['data_cadastro'] = $empresa['data_cadastro'];
        $dados[$indice_empresa]['total_s'] = 0;
        $dados[$indice_empresa]['total_a'] =0;
        ////SELECT FABRICAS
        $indice_fabrica = 0;
        $result_fabricas = executeQuery($select_fabricas.$empresa['id']);

        while ($fabricas = $result_fabricas->fetch_assoc()) {
            $dados[$indice_empresa]['fabrica'][$indice_fabrica]['nome'] = $fabricas['Nome da Fabrica'];
            $dados[$indice_empresa]['fabrica'][$indice_fabrica]['id'] = $fabricas['id_fabrica'];
            $dados[$indice_empresa]['fabrica'][$indice_fabrica]['total_s'] = 0;
            $dados[$indice_empresa]['fabrica'][$indice_fabrica]['total_a']    = 0;
            ////SELECT Setor
            $indice_setor = 0;
            $result_setor = executeQuery($select_setor.$fabricas['id_fabrica']);

            while ($setores = $result_setor->fetch_assoc()) {
                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['nome'] = $setores['descricao'];
                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['id'] = $setores['id_setor'];
                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['total_a'] = 0;
                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['total_s'] = 0;

                ////SELECT CÉLULAS
                $indice_celula = 0;
                $result_celula = executeQuery($select_celula.$setores['id_setor']);

                while ($celulas = $result_celula->fetch_assoc()) {
                    $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['nome'] = $celulas['nome'];
                    $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['id'] = $celulas['id_celulas'];
                    $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['total_a']  = 0;
                    $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['total_s'] = 0;

                    ////SELECT CARGO
                    $indice_cargo = 0;
                    $result_cargo= executeQuery($select_cargo.$celulas['id_celulas']);


                    while ($cargo = $result_cargo->fetch_assoc()) {
                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['nome'] = $cargo['nome'];
                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['id'] = $cargo['id_cargo'];
                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['total_a'] = 0;
                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['total_s'] = 0;

                        ///// SELECT FUNCIONARIOS
                            ////SELECT FUNCOES
                            $indice_funcao = 0;

                            $result_funcoes = executeQuery($select_funcao.$cargo['id_cargo']);
                            while ($funcoes = $result_funcoes->fetch_assoc()) {
                                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['nome'] = $funcoes['nome'];
                                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['id'] = $funcoes['id_funcao'];
                                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['total_a'] = 0;
                                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['total_s'] = 0;
                                $q = executeQuery("SELECT s.risco, s.acomp, s.tem_analise_acomp FROM funcoes as f JOIN atividades as a ON f.id_funcao = a.id_funcao JOIN subatividade as s ON a.id_Atividades = s.id_atividade WHERE f.id_funcao =".$funcoes['id_funcao']);
                                $full = [];
                                while($val = mysqli_fetch_assoc($q)){
                                    array_push($full, $val);
                                }
                                $completo = maior($full);
                                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['max_sub'] = $completo;
                                ////SELECT ATIVIDADES
                                $indice_atividade = 0;

                                $result_atividade = executeQuery($select_atividade.$funcoes['id_funcao']);

                                while ($atividades = $result_atividade->fetch_assoc()) {
                                    $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['total_s'] = 0;
                                    $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['nome'] = $atividades['Nome'];
                                    $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['id'] = $atividades['id_Atividades'];
                                    if(mysqli_num_rows(executeQuery("SELECT s.avaliado FROM atividades as a JOIN subatividade as s ON a.id_Atividades = s.id_atividade WHERE s.avaliado = 1 AND a.id_Atividades =".$atividades['id_Atividades'])) > 0){
                                        $q1 = executeQuery("SELECT s.risco, s.acomp, s.tem_analise_acomp FROM atividades as a JOIN subatividade as s ON a.id_Atividades = s.id_atividade WHERE a.id_Atividades =".$atividades['id_Atividades']);
                                        $full1 = [];
                                        while($val1 = mysqli_fetch_assoc($q1)){
                                            array_push($full1, $val1);
                                        }
                                        $completo1 = maior($full1);
                                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['max_sub'] = $completo1;
                                    }

                                    ////SELECT SUBATIVIDADES
                                    $indice_subatividade = 0;
                                    $result_subatividade = executeQuery($select_subatividade.$atividades['id_Atividades']);

                                    while ($subatividades = $result_subatividade->fetch_assoc()) {
                                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['subatividade'][$indice_subatividade]['nome'] = $subatividades['nome'];
                                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['subatividade'][$indice_subatividade]['descricao'] = $subatividades['descricao'];
                                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['subatividade'][$indice_subatividade]['risco'] = $subatividades['risco'];
                                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['subatividade'][$indice_subatividade]['proj'] = $subatividades['proj'];
                                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['subatividade'][$indice_subatividade]['acomp'] = $subatividades['acomp'];
                                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['subatividade'][$indice_subatividade]['id'] = $subatividades['id_subatividade'];
                                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['subatividade'][$indice_subatividade]['data_criar'] = $subatividades['data_criar'];
                                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['subatividade'][$indice_subatividade]['usuario_criar'] = $subatividades['usuario_criar'];
                                        $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['subatividade'][$indice_subatividade]['avaliado'] = $subatividades['avaliado'];
																				$dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['subatividade'][$indice_subatividade]['tem_analise_acomp'] = $subatividades['tem_analise_acomp'];
																				$dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['subatividade'][$indice_subatividade]['tem_analise_proj'] = $subatividades['tem_analise_proj'];

                                        $indice_subatividade++;
                                    }
                                    $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['total_s'] += $indice_subatividade;
																		$dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['total_s'] += $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['atividade'][$indice_atividade]['total_s'];

                                    $indice_atividade++;
                                }
                                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['total_a'] += $indice_atividade;

                                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['total_a'] += $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['total_a'];
                                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['total_s'] += $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['cargo'][$indice_cargo]['funcao'][$indice_funcao]['total_s'];

                                $indice_funcao++;
                            }
                        $indice_cargo++;
                    }
                    $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['total_a'] += $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['total_a'];
                    $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['total_s'] += $dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['celula'][$indice_celula]['total_s'];

                    $indice_celula++;
                }

                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['total_s'] +=$dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['total_s'];
                $dados[$indice_empresa]['fabrica'][$indice_fabrica]['total_a'] +=$dados[$indice_empresa]['fabrica'][$indice_fabrica]['setor'][$indice_setor]['total_a'];

                $indice_setor++;
            }

            $dados[$indice_empresa]['total_s'] += $dados[$indice_empresa]['fabrica'][$indice_fabrica]['total_s'];
            $dados[$indice_empresa]['total_a'] += $dados[$indice_empresa]['fabrica'][$indice_fabrica]['total_a'];
            $indice_fabrica++;
        }

        $indice_empresa++;
    }
?>
