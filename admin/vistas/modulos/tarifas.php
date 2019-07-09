<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
$new = new ControladorConfiguraciones();
$tarifas = $new->tarifas();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tarifas
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data tables</li>
    </ol>
  </section>

  <div class="pad margin no-print">
    <div class="callout callout-info" style="margin-bottom: 0!important;">
      <h4><i class="fa fa-info"></i> A tener en cuenta:</h4>
      En la siguiente tabla figuran las tarifas por cada categoria y a la temporada que corresponde.
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tarifas" class="table table-bordered table-striped tablas" style="width:100%">

              <thead>
              <tr>
                <th>id</th>
                <th>Categoria</th>
                <th>Por dia</th>
                <th>Semanal</th>
                <th>Temporada</th>
                <th>Opciones</th>
              </tr>
              </thead>
              <tbody>

              <?php

              foreach ($tarifas as $value) {

              ?>
              <tr>
                <td><?php echo $value['id']; ?></td>
                <td><?php echo $value['nombre']; ?></td>
                <td><?php echo '$ '.$value['por_dia']; ?></td>
                <td><?php echo '$ '.$value['por_semana']; ?></td>
                <td><?php echo mostrarFecha($value['fecha_desde'])." - ".mostrarFecha($value['fecha_hasta']); ?></td>

                  <td>

                </td>
              </tr>

              <?php } ?>

              </tbody>
              <tfoot>
              <tr>
                <th>id</th>
                <th>Categoria</th>
                <th>Por dia</th>
                <th>Semanal</th>
                <th>Temporada</th>
                <th>Opciones</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div id="dataModal" class="modal fade">
      <div class="modal-dialog">
           <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Employee Details</h4>
                </div>
                <div class="modal-body" id="employee_detail">
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
           </div>
      </div>
 </div>
 <div id="add_data_Modal" class="modal fade">
      <div class="modal-dialog">
           <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">PHP Ajax Update MySQL Data Through Bootstrap Modal</h4>
                </div>
                <div class="modal-body">
                     <form method="post" id="insert_form">
                          <label>Enter Employee Name</label>
                          <input type="text" name="name" id="name" class="form-control" />
                          <br />
                          <label>Enter Employee Address</label>
                          <textarea name="address" id="address" class="form-control"></textarea>
                          <br />
                          <label>Select Gender</label>
                          <select name="gender" id="gender" class="form-control">
                               <option value="Male">Male</option>
                               <option value="Female">Female</option>
                          </select>
                          <br />
                          <label>Enter Designation</label>
                          <input type="text" name="designation" id="designation" class="form-control" />
                          <br />
                          <label>Enter Age</label>
                          <input type="text" name="age" id="age" class="form-control" />
                          <br />
                          <input type="hidden" name="employee_id" id="employee_id" />
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                     </form>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
           </div>
      </div>
 </div>
 <script>
 $(document).ready(function(){
      $('#add').click(function(){
           $('#insert').val("Insert");
           $('#insert_form')[0].reset();
      });
      $(document).on('click', '.edit_data', function(){
           var employee_id = $(this).attr("id");
           $.ajax({
                url:"fetch.php",
                method:"POST",
                data:{employee_id:employee_id},
                dataType:"json",
                success:function(data){
                     $('#name').val(data.name);
                     $('#address').val(data.address);
                     $('#gender').val(data.gender);
                     $('#designation').val(data.designation);
                     $('#age').val(data.age);
                     $('#employee_id').val(data.id);
                     $('#insert').val("Update");
                     $('#add_data_Modal').modal('show');
                }
           });
      });
      $('#insert_form').on("submit", function(event){
           event.preventDefault();
           if($('#name').val() == "")
           {
                alert("Name is required");
           }
           else if($('#address').val() == '')
           {
                alert("Address is required");
           }
           else if($('#designation').val() == '')
           {
                alert("Designation is required");
           }
           else if($('#age').val() == '')
           {
                alert("Age is required");
           }
           else
           {
                $.ajax({
                     url:"insert.php",
                     method:"POST",
                     data:$('#insert_form').serialize(),
                     beforeSend:function(){
                          $('#insert').val("Inserting");
                     },
                     success:function(data){
                          $('#insert_form')[0].reset();
                          $('#add_data_Modal').modal('hide');
                          $('#employee_table').html(data);
                     }
                });
           }
      });
      $(document).on('click', '.view_data', function(){
           var employee_id = $(this).attr("id");
           if(employee_id != '')
           {
                $.ajax({
                     url:"select.php",
                     method:"POST",
                     data:{employee_id:employee_id},
                     success:function(data){
                          $('#employee_detail').html(data);
                          $('#dataModal').modal('show');
                     }
                });
           }
      });
 });
 </script>
