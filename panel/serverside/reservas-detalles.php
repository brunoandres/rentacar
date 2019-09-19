<?php
include '../modelos/modelo.conexion.php';
include '../controladores/controlador.configuraciones.php';
include '../modelos/modelo.configuraciones.php';
$link = Conexion::ConectarMysql();
$newConf = new ControladorConfiguraciones();

 if(isset($_POST["id_reserva"]))
 {
      $output = '';
      $id = $_POST['id_reserva'];
      $query = "SELECT * FROM reservas WHERE id = $id";
      $result = mysqli_query($link, $query);
      $output .= '
      <div class="table-responsive">
           <table class="table table-bordered">';
      while($row = mysqli_fetch_array($result)){

        $adicionales = null;
        $tiene_adicionales = $newConf->buscarAdicionales($id);
        if (!empty($tiene_adicionales)) {
          $adicionales = $tiene_adicionales['adicionales'];
        }         
           $output .= '

                <tr>
                     <td width="30%"><label>Código Reserva</label></td>
                     <td width="70%">'.$row["codigo"].'</td>
                </tr>

                <tr>
                     <td width="30%"><label>Teléfono</label></td>
                     <td width="70%">'.$row["telefono"].'</td>
                </tr>

                <tr>
                     <td width="30%"><label>Dirección Email</label></td>
                     <td width="70%">'.$row["email"].'</td>
                </tr>

                <tr>
                     <td width="30%"><label>Total Dias</label></td>
                     <td width="70%">'.$row["total_dias"].' dia/s</td>
                </tr>
                
                <tr>
                     <td width="30%"><label>Total Tarifa</label></td>
                     <td width="70%">'.'$ '.$row["tarifa"].'</td>
                </tr>

                <tr>
                     <td width="30%"><label>Adicionales</label></td>
                     <td width="70%"><span class="badge badge-primary">'.$adicionales.'</span></td>
                </tr>

                <tr>
                     <td width="30%"><label>Observaciones</label></td>
                     <td width="70%">'.$row["observaciones"].'</td>
                </tr>

           ';
      }
      $output .= '
           </table>
      </div>
      ';
      echo $output;
 }
 ?>
