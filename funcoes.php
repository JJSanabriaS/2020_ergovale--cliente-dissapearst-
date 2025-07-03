<?php
$sql = "SELECT risco_ambiental, risco_organizacional, risco_psci_cog FROM funcoes WHERE id_funcao = ".$_GET['funcao'];
$result = mysqli_fetch_object(executeQuery($sql));
$risco_ambiental = json_decode($result->risco_ambiental);
$risco_organizacional = json_decode($result->risco_organizacional);
$risco_psci_cog = json_decode($result->risco_psci_cog);
?>
<?php
$sql = "SELECT nome FROM funcoes WHERE id_funcao = ".$_GET['funcao'];
$funcao = mysqli_fetch_array(executeQuery($sql));
/*if ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) {
  redirect('index.php?page=main');
}*/
?>
<?php require_once('topo.php') ?>
<button type="button" class="btn btn-sm btn-info" onclick="location.href='?page=main'" style="margin-left:15px"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</button>
<button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#parametroModal"><i class="fa fa-question-circle-o" aria-hidden="true"></i>
	Info
</button>
<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#matrizModal"><i class="fa fa-bars" aria-hidden="true"></i>
	Matriz
</button>
<div class="container">
	<div class="row">
		<h2 style="padding: 23px 0px; font-size: 32px; font-weight: 440"><?php echo $funcao['nome'] ?></h2>
	</div>
	<div class="row">
		<h3 style="padding-bottom: 30px; font-size: 21px; font-weight: 440">Avaliação dos riscos Ambientais/Ocupacionais</h3>
	</div>
	<div class="row" style="margin-bottom: 50px">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Risco Ambiental</th>
					<th style="width: 141px; text-align: center;">Valor obtido</th>
					<th style="width: 108px">Severidade</th>
					<th style="width: 210px">Frequencia/Probabilidade</th>
					<th style="width: 65px">Risco</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Ruído<br><span style="font-size: 15px;">Índice: não superior a 65dB</span></td>
					<td style="display: flex; width: 140px">
						<input value="<?php echo($risco_ambiental->ruido) ?>" class="form-control col-8" type="number" id="ruido" name="ruido" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>><p style="position: relative; top: 6px; left: 14px">dB</p>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(1)" id="risco_amb_severidade_1" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_severidade_1 == "n"){echo("selected");} ?> value="n"></option>
							<option <?php if($risco_ambiental->risco_amb_severidade_1 == "a"){echo("selected");} ?> value="a">A</option>
							<option <?php if($risco_ambiental->risco_amb_severidade_1 == "b"){echo("selected");} ?> value="b">B</option>
							<option <?php if($risco_ambiental->risco_amb_severidade_1 == "c"){echo("selected");} ?> value="c">C</option>
							<option <?php if($risco_ambiental->risco_amb_severidade_1 == "d"){echo("selected");} ?> value="d">D</option>
							<option <?php if($risco_ambiental->risco_amb_severidade_1 == "e"){echo("selected");} ?> value="e">E</option>
						</select>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(1)" id="risco_amb_freq_1" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_freq_1 == "0"){echo("selected");} ?> value="0"></option>
							<option <?php if($risco_ambiental->risco_amb_freq_1 == "1"){echo("selected");} ?> value="1">1</option>
							<option <?php if($risco_ambiental->risco_amb_freq_1 == "2"){echo("selected");} ?> value="2">2</option>
							<option <?php if($risco_ambiental->risco_amb_freq_1 == "3"){echo("selected");} ?> value="3">3</option>
							<option <?php if($risco_ambiental->risco_amb_freq_1 == "4"){echo("selected");} ?> value="4">4</option>
							<option <?php if($risco_ambiental->risco_amb_freq_1 == "5"){echo("selected");} ?> value="5">5</option>
						</select>
					</td>
					<td <?php if($risco_ambiental->risco_amb_risco_1 == "4" || $risco_ambiental->risco_amb_risco_1 == "6" || $risco_ambiental->risco_amb_risco_1 == "8" || $risco_ambiental->risco_amb_risco_1 == "10" || $risco_ambiental->risco_amb_risco_1 == "12" || $risco_ambiental->risco_amb_risco_1 == "16" || $risco_ambiental->risco_amb_risco_1 == "18" || $risco_ambiental->risco_amb_risco_1 == "20" || $risco_ambiental->risco_amb_risco_1 == "22" || $risco_ambiental->risco_amb_risco_1 == "24"){echo("style='background-color: #3bef50'");}else if($risco_ambiental->risco_amb_risco_1=="32" || $risco_ambiental->risco_amb_risco_1=="36" || $risco_ambiental->risco_amb_risco_1=="40" || $risco_ambiental->risco_amb_risco_1=="44" || $risco_ambiental->risco_amb_risco_1=="48" || $risco_ambiental->risco_amb_risco_1=="64" || $risco_ambiental->risco_amb_risco_1=="72" || $risco_ambiental->risco_amb_risco_1=="80" || $risco_ambiental->risco_amb_risco_1=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_ambiental->risco_amb_risco_1=="96" || $risco_ambiental->risco_amb_risco_1=="144" || $risco_ambiental->risco_amb_risco_1=="160" || $risco_ambiental->risco_amb_risco_1=="176"){echo("style='background-color: #e84747'");}else if($risco_ambiental->risco_amb_risco_1=="288" || $risco_ambiental->risco_amb_risco_1 == "352"){echo("style='background-color: #9940dd'");}else if($risco_ambiental->risco_amb_risco_1==""){echo("style='background-color: #fff'");} ?>><p id="risco_amb_risco_1" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_ambiental->risco_amb_risco_1; ?></p></td>
				</tr>
				<tr>
					<td>Temperatura<br><span style="font-size: 15px;">Índice: temperatura entre 20ºC a 22ºC</span></td>
					<td style="display: flex; width: 140px">
						<input value="<?php echo($risco_ambiental->temperatura) ?>" class="form-control col-8" type="number" id="temperatura" name="temperatura" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>><p style="position: relative; top: 6px; left: 14px">ºC</p>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(2)" id="risco_amb_severidade_2" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_severidade_2 == "n"){echo("selected");} ?> value="n"></option>
							<option value="a" <?php if($risco_ambiental->risco_amb_severidade_2 == "a"){echo("selected");} ?>>A</option>
							<option value="b" <?php if($risco_ambiental->risco_amb_severidade_2 == "b"){echo("selected");} ?>>B</option>
							<option value="c" <?php if($risco_ambiental->risco_amb_severidade_2 == "c"){echo("selected");} ?>>C</option>
							<option value="d" <?php if($risco_ambiental->risco_amb_severidade_2 == "d"){echo("selected");} ?>>D</option>
							<option value="e" <?php if($risco_ambiental->risco_amb_severidade_2 == "e"){echo("selected");} ?>>E</option>
						</select>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(2)" id="risco_amb_freq_2" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_freq_2 == "0"){echo("selected");} ?> value="0"></option>
							<option value="1" <?php if($risco_ambiental->risco_amb_freq_2 == "1"){echo("selected");} ?>>1</option>
							<option value="2" <?php if($risco_ambiental->risco_amb_freq_2 == "2"){echo("selected");} ?>>2</option>
							<option value="3" <?php if($risco_ambiental->risco_amb_freq_2 == "3"){echo("selected");} ?>>3</option>
							<option value="4" <?php if($risco_ambiental->risco_amb_freq_2 == "4"){echo("selected");} ?>>4</option>
							<option value="5" <?php if($risco_ambiental->risco_amb_freq_2 == "5"){echo("selected");} ?>>5</option>
						</select>
					</td>
					<td <?php if($risco_ambiental->risco_amb_risco_2 == "4" || $risco_ambiental->risco_amb_risco_2 == "6" || $risco_ambiental->risco_amb_risco_2 == "8" || $risco_ambiental->risco_amb_risco_2 == "10" || $risco_ambiental->risco_amb_risco_2 == "12" || $risco_ambiental->risco_amb_risco_2 == "16" || $risco_ambiental->risco_amb_risco_2 == "18" || $risco_ambiental->risco_amb_risco_2 == "20" || $risco_ambiental->risco_amb_risco_2 == "22" || $risco_ambiental->risco_amb_risco_2 == "24"){echo("style='background-color: #3bef50'");}else if($risco_ambiental->risco_amb_risco_2=="32" || $risco_ambiental->risco_amb_risco_2=="36" || $risco_ambiental->risco_amb_risco_2=="40" || $risco_ambiental->risco_amb_risco_2=="44" || $risco_ambiental->risco_amb_risco_2=="48" || $risco_ambiental->risco_amb_risco_2=="64" || $risco_ambiental->risco_amb_risco_2=="72" || $risco_ambiental->risco_amb_risco_2=="80" || $risco_ambiental->risco_amb_risco_2=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_ambiental->risco_amb_risco_2=="96" || $risco_ambiental->risco_amb_risco_2=="144" || $risco_ambiental->risco_amb_risco_2=="160" || $risco_ambiental->risco_amb_risco_2=="176"){echo("style='background-color: #e84747'");}else if($risco_ambiental->risco_amb_risco_2=="288" || $risco_ambiental->risco_amb_risco_2 == "352"){echo("style='background-color: #9940dd'");}else if($risco_ambiental->risco_amb_risco_2==""){echo("style='background-color: #fff'");} ?>><p id="risco_amb_risco_2" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_ambiental->risco_amb_risco_2; ?></p>
					</td>
				</tr>
				<tr>
					<td>Velocidade do Ar<br><span style="font-size: 15px;">Índice: não superior a 0,75m/s</span></td>
					<td style="display: flex; width: 140px">
						<input value="<?php echo($risco_ambiental->velocidade_do_ar) ?>" class="form-control col-8" type="number" step="0.01" id="velocidade_do_ar" name="velocidade_do_ar" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>><p style="position: relative; top: 6px; left: 10px">m/s</p>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(3)" id="risco_amb_severidade_3" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_severidade_3 == "n"){echo("selected");} ?> value="n"></option>
							<option value="a" <?php if($risco_ambiental->risco_amb_severidade_3 == "a"){echo("selected");} ?>>A</option>
							<option value="b" <?php if($risco_ambiental->risco_amb_severidade_3 == "b"){echo("selected");} ?>>B</option>
							<option value="c" <?php if($risco_ambiental->risco_amb_severidade_3 == "c"){echo("selected");} ?>>C</option>
							<option value="d" <?php if($risco_ambiental->risco_amb_severidade_3 == "d"){echo("selected");} ?>>D</option>
							<option value="e" <?php if($risco_ambiental->risco_amb_severidade_3 == "e"){echo("selected");} ?>>E</option>
						</select>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(3)" id="risco_amb_freq_3" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_freq_3 == "0"){echo("selected");} ?> value="0"></option>
							<option value="1" <?php if($risco_ambiental->risco_amb_freq_3 == "1"){echo("selected");} ?>>1</option>
							<option value="2" <?php if($risco_ambiental->risco_amb_freq_3 == "2"){echo("selected");} ?>>2</option>
							<option value="3" <?php if($risco_ambiental->risco_amb_freq_3 == "3"){echo("selected");} ?>>3</option>
							<option value="4" <?php if($risco_ambiental->risco_amb_freq_3 == "4"){echo("selected");} ?>>4</option>
							<option value="5" <?php if($risco_ambiental->risco_amb_freq_3 == "5"){echo("selected");} ?>>5</option>
						</select>
					</td>
					<td <?php if($risco_ambiental->risco_amb_risco_3 == "4" || $risco_ambiental->risco_amb_risco_3 == "6" || $risco_ambiental->risco_amb_risco_3 == "8" || $risco_ambiental->risco_amb_risco_3 == "10" || $risco_ambiental->risco_amb_risco_3 == "12" || $risco_ambiental->risco_amb_risco_3 == "16" || $risco_ambiental->risco_amb_risco_3 == "18" || $risco_ambiental->risco_amb_risco_3 == "20" || $risco_ambiental->risco_amb_risco_3 == "22" || $risco_ambiental->risco_amb_risco_3 == "24"){echo("style='background-color: #3bef50'");}else if($risco_ambiental->risco_amb_risco_3=="32" || $risco_ambiental->risco_amb_risco_3=="36" || $risco_ambiental->risco_amb_risco_3=="40" || $risco_ambiental->risco_amb_risco_3=="44" || $risco_ambiental->risco_amb_risco_3=="48" || $risco_ambiental->risco_amb_risco_3=="64" || $risco_ambiental->risco_amb_risco_3=="72" || $risco_ambiental->risco_amb_risco_3=="80" || $risco_ambiental->risco_amb_risco_3=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_ambiental->risco_amb_risco_3=="96" || $risco_ambiental->risco_amb_risco_3=="144" || $risco_ambiental->risco_amb_risco_3=="160" || $risco_ambiental->risco_amb_risco_3=="176"){echo("style='background-color: #e84747'");}else if($risco_ambiental->risco_amb_risco_3=="288" || $risco_ambiental->risco_amb_risco_3 == "352"){echo("style='background-color: #9940dd'");}else if($risco_ambiental->risco_amb_risco_3==""){echo("style='background-color: #fff'");} ?>><p id="risco_amb_risco_3" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_ambiental->risco_amb_risco_3; ?></p>
					</td>
				</tr>
				<tr>
					<td>Umidade Relativa do Ar<br><span style="font-size: 15px;">Índice: não inferior a 40%</span></td>
					<td style="display: flex; width: 140px">
						<input value="<?php echo($risco_ambiental->umidade_relativa_do_ar) ?>" class="form-control col-8" type="number" id="umidade_relativa_do_ar" name="umidade_relativa_do_ar" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>><p style="position: relative; top: 6px; left: 15px">%</p>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(4)" id="risco_amb_severidade_4" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_severidade_4 == "n"){echo("selected");} ?> value="n"></option>
							<option value="a" <?php if($risco_ambiental->risco_amb_severidade_4 == "a"){echo("selected");} ?>>A</option>
							<option value="b" <?php if($risco_ambiental->risco_amb_severidade_4 == "b"){echo("selected");} ?>>B</option>
							<option value="c" <?php if($risco_ambiental->risco_amb_severidade_4 == "c"){echo("selected");} ?>>C</option>
							<option value="d" <?php if($risco_ambiental->risco_amb_severidade_4 == "d"){echo("selected");} ?>>D</option>
							<option value="e" <?php if($risco_ambiental->risco_amb_severidade_4 == "e"){echo("selected");} ?>>E</option>
						</select>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(4)" id="risco_amb_freq_4" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_freq_4 == "0"){echo("selected");} ?> value="0"></option>
							<option value="1" <?php if($risco_ambiental->risco_amb_freq_4 == "1"){echo("selected");} ?>>1</option>
							<option value="2" <?php if($risco_ambiental->risco_amb_freq_4 == "2"){echo("selected");} ?>>2</option>
							<option value="3" <?php if($risco_ambiental->risco_amb_freq_4 == "3"){echo("selected");} ?>>3</option>
							<option value="4" <?php if($risco_ambiental->risco_amb_freq_4 == "4"){echo("selected");} ?>>4</option>
							<option value="5" <?php if($risco_ambiental->risco_amb_freq_4 == "5"){echo("selected");} ?>>5</option>
						</select>
					</td>
					<td <?php if($risco_ambiental->risco_amb_risco_4 == "4" || $risco_ambiental->risco_amb_risco_4 == "6" || $risco_ambiental->risco_amb_risco_4 == "8" || $risco_ambiental->risco_amb_risco_4 == "10" || $risco_ambiental->risco_amb_risco_4 == "12" || $risco_ambiental->risco_amb_risco_4 == "16" || $risco_ambiental->risco_amb_risco_4 == "18" || $risco_ambiental->risco_amb_risco_4 == "20" || $risco_ambiental->risco_amb_risco_4 == "22" || $risco_ambiental->risco_amb_risco_4 == "24"){echo("style='background-color: #3bef50'");}else if($risco_ambiental->risco_amb_risco_4=="32" || $risco_ambiental->risco_amb_risco_4=="36" || $risco_ambiental->risco_amb_risco_4=="40" || $risco_ambiental->risco_amb_risco_4=="44" || $risco_ambiental->risco_amb_risco_4=="48" || $risco_ambiental->risco_amb_risco_4=="64" || $risco_ambiental->risco_amb_risco_4=="72" || $risco_ambiental->risco_amb_risco_4=="80" || $risco_ambiental->risco_amb_risco_4=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_ambiental->risco_amb_risco_4=="96" || $risco_ambiental->risco_amb_risco_4=="144" || $risco_ambiental->risco_amb_risco_4=="160" || $risco_ambiental->risco_amb_risco_4=="176"){echo("style='background-color: #e84747'");}else if($risco_ambiental->risco_amb_risco_4=="288" || $risco_ambiental->risco_amb_risco_4 == "352"){echo("style='background-color: #9940dd'");}else if($risco_ambiental->risco_amb_risco_4==""){echo("style='background-color: #fff'");} ?>><p id="risco_amb_risco_4" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_ambiental->risco_amb_risco_4; ?></p>
					</td>
				</tr>
				<tr>
					<td>Luminância<br><span style="font-size: 15px;">Índice: NBR 5413</span></td>
					<td style="display: flex; width: 140px">
						<input value="<?php echo($risco_ambiental->luminancia) ?>" class="form-control col-8" type="number" id="luminancia" name="luminancia" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>><p style="position: relative; top: 6px; left: 14px">lux</p>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(5)" id="risco_amb_severidade_5" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_severidade_5 == "n"){echo("selected");} ?> value="n"></option>
							<option value="a" <?php if($risco_ambiental->risco_amb_severidade_5 == "a"){echo("selected");} ?>>A</option>
							<option value="b" <?php if($risco_ambiental->risco_amb_severidade_5 == "b"){echo("selected");} ?>>B</option>
							<option value="c" <?php if($risco_ambiental->risco_amb_severidade_5 == "c"){echo("selected");} ?>>C</option>
							<option value="d" <?php if($risco_ambiental->risco_amb_severidade_5 == "d"){echo("selected");} ?>>D</option>
							<option value="e" <?php if($risco_ambiental->risco_amb_severidade_5 == "e"){echo("selected");} ?>>E</option>
						</select>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(5)" id="risco_amb_freq_5" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_freq_5 == "0"){echo("selected");} ?> value="0"></option>
							<option value="1" <?php if($risco_ambiental->risco_amb_freq_5 == "1"){echo("selected");} ?>>1</option>
							<option value="2" <?php if($risco_ambiental->risco_amb_freq_5 == "2"){echo("selected");} ?>>2</option>
							<option value="3" <?php if($risco_ambiental->risco_amb_freq_5 == "3"){echo("selected");} ?>>3</option>
							<option value="4" <?php if($risco_ambiental->risco_amb_freq_5 == "4"){echo("selected");} ?>>4</option>
							<option value="5" <?php if($risco_ambiental->risco_amb_freq_5 == "5"){echo("selected");} ?>>5</option>
						</select>
					</td>
					<td <?php if($risco_ambiental->risco_amb_risco_5 == "4" || $risco_ambiental->risco_amb_risco_5 == "6" || $risco_ambiental->risco_amb_risco_5 == "8" || $risco_ambiental->risco_amb_risco_5 == "10" || $risco_ambiental->risco_amb_risco_5 == "12" || $risco_ambiental->risco_amb_risco_5 == "16" || $risco_ambiental->risco_amb_risco_5 == "18" || $risco_ambiental->risco_amb_risco_5 == "20" || $risco_ambiental->risco_amb_risco_5 == "22" || $risco_ambiental->risco_amb_risco_5 == "24"){echo("style='background-color: #3bef50'");}else if($risco_ambiental->risco_amb_risco_5=="32" || $risco_ambiental->risco_amb_risco_5=="36" || $risco_ambiental->risco_amb_risco_5=="40" || $risco_ambiental->risco_amb_risco_5=="44" || $risco_ambiental->risco_amb_risco_5=="48" || $risco_ambiental->risco_amb_risco_5=="64" || $risco_ambiental->risco_amb_risco_5=="72" || $risco_ambiental->risco_amb_risco_5=="80" || $risco_ambiental->risco_amb_risco_5=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_ambiental->risco_amb_risco_5=="96" || $risco_ambiental->risco_amb_risco_5=="144" || $risco_ambiental->risco_amb_risco_5=="160" || $risco_ambiental->risco_amb_risco_5=="176"){echo("style='background-color: #e84747'");}else if($risco_ambiental->risco_amb_risco_5=="288" || $risco_ambiental->risco_amb_risco_5 == "352"){echo("style='background-color: #9940dd'");}else if($risco_ambiental->risco_amb_risco_5==""){echo("style='background-color: #fff'");} ?>><p id="risco_amb_risco_5" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_ambiental->risco_amb_risco_5; ?></p>
					</td>
				</tr>
				<tr>
					<td>Vibração Mãos e Braços(VMB)<br><span style="font-size: 15px;">Índice: 0 a 2,5 aceitável / >2,5 a < 3,5 acima do nível de ação / 3,5 a 5,0 região de incerteza / > 5,0 acima do limite de exposição</span></td>
					<td style="display: flex; width: 140px">
						<input value="<?php echo($risco_ambiental->vibracao_maos_bracos) ?>" class="form-control col-8" type="number" step="0.1" id="vibracao_maos_bracos" name="vibracao_maos_bracos" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>><p style="position: relative; top: 6px; left: 9px">m/s²</p>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(17)" id="risco_amb_severidade_17" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_severidade_17 == "n"){echo("selected");} ?> value="n"></option>
							<option value="a" <?php if($risco_ambiental->risco_amb_severidade_17 == "a"){echo("selected");} ?>>A</option>
							<option value="b" <?php if($risco_ambiental->risco_amb_severidade_17 == "b"){echo("selected");} ?>>B</option>
							<option value="c" <?php if($risco_ambiental->risco_amb_severidade_17 == "c"){echo("selected");} ?>>C</option>
							<option value="d" <?php if($risco_ambiental->risco_amb_severidade_17 == "d"){echo("selected");} ?>>D</option>
							<option value="e" <?php if($risco_ambiental->risco_amb_severidade_17 == "e"){echo("selected");} ?>>E</option>
						</select>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(17)" id="risco_amb_freq_17" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_freq_17 == "0"){echo("selected");} ?> value="0"></option>
							<option value="1" <?php if($risco_ambiental->risco_amb_freq_17 == "1"){echo("selected");} ?>>1</option>
							<option value="2" <?php if($risco_ambiental->risco_amb_freq_17 == "2"){echo("selected");} ?>>2</option>
							<option value="3" <?php if($risco_ambiental->risco_amb_freq_17 == "3"){echo("selected");} ?>>3</option>
							<option value="4" <?php if($risco_ambiental->risco_amb_freq_17 == "4"){echo("selected");} ?>>4</option>
							<option value="5" <?php if($risco_ambiental->risco_amb_freq_17 == "5"){echo("selected");} ?>>5</option>
						</select>
					</td>
					<td <?php if($risco_ambiental->risco_amb_risco_17 == "4" || $risco_ambiental->risco_amb_risco_17 == "6" || $risco_ambiental->risco_amb_risco_17 == "8" || $risco_ambiental->risco_amb_risco_17 == "10" || $risco_ambiental->risco_amb_risco_17 == "12" || $risco_ambiental->risco_amb_risco_17 == "16" || $risco_ambiental->risco_amb_risco_17 == "18" || $risco_ambiental->risco_amb_risco_17 == "20" || $risco_ambiental->risco_amb_risco_17 == "22" || $risco_ambiental->risco_amb_risco_17 == "24"){echo("style='background-color: #3bef50'");}else if($risco_ambiental->risco_amb_risco_17=="32" || $risco_ambiental->risco_amb_risco_17=="36" || $risco_ambiental->risco_amb_risco_17=="40" || $risco_ambiental->risco_amb_risco_17=="44" || $risco_ambiental->risco_amb_risco_17=="48" || $risco_ambiental->risco_amb_risco_17=="64" || $risco_ambiental->risco_amb_risco_17=="72" || $risco_ambiental->risco_amb_risco_17=="80" || $risco_ambiental->risco_amb_risco_17=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_ambiental->risco_amb_risco_17=="96" || $risco_ambiental->risco_amb_risco_17=="144" || $risco_ambiental->risco_amb_risco_17=="160" || $risco_ambiental->risco_amb_risco_17=="176"){echo("style='background-color: #e84747'");}else if($risco_ambiental->risco_amb_risco_17=="288" || $risco_ambiental->risco_amb_risco_17 == "352"){echo("style='background-color: #9940dd'");}else if($risco_ambiental->risco_amb_risco_17==""){echo("style='background-color: #fff'");} ?>><p id="risco_amb_risco_17" style="text-align: center; margin: 0px; position: relative; top: 18px"><?php echo $risco_ambiental->risco_amb_risco_17; ?></p>
					</td>
				</tr>
				<tr>
					<td>Vibração Corpo Inteiro(VCI)<br><span style="font-size: 15px;">Índice: 0 a 0,5 aceitável / > 0,5 a < 0,9 acima do nível de ação / 0,9 a 1,1 / acima de 1,1 acima do limite de exposição</span></td>
					<td style="display: flex; width: 140px">
						<input value="<?php echo($risco_ambiental->vibracao_corpo_inteiro) ?>" class="form-control col-8" type="number" step="0.1" id="vibracao_corpo_inteiro" name="vibracao_corpo_inteiro" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>><p style="position: relative; top: 6px; left: 9px">m/s²</p>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(18)" id="risco_amb_severidade_18" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_severidade_18 == "n"){echo("selected");} ?> value="n"></option>
							<option value="a" <?php if($risco_ambiental->risco_amb_severidade_18 == "a"){echo("selected");} ?>>A</option>
							<option value="b"  <?php if($risco_ambiental->risco_amb_severidade_18 == "b"){echo("selected");} ?>>B</option>
							<option value="c"  <?php if($risco_ambiental->risco_amb_severidade_18 == "c"){echo("selected");} ?>>C</option>
							<option value="d"  <?php if($risco_ambiental->risco_amb_severidade_18 == "d"){echo("selected");} ?>>D</option>
							<option value="e"  <?php if($risco_ambiental->risco_amb_severidade_18 == "e"){echo("selected");} ?>>E</option>
						</select>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(18)" id="risco_amb_freq_18" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_ambiental->risco_amb_freq_18 == "0"){echo("selected");} ?> value="0"></option>
							<option value="1" <?php if($risco_ambiental->risco_amb_freq_18 == "1"){echo("selected");} ?>>1</option>
							<option value="2" <?php if($risco_ambiental->risco_amb_freq_18 == "2"){echo("selected");} ?>>2</option>
							<option value="3" <?php if($risco_ambiental->risco_amb_freq_18 == "3"){echo("selected");} ?>>3</option>
							<option value="4" <?php if($risco_ambiental->risco_amb_freq_18 == "4"){echo("selected");} ?>>4</option>
							<option value="5" <?php if($risco_ambiental->risco_amb_freq_18 == "5"){echo("selected");} ?>>5</option>
						</select>
					</td>
					<td <?php if($risco_ambiental->risco_amb_risco_18 == "4" || $risco_ambiental->risco_amb_risco_18 == "6" || $risco_ambiental->risco_amb_risco_18 == "8" || $risco_ambiental->risco_amb_risco_18 == "10" || $risco_ambiental->risco_amb_risco_18 == "12" || $risco_ambiental->risco_amb_risco_18 == "16" || $risco_ambiental->risco_amb_risco_18 == "18" || $risco_ambiental->risco_amb_risco_18 == "20" || $risco_ambiental->risco_amb_risco_18 == "22" || $risco_ambiental->risco_amb_risco_18 == "24"){echo("style='background-color: #3bef50'");}else if($risco_ambiental->risco_amb_risco_18=="32" || $risco_ambiental->risco_amb_risco_18=="36" || $risco_ambiental->risco_amb_risco_18=="40" || $risco_ambiental->risco_amb_risco_18=="44" || $risco_ambiental->risco_amb_risco_18=="48" || $risco_ambiental->risco_amb_risco_18=="64" || $risco_ambiental->risco_amb_risco_18=="72" || $risco_ambiental->risco_amb_risco_18=="80" || $risco_ambiental->risco_amb_risco_18=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_ambiental->risco_amb_risco_18=="96" || $risco_ambiental->risco_amb_risco_18=="144" || $risco_ambiental->risco_amb_risco_18=="160" || $risco_ambiental->risco_amb_risco_18=="176"){echo("style='background-color: #e84747'");}else if($risco_ambiental->risco_amb_risco_18=="288" || $risco_ambiental->risco_amb_risco_18 == "352"){echo("style='background-color: #9940dd'");}else if($risco_ambiental->risco_amb_risco_18==""){echo("style='background-color: #fff'");} ?>><p id="risco_amb_risco_18" style="text-align: center; margin: 0px; position: relative; top: 18px"><?php echo $risco_ambiental->risco_amb_risco_18; ?></p>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="row" style="margin-bottom: 50px">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Risco Organizacional</th>
					<th style="width: 108px">Severidade</th>
					<th style="width: 210px">Frequencia/Probabilidade</th>
					<th style="width: 65px">Risco</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Ausência de pausas para descanso ou não cumprimento destas durante a jornada</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(6)" id="risco_org_severidade_6" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_organizacional->risco_org_severidade_6 == "n"){echo("selected");} ?> value="n"></option>
							<option value="a" <?php if($risco_organizacional->risco_org_severidade_6 == "a"){echo("selected");} ?>>A</option>
							<option value="b" <?php if($risco_organizacional->risco_org_severidade_6 == "b"){echo("selected");} ?>>B</option>
							<option value="c" <?php if($risco_organizacional->risco_org_severidade_6 == "c"){echo("selected");} ?>>C</option>
							<option value="d" <?php if($risco_organizacional->risco_org_severidade_6 == "d"){echo("selected");} ?>>D</option>
							<option value="e" <?php if($risco_organizacional->risco_org_severidade_6 == "e"){echo("selected");} ?>>E</option>
						</select>
					</td>
					<td>
						<select class="form-control" onchange="mudar_risco_amb(6)" id="risco_org_freq_prob_6" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
							<option <?php if($risco_organizacional->risco_org_freq_prob_6 == "0"){echo("selected");} ?> value="0"></option>
							<option value="1" <?php if($risco_organizacional->risco_org_freq_prob_6 == "1"){echo("selected");} ?>>1</option>
							<option value="2" <?php if($risco_organizacional->risco_org_freq_prob_6 == "2"){echo("selected");} ?>>2</option>
							<option value="3" <?php if($risco_organizacional->risco_org_freq_prob_6 == "3"){echo("selected");} ?>>3</option>
							<option value="4" <?php if($risco_organizacional->risco_org_freq_prob_6 == "4"){echo("selected");} ?>>4</option>
							<option value="5" <?php if($risco_organizacional->risco_org_freq_prob_6 == "5"){echo("selected");} ?>>5</option>
						</select>
						<td <?php if($risco_organizacional->risco_org_risco_6 == "4" || $risco_organizacional->risco_org_risco_6 == "6" || $risco_organizacional->risco_org_risco_6 == "8" || $risco_organizacional->risco_org_risco_6 == "10" || $risco_organizacional->risco_org_risco_6 == "12" || $risco_organizacional->risco_org_risco_6 == "16" || $risco_organizacional->risco_org_risco_6 == "18" || $risco_organizacional->risco_org_risco_6 == "20" || $risco_organizacional->risco_org_risco_6 == "22" || $risco_organizacional->risco_org_risco_6 == "24"){echo("style='background-color: #3bef50'");}else if($risco_organizacional->risco_org_risco_6=="32" || $risco_organizacional->risco_org_risco_6=="36" || $risco_organizacional->risco_org_risco_6=="40" || $risco_organizacional->risco_org_risco_6=="44" || $risco_organizacional->risco_org_risco_6=="48" || $risco_organizacional->risco_org_risco_6=="64" || $risco_organizacional->risco_org_risco_6=="72" || $risco_organizacional->risco_org_risco_6=="80" || $risco_organizacional->risco_org_risco_6=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_organizacional->risco_org_risco_6=="96" || $risco_organizacional->risco_org_risco_6=="144" || $risco_organizacional->risco_org_risco_6=="160" || $risco_organizacional->risco_org_risco_6=="176"){echo("style='background-color: #e84747'");}else if($risco_organizacional->risco_org_risco_6=="288" || $risco_organizacional->risco_org_risco_6 == "352"){echo("style='background-color: #9940dd'");}else if($risco_organizacional->risco_org_risco_6==""){echo("style='background-color: #fff'");} ?>><p id="risco_org_risco_6" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_organizacional->risco_org_risco_6; ?></p>
						</td>
					</tr>
					<tr>
						<td>Necessidade de manter ritmos intensos de trabalho</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(7)" id="risco_org_severidade_7" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_organizacional->risco_org_severidade_7 == "n"){echo("selected");} ?> value="n"></option>
								<option value="a" <?php if($risco_organizacional->risco_org_severidade_7 == "a"){echo("selected");} ?>>A</option>
								<option value="b" <?php if($risco_organizacional->risco_org_severidade_7 == "b"){echo("selected");} ?>>B</option>
								<option value="c" <?php if($risco_organizacional->risco_org_severidade_7 == "c"){echo("selected");} ?>>C</option>
								<option value="d" <?php if($risco_organizacional->risco_org_severidade_7 == "d"){echo("selected");} ?>>D</option>
								<option value="e" <?php if($risco_organizacional->risco_org_severidade_7 == "e"){echo("selected");} ?>>E</option>
							</select>
						</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(7)" id="risco_org_freq_prob_7" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_organizacional->risco_org_freq_prob_7 == "0"){echo("selected");} ?> value="0"></option>
								<option value="1" <?php if($risco_organizacional->risco_org_freq_prob_7 == "1"){echo("selected");} ?>>1</option>
								<option value="2" <?php if($risco_organizacional->risco_org_freq_prob_7 == "2"){echo("selected");} ?>>2</option>
								<option value="3" <?php if($risco_organizacional->risco_org_freq_prob_7 == "3"){echo("selected");} ?>>3</option>
								<option value="4" <?php if($risco_organizacional->risco_org_freq_prob_7 == "4"){echo("selected");} ?>>4</option>
								<option value="5" <?php if($risco_organizacional->risco_org_freq_prob_7 == "5"){echo("selected");} ?>>5</option>
							</select>
						</td>
						<td <?php if($risco_organizacional->risco_org_risco_7 == "4" || $risco_organizacional->risco_org_risco_7 == "6" || $risco_organizacional->risco_org_risco_7 == "8" || $risco_organizacional->risco_org_risco_7 == "10" || $risco_organizacional->risco_org_risco_7 == "12" || $risco_organizacional->risco_org_risco_7 == "16" || $risco_organizacional->risco_org_risco_7 == "18" || $risco_organizacional->risco_org_risco_7 == "20" || $risco_organizacional->risco_org_risco_7 == "22" || $risco_organizacional->risco_org_risco_7 == "24"){echo("style='background-color: #3bef50'");}else if($risco_organizacional->risco_org_risco_7=="32" || $risco_organizacional->risco_org_risco_7=="36" || $risco_organizacional->risco_org_risco_7=="40" || $risco_organizacional->risco_org_risco_7=="44" || $risco_organizacional->risco_org_risco_7=="48" || $risco_organizacional->risco_org_risco_7=="64" || $risco_organizacional->risco_org_risco_7=="72" || $risco_organizacional->risco_org_risco_7=="80" || $risco_organizacional->risco_org_risco_7=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_organizacional->risco_org_risco_7=="96" || $risco_organizacional->risco_org_risco_7=="144" || $risco_organizacional->risco_org_risco_7=="160" || $risco_organizacional->risco_org_risco_7=="176"){echo("style='background-color: #e84747'");}else if($risco_organizacional->risco_org_risco_7=="288" || $risco_organizacional->risco_org_risco_7 == "352"){echo("style='background-color: #9940dd'");}else if($risco_organizacional->risco_org_risco_7==""){echo("style='background-color: #fff'");} ?>><p id="risco_org_risco_7" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_organizacional->risco_org_risco_7; ?></p>
						</td>
					</tr>
					<tr>
						<td>Trabalho com necessidade de variação dos turnos</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(8)" id="risco_org_severidade_8" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_organizacional->risco_org_severidade_8 == "n"){echo("selected");} ?> value="n"></option>
								<option value="a" <?php if($risco_organizacional->risco_org_severidade_8 == "a"){echo("selected");} ?>>A</option>
								<option value="b" <?php if($risco_organizacional->risco_org_severidade_8 == "b"){echo("selected");} ?>>B</option>
								<option value="c" <?php if($risco_organizacional->risco_org_severidade_8 == "c"){echo("selected");} ?>>C</option>
								<option value="d" <?php if($risco_organizacional->risco_org_severidade_8 == "d"){echo("selected");} ?>>D</option>
								<option value="e" <?php if($risco_organizacional->risco_org_severidade_8 == "e"){echo("selected");} ?>>E</option>
							</select>
						</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(8)" id="risco_org_freq_prob_8" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_organizacional->risco_org_freq_prob_8 == "0"){echo("selected");} ?> value="0"></option>
								<option value="1" <?php if($risco_organizacional->risco_org_freq_prob_8 == "1"){echo("selected");} ?>>1</option>
								<option value="2" <?php if($risco_organizacional->risco_org_freq_prob_8 == "2"){echo("selected");} ?>>2</option>
								<option value="3" <?php if($risco_organizacional->risco_org_freq_prob_8 == "3"){echo("selected");} ?>>3</option>
								<option value="4" <?php if($risco_organizacional->risco_org_freq_prob_8 == "4"){echo("selected");} ?>>4</option>
								<option value="5" <?php if($risco_organizacional->risco_org_freq_prob_8 == "5"){echo("selected");} ?>>5</option>
							</select>
						</td>
						<td <?php if($risco_organizacional->risco_org_risco_8 == "4" || $risco_organizacional->risco_org_risco_8 == "6" || $risco_organizacional->risco_org_risco_8 == "8" || $risco_organizacional->risco_org_risco_8 == "10" || $risco_organizacional->risco_org_risco_8 == "12" || $risco_organizacional->risco_org_risco_8 == "16" || $risco_organizacional->risco_org_risco_8 == "18" || $risco_organizacional->risco_org_risco_8 == "20" || $risco_organizacional->risco_org_risco_8 == "22" || $risco_organizacional->risco_org_risco_8 == "24"){echo("style='background-color: #3bef50'");}else if($risco_organizacional->risco_org_risco_8=="32" || $risco_organizacional->risco_org_risco_8=="36" || $risco_organizacional->risco_org_risco_8=="40" || $risco_organizacional->risco_org_risco_8=="44" || $risco_organizacional->risco_org_risco_8=="48" || $risco_organizacional->risco_org_risco_8=="64" || $risco_organizacional->risco_org_risco_8=="72" || $risco_organizacional->risco_org_risco_8=="80" || $risco_organizacional->risco_org_risco_8=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_organizacional->risco_org_risco_8=="96" || $risco_organizacional->risco_org_risco_8=="144" || $risco_organizacional->risco_org_risco_8=="160" || $risco_organizacional->risco_org_risco_8=="176"){echo("style='background-color: #e84747'");}else if($risco_organizacional->risco_org_risco_8=="288" || $risco_organizacional->risco_org_risco_8 == "352"){echo("style='background-color: #9940dd'");}else if($risco_organizacional->risco_org_risco_8==""){echo("style='background-color: #fff'");} ?>><p id="risco_org_risco_8" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_organizacional->risco_org_risco_8; ?></p>
						</td>
					</tr>
					<tr>
						<td>Ausência de plano de capacidade, habilitação, reciclagem e atualização dos empregados</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(9)" id="risco_org_severidade_9" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_organizacional->risco_org_severidade_9 == "n"){echo("selected");} ?> value="n"></option>
								<option value="a" <?php if($risco_organizacional->risco_org_severidade_9 == "a"){echo("selected");} ?>>A</option>
								<option value="b" <?php if($risco_organizacional->risco_org_severidade_9 == "b"){echo("selected");} ?>>B</option>
								<option value="c" <?php if($risco_organizacional->risco_org_severidade_9 == "c"){echo("selected");} ?>>C</option>
								<option value="d" <?php if($risco_organizacional->risco_org_severidade_9 == "d"){echo("selected");} ?>>D</option>
								<option value="e" <?php if($risco_organizacional->risco_org_severidade_9 == "e"){echo("selected");} ?>>E</option>
							</select>
						</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(9)" id="risco_org_freq_prob_9" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_organizacional->risco_org_freq_prob_9 == "0"){echo("selected");} ?> value="0"></option>
								<option value="1" <?php if($risco_organizacional->risco_org_freq_prob_9 == "1"){echo("selected");} ?>>1</option>
								<option value="2" <?php if($risco_organizacional->risco_org_freq_prob_9 == "2"){echo("selected");} ?>>2</option>
								<option value="3" <?php if($risco_organizacional->risco_org_freq_prob_9 == "3"){echo("selected");} ?>>3</option>
								<option value="4" <?php if($risco_organizacional->risco_org_freq_prob_9 == "4"){echo("selected");} ?>>4</option>
								<option value="5" <?php if($risco_organizacional->risco_org_freq_prob_9 == "5"){echo("selected");} ?>>5</option>
							</select>
						</td>
						<td <?php if($risco_organizacional->risco_org_risco_9 == "4" || $risco_organizacional->risco_org_risco_9 == "6" || $risco_organizacional->risco_org_risco_9 == "8" || $risco_organizacional->risco_org_risco_9 == "10" || $risco_organizacional->risco_org_risco_9 == "12" || $risco_organizacional->risco_org_risco_9 == "16" || $risco_organizacional->risco_org_risco_9 == "18" || $risco_organizacional->risco_org_risco_9 == "20" || $risco_organizacional->risco_org_risco_9 == "22" || $risco_organizacional->risco_org_risco_9 == "24"){echo("style='background-color: #3bef50'");}else if($risco_organizacional->risco_org_risco_9=="32" || $risco_organizacional->risco_org_risco_9=="36" || $risco_organizacional->risco_org_risco_9=="40" || $risco_organizacional->risco_org_risco_9=="44" || $risco_organizacional->risco_org_risco_9=="48" || $risco_organizacional->risco_org_risco_9=="64" || $risco_organizacional->risco_org_risco_9=="72" || $risco_organizacional->risco_org_risco_9=="80" || $risco_organizacional->risco_org_risco_9=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_organizacional->risco_org_risco_9=="96" || $risco_organizacional->risco_org_risco_9=="144" || $risco_organizacional->risco_org_risco_9=="160" || $risco_organizacional->risco_org_risco_9=="176"){echo("style='background-color: #e84747'");}else if($risco_organizacional->risco_org_risco_9=="288" || $risco_organizacional->risco_org_risco_9 == "352"){echo("style='background-color: #9940dd'");}else if($risco_organizacional->risco_org_risco_9==""){echo("style='background-color: #fff'");} ?>><p id="risco_org_risco_9" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_organizacional->risco_org_risco_9; ?></p>
						</td>
					</tr>
					<tr>
						<td>Cobrança de metas impossíveis</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(10)" id="risco_org_severidade_10" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_organizacional->risco_org_severidade_10 == "n"){echo("selected");} ?> value="n"></option>
								<option value="a" <?php if($risco_organizacional->risco_org_severidade_10 == "a"){echo("selected");} ?>>A</option>
								<option value="b" <?php if($risco_organizacional->risco_org_severidade_10 == "b"){echo("selected");} ?>>B</option>
								<option value="c" <?php if($risco_organizacional->risco_org_severidade_10 == "c"){echo("selected");} ?>>C</option>
								<option value="d" <?php if($risco_organizacional->risco_org_severidade_10 == "d"){echo("selected");} ?>>D</option>
								<option value="e" <?php if($risco_organizacional->risco_org_severidade_10 == "e"){echo("selected");} ?>>E</option>
							</select>
						</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(10)" id="risco_org_freq_prob_10" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_organizacional->risco_org_freq_prob_10 == "0"){echo("selected");} ?> value="0"></option>
								<option value="1" <?php if($risco_organizacional->risco_org_freq_prob_10 == "1"){echo("selected");} ?>>1</option>
								<option value="2" <?php if($risco_organizacional->risco_org_freq_prob_10 == "2"){echo("selected");} ?>>2</option>
								<option value="3" <?php if($risco_organizacional->risco_org_freq_prob_10 == "3"){echo("selected");} ?>>3</option>
								<option value="4" <?php if($risco_organizacional->risco_org_freq_prob_10 == "4"){echo("selected");} ?>>4</option>
								<option value="5" <?php if($risco_organizacional->risco_org_freq_prob_10 == "5"){echo("selected");} ?>>5</option>
							</select>
						</td>
						<td <?php if($risco_organizacional->risco_org_risco_10 == "4" || $risco_organizacional->risco_org_risco_10 == "6" || $risco_organizacional->risco_org_risco_10 == "8" || $risco_organizacional->risco_org_risco_10 == "10" || $risco_organizacional->risco_org_risco_10 == "12" || $risco_organizacional->risco_org_risco_10 == "16" || $risco_organizacional->risco_org_risco_10 == "18" || $risco_organizacional->risco_org_risco_10 == "20" || $risco_organizacional->risco_org_risco_10 == "22" || $risco_organizacional->risco_org_risco_10 == "24"){echo("style='background-color: #3bef50'");}else if($risco_organizacional->risco_org_risco_10=="32" || $risco_organizacional->risco_org_risco_10=="36" || $risco_organizacional->risco_org_risco_10=="40" || $risco_organizacional->risco_org_risco_10=="44" || $risco_organizacional->risco_org_risco_10=="48" || $risco_organizacional->risco_org_risco_10=="64" || $risco_organizacional->risco_org_risco_10=="72" || $risco_organizacional->risco_org_risco_10=="80" || $risco_organizacional->risco_org_risco_10=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_organizacional->risco_org_risco_10=="96" || $risco_organizacional->risco_org_risco_10=="144" || $risco_organizacional->risco_org_risco_10=="160" || $risco_organizacional->risco_org_risco_10=="176"){echo("style='background-color: #e84747'");}else if($risco_organizacional->risco_org_risco_10=="288" || $risco_organizacional->risco_org_risco_10 == "352"){echo("style='background-color: #9940dd'");}else if($risco_organizacional->risco_org_risco_10==""){echo("style='background-color: #fff'");} ?>><p id="risco_org_risco_10" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_organizacional->risco_org_risco_10; ?></p>
						</td>
					</tr>
					<tr>
						<td>Outros - organizacionais</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(11)" id="risco_org_severidade_11" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_organizacional->risco_org_severidade_11 == "n"){echo("selected");} ?> value="n"></option>
								<option value="a" <?php if($risco_organizacional->risco_org_severidade_11 == "a"){echo("selected");} ?>>A</option>
								<option value="b" <?php if($risco_organizacional->risco_org_severidade_11 == "b"){echo("selected");} ?>>B</option>
								<option value="c" <?php if($risco_organizacional->risco_org_severidade_11 == "c"){echo("selected");} ?>>C</option>
								<option value="d" <?php if($risco_organizacional->risco_org_severidade_11 == "d"){echo("selected");} ?>>D</option>
								<option value="e" <?php if($risco_organizacional->risco_org_severidade_11 == "e"){echo("selected");} ?>>E</option>
							</select>
						</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(11)" id="risco_org_freq_prob_11" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_organizacional->risco_org_freq_prob_11 == "0"){echo("selected");} ?> value="0"></option>
								<option value="1" <?php if($risco_organizacional->risco_org_freq_prob_11 == "1"){echo("selected");} ?>>1</option>
								<option value="2" <?php if($risco_organizacional->risco_org_freq_prob_11 == "2"){echo("selected");} ?>>2</option>
								<option value="3" <?php if($risco_organizacional->risco_org_freq_prob_11 == "3"){echo("selected");} ?>>3</option>
								<option value="4" <?php if($risco_organizacional->risco_org_freq_prob_11 == "4"){echo("selected");} ?>>4</option>
								<option value="5" <?php if($risco_organizacional->risco_org_freq_prob_11 == "5"){echo("selected");} ?>>5</option>
							</select>
						</td>
						<td <?php if($risco_organizacional->risco_org_risco_11 == "4" || $risco_organizacional->risco_org_risco_11 == "6" || $risco_organizacional->risco_org_risco_11 == "8" || $risco_organizacional->risco_org_risco_11 == "10" || $risco_organizacional->risco_org_risco_11 == "12" || $risco_organizacional->risco_org_risco_11 == "16" || $risco_organizacional->risco_org_risco_11 == "18" || $risco_organizacional->risco_org_risco_11 == "20" || $risco_organizacional->risco_org_risco_11 == "22" || $risco_organizacional->risco_org_risco_11 == "24"){echo("style='background-color: #3bef50'");}else if($risco_organizacional->risco_org_risco_11=="32" || $risco_organizacional->risco_org_risco_11=="36" || $risco_organizacional->risco_org_risco_11=="40" || $risco_organizacional->risco_org_risco_11=="44" || $risco_organizacional->risco_org_risco_11=="48" || $risco_organizacional->risco_org_risco_11=="64" || $risco_organizacional->risco_org_risco_11=="72" || $risco_organizacional->risco_org_risco_11=="80" || $risco_organizacional->risco_org_risco_11=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_organizacional->risco_org_risco_11=="96" || $risco_organizacional->risco_org_risco_11=="144" || $risco_organizacional->risco_org_risco_11=="160" || $risco_organizacional->risco_org_risco_11=="176"){echo("style='background-color: #e84747'");}else if($risco_organizacional->risco_org_risco_11=="288" || $risco_organizacional->risco_org_risco_11 == "352"){echo("style='background-color: #9940dd'");}else if($risco_organizacional->risco_org_risco_11==""){echo("style='background-color: #fff'");} ?>><p id="risco_org_risco_11" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_organizacional->risco_org_risco_11; ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row" style="margin-bottom: 30px">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Risco Pscicossocial/Cognitivo</th>
						<th style="width: 108px">Severidade</th>
						<th style="width: 210px">Frequencia/Probabilidade</th>
						<th style="width: 65px">Risco</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Situações de estresse</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(12)" id="risco_psc_cog_severidade_12" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_psci_cog->risco_psc_cog_severidade_12 == "n"){echo("selected");} ?> value="n"></option>
								<option value="a" <?php if($risco_psci_cog->risco_psc_cog_severidade_12 == "a"){echo("selected");} ?>>A</option>
								<option value="b" <?php if($risco_psci_cog->risco_psc_cog_severidade_12 == "b"){echo("selected");} ?>>B</option>
								<option value="c" <?php if($risco_psci_cog->risco_psc_cog_severidade_12 == "c"){echo("selected");} ?>>C</option>
								<option value="d" <?php if($risco_psci_cog->risco_psc_cog_severidade_12 == "d"){echo("selected");} ?>>D</option>
								<option value="e" <?php if($risco_psci_cog->risco_psc_cog_severidade_12 == "e"){echo("selected");} ?>>E</option>
							</select>
						</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(12)" id="risco_psc_cog_freq_12" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_psci_cog->risco_psc_cog_freq_12 == "0"){echo("selected");} ?> value="0"></option>
								<option value="1" <?php if($risco_psci_cog->risco_psc_cog_freq_12 == "1"){echo("selected");} ?>>1</option>
								<option value="2" <?php if($risco_psci_cog->risco_psc_cog_freq_12 == "2"){echo("selected");} ?>>2</option>
								<option value="3" <?php if($risco_psci_cog->risco_psc_cog_freq_12 == "3"){echo("selected");} ?>>3</option>
								<option value="4" <?php if($risco_psci_cog->risco_psc_cog_freq_12 == "4"){echo("selected");} ?>>4</option>
								<option value="5" <?php if($risco_psci_cog->risco_psc_cog_freq_12 == "5"){echo("selected");} ?>>5</option>
							</select>
						</td>
						<td <?php if($risco_psci_cog->risco_psc_cog_risco_12 == "4" || $risco_psci_cog->risco_psc_cog_risco_12 == "6" || $risco_psci_cog->risco_psc_cog_risco_12 == "8" || $risco_psci_cog->risco_psc_cog_risco_12 == "10" || $risco_psci_cog->risco_psc_cog_risco_12 == "12" || $risco_psci_cog->risco_psc_cog_risco_12 == "16" || $risco_psci_cog->risco_psc_cog_risco_12 == "18" || $risco_psci_cog->risco_psc_cog_risco_12 == "20" || $risco_psci_cog->risco_psc_cog_risco_12 == "22" || $risco_psci_cog->risco_psc_cog_risco_12 == "24"){echo("style='background-color: #3bef50'");}else if($risco_psci_cog->risco_psc_cog_risco_12=="32" || $risco_psci_cog->risco_psc_cog_risco_12=="36" || $risco_psci_cog->risco_psc_cog_risco_12=="40" || $risco_psci_cog->risco_psc_cog_risco_12=="44" || $risco_psci_cog->risco_psc_cog_risco_12=="48" || $risco_psci_cog->risco_psc_cog_risco_12=="64" || $risco_psci_cog->risco_psc_cog_risco_12=="72" || $risco_psci_cog->risco_psc_cog_risco_12=="80" || $risco_psci_cog->risco_psc_cog_risco_12=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_psci_cog->risco_psc_cog_risco_12=="96" || $risco_psci_cog->risco_psc_cog_risco_12=="144" || $risco_psci_cog->risco_psc_cog_risco_12=="160" || $risco_psci_cog->risco_psc_cog_risco_12=="176"){echo("style='background-color: #e84747'");}else if($risco_psci_cog->risco_psc_cog_risco_12=="288" || $risco_psci_cog->risco_psc_cog_risco_12 == "352"){echo("style='background-color: #9940dd'");}else if($risco_psci_cog->risco_psc_cog_risco_12==""){echo("style='background-color: #fff'");} ?>><p id="risco_psc_cog_risco_12" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_psci_cog->risco_psc_cog_risco_12; ?></p>
						</td>
					</tr>
					<tr>
						<td>Situações de sobrecarga de trabalho mental</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(13)" id="risco_psc_cog_severidade_13" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_psci_cog->risco_psc_cog_severidade_13 == "n"){echo("selected");} ?> value="n"></option>
								<option value="a" <?php if($risco_psci_cog->risco_psc_cog_severidade_13 == "a"){echo("selected");} ?>>A</option>
								<option value="b" <?php if($risco_psci_cog->risco_psc_cog_severidade_13 == "b"){echo("selected");} ?>>B</option>
								<option value="c" <?php if($risco_psci_cog->risco_psc_cog_severidade_13 == "c"){echo("selected");} ?>>C</option>
								<option value="d" <?php if($risco_psci_cog->risco_psc_cog_severidade_13 == "d"){echo("selected");} ?>>D</option>
								<option value="e" <?php if($risco_psci_cog->risco_psc_cog_severidade_13 == "e"){echo("selected");} ?>>E</option>
							</select>
						</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(13)" id="risco_psc_cog_freq_13" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_psci_cog->risco_psc_cog_freq_13 == "0"){echo("selected");} ?> value="0"></option>
								<option value="1" <?php if($risco_psci_cog->risco_psc_cog_freq_13 == "1"){echo("selected");} ?>>1</option>
								<option value="2" <?php if($risco_psci_cog->risco_psc_cog_freq_13 == "2"){echo("selected");} ?>>2</option>
								<option value="3" <?php if($risco_psci_cog->risco_psc_cog_freq_13 == "3"){echo("selected");} ?>>3</option>
								<option value="4" <?php if($risco_psci_cog->risco_psc_cog_freq_13 == "4"){echo("selected");} ?>>4</option>
								<option value="5" <?php if($risco_psci_cog->risco_psc_cog_freq_13 == "5"){echo("selected");} ?>>5</option>
							</select>
						</td>
						<td <?php if($risco_psci_cog->risco_psc_cog_risco_13 == "4" || $risco_psci_cog->risco_psc_cog_risco_13 == "6" || $risco_psci_cog->risco_psc_cog_risco_13 == "8" || $risco_psci_cog->risco_psc_cog_risco_13 == "10" || $risco_psci_cog->risco_psc_cog_risco_13 == "12" || $risco_psci_cog->risco_psc_cog_risco_13 == "16" || $risco_psci_cog->risco_psc_cog_risco_13 == "18" || $risco_psci_cog->risco_psc_cog_risco_13 == "20" || $risco_psci_cog->risco_psc_cog_risco_13 == "22" || $risco_psci_cog->risco_psc_cog_risco_13 == "24"){echo("style='background-color: #3bef50'");}else if($risco_psci_cog->risco_psc_cog_risco_13=="32" || $risco_psci_cog->risco_psc_cog_risco_13=="36" || $risco_psci_cog->risco_psc_cog_risco_13=="40" || $risco_psci_cog->risco_psc_cog_risco_13=="44" || $risco_psci_cog->risco_psc_cog_risco_13=="48" || $risco_psci_cog->risco_psc_cog_risco_13=="64" || $risco_psci_cog->risco_psc_cog_risco_13=="72" || $risco_psci_cog->risco_psc_cog_risco_13=="80" || $risco_psci_cog->risco_psc_cog_risco_13=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_psci_cog->risco_psc_cog_risco_13=="96" || $risco_psci_cog->risco_psc_cog_risco_13=="144" || $risco_psci_cog->risco_psc_cog_risco_13=="160" || $risco_psci_cog->risco_psc_cog_risco_13=="176"){echo("style='background-color: #e84747'");}else if($risco_psci_cog->risco_psc_cog_risco_13=="288" || $risco_psci_cog->risco_psc_cog_risco_13 == "352"){echo("style='background-color: #9940dd'");}else if($risco_psci_cog->risco_psc_cog_risco_13==""){echo("style='background-color: #fff'");} ?>><p id="risco_psc_cog_risco_13" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_psci_cog->risco_psc_cog_risco_13; ?></p>
						</td>
					</tr>
					<tr>
						<td>Exigência de alto nível de concentração no trabalho</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(14)" id="risco_psc_cog_severidade_14" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_psci_cog->risco_psc_cog_severidade_14 == "n"){echo("selected");} ?> value="n"></option>
								<option value="a" <?php if($risco_psci_cog->risco_psc_cog_severidade_14 == "a"){echo("selected");} ?>>A</option>
								<option value="b" <?php if($risco_psci_cog->risco_psc_cog_severidade_14 == "b"){echo("selected");} ?>>B</option>
								<option value="c" <?php if($risco_psci_cog->risco_psc_cog_severidade_14 == "c"){echo("selected");} ?>>C</option>
								<option value="d" <?php if($risco_psci_cog->risco_psc_cog_severidade_14 == "d"){echo("selected");} ?>>D</option>
								<option value="e" <?php if($risco_psci_cog->risco_psc_cog_severidade_14 == "e"){echo("selected");} ?>>E</option>
							</select>
						</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(14)" id="risco_psc_cog_freq_14" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_psci_cog->risco_psc_cog_freq_14 == "0"){echo("selected");} ?> value="0"></option>
								<option value="1" <?php if($risco_psci_cog->risco_psc_cog_freq_14 == "1"){echo("selected");} ?>>1</option>
								<option value="2" <?php if($risco_psci_cog->risco_psc_cog_freq_14 == "2"){echo("selected");} ?>>2</option>
								<option value="3" <?php if($risco_psci_cog->risco_psc_cog_freq_14 == "3"){echo("selected");} ?>>3</option>
								<option value="4" <?php if($risco_psci_cog->risco_psc_cog_freq_14 == "4"){echo("selected");} ?>>4</option>
								<option value="5" <?php if($risco_psci_cog->risco_psc_cog_freq_14 == "5"){echo("selected");} ?>>5</option>
							</select>
						</td>
						<td <?php if($risco_psci_cog->risco_psc_cog_risco_14 == "4" || $risco_psci_cog->risco_psc_cog_risco_14 == "6" || $risco_psci_cog->risco_psc_cog_risco_14 == "8" || $risco_psci_cog->risco_psc_cog_risco_14 == "10" || $risco_psci_cog->risco_psc_cog_risco_14 == "12" || $risco_psci_cog->risco_psc_cog_risco_14 == "16" || $risco_psci_cog->risco_psc_cog_risco_14 == "18" || $risco_psci_cog->risco_psc_cog_risco_14 == "20" || $risco_psci_cog->risco_psc_cog_risco_14 == "22" || $risco_psci_cog->risco_psc_cog_risco_14 == "24"){echo("style='background-color: #3bef50'");}else if($risco_psci_cog->risco_psc_cog_risco_14=="32" || $risco_psci_cog->risco_psc_cog_risco_14=="36" || $risco_psci_cog->risco_psc_cog_risco_14=="40" || $risco_psci_cog->risco_psc_cog_risco_14=="44" || $risco_psci_cog->risco_psc_cog_risco_14=="48" || $risco_psci_cog->risco_psc_cog_risco_14=="64" || $risco_psci_cog->risco_psc_cog_risco_14=="72" || $risco_psci_cog->risco_psc_cog_risco_14=="80" || $risco_psci_cog->risco_psc_cog_risco_14=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_psci_cog->risco_psc_cog_risco_14=="96" || $risco_psci_cog->risco_psc_cog_risco_14=="144" || $risco_psci_cog->risco_psc_cog_risco_14=="160" || $risco_psci_cog->risco_psc_cog_risco_14=="176"){echo("style='background-color: #e84747'");}else if($risco_psci_cog->risco_psc_cog_risco_14=="288" || $risco_psci_cog->risco_psc_cog_risco_14 == "352"){echo("style='background-color: #9940dd'");}else if($risco_psci_cog->risco_psc_cog_risco_14==""){echo("style='background-color: #fff'");} ?>><p id="risco_psc_cog_risco_14" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_psci_cog->risco_psc_cog_risco_14; ?></p>
						</td>
					</tr>
					<tr>
						<td>Meios de comunicação ineficientes</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(15)" id="risco_psc_cog_severidade_15" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_psci_cog->risco_psc_cog_severidade_15 == "n"){echo("selected");} ?> value="n"></option>
								<option value="a" <?php if($risco_psci_cog->risco_psc_cog_severidade_15 == "a"){echo("selected");} ?>>A</option>
								<option value="b" <?php if($risco_psci_cog->risco_psc_cog_severidade_15 == "b"){echo("selected");} ?>>B</option>
								<option value="c" <?php if($risco_psci_cog->risco_psc_cog_severidade_15 == "c"){echo("selected");} ?>>C</option>
								<option value="d" <?php if($risco_psci_cog->risco_psc_cog_severidade_15 == "d"){echo("selected");} ?>>D</option>
								<option value="e" <?php if($risco_psci_cog->risco_psc_cog_severidade_15 == "e"){echo("selected");} ?>>E</option>
							</select>
						</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(15)" id="risco_psc_cog_freq_15" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_psci_cog->risco_psc_cog_freq_15 == "0"){echo("selected");} ?> value="0"></option>
								<option value="1" <?php if($risco_psci_cog->risco_psc_cog_freq_15 == "1"){echo("selected");} ?>>1</option>
								<option value="2" <?php if($risco_psci_cog->risco_psc_cog_freq_15 == "2"){echo("selected");} ?>>2</option>
								<option value="3" <?php if($risco_psci_cog->risco_psc_cog_freq_15 == "3"){echo("selected");} ?>>3</option>
								<option value="4" <?php if($risco_psci_cog->risco_psc_cog_freq_15 == "4"){echo("selected");} ?>>4</option>
								<option value="5" <?php if($risco_psci_cog->risco_psc_cog_freq_15 == "5"){echo("selected");} ?>>5</option>
							</select>
						</td>
						<td <?php if($risco_psci_cog->risco_psc_cog_risco_15 == "4" || $risco_psci_cog->risco_psc_cog_risco_15 == "6" || $risco_psci_cog->risco_psc_cog_risco_15 == "8" || $risco_psci_cog->risco_psc_cog_risco_15 == "10" || $risco_psci_cog->risco_psc_cog_risco_15 == "12" || $risco_psci_cog->risco_psc_cog_risco_15 == "16" || $risco_psci_cog->risco_psc_cog_risco_15 == "18" || $risco_psci_cog->risco_psc_cog_risco_15 == "20" || $risco_psci_cog->risco_psc_cog_risco_15 == "22" || $risco_psci_cog->risco_psc_cog_risco_15 == "24"){echo("style='background-color: #3bef50'");}else if($risco_psci_cog->risco_psc_cog_risco_15=="32" || $risco_psci_cog->risco_psc_cog_risco_15=="36" || $risco_psci_cog->risco_psc_cog_risco_15=="40" || $risco_psci_cog->risco_psc_cog_risco_15=="44" || $risco_psci_cog->risco_psc_cog_risco_15=="48" || $risco_psci_cog->risco_psc_cog_risco_15=="64" || $risco_psci_cog->risco_psc_cog_risco_15=="72" || $risco_psci_cog->risco_psc_cog_risco_15=="80" || $risco_psci_cog->risco_psc_cog_risco_15=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_psci_cog->risco_psc_cog_risco_15=="96" || $risco_psci_cog->risco_psc_cog_risco_15=="144" || $risco_psci_cog->risco_psc_cog_risco_15=="160" || $risco_psci_cog->risco_psc_cog_risco_15=="176"){echo("style='background-color: #e84747'");}else if($risco_psci_cog->risco_psc_cog_risco_15=="288" || $risco_psci_cog->risco_psc_cog_risco_15 == "352"){echo("style='background-color: #9940dd'");}else if($risco_psci_cog->risco_psc_cog_risco_15==""){echo("style='background-color: #fff'");} ?>><p id="risco_psc_cog_risco_15" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_psci_cog->risco_psc_cog_risco_15; ?></p>
						</td>
					</tr>
					<tr>
						<td>Outros - psicossociais/cognitivos</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(16)" id="risco_psc_cog_severidade_16" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_psci_cog->risco_psc_cog_severidade_16 == "n"){echo("selected");} ?> value="n"></option>
								<option value="a" <?php if($risco_psci_cog->risco_psc_cog_severidade_16 == "a"){echo("selected");} ?>>A</option>
								<option value="b" <?php if($risco_psci_cog->risco_psc_cog_severidade_16 == "b"){echo("selected");} ?>>B</option>
								<option value="c" <?php if($risco_psci_cog->risco_psc_cog_severidade_16 == "c"){echo("selected");} ?>>C</option>
								<option value="d" <?php if($risco_psci_cog->risco_psc_cog_severidade_16 == "d"){echo("selected");} ?>>D</option>
								<option value="e" <?php if($risco_psci_cog->risco_psc_cog_severidade_16 == "e"){echo("selected");} ?>>E</option>
							</select>
						</td>
						<td>
							<select class="form-control" onchange="mudar_risco_amb(16)" id="risco_psc_cog_freq_16" <?= ( !in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ) ? 'disabled' : ''?>>
								<option <?php if($risco_psci_cog->risco_psc_cog_freq_16 == "0"){echo("selected");} ?> value="0"></option>
								<option value="1" <?php if($risco_psci_cog->risco_psc_cog_freq_16 == "1"){echo("selected");} ?>>1</option>
								<option value="2" <?php if($risco_psci_cog->risco_psc_cog_freq_16 == "2"){echo("selected");} ?>>2</option>
								<option value="3" <?php if($risco_psci_cog->risco_psc_cog_freq_16 == "3"){echo("selected");} ?>>3</option>
								<option value="4" <?php if($risco_psci_cog->risco_psc_cog_freq_16 == "4"){echo("selected");} ?>>4</option>
								<option value="5" <?php if($risco_psci_cog->risco_psc_cog_freq_16 == "5"){echo("selected");} ?>>5</option>
							</select>
						</td>
						<td <?php if($risco_psci_cog->risco_psc_cog_risco_16 == "4" || $risco_psci_cog->risco_psc_cog_risco_16 == "6" || $risco_psci_cog->risco_psc_cog_risco_16 == "8" || $risco_psci_cog->risco_psc_cog_risco_16 == "10" || $risco_psci_cog->risco_psc_cog_risco_16 == "12" || $risco_psci_cog->risco_psc_cog_risco_16 == "16" || $risco_psci_cog->risco_psc_cog_risco_16 == "18" || $risco_psci_cog->risco_psc_cog_risco_16 == "20" || $risco_psci_cog->risco_psc_cog_risco_16 == "22" || $risco_psci_cog->risco_psc_cog_risco_16 == "24"){echo("style='background-color: #3bef50'");}else if($risco_psci_cog->risco_psc_cog_risco_16=="32" || $risco_psci_cog->risco_psc_cog_risco_16=="36" || $risco_psci_cog->risco_psc_cog_risco_16=="40" || $risco_psci_cog->risco_psc_cog_risco_16=="44" || $risco_psci_cog->risco_psc_cog_risco_16=="48" || $risco_psci_cog->risco_psc_cog_risco_16=="64" || $risco_psci_cog->risco_psc_cog_risco_16=="72" || $risco_psci_cog->risco_psc_cog_risco_16=="80" || $risco_psci_cog->risco_psc_cog_risco_16=="88"){echo("style='background-color: #e0ef3b'");}else if($risco_psci_cog->risco_psc_cog_risco_16=="96" || $risco_psci_cog->risco_psc_cog_risco_16=="144" || $risco_psci_cog->risco_psc_cog_risco_16=="160" || $risco_psci_cog->risco_psc_cog_risco_16=="176"){echo("style='background-color: #e84747'");}else if($risco_psci_cog->risco_psc_cog_risco_16=="288" || $risco_psci_cog->risco_psc_cog_risco_16 == "352"){echo("style='background-color: #9940dd'");}else if($risco_psci_cog->risco_psc_cog_risco_16==""){echo("style='background-color: #fff'");} ?>><p id="risco_psc_cog_risco_16" style="text-align: center; margin: 0px; position: relative; top: 9px"><?php echo $risco_psci_cog->risco_psc_cog_risco_16; ?></p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
    <?php if(in_array( $_SESSION['perfil'], [ LEVEL_ADMIN, LEVEL_GERENTE ] ) ){?>
		<div class="row" style="display: block;">
			<button onclick="confirm('tem certeza que deseja cancelar')?location.href='?page=main':''" style="cursor: pointer; float: right;" class="btn btn-secondary">Cancelar</button>
			<button onclick="salvar_risco_amb(<?php echo $_GET['funcao'] ?>)" id="risco_amb_save" style="margin: 0px 10px 50px 0px; float: right; cursor: pointer;" class="btn btn-primary">Salvar</button>
		</div>
  <?php } ?>
	</div>

	<div class="modal fade" id="matrizModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Matriz dos riscos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered" style="margin-bottom: 50px">
						<thead>
							<tr>
								<th colspan="3" class="text-center">Tabela de Severidade</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center" style="font-weight: 499">Nível</td>
								<td class="text-center" style="font-weight: 499">Efeitos a saúde ocupacional</td>
								<td class="text-center" style="font-weight: 499">Detalhamento Ergonomia</td>
							</tr>
							<tr>
								<td class="text-center" style="padding-top: 33px; font-size: 15px">A</td>
								<td style="font-size: 15px">Efeitos reversíveis pouco preocupantes ou sem efeitos adversos conhecidos.</td>
								<td style="font-size: 15px">São efeitos (dores, desconforto, cansaço, etc) que melhoram com um período de repouso durante a jornada de trabalho (pausas).</td>
							</tr>
							<tr>
								<td class="text-center" style="padding-top: 23px; font-size: 15px">B</td>
								<td style="font-size: 15px">Efeitos reversíveis preocupantes.</td>
								<td style="font-size: 15px">São efietos (dores, desconforto, cansaço, etc) que melhoram com período de repouso entre jornadas.</td>
							</tr>
							<tr>
								<td class="text-center" style="padding-top: 30px; font-size: 15px">C</td>
								<td style="font-size: 15px">Efeitos reversíveis severos.</td>
								<td style="font-size: 15px">São efeitos (doenças/lesões) que reduzem a capacidade de trabalho podendo gerar restrição ou necessidade de tempo de recuperação acima do descanso entre jornadas.</td>
							</tr>
							<tr>
								<td class="text-center" style="padding-top: 30px; font-size: 15px">D</td>
								<td style="font-size: 15px">Efeitos irreversíveis.</td>
								<td style="font-size: 15px">São efeitos irreversíveis (doenças/lesões) que podem gerar necessidade de afastamento da atividade ou reavaliação da função.</td>
							</tr>
							<tr>
								<td class="text-center" style="padding-top: 23px; font-size: 15px">E</td>
								<td style="font-size: 15px">Risco de vida ou doenças incapacitantes.</td>
								<td style="font-size: 15px">São efeitos irreversíveis (doenças/lesões) que podem gerar perda da capacidade laoral (não pode exercer nenhuma função).</td>
							</tr>
						</tbody>
					</table>
					<table class="table table-bordered" style="margin-bottom: 50px">
						<thead>
							<tr>
								<th colspan="4" class="text-center">Tabela de Probabilidade/Frequência</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center" colspan="2" style="font-weight: 499">Nível</td>
								<td class="text-center" style="font-weight: 499">Efeitos a saúde ocupacional</td>
								<td class="text-center" style="font-weight: 499">Detalhamento Ergonomia</td>
							</tr>
							<tr>
								<td style="font-size: 15px; padding-top: 42px">1</td>
								<td style="font-size: 15px">Raro</td>
								<td style="font-size: 15px">O evento está inserido em um ambiente não perigoso e/ou existem controles adequados e suficientes atuando em suas principais possíveis causas.</td>
								<td style="font-size: 15px">A exposição a condição ergonômica ocorre pelo menos 1x/ano.</td>
							</tr>
							<tr>
								<td style="font-size: 15px ; padding-top: 42px">2</td>
								<td style="font-size: 15px">Pouco provável</td>
								<td style="font-size: 15px">O evento está inserido em um ambiente pouco perigoso e/ou existe um nível satisfatório de controles preventivos implementados.</td>
								<td style="font-size: 15px">A exposição a condição ergonômica ocorre pelo menos 1x/mês.</td>
							</tr>
							<tr>
								<td style="font-size: 15px; padding-top: 50px">3</td>
								<td style="font-size: 15px">Ocasional</td>
								<td style="font-size: 15px">O evento está inserido em um ambiente perigoso e/ou existem alguns controles inadequados ou faltantes relacionados a causas possíveis importantes.</td>
								<td style="font-size: 15px">A exposição a condição ergonômica ocorre pelo menos 1x/semana.</td>
							</tr>
							<tr>
								<td style="font-size: 15px; padding-top: 42px">4</td>
								<td style="font-size: 15px">Provável</td>
								<td style="font-size: 15px">O evento está inserido em um ambiente muito perigoso e/ou existem diversos controles inadequados ou faltantes relacionados a causas possíveis importantes a consequencia deste evento é quase certa.</td>
								<td style="font-size: 15px">A exposição a condição ergonômica ocorre uma vez ao dia.</td>
							</tr>
							<tr>
								<td style="font-size: 15px; ; padding-top: 42px">5</td>
								<td style="font-size: 15px">Frequente</td>
								<td style="font-size: 15px">Estima-se que o evento/consequencia pode vir a ocorrer em curto/médio prazo.</td>
								<td style="font-size: 15px">A exposição a condição ergonômica ocorre várias vezes/dia.</td>
							</tr>
						</tbody>
					</table>
					<table class="table table-bordered" style="margin-bottom: 50px">
						<thead>
							<tr>
								<th scope="col" colspan="6" class="text-center">Matriz Resultados</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center" style="width: 100px">Niveis Frequencia/Severidade</td>
								<td class="text-center" style="padding-top: 22px">1</td>
								<td class="text-center" style="padding-top: 22px">2</td>
								<td class="text-center" style="padding-top: 22px">3</td>
								<td class="text-center" style="padding-top: 22px">4</td>
								<td class="text-center" style="padding-top: 22px">5</td>
							</tr>
							<tr>
								<td class="text-center">E</td>
								<td class="text-center" style="background: #e0ef3b">64</td>
								<td class="text-center" style="background: #e84747">96</td>
								<td class="text-center" style="background: #e84747">160</td>
								<td class="text-center" style="background: #9940dd">288</td>
								<td class="text-center" style="background: #9940dd">352</td>
							</tr>
							<tr>
								<td class="text-center">D</td>
								<td class="text-center" style="background: #e0ef3b">32</td>
								<td class="text-center" style="background: #e0ef3b">48</td>
								<td class="text-center" style="background: #e0ef3b">80</td>
								<td class="text-center" style="background: #e84747">144</td>
								<td class="text-center" style="background: #e84747">176</td>
							</tr>
							<tr>
								<td class="text-center">C</td>
								<td class="text-center" style="background: #3bef50">16</td>
								<td class="text-center" style="background: #3bef50">24</td>
								<td class="text-center" style="background: #e0ef3b">40</td>
								<td class="text-center" style="background: #e0ef3b">72</td>
								<td class="text-center" style="background: #e0ef3b">88</td>
							</tr>
							<tr>
								<td class="text-center">B</td>
								<td class="text-center" style="background: #3bef50">8</td>
								<td class="text-center" style="background: #3bef50">12</td>
								<td class="text-center" style="background: #3bef50">20</td>
								<td class="text-center" style="background: #e0ef3b">36</td>
								<td class="text-center" style="background: #e0ef3b">44</td>
							</tr>
							<tr>
								<td class="text-center">A</td>
								<td class="text-center" style="background: #3bef50">4</td>
								<td class="text-center" style="background: #3bef50">6</td>
								<td class="text-center" style="background: #3bef50">10</td>
								<td class="text-center" style="background: #3bef50">18</td>
								<td class="text-center" style="background: #3bef50">22</td>
							</tr>
						</tbody>
					</table>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col" colspan="3" class="text-center">Classificação do risco ergonômico</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="background: #9940dd"></td>
								<td class="text-center">>=177</td>
								<td class="text-center">Altíssimo risco para lesão/doenças.</td>
							</tr>
							<tr>
								<td style="background: #e84747"></td>
								<td class="text-center">89 a 176</td>
								<td class="text-center">Alto risco para lesão/doenças.</td>
							</tr>
							<tr>
								<td style="background: #e0ef3b"></td>
								<td class="text-center">25 a 88</td>
								<td class="text-center">Risco moderado para lesão/doenças.</td>
							</tr>
							<tr>
								<td style="background: #3bef50"></td>
								<td class="text-center">< 24</td>
								<td class="text-center">Baixo risco para lesão/doenças.</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="parametroModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Parametros para classificação</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col" class="text-center" style="background: #79f77d">Riscos Organizacional/Cognitivo</th>
								<th scope="col" class="text-center" style="background: #79f77d">Observações E-social</th>
								<th scope="col" class="text-center" style="background: #79f77d">Exemplos</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="font-size: 15px; background: #f7f7f7"> Ausência de pausas para descanso ou não cumprimento destas durante a jornada.</td>
								<td style="font-size: 15px; background: #f7f7f7"> Aplicável quando o trabalhador para exercer sua atividade não disponha da possibilidade de fazer interrupções periódicas para descanso durante a jornada.</td>
								<td style="font-size: 15px; background: #f7f7f7"> Atividades repetitivas com ritmo rápido; atividades com esforço físico intenso; atividades em temperaturas extremas; atividades com posturas estáticas por longos períodos, atividades com grau de concentração elevado.</td>
							</tr>
							<tr>
								<td style="font-size: 15px; background: #f7f7f7"> Necessidade de manter ritmos intensos de trabalho.</td>
								<td style="font-size: 15px; background: #f7f7f7"> Aplicável as situações que o trabalhador necessite manter um ritmo intenso de trabalho, seja físico ou mental para cumprir suas atividades.</td>
								<td style="font-size: 15px; background: #f7f7f7"> Atividades repetitivas sem micro pausas, atividades mentais de concentração por longos períodos (controladores de vôo, motoristas, operadores de console).</td>
							</tr>
							<tr>
								<td style="font-size: 15px; background: #f7f7f7"> Trabalho com necessidade de variação dos turnos.</td>
								<td style="font-size: 15px; background: #f7f7f7"> Aplicável quando o trabalhador possui escalas escalonadas alternando o turno de trabalho.</td>
								<td style="font-size: 15px; background: #f7f7f7"> Trabalhos com escalas com variação de horários de trabalho, após dias de pausas.</td>
							</tr>
							<tr>
								<td style="font-size: 15px; background: #f7f7f7"> Ausência de plano de capacidade, habilitação, reciclagem e atualização dos empregados.</td>
								<td style="font-size: 15px; background: #f7f7f7"> Aplicável quando o colaborador não participa de um plano de desenvolvimento profissional, não recebe instruções formais, cursos ou treinamentos.</td>
								<td style="background: #f7f7f7"></td>
							</tr>
							<tr>
								<td style="font-size: 15px; background: #f7f7f7"> Cobrança de metas impossíveis.</td>
								<td style="font-size: 15px; background: #f7f7f7"> Aplicável quando colaborador é cobrado por metas de produtividade que não estão de acordo  com a realidade.</td>
								<td style="background: #f7f7f7"></td>
							</tr>
							<tr>
								<td style="font-size: 15px; background: #f7f7f7">Outros - organizacionais</td>
								<td style="background: #f7f7f7"></td>
								<td style="background: #f7f7f7"></td>
							</tr>
							<tr>
								<td style="font-size: 15px;">Situações de estresse.</td>
								<td style="font-size: 15px;"> Aplicável em situações que o colaborador tem exigências físicas e/ou mentais exageradas. Estas exigências podem estar relacionadas ao conteúdo ou as condições de trabalho, aos fatores organizacionais ou pressão econômico- sociais.</td>
								<td style="font-size: 15px;"> Numero menor de funcionários que o necessário, metas inatingiveis, pressão por resultado, executar atividade com risco de acidente.</td>
							</tr>
							<tr>
								<td style="font-size: 15px;">Situações de sobrecarga de trabalho mental.</td>
								<td style="font-size: 15px;"> Aplicável quando o empregado realiza o trabalho de alta exigência mental que envolva muitas tarefas e grandes responsabilidades.</td>
								<td style="font-size: 15px;"> Ter várias frentes de trabalho com prazos curtos, tomada de decisão sem preparação para isso, interferências do ambiente ou do trabalho que não permitem o cumprimento do prazo.</td>
							</tr>
							<tr>
								<td style="font-size: 15px;">Exigência de alto nível de concentração no trabalho.</td>
								<td style="font-size: 15px;"> Aplicável as situações em que o empregado necesista de alto nível de concentração e atenção.</td>
								<td style="font-size: 15px;"> Controlador de voo, operador de  console, inspeção de eletrônicos, montagem de produtos eletronicos, ourives.</td>
							</tr>
							<tr>
								<td style="font-size: 15px;">Meios de comunicação ineficientes.</td>
								<td style="font-size: 15px;"> Aplicável nas situações que os sistemas de comunicação, de todas as naturezas são falhas e ineficientes.</td>
								<td style="font-size: 15px;"> Dificuldade de acesso as informações importantes para atividade, dificuldade no acesso a chefia, dificuldade no contaro com areas essenciais para a execução da atividade.</td>
							</tr>
							<tr>
								<td style="font-size: 15px;">Outros - psicossociais/cognitivos.</td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php require_once('scripts.php') ?>
	<script type="text/javascript" src="assets/js/funcoes.js"></script>
</body>
