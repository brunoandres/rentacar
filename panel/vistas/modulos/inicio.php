<?php  

$new = new ControladorReservas();
$newCat = new ControladorCategorias();
$newConf = new ControladorConfiguraciones();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Sistema de Reservas Online
      <small>Patagonia Austral Rent a Car</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Tablero</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $total = $new->listarTotalReservas(); ?></h3>

            <p>Reservas confirmadas 2019</p>
          </div>
          <div class="icon">
            <i class="fa fa-list-ol" aria-hidden="true"></i>
          </div>
          <a href="confirmadas" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $totalCat = $newCat->listarTotalCategorias(); ?><sup style="font-size: 20px"></sup></h3>
            <p>Categorias activas</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="categorias" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $totalConf = $newConf->listarTotalAutos(); ?></h3>

            <p>Autos habilitados</p>
          </div>
          <div class="icon">
            <i class="fa fa-car" aria-hidden="true"></i>
          </div>
          <a href="autos" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo $total = $newConf->listarTotalConfiguraciones(); ?></h3>

            <p>Configuraciones activas</p>
          </div>
          <div class="icon">
            <i class="fa fa-wrench" aria-hidden="true"></i>
          </div>
          <a href="configuraciones" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>

    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $total = $newConf->listarTotalTemporadas(); ?></h3>

            <p>Temporadas activas</p>
          </div>
          <div class="icon">
           <i class="fa fa-sun-o" aria-hidden="true"></i>

          </div>
          <a href="temporadas" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $total = $newConf->listarTotalLugares(); ?><sup style="font-size: 20px"></sup></h3>

            <p>Lugares activos</p>
          </div>
          <div class="icon">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
          </div>
          <a href="lugares" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $total = $newConf->listarTotalAdicionales(); ?></h3>

            <p>Adicionales activos</p>
          </div>
          <div class="icon">
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
          </div>
          <a href="adicionales" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo $total = $newConf->listarTotalTarifas(); ?></h3>

            <p>Tarifas activas</p>
          </div>
          <div class="icon">
            <i class="fa fa-money" aria-hidden="true"></i>
          </div>
          <a href="tarifas" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

  <section class="content-header">
    <h1>
      Movimientos Reservas
    </h1>
  </section>


  <!-- movimientos contenidos -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php
            $date = date('Y-m-d'); 
            $query = " fecha_desde = '$date'";
            echo $total = $new->listarTotalesReservasPanel($query); 
            ?></h3>

            <p>Autos que se retiran Hoy</p>
          </div>
          <div class="icon">
            <i class="fa fa-car" aria-hidden="true"></i>
          </div>
          <a href="entregar-hoy" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php

            $date = date('Y-m-d'); 
            $query = " fecha_desde = DATE_SUB('$date',INTERVAL -1 DAY)";
            echo $total = $new->listarTotalesReservasPanel($query); 

             ?></h3>

            <p>Autos que se retiran Mañana</p>
          </div>
          <div class="icon">
            <i class="fa fa-car" aria-hidden="true"></i>
          </div>
          <a href="entregar-manana" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        

        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php 

            $date = date('Y-m-d'); 
            $query = " fecha_hasta = '$date'";
            echo $total = $new->listarTotalesReservasPanel($query); 

            ?><sup style="font-size: 20px"></sup></h3>
            <p>Autos que devuelven Hoy</p>
          </div>
          <div class="icon">
            <i class="fa fa-car" aria-hidden="true"></i>
          </div>
          <a href="devuelven-hoy" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>

      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php 

            $date = date('Y-m-d'); 
            $query = " fecha_hasta = DATE_SUB('$date',INTERVAL -1 DAY)";
            echo $total = $new->listarTotalesReservasPanel($query); 

            ?></h3>

            <p>Autos que devuelven Mañana</p>
          </div>
          <div class="icon">
            <i class="fa fa-car" aria-hidden="true"></i>
          </div>
          <a href="devuelven-manana" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>

  </section>
  <!-- /.contenido movimiento -->
</div>
<!-- /.content-wrapper -->
