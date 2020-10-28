<?php

$new = new ControladorConfiguraciones();
$tarifas = $new->listarTarifasFrontEnd();

?>
<section id="portfolio">
  <div class="container">
    <div class="center">
      <h2>Tarifas Austral Rent a Car vigentes al <?php echo date('d/m/Y'); ?></h2>
      <p class="lead">El Kilometraje es libre para la zona de El Bolsón, Villa La Angostura, 7 Lagos, y San Martín de los Andes.</p>
    </div>
    <hr>
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

        foreach ($tarifas as $value) {

        ?>
        <tr>
          <td><?php echo $value['nombre']; ?></td>
          <td><?php echo '$ '.$value['por_dia']; ?></td>
          <td><?php echo 'Libre' ?></td>
        </tr>

        <?php } ?>

      </tbody>
    </table><br><br><br><br><br><br><br><br>
  </div>


  <!--/.container-->
</section>
<!--/#contact-page-->

