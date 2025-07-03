<?php require_once('topo.php') ?>
<button type="button" class="btn btn-sm btn-info" onclick="location.href='?page=main'" style="margin-left:15px"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</button>
<div class="dropdown" style="position: absolute; top: 11px; left: 203px">
  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <i class="fa fa-pie-chart" aria-hidden="true"></i> Gerenciamento
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" style="cursor: pointer" onclick="location.href='?page=gerencia'">Painel de Indicadores</a>
    <a class="dropdown-item" style="cursor: pointer" onclick="location.href='?page=gerencia_avaliacao_trabalho'">Avaliação do trabalho</a>
  </div>
</div>
<h3 style="margin: 40px 0px 35px 50px">Painel de Indicadores</h3>
<div class="row" style="margin: 0px 0px 0px 40px">
  <div id="riscos_func"></div>
  <div id="risco_ativ"></div>
  <div id="risco_sub"></div>
</div>
<div class="container" style="margin-top: 50px; overflow-y:hidden; overflow-x: scroll; height: 470px;">
<table id="table-table" class="table" style="border: 1px solid #212121">
  <thead style="display: block">
    <tr>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 1120px;">Dados de Identificação</th>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 640px;">Pontuação de Prioridade de Risco (PPR)</th>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 320px;">Levantar/Baixar</th>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 320px;">Empurrar</th>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 320px;">Puxar</th>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 320px;">Transportar</th>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 1440px;">Avaliação do Corpo Inteiro</th>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 480px;">Totais da Avaliação do Corpo Inteiro</th>
      <th style="border: 1px solid #212121; min-width: 160px;"></th>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 320px;">Causa Direta</th>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 320px;">Melhorias</th>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 640px;">Dados de retorno sobre o investimento</th>
      <th scope="col" style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 640px;">Base para o retorno sobre o investimento</th>
    </tr>
  </thead>
  <tbody id="tabela_avaliacao_trabalho" style="overflow-y:scroll; overflow-x: hidden; display: block; height: 400px; width: 100%">
    <tr>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Localização</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Cargo</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Função</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Atividade</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Avaliação da Subatividade</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Tempo na Sub Atividade</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Nº de Operadores</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Inicial</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Projeção</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Acompanhamento</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">% de Variação</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Inicial</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Acomp</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Inicial</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Acomp</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Inicial</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Acomp</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Inicial</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Acomp</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">PE</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">PD</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">CE</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">CD</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">OE</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">OD</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Pes</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">C</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Per</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Baixo</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Medio</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Alto</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Estressores fisicos</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Identificada</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Encaminhada</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Identificado</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Concluido</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Custo</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Poupança</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Projetado</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Conservador</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">produtividade</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Qualidade</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Engajamento de funcionário</td>
      <td style="text-align: center; border: 1px solid #212121; font-size: 15px; min-width: 160px; vertical-align: middle">Evitar ferimentos e doenças</td>
    </tr>
  </tbody>
</table>
</div>
</tbody>
</table>
<hr />
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <p style="font-size: 16px">2017 - ENVERGO ERGONOMIA - CNPJ: 13.253.657/0001-02</p>
    </div>
  </div>
</div>
</body>
<?php require_once('scripts.php') ?>
<script type="text/javascript" src="assets/js/gerencia.js"></script>
</html>