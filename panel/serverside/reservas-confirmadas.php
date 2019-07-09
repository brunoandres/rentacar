<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include '../modelos/modelo.conexion.php';
$request=$_REQUEST;
$col =array(
    0   =>  'id_reserva',
    1   =>  'nombre',
    2   =>  'email',
    3   =>  'tel',
    4   =>  'vehiculo',
    5   =>  'retiro',
    6   =>  'devolucion'
);

$link = Conexion::ConectarMysql();
$sql ="select a.*,b.categoria from reservas a, categorias b where a.vehiculo=b.id_categoria and a.estado = 1 ";
$query=mysqli_query($link,$sql);
$totalData=mysqli_num_rows($query);
$totalFilter=$totalData;
//Search
$sql ="select a.*,b.categoria from reservas a, categorias b where a.vehiculo=b.id_categoria and a.estado = 1 ";
if(!empty($request['search']['value'])){
    $sql.=" AND (a.id_reserva Like '%".$request['search']['value']."%' ";
    $sql.=" OR a.nombre Like '%".$request['search']['value']."%' ";
    $sql.=" OR a.email Like '%".$request['search']['value']."%' ";
    $sql.=" OR a.vehiculo Like '%".$request['search']['value']."%' ";
    $sql.=" OR a.vuelo Like '%".$request['search']['value']."%' ";
    $sql.=" OR a.retiro Like '%".$request['search']['value']."%' ";
    $sql.=" OR a.hdesde Like '%".$request['search']['value']."%' ";
    $sql.=" OR date_format(a.fdesde,'%d/%m/%Y') Like '%".$request['search']['value']."%' ";
    $sql.=" OR b.categoria Like '%".$request['search']['value']."%' ";
    $sql.=" OR a.devolucion Like '%".$request['search']['value']."%' )";
}
$query=mysqli_query($link,$sql);
$totalData=mysqli_num_rows($query);
//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";
$query=mysqli_query($link,$sql);
$data=array();


while($row=mysqli_fetch_array($query)){

    $subdata=array();

    $subdata[]=$row[0];
    $subdata[]=$row[1];
    $subdata[]=$row[26];
    $subdata[]=date('d-m-Y', strtotime($row[11]));
    $subdata[]=$row[13];
    $subdata[]=$row[5];
    if (!empty($row[9])) {
        $subdata[]=$row[9];
    }else{
        $subdata[]='--';
    }
    

    $subdata[]='

    <td width="25%">
  

      <a href="index.php?ruta=editar-ip&ip='.$row[0].'" title="Editar IP"><button class="btn btn-xs btn-warning"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>

      <button type="button" name="view" value="" id='.$row[0].' class="btn btn-info btn-xs view_data"><i class="fa fa-eye" aria-hidden="true"></i></button>
    </td>
    '; //        
    
     
    $data[]=$subdata;
}
$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);
echo json_encode($json_data);

?>