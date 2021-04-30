<?php

$new = new ControladorConfiguraciones();
$tarifasVigentes = $new->listarTarifasFrontEnd(null,4);

$tarifasProxTemp = $new->listarTarifasFrontEnd(null,5);

$tempVig = implode(',',$tarifasVigentes[0]);
$fecha1 = substr($tempVig,19);

$proxTemp = implode(',',$tarifasProxTemp[0]);
$fecha2 = substr($proxTemp,19);

?>
<section id="portfolio">
  <div class="container">
    <div class="center">
      <h2>Tarifas Austral Rent a Car vigentes</h2>
      <p class="lead">El Kilometraje es libre para la zona de El Bolsón, Villa La Angostura, 7 Lagos, y San Martín de los Andes.</p>
    </div>
    <div class="row">
      <!--<div class="col-lg-6">
        <div class="center">
          <h3>Tarifa vigente hasta el <strong><?php echo $fecha1; ?></strong></h3>

        </div>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Categoria</th>
              <th scope="col">Tarifa diaria</th>
              <th scope="col">Kilometrajes</th>
            </tr>
          </thead>
          <tbody>

            <?php

            foreach ($tarifasVigentes as $value) {

            ?>
            <tr>
              <td><?php echo $value['nombre']; ?></td>
              <td><?php echo '$ '.$value['por_dia']; ?></td>
              <td><?php echo 'Libre' ?></td>
            </tr>

            <?php } ?>

          </tbody>
        </table>
      </div>-->
      <div class="col-lg-12">
        <div class="center">
          <div class="center">
            <h3>Tarifa vigente desde el <strong>01/12/2020</strong> hasta el <strong><?php echo $fecha2; ?></strong></h3>

          </div>
        </div>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Categoria</th>
              <th scope="col">Tarifa diaria</th>
              <th scope="col">Kilometrajes</th>
            </tr>
          </thead>
          <tbody>

            <?php

            foreach ($tarifasProxTemp as $value) {

            ?>
            <tr>
              <td><?php echo $value['nombre']; ?></td>
              <td><?php echo '$ '.number_format($value['por_dia'],2); ?></td>
              <td><?php echo 'Libre' ?></td>
            </tr>

            <?php } ?>

          </tbody>
        </table><br><br><br><br><br><br><br><br>
      </div>

    </div>

  </div>


  <!--/.container-->
</section>
<!--/#contact-page-->
