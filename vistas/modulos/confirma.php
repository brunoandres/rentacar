<?php
$categoria = $_POST['id_categoria'];
$total_dias = $_SESSION['total_dias'];

$new = new ControladorConfiguraciones();
$lugares = $new->listarLugares();

$new2 = new ControladorReservas();
$tarifa = $new2->tarifaReserva($categoria);
$categoria_seleccionada = explode(" ", $tarifa['categoria']);
if (isset($_POST['checkout'])) {

?>
<section id="portfolio">
  <div class="container">
    <div class="center">
      <h2>Confirme su Reserva</h2>
      <p class="lead">Verifique los datos de su reserva para confirmarla.</p>
      <p># Código reserva : <?php echo $_SESSION['codigo']; ?></p>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Detalle Reserva</span>
            <!--<span class="badge badge-secondary badge-pill">3</span>-->
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Categoria elegida</h6>
                <small class="text-muted"><?php echo $tarifa['categoria']; ?></small>
              </div>
              <span class="text-success"><strong>(<?php echo $categoria_seleccionada[1]; ?>)</strong></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Días de reservas</h6>
                <small class="text-muted">Cantidad de días</small>
              </div>
              <span class="text-success"><strong>(<?php echo $total_dias; ?>)</strong></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Valor diario</h6>
                <small class="text-muted">Tarifa por día</small>
              </div>
              <span class="text-success"><strong>$<?php echo $tarifa['valor_diario']; ?></strong></span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Valor reserva</h6>
                
                  
                <small class="text-muted">Por días selecionados</small>
              </div>
              <span class="text-success"><strong>$<?php echo $tarifa['valor_diario']*$total_dias; ?></strong></span>
            </li>
            

            <?php  
            $tarifa_ad = null;
            if (!empty($_POST['adicionales'])) {
              $adicionales = $_POST['adicionales'];
              foreach ($adicionales as $adicional => $value) {
                $tarifa_adicional = $new->tarifaAdicional($value);
                
                $tarifa_ad+=$tarifa_adicional['tarifa'];
              }
            

            ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?php echo $tarifa_adicional['nombre']; ?> + </h6>
                <small class="text-muted">Adicional seleccionado</small>
              </div>
              <span class="text-success"><strong>$<?php echo $tarifa_adicional['tarifa']; ?></strong></span>
            </li>
            <?php } ?>

            <li class="list-group-item d-flex justify-content-between">
              <span>Total Reserva (ARG)</span>
              <strong>

              
              <?php 
              $total = null;

              if ($tarifa['permite_promo']==0) {
                $total = ($tarifa['valor_diario']*$total_dias)+$tarifa_ad;
              }else{
                $total = $tarifa['valor_semanal'];
              } 

              echo '$'.$total;
              ?>
     
              </strong>
            </li>

          </ul>

          <form class="card p-2" method="GET">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Código Descuento">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Aplicar</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-8 order-md-1">
          <h3 class="mb-3">Detalles de su Reserva</h3>
          <form class="needs-validation" novalidate method="post">
            <hr class="mb-4">
            <div class="row">

              <div class="col-md-12">
              
                <ul><div class="shadow-none p-3 mb-5 bg-light rounded">Fecha desde </div></ul>
                <ul><div class="shadow-none p-3 mb-5 bg-light rounded">Fecha hasta </div></ul>  
                <ul><div class="shadow-none p-3 mb-5 bg-light rounded">Lugar de retiro </div></ul>
                <ul><div class="shadow-none p-3 mb-5 bg-light rounded">Lugar de entrega</div></ul>
      
              </div>

              <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

            </div>
            <hr class="mb-4">
            <br>
            <button class="btn btn-danger btn-lg btn-block" type="submit">Confirmar Reserva</button>
          </form>
        </div>
      </div>
    <!--/.row-->
  </div>
  <!--/.container-->
</section>
<!--/#contact-page-->
<?php }else{
  echo "NO POST";
} ?>
