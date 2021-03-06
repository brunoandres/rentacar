$(function () {
  
  //Initialize Select2 Elements
  $('.select2').select2()

  $.datepicker.regional['es'] = {
   closeText: 'Cerrar',
   prevText: '< Ant',
   nextText: 'Sig >',
   currentText: 'Hoy',
   monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
   monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
   dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
   dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
   dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
   weekHeader: 'Sm',
   dateFormat: 'yy/mm/dd',
   firstDay: 1,
   isRTL: false,
   showMonthAfterYear: false,
   yearSuffix: ''
   };
   $.datepicker.setDefaults($.datepicker.regional['es']);


  //DEFINO ARRAY DE FECHAS ESPECÍFICAS
  var disableddates = ["01-12-2018", "02-12-2018", "03-12-2018", "04-12-2018", "05-12-2018", "06-12-2018", "07-12-2018", "08-12-2018", "09-12-2018", "10-12-2018", "11-12-2018", "12-12-2018", "13-12-2018", "14-12-2018", "15-12-2018", "16-12-2018", "17-12-2018", "18-12-2018", "19-12-2018", "20-12-2018", "21-12-2018", "22-12-2018", "23-12-2018", "24-12-2018", "25-12-2018", "26-12-2018", "27-12-2018", "28-12-2018", "29-12-2018", "30-12-2018", "31-12-2018", "01-01-2019", "02-01-2019", "03-01-2019", "04-01-2019", "05-01-2019", "06-01-2019", "07-01-2019", "08-01-2019", "09-01-2019", "10-01-2019", "11-01-2019", "12-01-2019", "13-01-2019", "14-01-2019", "15-01-2019", "16-01-2019", "17-01-2019", "18-01-2019", "19-01-2019", "20-01-2019", "21-01-2019", "22-01-2019", "23-01-2019", "24-01-2019", "25-01-2019", "26-01-2019", "27-01-2019", "28-01-2019", "29-01-2019", "30-01-2019", "31-01-2019", "01-02-2019", "02-02-2019", "03-02-2019", "04-02-2019", "05-02-2019", "06-02-2019", "07-02-2019", "08-02-2019", "09-02-2019", "10-02-2019", "11-02-2019", "12-02-2019", "13-02-2019", "14-02-2019", "15-02-2019", "16-02-2019", "17-02-2019", "18-02-2019", "19-02-2019", "20-02-2019", "21-02-2019", "22-02-2019", "23-02-2019", "24-02-2019", "25-02-2019", "26-02-2019", "27-02-2019", "28-02-2019"];

  //FUNCION PARA DESHABILITAR FECHAS
  function DisableSpecificDates(date) {
    var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
    return [disableddates.indexOf(string) == -1];
  }

  $( function() {
      var dateFormat = "yy-mm-dd",
        from = $( "#datepicker" )
          .datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat : "yy-mm-dd",
            minDate: 0//,
            //beforeShowDay: DisableSpecificDates
          })
          .on( "change", function() {
            to.datepicker( "option", "minDate", getDate( this ) );
          }),
        to = $( "#datepicker2" ).datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1,
          dateFormat : "yy-mm-dd",//
          minDate: 0//,
          //beforeShowDay: DisableSpecificDates

        })
        .on( "change", function() {
          from.datepicker( "option", "maxDate", getDate( this ) );
        });

      function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }

        return date;
      }
    } );


  $('.clockpicker').clockpicker()
        .find('input').change(function(){
          console.log(this.value);
        });
      var input = $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
      });

      var input = $('#single-input2').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
  });

  $('.clockpicker-with-callbacks').clockpicker({
          donetext: 'Done',
          init: function() {
            console.log("colorpicker initiated");
          },
          beforeShow: function() {
            console.log("before show");
          },
          afterShow: function() {
            console.log("after show");
          },
          beforeHide: function() {
            console.log("before hide");
          },
          afterHide: function() {
            console.log("after hide");
          },
          beforeHourSelect: function() {
            console.log("before hour selected");
          },
          afterHourSelect: function() {
            console.log("after hour selected");
          },
          beforeDone: function() {
            console.log("before done");
          },
          afterDone: function() {
            console.log("after done");
          }
        })
        .find('input').change(function(){
          console.log(this.value);
        });

      // Manually toggle to the minutes view
      $('#check-minutes').click(function(e){
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show')
            .clockpicker('toggleView', 'minutes');
      });
      if (/mobile/i.test(navigator.userAgent)) {
        //$('input').prop('readOnly', true);
        $("#single-input").prop("readonly", true);
        $("#single-input2").prop("readonly", true);
        $("#single-input1").prop("required", true);
        $("#single-input2").prop("required", true);
      }

      
      
  })
