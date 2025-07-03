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
<h3 style="margin: 40px 0px 35px 50px">Resumo da avaliação do trabalho</h3>
<div class="row" style="margin: 0px">
    <div style="width: 20%; heigth: 300px; margin: 30px 0px 0px 120px">
        <canvas id="priori_risco"></canvas>
    </div>
    <div style="width: 20%; heigth: 300px; margin: 30px 0px 0px 120px">
        <canvas id="levantar_baixar"></canvas>
    </div>
    <div style="width: 20%; heigth: 300px; margin: 30px 0px 0px 120px">
        <canvas id="e/p/t"></canvas>
    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript" src="assets/js/gerencia_avaliacao_trabalho.js"></script>
</html>