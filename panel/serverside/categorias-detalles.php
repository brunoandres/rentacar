<?php
include '../modelos/modelo.conexion.php';

$link = Conexion::ConectarMysql();

if(isset($_POST["id_categoria"])){

      $output = '';
      $id = $_POST['id_categoria'];
      $query = "SELECT * FROM autos WHERE id_categoria = $id";
      $result = mysqli_query($link, $query);
      $output .= '
      <div class="table-responsive">
           <table class="table table-bordered"><thead>
            <tr>
              <th scope="col">Marca</th>
              <th scope="col">Modelo</th>
              <th scope="col">Patente</th>
              <th scope="col">Estado</th>
              <th scope="col">Chile</th>
            </tr>
          </thead>
          <tbody>';
      while($row = mysqli_fetch_array($result)){

          if ($row['estado']==1) {
            $estado = '<span class="label label-success">Habilitado</span>';
          }else{
            $estado = '<span class="label label-danger">No Habilitado</span>';
          }

          if ($row['viaja_chile']==1) {
            $chile = '<span class="label label-success">Habilitado</span>';
          }else{
            $chile = '<span class="label label-danger">No Habilitado</span>';
          }
        
           $output .= '

                <tr>
                  <th scope="row">'.$row['marca'].'</th>
                  <td>'.$row['modelo'].'</td>
                  <td>'.$row['patente'].'</td>
                  <td>'.$estado.'</td>
                  <td>'.$chile.'</td>
                </tr>

           ';
      }
      $output .= 
            '</tbody>
           </table>
      </div>
      ';
      echo $output;
 }
 ?>
