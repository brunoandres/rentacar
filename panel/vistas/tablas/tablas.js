
  $(function () {
    $('#tarifas').DataTable({
      "language":{
        "url":"spanish.json"
      },
      "order": [[ 0, "asc" ]],
      responsive: true
    })
  })

  $(document).ready(function() {
    $.fn.dataTable.moment( 'DD/MM/YYYY' );
    $('#confirmadas').DataTable({
      "language":{
        "url":"spanish.json"
      },
      "order": [[ 0, "desc" ]],
      responsive: true
    })
  })

  $(document).ready(function() {
    $.fn.dataTable.moment( 'DD/MM/YYYY' );
    $('#categorias').DataTable({
      "language":{
        "url":"spanish.json"
      },
      "order": [[ 0, "asc" ]],
      responsive: true
    })
  })

  $(document).ready(function() {
    $.fn.dataTable.moment( 'DD/MM/YYYY' );
    $('#temporadas').DataTable({
      "language":{
        "url":"spanish.json"
      },
      "order": [[ 0, "asc" ]],
      responsive: true
    })
  })

  $(document).ready(function() {
    $.fn.dataTable.moment( 'DD/MM/YYYY' );
    $('#adicionales').DataTable({
      "language":{
        "url":"spanish.json"
      },
      "order": [[ 0, "asc" ]],
      responsive: true
    })
  })
