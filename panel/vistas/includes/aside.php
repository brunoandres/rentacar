<?php
if (!isset($_GET['ruta'])) {
  $_GET['ruta']=null;
}
$text = null;
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="vistas/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['usuario']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Menú</li>

      <li class="<?php if ($_GET['ruta']=='inicio') {
        echo "active";
      } ?>"><a href="inicio"><i class="fa fa-dashboard"></i> <span>Inicio</span></a></li>

      <li class="treeview <?php if ($_GET['ruta']=='nueva-reserva' || $_GET['ruta']=='pendientes' || $_GET['ruta']=='confirmadas') {
        echo "active";
      } ?>">
        <a href="#">
          <i class="fa fa-pie-chart"></i>
          <span>Reservas</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          <li class="<?php if ($_GET['ruta']=='nueva-reserva') {
            echo "active";
            $text = 'text-red';
          }?>"><a href="nueva-reserva"><i class="fa fa-circle-o"></i> Nueva reserva</a></li>
          <li class="<?php if ($_GET['ruta']=='pendientes') {
            echo "active";
          } ?>"><a href="pendientes"><i class="fa fa-circle-o>"></i> Pendientes</a></li>
          <li class="<?php if ($_GET['ruta']=='confirmadas') {
            echo "active";
          } ?>"><a href="confirmadas"><i class="fa fa-circle-o"></i> Confirmadas</a></li>
        </ul>
      </li>
      <li class="treeview <?php if ($_GET['ruta']=='nueva-tarifa'
      || $_GET['ruta']=='tarifas'
      || $_GET['ruta']=='categorias'
      || $_GET['ruta']=='nueva-categoria'
      || $_GET['ruta']=='configuraciones'
      || $_GET['ruta']=='temporadas'
      || $_GET['ruta']=='nueva-temporada'
      || $_GET['ruta']=='editar-temporada'
      || $_GET['ruta']=='nueva-configuracion'
      || $_GET['ruta']=='nuevo-adicional'
      || $_GET['ruta']=='adicionales'
      || $_GET['ruta']=='autos'
      || $_GET['ruta']=='nuevo-auto') {
        echo "active";
      } ?>">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Administración</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="treeview <?php if ($_GET['ruta']=='autos' || $_GET['ruta']=='nuevo-auto') {
            echo "active";
          } ?>">
            <a href="#"><i class="fa fa-circle-o"></i> Autos
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              <li class="<?php if ($_GET['ruta']=='nuevo-auto') {
                echo "active";
              } ?>"><a href="nuevo-auto"><i class="fa fa-circle-o"></i> Nuevo Auto</a></li>

              <li class="<?php if ($_GET['ruta']=='autos') {
                echo "active";
              } ?>"><a href="autos"><i class="fa fa-circle-o"></i> Ver Autos</a></li>
            </ul>
          </li>
          <li class="treeview <?php if ($_GET['ruta']=='tarifas' || $_GET['ruta']=='nueva-tarifa') {
            echo "active";
          } ?>">
            <a href="#"><i class="fa fa-circle-o"></i> Tarifas
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              <li class="<?php if ($_GET['ruta']=='nueva-tarifa') {
                echo "active";
              } ?>"><a href="nueva-tarifa"><i class="fa fa-circle-o"></i> Nueva Tarifa</a></li>

              <li class="<?php if ($_GET['ruta']=='tarifas') {
                echo "active";
              } ?>"><a href="tarifas"><i class="fa fa-circle-o"></i> Ver Tarifas</a></li>
            </ul>
          </li>

          <li class="treeview <?php if ($_GET['ruta']=='categorias' || $_GET['ruta']=='nueva-categoria') {
            echo "active";
          } ?>">
            <a href="#"><i class="fa fa-circle-o"></i> Categorias
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              <li class="<?php if ($_GET['ruta']=='nueva-categoria') {
                echo "active";
              } ?>"><a href="nueva-categoria"><i class="fa fa-circle-o"></i> Nueva Categoria</a></li>

              <li class="<?php if ($_GET['ruta']=='categorias') {
                echo "active";
              } ?>"><a href="categorias"><i class="fa fa-circle-o"></i> Ver Categorias</a></li>
            </ul>
          </li>

          <li class="treeview <?php if ($_GET['ruta']=='temporadas' || $_GET['ruta']=='nueva-temporada' || $_GET['ruta']=='editar-temporada') {
            echo "active";
          } ?>">
            <a href="#"><i class="fa fa-circle-o"></i> Temporadas
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              <li class="<?php if ($_GET['ruta']=='nueva-temporada') {
                echo "active";
              } ?>"><a href="nueva-temporada"><i class="fa fa-circle-o"></i> Nueva Temporada</a></li>

              <li class="<?php if ($_GET['ruta']=='temporadas') {
                echo "active";
              } ?>"><a href="temporadas"><i class="fa fa-circle-o"></i> Ver Temporadas</a></li>
            </ul>
          </li>

          <li class="treeview <?php if ($_GET['ruta']=='configuraciones' || $_GET['ruta']=='nueva-configuracion') {
            echo "active";
          } ?>">
            <a href="#"><i class="fa fa-circle-o"></i> Configuraciones
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              <li class="<?php if ($_GET['ruta']=='nueva-configuracion') {
                echo "active";
              } ?>"><a href="nueva-configuracion"><i class="fa fa-circle-o"></i> Nueva configuración</a></li>

              <li class="<?php if ($_GET['ruta']=='configuraciones') {
                echo "active";
              } ?>"><a href="configuraciones"><i class="fa fa-circle-o"></i> Ver Configuraciones</a></li>
            </ul>
          </li>

          <li class="treeview <?php if ($_GET['ruta']=='adicionales' || $_GET['ruta']=='nuevo-adicional') {
            echo "active";
          } ?>">
            <a href="#"><i class="fa fa-circle-o"></i> Adicionales
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              <li class="<?php if ($_GET['ruta']=='nuevo-adicional') {
                echo "active";
              } ?>"><a href="nuevo-adicional"><i class="fa fa-circle-o"></i> Nuevo adicional</a></li>


              <li class="<?php if ($_GET['ruta']=='adicionales') {
                echo "active";
              } ?>"><a href="adicionales"><i class="fa fa-circle-o"></i> Ver Adicionales</a></li>
            </ul>
          </li>

        </ul>

      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
