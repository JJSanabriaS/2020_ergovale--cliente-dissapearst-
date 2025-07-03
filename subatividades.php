<?php
if ( isset( $_GET['analise_acomp'] ) ) {
	$sql            = "SELECT  acomp.nome AS sub_nome,
                             acomp.risco AS sub_risco,
                             acomp.comentario AS sub_comentario,
                             acomp.avaliado AS sub_avaliado,
                             acomp.levantar_avaliado AS sub_levantar_avaliado,
                             sub.descricao AS sub_descricao,
                             sub.duracao AS sub_duracao,
                             sub.n_operadores AS n_op,
                             sub.q_turnos AS q_turno,
                             ativ.Nome AS ativ_nome,
                             fun.nome AS fun_nome,
                             car.nome AS car_nome,
                             cel.nome AS cel_nome,
                             setor.descricao AS setor_nome,
                             fab.`Nome da Fabrica` AS fab_nome,
                             emp.razao AS emp_nome
                      FROM subatividade_analise_acomp as acomp
                      JOIN subatividade AS sub ON acomp.subatividade_id = sub.id_subatividade
                      JOIN atividades AS ativ ON ativ.id_Atividades = sub.id_atividade
                      JOIN funcoes AS fun ON fun.id_funcao = ativ.id_funcao
                      JOIN cargo AS car ON car.id_cargo = fun.id_cargo
                      JOIN celulas AS cel ON cel.id_celulas = car.id_celula
                      JOIN setor ON setor.id_setor = cel.id_setor
                      JOIN fabricas AS fab ON fab.id_fabrica = setor.id_fabrica
                      JOIN empresas AS emp ON emp.id = fab.id_empresa
                      WHERE acomp.id = " . $_GET['analise_acomp'];
	$sub            = mysqli_fetch_object( executeQuery( $sql ) );
	$sql2           = "SELECT id, type, midia FROM subatividade_analise_acomp_midia WHERE subatividade_analise_acomp_id = " . $_GET['analise_acomp'] . " AND (type = 'foto' OR type = 'video') ORDER BY id ASC";
	$result         = executeQuery( $sql2 );
	$arq            = "SELECT id, type, midia FROM subatividade_analise_acomp_midia WHERE subatividade_analise_acomp_id = " . $_GET['analise_acomp'] . " AND type = 'arquivo' ORDER BY id ASC";
	$result_arquivo = executeQuery( $arq );
	$i              = 0;
	$sql3           = "SELECT avaliacao, levantar, empurrar, puxar, transportar FROM subatividade_analise_acomp WHERE id = " . $_GET['analise_acomp'];
	$sql3_result    = mysqli_fetch_object( executeQuery( $sql3 ) );
	$avaliacao      = json_decode( $sql3_result->avaliacao );
	$levantar       = json_decode( $sql3_result->levantar );
	$empurrar       = json_decode( $sql3_result->empurrar );
	$puxar          = json_decode( $sql3_result->puxar );
	$transportar    = json_decode( $sql3_result->transportar );
} else if ( isset( $_GET['analise_projetada'] ) ) {
	$sql            = "SELECT  proj.nome              AS sub_nome, 
                             proj.risco             AS sub_risco, 
                             proj.comentario        AS sub_comentario, 
                             proj.avaliado          AS sub_avaliado, 
                             proj.levantar_avaliado AS sub_levantar_avaliado,
                             sub.descricao AS sub_descricao,
                             sub.duracao AS sub_duracao,
                             sub.n_operadores AS n_op,
                             sub.q_turnos AS q_turno,
                             ativ.Nome AS ativ_nome,
                             fun.nome AS fun_nome,
                             car.nome AS car_nome,
                             cel.nome AS cel_nome,
                             setor.descricao AS setor_nome,
                             fab.`Nome da Fabrica` AS fab_nome,
                             emp.razao AS emp_nome
                      FROM   subatividade_analise_proj proj
                      JOIN subatividade AS sub ON proj.subatividade_id = sub.id_subatividade
                      JOIN atividades AS ativ ON ativ.id_Atividades = sub.id_atividade
                      JOIN funcoes AS fun ON fun.id_funcao = ativ.id_funcao
                      JOIN cargo AS car ON car.id_cargo = fun.id_cargo
                      JOIN celulas AS cel ON cel.id_celulas = car.id_celula
                      JOIN setor ON setor.id_setor = cel.id_setor
                      JOIN fabricas AS fab ON fab.id_fabrica = setor.id_fabrica
                      JOIN empresas AS emp ON emp.id = fab.id_empresa
                      WHERE  proj.id =" . $_GET['analise_projetada'];
	$sub            = mysqli_fetch_object( executeQuery( $sql ) );
	$sql2           = "SELECT id, type, midia FROM subatividade_analise_proj_midia WHERE subatividade_analise_proj_id = " . $_GET['analise_projetada'] . " AND (type = 'foto' OR type = 'video') ORDER BY id ASC";
	$result         = executeQuery( $sql2 );
	$arq            = "SELECT id, type, midia FROM subatividade_analise_proj_midia WHERE subatividade_analise_proj_id = " . $_GET['analise_projetada'] . " AND type = 'arquivo' ORDER BY id ASC";
	$result_arquivo = executeQuery( $arq );
	$i              = 0;
	$sql3           = "SELECT avaliacao, levantar, empurrar, puxar, transportar FROM subatividade_analise_proj WHERE id = " . $_GET['analise_projetada'];
	$sql3_result    = mysqli_fetch_object( executeQuery( $sql3 ) );
	$avaliacao      = json_decode( $sql3_result->avaliacao );
	$levantar       = json_decode( $sql3_result->levantar );
	$empurrar       = json_decode( $sql3_result->empurrar );
	$puxar          = json_decode( $sql3_result->puxar );
	$transportar    = json_decode( $sql3_result->transportar );
} else {
	$sql            = "SELECT sub.comentario AS sub_comentario,
       sub.levantar_avaliado AS sub_levantar_avaliado,
       sub.avaliado AS sub_avaliado,
       sub.risco AS sub_risco,
       sub.nome AS sub_nome,
       sub.descricao AS sub_descricao,
       sub.duracao AS sub_duracao,
       sub.n_operadores AS n_op,
       sub.q_turnos AS q_turno,
       ativ.Nome AS ativ_nome,
       fun.nome AS fun_nome,
       car.nome AS car_nome,
       cel.nome AS cel_nome,
       setor.descricao AS setor_nome,
       fab.`Nome da Fabrica` AS fab_nome,
       emp.razao AS emp_nome
FROM subatividade AS sub
JOIN atividades AS ativ ON ativ.id_Atividades = sub.id_atividade
JOIN funcoes AS fun ON fun.id_funcao = ativ.id_funcao
JOIN cargo AS car ON car.id_cargo = fun.id_cargo
JOIN celulas AS cel ON cel.id_celulas = car.id_celula
JOIN setor ON setor.id_setor = cel.id_setor
JOIN fabricas AS fab ON fab.id_fabrica = setor.id_fabrica
JOIN empresas AS emp ON emp.id = fab.id_empresa
WHERE sub.id_subatividade = " . $_GET['subatividade'];
	$sub            = mysqli_fetch_object( executeQuery( $sql ) );
	$sql2           = "SELECT id, type, midia FROM subatividade_midia WHERE subatividade_id = " . $_GET['subatividade'] . " AND (type = 'foto' OR type = 'video') ORDER BY id ASC";
	$result         = executeQuery( $sql2 );
	$arq            = "SELECT id, type, midia FROM subatividade_midia WHERE subatividade_id = " . $_GET['subatividade'] . " AND type = 'arquivo' ORDER BY id ASC";
	$result_arquivo = executeQuery( $arq );
	$i              = 0;
	$sql3           = "SELECT avaliacao, levantar, empurrar, puxar, transportar FROM subatividade WHERE id_subatividade = " . $_GET['subatividade'];
	$sql3_result    = mysqli_fetch_object( executeQuery( $sql3 ) );
	$avaliacao      = json_decode( $sql3_result->avaliacao );
	$levantar       = json_decode( $sql3_result->levantar );
	$empurrar       = json_decode( $sql3_result->empurrar );
	$puxar          = json_decode( $sql3_result->puxar );
	$transportar    = json_decode( $sql3_result->transportar );
}
?>

<?php require_once( 'topo.php' ) ?>
<button type="button" class="btn btn-sm btn-info" <?php if ( isset( $_GET['analise_acomp'] ) ) {
	echo( "onclick='location.href=\"?page=analise_acompanhamento&subatividade={$_GET['subatividade']}\"'" );
} else if ( isset( $_GET['analise_projetada'] ) ) {
	echo( "onclick='location.href=\"?page=analise_projetada&subatividade={$_GET['subatividade']}\"'" );
} else {
	echo( "onclick='location.href=\"?page=main\"'" );
} ?> style="margin-left:15px"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
</button>
<div class="container">
  <div class="row">
    <h2 style="padding: 15px 0px"><?php echo $sub->sub_nome ?></h2>
  </div>
</div>
  <div class="container">
    <div class="row">
      <p><span style="font-weight: 600; font-size: 19.5px">Descrição:</span> <span style="font-weight: 400; font-size: 19px"><?php echo $sub->sub_descricao ?></span></p>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div style="width: 25%">
        <p><span style="font-weight: 600; font-size: 16px">Área:</span> <?php echo $sub->fab_nome ?></p>
      </div>
      <div style="width: 25%">
        <p><span style="font-weight: 600; font-size: 16px">Cargo:</span> <?php echo $sub->car_nome ?></p>
      </div>
      <div style="width: 25%">
        <p><span style="font-weight: 600; font-size: 16px">Função:</span> <?php echo $sub->fun_nome ?></p>
      </div>
      <div style="width: 25%">
        <p><span style="font-weight: 600; font-size: 16px">Atividade:</span> <?php echo $sub->ativ_nome ?></p>
      </div>
    </div>
    <div class="row">
      <div style="width: 25%">
        <p><span style="font-weight: 600; font-size: 16px">Tempo:</span> <?php if ( $sub->sub_duracao == 1 ) {
				echo( 'Menos de 4 horas' );
			} else if ( $sub->sub_duracao == 2 ) {
				echo( 'De 4 a 19 horas' );
			} else if ( $sub->sub_duracao == 3 ) {
				echo( 'De 20 a 40 horas' );
			} else {
				echo( "Mais de 40 horas" );
			}; ?></p>
      </div>
      <div style="width: 25%">
        <p><span style="font-weight: 600; font-size: 16px">Nº de operadores:</span> <?php echo $sub->n_op ?></p>
      </div>
    </div>
  </div>
  <div style="margin: 20px auto; padding: 0px;" class="container">
    <div class="row">
      <div style="padding: 0px; width: 20%; position: relative;">
        <div class="menu-sub <?= (!isset( $_GET['analise_acomp'] )  AND !isset( $_GET['analise_projetada'] )) ? 'active' : '' ?>" onclick="location.href='?page=subatividades&subatividade=<?php echo $_GET['subatividade']; ?>'">Análise inicial</div>
      </div>
      <div style="padding: 0px; width: 20%; position: relative;">
        <div class="arrow-subatividade"></div>
        <div class="menu-sub" onclick="location.href='?page=causasdiretas&subatividade=<?php echo $_GET['subatividade']; ?>'">Causas diretas</div>
      </div>
      <div style="padding: 0px; width: 15%; position: relative;">
        <div class="arrow-subatividade"></div>
        <div class="menu-sub" onclick="location.href='?page=melhorias&subatividade=<?php echo $_GET['subatividade']; ?>'">Melhorias</div>
      </div>
      <div style="padding: 0px; width: 25%; position: relative;">
        <div class="arrow-subatividade"></div>
        <div class="menu-sub  <?= isset( $_GET['analise_acomp'] ) ? 'active' : '' ?>" onclick="location.href='?page=analise_acompanhamento&subatividade=<?php echo $_GET['subatividade']; ?>'">Análise de acompanhamento</div>
      </div>
      <div style="padding: 0px; width: 20%; position: relative;">
        <div class="arrow-subatividade"></div>
        <div class="menu-sub  <?= isset( $_GET['analise_projetada'] )  ? 'active' : '' ?>" onclick="location.href='?page=analise_projetada&subatividade=<?php echo $_GET['subatividade']; ?>'">Análise projetada</div>
      </div>
    </div>
  </div>
<div style="padding-top: 60px" class="container">
  <div class="row">
    <div style="padding: 0px" class="col-7">
      <div class="row text-center">
        <div style="padding: 40px 0px 0px 25px" class="col-5">
          <p style="padding-bottom: 20px; font-size: 16.5px; font-weight: 500">Pontuação de Prioridade de Risco<br>(PPR)</p>
          <div>
            <div class="risco-ponto <?php if ( $sub->sub_avaliado ) {
				if ( $sub->sub_risco < 10 ) {
					echo( 'clas-risco-back-green' );
				} else if ( $sub->sub_risco < 30 ) {
					echo( 'clas-risco-back-yellow' );
				} else if ( $sub->sub_risco < 50 ) {
					echo( 'clas-risco-back-red' );
				} else if ( $sub->sub_risco >= 50 ) {
					echo( 'clas-risco-back-roxo' );
				}
			} ?>"><?php echo $sub->sub_risco ?></div>
          </div>
        </div>
        <div style="padding: 0px 30px 0px 0px; position: relative;" class="col-7">
          <img class="img-responsive" width="181px" height="300px" src="assets/imgs/corpo.png">
          <div id="um" class="circulo-corpo <?php if ( $avaliacao->pontuacao->pontuacao_mao_esq <= 1 ) {
			  echo( 'clas-risco-back-green' );
		  } else if ( $avaliacao->pontuacao->pontuacao_mao_esq <= 2 ) {
			  echo( 'clas-risco-back-yellow' );
		  } else if ( $avaliacao->pontuacao->pontuacao_mao_esq > 2 ) {
			  echo( 'clas-risco-back-red' );
		  } ?>"></div>
          <div id="dois" class="circulo-corpo <?php if ( $avaliacao->pontuacao->pontuacao_mao_dir <= 1 ) {
			  echo( 'clas-risco-back-green' );
		  } else if ( $avaliacao->pontuacao->pontuacao_mao_dir <= 2 ) {
			  echo( 'clas-risco-back-yellow' );
		  } else if ( $avaliacao->pontuacao->pontuacao_mao_dir > 2 ) {
			  echo( 'clas-risco-back-red' );
		  } ?>"></div>
          <div id="tres" class="circulo-corpo <?php if ( $avaliacao->pontuacao->pontuacao_cotovelo_esq <= 1 ) {
			  echo( 'clas-risco-back-green' );
		  } else if ( $avaliacao->pontuacao->pontuacao_cotovelo_esq <= 2 ) {
			  echo( 'clas-risco-back-yellow' );
		  } else if ( $avaliacao->pontuacao->pontuacao_cotovelo_esq > 2 ) {
			  echo( 'clas-risco-back-red' );
		  } ?>"></div>
          <div id="quatro" class="circulo-corpo <?php if ( $avaliacao->pontuacao->pontuacao_cotovelo_dir <= 1 ) {
			  echo( 'clas-risco-back-green' );
		  } else if ( $avaliacao->pontuacao->pontuacao_cotovelo_dir <= 2 ) {
			  echo( 'clas-risco-back-yellow' );
		  } else if ( $avaliacao->pontuacao->pontuacao_cotovelo_dir > 2 ) {
			  echo( 'clas-risco-back-red' );
		  } ?>"></div>
          <div id="cinco" class="circulo-corpo <?php if ( $avaliacao->pontuacao->pontuacao_ombro_esq <= 1 ) {
			  echo( 'clas-risco-back-green' );
		  } else if ( $avaliacao->pontuacao->pontuacao_ombro_esq <= 2 ) {
			  echo( 'clas-risco-back-yellow' );
		  } else if ( $avaliacao->pontuacao->pontuacao_ombro_esq > 2 ) {
			  echo( 'clas-risco-back-red' );
		  } ?>"></div>
          <div id="seis" class="circulo-corpo <?php if ( $avaliacao->pontuacao->pontuacao_ombro_dir <= 1 ) {
			  echo( 'clas-risco-back-green' );
		  } else if ( $avaliacao->pontuacao->pontuacao_ombro_dir <= 2 ) {
			  echo( 'clas-risco-back-yellow' );
		  } else if ( $avaliacao->pontuacao->pontuacao_ombro_dir > 2 ) {
			  echo( 'clas-risco-back-red' );
		  } ?>"></div>
          <div id="sete" class="circulo-corpo <?php if ( $avaliacao->pontuacao->pontuacao_pescoco <= 1 ) {
			  echo( 'clas-risco-back-green' );
		  } else if ( $avaliacao->pontuacao->pontuacao_pescoco <= 2 ) {
			  echo( 'clas-risco-back-yellow' );
		  } else if ( $avaliacao->pontuacao->pontuacao_pescoco > 2 ) {
			  echo( 'clas-risco-back-red' );
		  } ?>"></div>
          <div id="oito" class="circulo-corpo <?php if ( $avaliacao->pontuacao->pontuacao_costa <= 1 ) {
			  echo( 'clas-risco-back-green' );
		  } else if ( $avaliacao->pontuacao->pontuacao_costa <= 2 ) {
			  echo( 'clas-risco-back-yellow' );
		  } else if ( $avaliacao->pontuacao->pontuacao_costa > 2 ) {
			  echo( 'clas-risco-back-red' );
		  } ?>"></div>
          <div id="nove" class="circulo-corpo <?php if ( $avaliacao->pontuacao->pontuacao_perna <= 1 ) {
			  echo( 'clas-risco-back-green' );
		  } else if ( $avaliacao->pontuacao->pontuacao_perna <= 2 ) {
			  echo( 'clas-risco-back-yellow' );
		  } else if ( $avaliacao->pontuacao->pontuacao_perna > 2 ) {
			  echo( 'clas-risco-back-red' );
		  } ?>"></div>
          <div id="dez" class="circulo-corpo <?php if ( $avaliacao->pontuacao->pontuacao_perna <= 1 ) {
			  echo( 'clas-risco-back-green' );
		  } else if ( $avaliacao->pontuacao->pontuacao_perna <= 2 ) {
			  echo( 'clas-risco-back-yellow' );
		  } else if ( $avaliacao->pontuacao->pontuacao_perna > 2 ) {
			  echo( 'clas-risco-back-red' );
		  } ?>"></div>
        </div>
      </div>
    </div>
    <div style="padding: 0px" class="col-5">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
			<?php if ( mysqli_num_rows( $result ) == 0 ) { ?>
              <div class="carousel-item active ?>">
                <img class="d-block" style="margin: 0px auto" height="300" src="assets/imgs/sem-foto.jpg">
              </div>
			<?php } else { ?>
				<?php while ( $midia = mysqli_fetch_object( $result ) ) { ?>
                <span onclick="excluir_img_sub(<?php echo $midia->id; ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
					echo( 0 );
				} else {
					echo( 1 );
				} ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
					echo( 0 );
				} else {
					echo( 1 );
				} ?>)" id="excluir-sub-img">&times;</span>
                <div class="carousel-item <?php if ( $i == 0 ) {
					echo( 'active' );
				} ?>">
					<?php if ( $midia->type == "foto" ) { ?>
                      <img class="d-block sub-imgs" style="margin: 0px auto" height="300" src="<?php echo substr( $midia->midia, 3 ); ?>">
					<?php } else if ( $midia->type == "video" ) { ?>
                      <iframe class="video-subatividade-screen" width="480" height="300" src="<?php echo str_replace( "watch?v=", 'embed/', $midia->midia ) . '?rel=0&amp;showinfo=0' ?>"
                              frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					<?php } ?>
                  <input type="hidden" value="<?php echo $midia->id ?>">
                </div>
					<?php $i ++;
				} ?>
			<?php } ?>
        </div>
		  <?php if ( ! ( mysqli_num_rows( $result ) == 0 || mysqli_num_rows( $result ) == 1 ) ) { ?>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="height: 100px; top: 105">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="height: 100px; top: 99">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
		  <?php } ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div style="padding-top: 61.8px" class="col-9">
      <table class="table text-center table-bordered">
        <thead>
        <tr>
          <th style="font-weight: 500; font-size: 17px; padding-bottom: 19px" class="text-center" colspan="8" scope="col">Avaliação do corpo inteiro</th>
          <th style="padding-left: 0px; padding-right: 0px;" class="text-center">

            <button style="cursor: pointer; margin: 0px auto" class="btn btn-primary" <?php if ( isset( $_GET['analise_acomp'] ) ) {
				echo( "onclick='location.href=\"?page=avaliar&subatividade={$_GET['subatividade']}&analise_acomp={$_GET['analise_acomp']}\"'" );
			} else if ( isset( $_GET['analise_projetada'] ) ) {
				echo( "onclick='location.href=\"?page=avaliar&subatividade={$_GET['subatividade']}&analise_projetada={$_GET['analise_projetada']}\"'" );
			} else {
				echo( "onclick='location.href=\"?page=avaliar&subatividade={$_GET['subatividade']}\"'" );
			} ?>><i class="fa fa-check-square-o" aria-hidden="true"></i> Avaliar
            </button>
          </th>
        </tr>
        </thead>
        <thead>
        <tr>
          <th class="text-center" colspan="2" scope="col">Mãos/pulsos</th>
          <th class="text-center" colspan="2" scope="col">Cotovelos</th>
          <th class="text-center" colspan="2" scope="col">Ombros</th>
          <th class="text-center" scope="col">Pescoço</th>
          <th class="text-center" scope="col">Costas</th>
          <th class="text-center" scope="col">Pernas</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Esq.</td>
          <td>Dir.</td>
          <td>Esq.</td>
          <td>Dir.</td>
          <td>Esq.</td>
          <td>Dir.</td>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td style="font-weight: 600"><?php echo $avaliacao->pontuacao->pontuacao_mao_esq ?></td>
          <td style="font-weight: 600"><?php echo $avaliacao->pontuacao->pontuacao_mao_dir ?></td>
          <td style="font-weight: 600"><?php echo $avaliacao->pontuacao->pontuacao_cotovelo_esq ?></td>
          <td style="font-weight: 600"><?php echo $avaliacao->pontuacao->pontuacao_cotovelo_dir ?></td>
          <td style="font-weight: 600"><?php echo $avaliacao->pontuacao->pontuacao_ombro_esq ?></td>
          <td style="font-weight: 600"><?php echo $avaliacao->pontuacao->pontuacao_ombro_dir ?></td>
          <td style="font-weight: 600"><?php echo $avaliacao->pontuacao->pontuacao_pescoco ?></td>
          <td style="font-weight: 600"><?php echo $avaliacao->pontuacao->pontuacao_costa ?></td>
          <td style="font-weight: 600"><?php echo $avaliacao->pontuacao->pontuacao_perna ?></td>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="col-3" style="padding: 10px 0px 0px 0px">
      <div style="float: right;" id="foto-video-container">
		  <?php if ( in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) { ?>
            <button style="cursor: pointer;" class="btn btn-success add-midia"><i class="fa fa-picture-o" aria-hidden="true"></i> Foto</button>
            <button data-toggle="modal" data-target="#videoModal" style="cursor: pointer;" class="btn btn-danger"><i class="fa fa-play" aria-hidden="true"></i> Vídeo</button>
		  <?php } ?>
        <a id="table-risco-btn" style="background-color: #DDDDDD;" class="btn"><i class="fa fa-list-ul" aria-hidden="true"></i> Risco</a>
      </div>
      <form id="sub_img_form" method="POST" enctype="multipart/form-data">
        <input style="display: none" name="sub_img" id="sub_img" type="file" accept="image/*"/>
		  <?php if ( isset( $_GET['analise_acomp'] ) ) { ?>
            <input type="hidden" id="sub_id" name="sub_id" value="<?php echo $_GET['analise_acomp'] ?>">
            <input type="hidden" id="operacao_sub" value="img" name="operacao_sub">
            <input type="hidden" id="operacao_sub_acomp" value="1" name="operacao_sub_acomp">
		  <?php } else if ( isset( $_GET['analise_projetada'] ) ) { ?>
            <input type="hidden" id="sub_id" name="sub_id" value="<?php echo $_GET['analise_projetada'] ?>">
            <input type="hidden" id="operacao_sub" value="img" name="operacao_sub">
            <input type="hidden" id="operacao_sub_proj" value="1" name="operacao_sub_proj">
		  <?php } else { ?>
            <input type="hidden" id="sub_id" name="sub_id" value="<?php echo $_GET['subatividade'] ?>">
            <input type="hidden" id="operacao_sub" value="img" name="operacao_sub">
		  <?php } ?>
      </form>
      <div id="table-risco">
        <table style="margin: 0px" class="table text-center table-bordered">
          <thead>
          <tr>
            <th style="font-weight: 500; font-size: 15px; text-align: center;" scope="col" colspan="2">Prioridade do Risco</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td style="font-weight: 500; font-size: 14.5px;" class="clas-risco-back-green">00-09</td>
            <td style="font-size: 14.5px;">Tolerável</td>
          </tr>
          <tr>
            <td style="font-weight: 500; font-size: 14.5px;" class="clas-risco-back-yellow">10-29</td>
            <td style="font-size: 14.5px;">Moderado</td>
          </tr>
          <tr>
            <td style="font-weight: 500; font-size: 14.5px;" class="clas-risco-back-red">30-49</td>
            <td style="font-size: 14.5px;">Substâncial</td>
          </tr>
          <tr>
            <td style="font-weight: 500; font-size: 14.5px;" class="clas-risco-back-roxo">>50</td>
            <td style="font-size: 14.5px;">Intolerável</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-7">
      <table style="margin-top: 20px" class="table table-bordered">
        <thead>
        <tr>
          <th style="font-weight: 500; font-size: 17px; text-align: center;" colspan="2">Movimentação manual de carga</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td><p style="display: inline; position: relative; top: 7px;">Levantar/Baixar</p><span <?php if ( ! $sub->sub_levantar_avaliado ) {
				  echo( 'style="display: none"' );
			  } ?> class="<?php if ( $levantar->indice_l <= 1 ) {
				  echo( 'clas-risco-back-green' );
			  } else if ( $levantar->indice_l <= 3 ) {
				  echo( 'clas-risco-back-yellow' );
			  } else {
				  echo( 'clas-risco-back-red' );
			  } ?>" id="il-display"><?php if ( $sub->sub_levantar_avaliado ) {
					  echo $levantar->indice_l;
				  } ?></span>
            <button <?php if ( isset( $_GET['analise_acomp'] ) ) {
				echo( "onclick='location.href=\"?page=avaliarLevantar&subatividade={$_GET['subatividade']}&analise_acomp={$_GET['analise_acomp']}\"'" );
			} else if ( isset( $_GET['analise_projetada'] ) ) {
				echo( "onclick='location.href=\"?page=avaliarLevantar&subatividade={$_GET['subatividade']}&analise_projetada={$_GET['analise_projetada']}\"'" );
			} else {
				echo( "onclick='location.href=\"?page=avaliarLevantar&subatividade={$_GET['subatividade']}\"'" );
			} ?> style="float: right; cursor: pointer; color: #fff;" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i> Avaliar
            </button>
          </td>
          <td><p style="display: inline; position: relative; top: 7px;">Empurrar</p>
            <div id="indicador_empurrar_inicio" <?php if ( $empurrar->forca_i_e_e == "" || $empurrar->forca_i_m == "" ) {
				echo( 'style="display: none"' );
			} ?> class="<?php if ( floatval( $empurrar->forca_i_e_e ) < floatval( $empurrar->forca_i_m ) ) {
				echo( 'clas-risco-back-green' );
			} else if ( floatval( $empurrar->forca_i_e_e ) == floatval( $empurrar->forca_i_m ) ) {
				echo( 'clas-risco-back-yellow' );
			} else if ( floatval( $empurrar->forca_i_e_e ) > floatval( $empurrar->forca_i_m ) ) {
				echo( 'clas-risco-back-red' );
			} ?>" style="width: 15px; height: 15px; position: absolute; top: 82px; right: 130px; border-radius: 50%"></div>
            <div id="indicador_empurrar_manter" <?php if ( $empurrar->forca_i_e_e == "" || $empurrar->forca_i_m == "" ) {
				echo( 'style="display: none"' );
			} ?> class="<?php if ( floatval( $empurrar->forca_m_e_e ) < floatval( $empurrar->forca_m_m ) ) {
				echo( 'clas-risco-back-green' );
			} else if ( floatval( $empurrar->forca_m_e_e ) == floatval( $empurrar->forca_m_m ) ) {
				echo( 'clas-risco-back-yellow' );
			} else if ( floatval( $empurrar->forca_m_e_e ) > floatval( $empurrar->forca_m_m ) ) {
				echo( 'clas-risco-back-red' );
			} ?>" style="width: 15px; height: 15px; position: absolute; top: 105px; right: 130px; border-radius: 50%"></div>
            <button onclick="mudar_empurrar(1)" data-toggle="modal" data-target="#empurrarModal" style="float: right; cursor: pointer;" class="btn btn-primary"><i class="fa fa-check-square-o">  </i>
            Avaliar </button>
          </td>
        </tr>
        <tr>
          <td><p style="display: inline; position: relative; top: 7px;">Puxar</p>
            <div id="indicador_puxar_inicio" <?php if ( $puxar->forca_i_e_p == "" || $puxar->forca_m_e_p == "" ) {
				echo( 'style="display: none"' );
			} ?> class="<?php if ( floatval( $puxar->forca_i_e_p ) < floatval( $puxar->f_a_o_m ) ) {
				echo( 'clas-risco-back-green' );
			} else if ( floatval( $puxar->forca_i_e_p ) == floatval( $puxar->f_a_o_m ) ) {
				echo( 'clas-risco-back-yellow' );
			} else if ( floatval( $puxar->forca_i_e_p ) > floatval( $puxar->f_a_o_m ) ) {
				echo( 'clas-risco-back-red' );
			} ?>" style="width: 15px; height: 15px; position: absolute; top: 145px; right: 427px; border-radius: 50%"></div>
            <div id="indicador_puxar_manter" <?php if ( $puxar->forca_i_e_p == "" || $puxar->forca_m_e_p == "" ) {
				echo( 'style="display: none"' );
			} ?> class="<?php if ( floatval( $puxar->forca_m_e_p ) < floatval( $puxar->f_m_m_p ) ) {
				echo( 'clas-risco-back-green' );
			} else if ( floatval( $puxar->forca_m_e_p ) == floatval( $puxar->f_m_m_p ) ) {
				echo( 'clas-risco-back-yellow' );
			} else if ( floatval( $puxar->forca_m_e_p ) > floatval( $puxar->f_m_m_p ) ) {
				echo( 'clas-risco-back-red' );
			} ?>" style="width: 15px; height: 15px; position: absolute; top: 168px; right: 427px; border-radius: 50%"></div>
              <button style="float: right; cursor: pointer;" onclick="mudar_puxar(1)" data-toggle="modal" data-target="#puxarModal" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i> Avaliar
              </button>
          </td>
          <td><p style="display: inline; position: relative; top: 7px;">Transportar</p>
            <div id="info_transportar" <?php if ( $transportar->p_m_a_c == "" ) {
				echo( 'style="display: none"' );
			} ?> class="<?php if ( floatval( $transportar->peso_i_e ) < floatval( $transportar->p_m_a_c ) ) {
				echo( 'clas-risco-back-green' );
			} else if ( floatval( $transportar->peso_i_e ) == floatval( $transportar->p_m_a_c ) ) {
				echo( 'clas-risco-back-yellow' );
			} else if ( floatval( $transportar->peso_i_e ) > floatval( $transportar->p_m_a_c ) ) {
				echo( 'clas-risco-back-red' );
			} ?>" style="width: 18px; height: 18px; position: absolute; top: 155px; right: 130px; border-radius: 50%"></div>
              <button style="float: right; cursor: pointer;" onclick="mudar_tranportar()" data-toggle="modal" data-target="#transportarModal" class="btn btn-primary"><i class="fa fa-check-square-o"></i>
                  Avaliar
              </button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="col-4" style="margin-top: 32px; padding: 0px 10px">
      <div class="row" style="display: block;">
        <p style="font-weight: 500; font-size: 17px; text-align: center; margin-left: -40px">Comentários - Notas</p>
      </div>
      <div class="row">
        <textarea <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : '' ?> style="padding: 10px; border-color: #e0e0e0" id="sub_comentario" onkeydown="comentarios_mudar()" rows="3" cols="45"><?php echo $sub->sub_comentario ?></textarea>
      </div>
	    <?php if ( in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) { ?>

      <button onclick="salvar_comentario(<?php echo $_GET['subatividade'] ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
		  echo( 0 );
	  } else {
		  echo( $_GET['analise_acomp'] );
	  } ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
		  echo( 0 );
	  } else {
		  echo( 1 );
	  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
		  echo( 0 );
	  } else {
		  echo( $_GET['analise_projetada'] );
	  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
		  echo( 0 );
	  } else {
		  echo( 1 );
	  } ?>)" id="comentario_Salvar" disabled="disabled" style="margin: 5px 21px 0px 0px; float: right; cursor: pointer;" data-toggle="modal" data-target="#transportarModal" class="btn btn-primary">
        Salvar
      </button>
      <?php }else{
	      echo "<div style='display: inline-block;height:36px; width: 90px;float: right'></div>";
      } ?>
    </div>
    <div class="col-1" id="arquivo_btn_container" style="margin-top: 32px; padding: 0px">
      <p style="font-weight: 500; font-size: 17px; text-align: center;">Anexar</p>
      <button style="float: right; cursor: pointer;" data-toggle="modal" data-target="#arquivosModal" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i> Arquivos</button>
		<?php if ( mysqli_num_rows( $result_arquivo ) > 0 ) { ?>
          <div id="arquivo_indicador" style="margin: 10px 1px 0px 0px; float: right; border-radius: 50%; width: 15px; height: 15px; background: #007bff"></div>
		<?php } ?>
		<?php if ( isset( $_GET['analise_acomp'] ) ) { ?>
          <input type="hidden" id="subatividade_id_arquivo" name="subatividade_id_arquivo" value="<?php echo $_GET['analise_acomp'] ?>">
		<?php } else if ( isset( $_GET['analise_projetada'] ) ) { ?>
          <input type="hidden" id="subatividade_id_arquivo" name="subatividade_id_arquivo" value="<?php echo $_GET['analise_projetada'] ?>">
		<?php } else { ?>
          <input type="hidden" id="subatividade_id_arquivo" name="subatividade_id_arquivo" value="<?php echo $_GET['subatividade'] ?>">
		<?php } ?>
    </div>
  </div>
</div>

<!-- The Modal -->
<div id="modal-sub-img" class="modal-sub-img">
  <span id="close-sub-img">&times;</span>
  <img class="modal-content-sub-img" id="img01">
</div>
<div class="container" style="margin-top: 40px">
  <div class="row">
    <div class="col-md-12 text-center">
      <p style="font-size: 16px">2017 - ENVERGO ERGONOMIA - CNPJ: 13.253.657/0001-02</p>
    </div>
  </div>
</div>

<div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar vídeo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Insira a URL do vídeo do Youtube aqui.</p>
        <input class="form-control" id="video-subatividade" type="url" name="video-subatividade">
      </div>
      <div class="modal-footer">
        <button id="salvar_video_btn" type="button" onclick="salvar_video(<?php echo $_GET['subatividade'] ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			echo( 0 );
		} else {
			echo( $_GET['analise_acomp'] );
		} ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			echo( 0 );
		} else {
			echo( 1 );
		} ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			echo( 0 );
		} else {
			echo( $_GET['analise_projetada'] );
		} ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			echo( 0 );
		} else {
			echo( 1 );
		} ?>)" style="cursor: pointer;" class="btn btn-primary">Enviar
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="empurrarModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Empurrar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="forca_i_e_e">Força inicial encontrada:</label>
            <div class="col-sm-5">
              <input type="number" value="<?php echo $empurrar->forca_i_e_e ?>" onchange="mudar_empurrar()" class="form-control" name="forca_i_e_e" id="forca_i_e_e" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="forca_m_e_e">Força mantida encontrada:</label>
            <div class="col-sm-5">
              <input type="number" value="<?php echo $empurrar->forca_m_e_e ?>" onchange="mudar_empurrar()" class="form-control" name="forca_m_e_e" id="forca_m_e_e" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="genero_e">Gênero:</label>
            <div class="col-sm-5">
              <select onchange="mudar_empurrar(0)" class="form-control" id='genero_e' name="genero_e" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="n" <?php if ( $empurrar->genero_e == 'n' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="homem" <?php if ( $empurrar->genero_e == 'homem' ) {
					echo( 'selected' );
				} ?>>homem
                </option>
                <option value="mulher" <?php if ( $empurrar->genero_e == 'mulher' ) {
					echo( 'selected' );
				} ?>>mulher
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="d_v_c_m">Distância vertical do chão para mãos:</label>
            <div class="col-sm-5">
              <select onchange="mudar_empurrar(0)" class="form-control" id='d_v_c_m' name="d_v_c_m" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $empurrar->d_v_c_m == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="64" <?php if ( $empurrar->d_v_c_m == '64' ) {
					echo( 'selected' );
				} ?>>64 cm
                </option>
                <option value="95" <?php if ( $empurrar->d_v_c_m == '95' ) {
					echo( 'selected' );
				} ?>>95 cm
                </option>
                <option value="144" <?php if ( $empurrar->d_v_c_m == '144' ) {
					echo( 'selected' );
				} ?>>144 cm
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="p_p_i">Percentil desejado de população industrial:</label>
            <div class="col-sm-5">
              <select onchange="mudar_empurrar(0)" class="form-control" id='p_p_i' name="p_p_i" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $empurrar->p_p_i == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="10" <?php if ( $empurrar->p_p_i == '10' ) {
					echo( 'selected' );
				} ?>>10%
                </option>
                <option value="25" <?php if ( $empurrar->p_p_i == '25' ) {
					echo( 'selected' );
				} ?>>25%
                </option>
                <option value="50" <?php if ( $empurrar->p_p_i == '50' ) {
					echo( 'selected' );
				} ?>>50%
                </option>
                <option value="75" <?php if ( $empurrar->p_p_i == '75' ) {
					echo( 'selected' );
				} ?>>75%
                </option>
                <option value="90" <?php if ( $empurrar->p_p_i == '90' ) {
					echo( 'selected' );
				} ?>>90%
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="distancia_e">Distância:</label>
            <div class="col-sm-5">
              <select onchange="mudar_empurrar(1)" class="form-control" id='distancia_e' name="distancia_e" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $empurrar->distancia_e == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="2.1" <?php if ( $empurrar->distancia_e == '2.1' ) {
					echo( 'selected' );
				} ?>>2,1m
                </option>
                <option value="7.6" <?php if ( $empurrar->distancia_e == '7.6' ) {
					echo( 'selected' );
				} ?>>7,6m
                </option>
                <option value="15.2" <?php if ( $empurrar->distancia_e == '15.2' ) {
					echo( 'selected' );
				} ?>>15,2m
                </option>
                <option value="30.5" <?php if ( $empurrar->distancia_e == '30.5' ) {
					echo( 'selected' );
				} ?>>30,5m
                </option>
                <option value="45.7" <?php if ( $empurrar->distancia_e == '45.7' ) {
					echo( 'selected' );
				} ?>>45,7m
                </option>
                <option value="61" <?php if ( $empurrar->distancia_e == '61' ) {
					echo( 'selected' );
				} ?>>61m
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="frequencia_e">Freqüência - Uma vez a cada:</label>
            <div class="col-sm-5">
              <select onchange="mudar_empurrar(0)" class="form-control" id='frequencia_e' name="frequencia_e" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $empurrar->frequencia_e == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option class="remover" value="5s" <?php if ( $empurrar->frequencia_e == '5s' ) {
					echo( 'selected' );
				} ?>>5s
                </option>
                <option class="remover" value="12s" <?php if ( $empurrar->frequencia_e == '12s' ) {
					echo( 'selected' );
				} ?>>12s
                </option>
                <option class="remover-3" value="1m" <?php if ( $empurrar->frequencia_e == '1m' ) {
					echo( 'selected' );
				} ?>>1m
                </option>
                <option value="2m" <?php if ( $empurrar->frequencia_e == '2m' ) {
					echo( 'selected' );
				} ?>>2m
                </option>
                <option value="5m" <?php if ( $empurrar->frequencia_e == '5m' ) {
					echo( 'selected' );
				} ?>>5m
                </option>
                <option value="30m" <?php if ( $empurrar->frequencia_e == '30m' ) {
					echo( 'selected' );
				} ?>>30m
                </option>
                <option value="8h" <?php if ( $empurrar->frequencia_e == '8h' ) {
					echo( 'selected' );
				} ?>>8h
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="f_i_m">Força para iniciar o movimento:</label>
            <div class="col-sm-5">
              <p id="f_i_m"><?php echo $empurrar->forca_i_m ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="f_m_m">Força para manter o objeto em movimento:</label>
            <div class="col-sm-5">
              <p id="f_m_m"><?php echo $empurrar->forca_m_m ?></p>
            </div>
          </div>
	        <?php if ( in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) { ?>

          <button id="salvar_empurrar_btn" type="button" onclick="salvar_empurrar(<?php echo $_GET['subatividade'] ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_acomp'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_projetada'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>)" style="cursor: pointer; float: right;" class="btn btn-primary">Salvar
          </button>
          <button type="button" onclick="limpar_empurrar(<?php echo $_GET['subatividade'] ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_acomp'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_projetada'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>)" style="cursor: pointer; float: right; margin-right: 10px" class="btn btn-secondary">Limpar
          </button>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="puxarModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Puxar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="forca_i_e_e">Força inicial encontrada:</label>
            <div class="col-sm-5">
              <input type="number" value="<?php echo $puxar->forca_i_e_p ?>" onchange="mudar_puxar()" class="form-control" name="forca_i_e_p" id="forca_i_e_p" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="forca_m_e_p">Força mantida encontrada:</label>
            <div class="col-sm-5">
              <input type="number" value="<?php echo $puxar->forca_m_e_p ?>" onchange="mudar_puxar()" class="form-control" name="forca_m_e_p" id="forca_m_e_p" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="genero_p">Gênero:</label>
            <div class="col-sm-5">
              <select onchange="mudar_puxar(0)" class="form-control" id='genero_p' name="genero_p" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="n" <?php if ( $puxar->genero_p == 'n' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="homem" <?php if ( $puxar->genero_p == 'homem' ) {
					echo( 'selected' );
				} ?>>homem
                </option>
                <option value="mulher" <?php if ( $puxar->genero_p == 'mulher' ) {
					echo( 'selected' );
				} ?>>mulher
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="d_v_c_m_p">Distância vertical do chão para mãos:</label>
            <div class="col-sm-5">
              <select onchange="mudar_puxar(0)" class="form-control" id='d_v_c_m_p' name="d_v_c_m_p" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $puxar->d_v_c_m_p == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="64" <?php if ( $puxar->d_v_c_m_p == '64' ) {
					echo( 'selected' );
				} ?>>64 cm
                </option>
                <option value="95" <?php if ( $puxar->d_v_c_m_p == '95' ) {
					echo( 'selected' );
				} ?>>95 cm
                </option>
                <option value="144" <?php if ( $puxar->d_v_c_m_p == '144' ) {
					echo( 'selected' );
				} ?>>144 cm
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="p_p_i_p">Percentil desejado de população industrial:</label>
            <div class="col-sm-5">
              <select onchange="mudar_puxar(0)" class="form-control" id='p_p_i_p' name="p_p_i_p" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $puxar->p_p_i_p == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="10" <?php if ( $puxar->p_p_i_p == '10' ) {
					echo( 'selected' );
				} ?>>10%
                </option>
                <option value="25" <?php if ( $puxar->p_p_i_p == '25' ) {
					echo( 'selected' );
				} ?>>25%
                </option>
                <option value="50" <?php if ( $puxar->p_p_i_p == '50' ) {
					echo( 'selected' );
				} ?>>50%
                </option>
                <option value="75" <?php if ( $puxar->p_p_i_p == '75' ) {
					echo( 'selected' );
				} ?>>75%
                </option>
                <option value="90" <?php if ( $puxar->p_p_i_p == '90' ) {
					echo( 'selected' );
				} ?>>90%
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="distancia_p">Distância:</label>
            <div class="col-sm-5">
              <select onchange="mudar_puxar(1)" class="form-control" id='distancia_p' name="distancia_p" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $puxar->distancia_p == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="2.1" <?php if ( $puxar->distancia_p == '2.1' ) {
					echo( 'selected' );
				} ?>>2,1m
                </option>
                <option value="7.6" <?php if ( $puxar->distancia_p == '7.6' ) {
					echo( 'selected' );
				} ?>>7,6m
                </option>
                <option value="15.2" <?php if ( $puxar->distancia_p == '15.2' ) {
					echo( 'selected' );
				} ?>>15,2m
                </option>
                <option value="30.5" <?php if ( $puxar->distancia_p == '30.5' ) {
					echo( 'selected' );
				} ?>>30,5m
                </option>
                <option value="45.7" <?php if ( $puxar->distancia_p == '45.7' ) {
					echo( 'selected' );
				} ?>>45,7m
                </option>
                <option value="61" <?php if ( $puxar->distancia_p == '61' ) {
					echo( 'selected' );
				} ?>>61m
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="frequencia_p">Freqüência - Uma vez a cada:</label>
            <div class="col-sm-5">
              <select onchange="mudar_puxar(0)" class="form-control" id='frequencia_p' name="frequencia_p" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $puxar->frequencia_p == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option class="remover" value="5s" <?php if ( $puxar->frequencia_p == '5s' ) {
					echo( 'selected' );
				} ?>>5s
                </option>
                <option class="remover" value="12s" <?php if ( $puxar->frequencia_p == '12s' ) {
					echo( 'selected' );
				} ?>>12s
                </option>
                <option class="remover-3" value="1m" <?php if ( $puxar->frequencia_p == '1m' ) {
					echo( 'selected' );
				} ?>>1m
                </option>
                <option value="2m" <?php if ( $puxar->frequencia_p == '2m' ) {
					echo( 'selected' );
				} ?>>2m
                </option>
                <option value="5m" <?php if ( $puxar->frequencia_p == '5m' ) {
					echo( 'selected' );
				} ?>>5m
                </option>
                <option value="30m" <?php if ( $puxar->frequencia_p == '30m' ) {
					echo( 'selected' );
				} ?>>30m
                </option>
                <option value="8h" <?php if ( $puxar->frequencia_p == '8h' ) {
					echo( 'selected' );
				} ?>>8h
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="f_a_o_m">Força para adquirir o objeto em movimento:</label>
            <div class="col-sm-5">
              <p id="f_a_o_m"><?php echo $puxar->f_a_o_m ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="f_m_m_p">Força para manter o objeto em movimento:</label>
            <div class="col-sm-5">
              <p id="f_m_m_p"><?php echo $puxar->f_m_m_p ?></p>
            </div>
          </div>
	        <?php if ( in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) { ?>

          <button id="salvar_puxar_btn" type="button" onclick="salvar_puxar(<?php echo $_GET['subatividade'] ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_acomp'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_projetada'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>)" style="cursor: pointer; float: right;" class="btn btn-primary">Salvar
          </button>
          <button type="button" onclick="limpar_puxar(<?php echo $_GET['subatividade'] ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_acomp'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_projetada'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>)" style="cursor: pointer; float: right; margin-right: 10px" class="btn btn-secondary">Limpar
          </button>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="transportarModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Transportar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="peso_i_e">Peso inicial encontrado:</label>
            <div class="col-sm-5">
              <input type="number" value="<?php echo $transportar->peso_i_e ?>" onchange="mudar_tranportar()" class="form-control" name="peso_i_e" id="peso_i_e" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="genero_t">Gênero:</label>
            <div class="col-sm-5">
              <select onchange="mudar_tranportar()" class="form-control" id='genero_t' name="genero_t" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="n" <?php if ( $transportar->genero_t == 'n' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="homem" <?php if ( $transportar->genero_t == 'homem' ) {
					echo( 'selected' );
				} ?>>homem
                </option>
                <option value="mulher" <?php if ( $transportar->genero_t == 'mulher' ) {
					echo( 'selected' );
				} ?>>mulher
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="d_v_c_m_t">Distância vertical do chão para mãos:</label>
            <div class="col-sm-5">
              <select onchange="mudar_tranportar()" class="form-control" id='d_v_c_m_t' name="d_v_c_m_t" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $transportar->d_v_c_m_t == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option id="79" value="79" <?php if ( $transportar->d_v_c_m_t == '79' ) {
					echo( 'selected' );
				} ?>>79
                </option>
                <option id="111" value="111" <?php if ( $transportar->d_v_c_m_t == '111' ) {
					echo( 'selected' );
				} ?>>111
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="p_p_i_t">Percentil desejado de população industrial:</label>
            <div class="col-sm-5">
              <select onchange="mudar_tranportar()" class="form-control" id='p_p_i_t' name="p_p_i_t" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $transportar->p_p_i_t == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="10" <?php if ( $transportar->p_p_i_t == '10' ) {
					echo( 'selected' );
				} ?>>10%
                </option>
                <option value="25" <?php if ( $transportar->p_p_i_t == '25' ) {
					echo( 'selected' );
				} ?>>25%
                </option>
                <option value="50" <?php if ( $transportar->p_p_i_t == '50' ) {
					echo( 'selected' );
				} ?>>50%
                </option>
                <option value="75" <?php if ( $transportar->p_p_i_t == '75' ) {
					echo( 'selected' );
				} ?>>75%
                </option>
                <option value="90" <?php if ( $transportar->p_p_i_t == '90' ) {
					echo( 'selected' );
				} ?>>90%
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="distancia_t">Distância:</label>
            <div class="col-sm-5">
              <select onchange="mudar_tranportar()" class="form-control" id='distancia_t' name="distancia_t" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $transportar->distancia_t == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="2.1" <?php if ( $transportar->distancia_t == '2.1' ) {
					echo( 'selected' );
				} ?>>2,1m
                </option>
                <option value="4.3" <?php if ( $transportar->distancia_t == '4.3' ) {
					echo( 'selected' );
				} ?>>4,3m
                </option>
                <option value="8.5" <?php if ( $transportar->distancia_t == '8.5' ) {
					echo( 'selected' );
				} ?>>8,5m
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="frequencia_t">Freqüência - Uma vez a cada:</label>
            <div class="col-sm-5">
              <select onchange="mudar_tranportar()" class="form-control" id='frequencia_t' name="frequencia_t" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
                <option value="0" <?php if ( $transportar->frequencia_t == '0' ) {
					echo( 'selected' );
				} ?>></option>
                <option value="6s" <?php if ( $transportar->frequencia_t == '6s' ) {
					echo( 'selected' );
				} ?>>6s
                </option>
                <option value="12s" <?php if ( $transportar->frequencia_t == '12s' ) {
					echo( 'selected' );
				} ?>>12s
                </option>
                <option value="1m" <?php if ( $transportar->frequencia_t == '1m' ) {
					echo( 'selected' );
				} ?>>1m
                </option>
                <option value="2m" <?php if ( $transportar->frequencia_t == '2m' ) {
					echo( 'selected' );
				} ?>>2m
                </option>
                <option value="5m" <?php if ( $transportar->frequencia_t == '5m' ) {
					echo( 'selected' );
				} ?>>5m
                </option>
                <option value="30m" <?php if ( $transportar->frequencia_t == '30m' ) {
					echo( 'selected' );
				} ?>>30m
                </option>
                <option value="8h" <?php if ( $transportar->frequencia_t == '8h' ) {
					echo( 'selected' );
				} ?>>8h
                </option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-7 col-form-label" for="p_m_a_c">Peso máximo aceitável para carregar:</label>
            <div class="col-sm-5">
              <p id="p_m_a_c"><?php echo $transportar->p_m_a_c ?></p>
            </div>
          </div>
	        <?php if ( in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) { ?>

          <button id="salvar_transportar_btn" type="button" onclick="salvar_transportar(<?php echo $_GET['subatividade'] ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_acomp'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_projetada'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>)" style="cursor: pointer; float: right;" class="btn btn-primary">Salvar
          </button>
          <button type="button" onclick="limpar_transportar(<?php echo $_GET['subatividade'] ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_acomp'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( $_GET['analise_projetada'] );
		  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
			  echo( 0 );
		  } else {
			  echo( 1 );
		  } ?>)" style="cursor: pointer; float: right; margin-right: 10px" class="btn btn-secondary">Limpar
          </button>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="arquivosModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Arquivos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="arquivo_container">
			<?php while ( $arquivo = mysqli_fetch_object( $result_arquivo ) ) { ?>
              <div class="row" style="margin-bottom: 20px">
                <div class="col-10">
                  <a href="uploads/<?php echo $arquivo->midia; ?>"><?php echo str_replace( "../uploads/", "", $arquivo->midia ); ?></a>
                </div>
                <div class="col-2">
	                <?php if ( in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) { ?>

                  <span onclick="excluir_arquivo_btn(<?php echo $arquivo->id; ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
					  echo( $_GET['subatividade'] );
				  } else {
					  echo( $_GET['analise_acomp'] );
				  } ?>, <?php if ( ! isset( $_GET['analise_acomp'] ) ) {
					  echo( 0 );
				  } else {
					  echo( 1 );
				  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
					  echo( 0 );
				  } else {
					  echo( $_GET['analise_projetada'] );
				  } ?>, <?php if ( ! isset( $_GET['analise_projetada'] ) ) {
					  echo( 0 );
				  } else {
					  echo( 1 );
				  } ?>)" class="excluir-arquivo" id="<?php echo $arquivo->id; ?>" aria-hidden="true">&times;</span>
                  <?php } ?>
                </div>
              </div>
			<?php } ?>
        </div>
        <form id="sub_arquivo_form" method="POST" enctype="multipart/form-data">
          <input style="display: none" name="sub_arquivo" id="sub_arquivo" type="file"/>
			<?php if ( isset( $_GET['analise_acomp'] ) ) { ?>
              <input type="hidden" id="sub_id" name="sub_id" value="<?php echo $_GET['analise_acomp'] ?>">
              <input type="hidden" id="operacao_sub" value="arquivo" name="operacao_sub">
              <input type="hidden" id="operacao_sub_acomp" value="1" name="operacao_sub_acomp">
              <input type="hidden" id="operacao_sub_proj" value="0" name="operacao_sub_proj">
			<?php } else if ( isset( $_GET['analise_projetada'] ) ) { ?>
              <input type="hidden" id="sub_id_proj" name="sub_id_proj" value="<?php echo $_GET['subatividade'] ?>">
              <input type="hidden" id="sub_id" name="sub_id" value="<?php echo $_GET['analise_projetada'] ?>">
              <input type="hidden" id="operacao_sub" value="arquivo" name="operacao_sub">
              <input type="hidden" id="operacao_sub_proj" value="1" name="operacao_sub_proj">
              <input type="hidden" id="operacao_sub_acomp" value="0" name="operacao_sub_acomp">
			<?php } else { ?>
              <input type="hidden" id="sub_id" name="sub_id" value="<?php echo $_GET['subatividade'] ?>">
              <input type="hidden" id="operacao_sub" value="arquivo" name="operacao_sub">
              <input type="hidden" id="operacao_sub_proj" value="0" name="operacao_sub_proj">
              <input type="hidden" id="operacao_sub_acomp" value="0" name="operacao_sub_acomp">
			<?php } ?>
        </form>
	      <?php if ( in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) { ?>
          <button id="add-arquivo" type="button" style="cursor: pointer; float: right; margin-top: 10px" class="btn btn-primary">Anexar</button>

	      <?php }else{
		      echo "<div style='display: inline-block;height:36px; width: 90px;float: right'></div>";
	      } ?>
      </div>
    </div>
  </div>
</div>

</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
<script type="text/javascript" src="assets/js/validation.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/levantar_baixar.js"></script>
<script type="text/javascript" src="assets/js/empurrar.js"></script>
<script type="text/javascript" src="assets/js/puxar.js"></script>
<script type="text/javascript" src="assets/js/transportar.js"></script>
</html>
