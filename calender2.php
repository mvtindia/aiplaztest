            <!--+++++++++Form Start HERE for ADd_ canelder data++++++++++++-->
          <link rel="stylesheet" type="text/css" href="jquery-cal/css/range-calendar.css">
  <link rel="stylesheet" type="text/css" href="jquery-cal/css/range-style.css">

 <link rel="stylesheet" type="text/css" href="jquery-cal/css/range-calendar.css">

 <!--+++++++++Form Start HERE for ADd_ canelder data++++++++++++-->
      <div id="demo1"></div>
         <form  id="display-form" style="display: none">
  <div class="col-md-12">
  <div class="event empty">
  <input type="text" id="placeid_cal" value="<?php echo $sid; ?>" hidden>
  <input class="form-control "type="text" required id="plabel" placeholder="Give Dates a Label" name="plabel">
  </div></div>
  <div class="col-md-12 mg-top10">
  <div class="col-md-6">
<button class="btn-3 btn-custom2 avail1" style="background: #03DAAB;" type="button">Available</button>
  </div><div class="col-md-6">
<button class="btn-3 btn-custom2 avail2" type="button">Not Available</button>
  </div>
  </div>
  <div class="col-md-12 mg-top10" id="priceper">
  <div class="col-md-4">
<input type="text" id="pph" required placeholder="Price Per hour" class="form-control">
  </div>
    <div class="col-md-4">
<input type="text" id="ppw" required placeholder="Price Per Night" class="form-control">
  </div>
    <div class="col-md-4">
<input type="text" id="ppm" required placeholder="Price Per Week" class="form-control">
  </div>
  </div>

  <input type="text" id="status" required value="" hidden>;
  <div class="col-md-12 mg-top10" id="showpnames"></div>
  <div class="col-md-12 mg-top10"><div class="col-md-6">
  <input class="form-control date21" required type="text" id="datevalue1" name="pdate1" readonly>
  </div>
  <div class="col-md-6">
  <input class="form-control date21" required type="text" id="datevalue2" name="pdate2" readonly>
  <!-- <input class="form-control placeid" type="hidden" name="placeid" placeholder="dd/mm/yy"> -->
 <!--  <input class="form-control" type="hidden" name="ppath" value="http://localhost/nf/bookmyspace"> --></div>
  </div>
 <!--  <div class="col-md-12 mg-top10">
  <div class="col-md-6">
  <input class="form-control" type="time" name="ptime1"></div>
  <div class="col-md-6">
  <input class="form-control" type="time" name="ptime2">
  </div>
  </div> -->
  <div class="col-md-12 mg-top10"><div class="col-md-6">
  <button class="btn-3 btn-custom2 cancl" type="button">Cancel</button></div>
  <div class="col-md-6"><button class="btn-3 btn-custom2 myset2" type="button" name="values">Set</button></div></div></form>
        <script src="js/jquery.min.js"></script>     
     <script src="bootstrap/js/bootstrap.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment-with-langs.min.js"></script>
<script src="jquery-cal/js/jquery.rangecalendar.js"></script>
  <script>
  $(document).ready(function(){

      // $('.date21').datepicker();
      var customizedRangeCalendar = $("#demo1").rangeCalendar({ theme:"full-green-theme", start : "+0",startRangeWidth : 1,

});
       $(".cal-cell ").click(function(){
                $('#display-form').css('display','block');
              });
        $(".cal-cell ").mouseenter(function(){
               var start = $('.start').attr('date-id');
               var  year = start.substring(0,4);
               var month = start.substring(4,6);
               var day = start.substring(6,8);
               var last = $('.last').attr('date-id');
               var  year1 = last.substring(0,4);
               var month1 = last.substring(4,6);
               var day1 = last.substring(6,8);
             
                $('#datevalue1').val(year+"-"+month+"-"+day).attr('readonly');
               $('#datevalue2').val(year1+"-"+month1+"-"+day1).attr('readonly');
              });
         $(".cal-cell").mouseleave(function(){
               var start = $('.start').attr('date-id');
             var  year = start.substring(0,4);
             var month = start.substring(4,6);
             var day = start.substring(6,8);
                var last = $('.last').attr('date-id');
                var  year1 = last.substring(0,4);
             var month1 = last.substring(4,6);
             var day1 = last.substring(6,8);
              
                $('#datevalue1').val(year+"-"+month+"-"+day).attr('readonly');
               $('#datevalue2').val(year1+"-"+month1+"-"+day1).attr('readonly');
              });
$('#priceper').css('display','none');

$('.avail1').click(function(){
  $('this').css('background','white;');
  $('.avail2').removeAttr('disabled');
     $('#status').attr('value','Available');
     $('#priceper').css('display','block');
    });

    $('.avail2').click(function(){
      $('#priceper input').attr('value','');
      $('#priceper').css('display','none');
       $('this').css('background','white;');
  $('.avail1').removeAttr('disabled');
  $('#pph').val('');
   $('#ppw').val('');
    $('#ppm').val('');
      $('#status').attr('value','Not Available');
    });

  $(".myset2").click(function(e)
  {
    var place_ids = $('#placeid_cal').val();
    var status = $('#status').val();
  var pph = $('#pph').val();
   var ppw = $('#ppw').val();
    var ppm = $('#ppm').val();
   var label =  $('#plabel').val();
   var date1 = $('#datevalue1').val();
   var date2 = $('#datevalue2').val();
   console.log('label1='+label+'&datefirst='+date1+'&datelast='+date2+'&status='+status+'&pph='+pph+'&ppn='+ppw+'&ppw='+ppm+'&placeid_cal='+place_ids);
     $.ajax({
           url: 'forms.php?label1='+label+'&datefirst='+date1+'&datelast='+date2+'&status='+status+'&pph='+pph+'&ppn='+ppw+'&ppw='+ppm+'&placeid_cal='+place_ids,
           contentType: false,
           cache: false,
           processData:false,
           success: function(data, textStatus, jqXHR)
           {    
            console.log(data);
             if(data == 'ok')
             { 
               $('#priceper').css('display','none');
               $('#calenderform').find("input[type=text], textarea").val("");
               
               $('#display-form').css('display','none');
              swal( 'Success!', 'Sucessfully Submitted', 'success');
              $('#selecteddates').load(window.location + ' #selecteddates');
              // $('.comment-main').load(window.location + ' .comment-main');
               $('.month-cell').removeClass('selected');
              $('.selected').append( "<p style='    padding: 1px 2px 1px 2px;color: rgb(3, 218, 171); background:rgb(205, 87, 87); font-size: 13px;  margin: 11px -9px; display: inline-block;'>Booked</p>" );
              $('.start').addClass('last');
              window.location.href="edit-service.php?sid="+place_ids+"&unique=100"
             }
             else
             { 
              $('#selecteddates').load(window.location + ' #selecteddates');
               swal( 'Oops!', 'This Date Range is Already Booked', 'error');
             }      
           },
      });
});
    });
</script>