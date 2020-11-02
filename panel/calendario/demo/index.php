<?php
require_once 'conexion.php';

$db = Conexion();

$qry_cat = "select c.nombre , a.patente, a.id as id_auto, concat(a.marca,'-',a.modelo) as marca from  autos a  inner join categorias c on  (c.id = a.id_categoria)";

$categorias_db = $db->query($qry_cat);

$categorias = array();

foreach($categorias_db as $cat)
{
    $categorias[]=$cat;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="chuck-durst">

    <title>pit-scheduler</title>

    <link  rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link  rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css">
    <link  rel="stylesheet" type="text/css" href="../dist/css/pitscheduler.min.css">
    <link  rel="stylesheet" type="text/css" href="css/demo.css">
</head>

<body data-spy="scroll" data-target=".bs-sidebar" data-offset="50">

<div class="main-container container-fluid row">
    <div class="demo-container">
        <div id="pit-scheduler"></div>
    </div>
</div>
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/moment-with-locales.min.js"></script>
<script src="js/bootstrap-datetimepicker.js"></script>
<script src="../dist/js/pitscheduler.min.js"></script>
<script>

    $(document).ready(function () {

         var fecha_a_posicionar = new Date();

        $("#pit-scheduler").pitScheduler({
            locale: 'es',
            defaultDisplay: 'months',
            hideEmptyLines: false,
            disableLabelsMovement: true,
            defaultGroupName: 'Sin categoria',
            defaultDate: fecha_a_posicionar,
            disableNotifications: false,
            notificationDuration: 4000,
            hideSpinner: true,
            resizeTask: false,
            tasks:  [

                {
                    id: 'reserva',
                    name: 'Reservado',
                    description: '',
                    color: '#fcd720',
                    tag: '',
                    tagColor: '#50d371'
                }
            ],
            users: [

                //Traigo los autos con las categorias
                <?php

                $id_auto = '';

                foreach ($categorias as $c) {
                    $id_auto = $c['id_auto'];

                    $auto = $c['patente'].'-'.$c['marca'];?>

                   {
                    name: '<?php echo $auto; ?>',
                    group: '<?php echo $c['nombre']; ?>',
                    tasks: [

                        <?php
                        //Traigo Reservas del auto

                         $qry_res = "   SELECT
                                        r.id as id_reserva,
                                        concat(r.fecha_desde,' ',r.hora_desde) as fecha_desde,
                                        concat(r.fecha_hasta,' ',r.hora_hasta) as fecha_hasta,
                                        r.id_auto as fk_id_auto
                                        FROM reservas r
                                        INNER JOIN autos a on (r.id_auto = a.id)
                                        WHERE a.id = '$id_auto'";

                        $reservas_db = $db->query($qry_res);

                        $reservas = array();

                        foreach($reservas_db as $res)
                        {
                            $reservas[]=$res;
                        }


                        foreach ($reservas as $r) {
                            //Formateo las fechas de la base

                            $inicio = $r['fecha_desde'];
                            $fin = $r['fecha_hasta'];

                            $mensaje = 'Reservado del '.date_create($inicio)->format('d/m/Y H:i').' al '.date_create($fin)->format('d/m/Y H:i');
                            ?>

                            {
                                id: 'reserva',
                                name: '<?php echo $mensaje; ?>',
                                start_date: '<?php echo $inicio; ?>',
                                end_date: '<?php echo $fin; ?>'
                            },
                       <?php }?>
                    ]
                },

         <?php  }//END FOR Categorias  ?>

            ]//END Users
        });

    });

</script>
</body>
</html>
