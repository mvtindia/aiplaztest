<!--==================Signup Modal box==============-->
  <!-- Modal -->
    <?php

 $placeid = $_GET['placeid'];

//booking disable for hours
 $sql_footer2 = mysqli_query($connect,"SELECT * FROM booking WHERE placeid='".$placeid."'");
// Booking Dates Disables here
if(mysqli_num_rows($sql_footer2)>0)
{ 
  $total_array_days="";
  while($row_footer = mysqli_fetch_array($sql_footer2))
{        
            $days="";
            $newdays = "";
            $start    = new DateTime($row_footer['checkin']);
            $end_date = $row_footer['checkout'];
            $end      = new DateTime($row_footer['checkout']);
            $interval = new DateInterval('P1D'); // 1 day interval
            $period   = new DatePeriod($start, $interval, $end);
            foreach ($period as $day)
            {
                // Do stuff with each $day...
                $days .= $day->format('Y-m-d').',';
            }    
            $days = $days.$end_date.'<br>';
            $newdays = explode('<br>', $days);
            $main_days="";
              for($i=0;$i<count($newdays);$i++)
              {
                if($row_footer['hours']!="0")
                {
                  continue;
                }
                else
                {
                   $main_days = $main_days.$newdays[$i];
                }    
              }
            $total_array_days=$total_array_days.$main_days."-----";
             
            
}
            $total_array_days= rtrim($total_array_days,"-----");
            $total_array_days1 = explode('-----',$total_array_days);
            $assign_values3="";
            for($j=0;$j<count($total_array_days1);$j++)
            {
                $total_array_days1[$j]."<br>";
               $fruther_days = explode(',',$total_array_days1[$j]);
              for($k=0;$k<count($fruther_days);$k++)
              {   
                $fruther_days1=date_create($fruther_days[$k]);
                 $fruther_days2 = date_format($fruther_days1,"m/d/Y");
                 $assign_values3 = $assign_values3."arrDisabledDates[new Date('".$fruther_days2."')] = new Date('".$fruther_days2."');";
              }
            }
           
}
else
{

}
 //end here

 $sql_footer2 = mysqli_query($connect,"SELECT * FROM booking WHERE placeid='".$placeid."'");
// Booking Dates Disables here
if(mysqli_num_rows($sql_footer2)>0)
{ 
  $total_array_days="";
  while($row_footer = mysqli_fetch_array($sql_footer2))
{        
            $days="";
            $newdays = "";
            $start    = new DateTime($row_footer['checkin']);
            $end_date = $row_footer['checkout'];
            $end      = new DateTime($row_footer['checkout']);
            $interval = new DateInterval('P1D'); // 1 day interval
            $period   = new DatePeriod($start, $interval, $end);
            foreach ($period as $day)
            {
                // Do stuff with each $day...
                $days .= $day->format('Y-m-d').',';
            }    
            $days = $days.$end_date.'<br>';
            $newdays = explode('<br>', $days);
            $main_days="";
              for($i=0;$i<count($newdays);$i++)
              {
                $main_days = $main_days.$newdays[$i];
              }
            $total_array_days=$total_array_days.$main_days."-----";
             
            
}
            $total_array_days= rtrim($total_array_days,"-----");
            $total_array_days1 = explode('-----',$total_array_days);
            $assign_values2="";
            for($j=0;$j<count($total_array_days1);$j++)
            {
                $total_array_days1[$j]."<br>";
               $fruther_days = explode(',',$total_array_days1[$j]);
              for($k=0;$k<count($fruther_days);$k++)
              {   
                $fruther_days1=date_create($fruther_days[$k]);
                 $fruther_days2 = date_format($fruther_days1,"m/d/Y");
                 $assign_values2 = $assign_values2."arrDisabledDates[new Date('".$fruther_days2."')] = new Date('".$fruther_days2."');";
              }
            }
           
}
else
{

}
// End HEre


$sql_footer = mysqli_query($connect,"SELECT * FROM calenderdata WHERE placeid='".$placeid."' and status='Not Available'");
if(mysqli_num_rows($sql_footer)>0)
{ 
  $total_array_days="";
  while($row_footer = mysqli_fetch_array($sql_footer))
{        
            $days="";
            $newdays = "";
            $start    = new DateTime($row_footer['date1']);
            $end_date = $row_footer['date2'];
            $end      = new DateTime($row_footer['date2']);
            $interval = new DateInterval('P1D'); // 1 day interval
            $period   = new DatePeriod($start, $interval, $end);
            foreach ($period as $day)
            {
                // Do stuff with each $day...
                $days .= $day->format('Y-m-d').',';
            }    
            $days = $days.$end_date.'<br>';
            $newdays = explode('<br>', $days);
            $main_days="";
              for($i=0;$i<count($newdays);$i++)
              {
                $main_days = $main_days.$newdays[$i];
              }
            $total_array_days=$total_array_days.$main_days."-----";
             
            
}
$total_array_days= rtrim($total_array_days,"-----");
            $total_array_days1 = explode('-----',$total_array_days);
            $assign_values="";
            for($j=0;$j<count($total_array_days1);$j++)
            {
                $total_array_days1[$j]."<br>";
               $fruther_days = explode(',',$total_array_days1[$j]);
              for($k=0;$k<count($fruther_days);$k++)
              {   
                $fruther_days1=date_create($fruther_days[$k]);
                 $fruther_days2 = date_format($fruther_days1,"m/d/Y");
                 $assign_values = $assign_values."arrDisabledDates[new Date('".$fruther_days2."')] = new Date('".$fruther_days2."');";
              }
            }
           
}
else
{

}
    ?>
<div id="myModal2" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="showload" style="display:none;">
      <img class="showimg" src="img/loading.gif" style="margin:0 auto;display:block;">
    </div>
    <div class="hidecontent">
      
   
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login to continue</h4>
      </div>
      <div class="modal-body">
    <div id="first-block">
        <div class="fb">
  <button class="fb-btn"><i class="fa fa-facebook"></i>&nbsp;Join with Facebook</button>
  </div>

  <div class="google mg-top10">
  <button class="google-btn"><i class="fa fa-google-plus"></i>&nbsp;Join with Google</button>
  </div>

  <p class="text-center">or</p>
  <div class="text-center">
  <button type="button" class="btn-3">Login</button>
  <button type="button" class="btn-4">Signup</button>
  </div>
  </div>
  <div class="hide1" id="second-block">
  <form class="form-group" id="login">
  
  <div class="input-group" id="login">
    
    <span class="input-group-addon"><i class="fa fa-user"></i></span>
  <input type="email" class="form-control form-height40 bord-0"  name="email" reuired placeholder="Email Id"/>
</div>

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
  <input type="password" class="form-control form-height40 bord-0" name="password" required placeholder="Password"/>

  <input type="hidden" class="urlval" >

</div>

  <div class="text-center mg-top10">
  <button type="submit" class="btn-3" name="login">Login</button>
  <button type="button" class="btn-back">Back</button>
  </div>
  </form>
  </div>
  
  
  <div class="hide1" id="third-block">
  <form class="form-group" action="actions.php" id="signup_form" method="POST">
  
  <div class="input-group">
    
    <span class="input-group-addon"><i class="fa fa-user"></i></span>
  <input type="text" class="form-control form-height40 bord-0" name="fname" placeholder="First Name" required/>
</div>

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-user"></i></span>
  <input type="text" class="form-control form-height40 bord-0" name="lname" placeholder="Last Name" required/>
</div>


<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-at"></i></span>
  <input type="email" class="form-control form-height40 bord-0" name="email" placeholder="Email Address" required/>
</div>

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" class="form-control form-height40 bord-0 pwd" minlength="6" name="pwd" id="pwd" placeholder="Password" required/>
</div>

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
<input type="text"  maxlength="15" class="form-control form-height40 bord-0 phone" name="contact" placeholder="Mobile" required/>
</div>  

  
  <div class="text-center mg-top10">
  <button type="submit" name="signup" id="signup" class="btn-4">Signup</button>
  <button type="button" class="btn-back">Back</button>
  </div>
  </form>
  </div>
  
      </div>
      <div class="modal-footer" style="text-align: center;">
       <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <span class="showmsg" style="display:none;"></span>
      </div>
    </div>
 </div>
  </div>
</div>
  <!--==================Signup Modal box Ends==============-->
  

 
<!--========== footer 1st============-->
<footer class="footer-media">
        <div class="container container-custom">
            <div class="row">
                <div class="col-sm-4">
                    <h3 class="subtitle"><strong>Useful Links</strong></h3>
                    <ul class="site-links">
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Rooms</a></li>
                        <li><a href="#">Facilities</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Event Planner</a></li>
                        <li><a href="#">Special Offer</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Under Construction</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 text-center">
                    <h3 class="subtitle wide">Book <strong>My</strong> Space</h3>
                    <div class="moon-divider small"></div>
                    <p>24-26-28 Southern Str, Melbourne, VIC</p>
                    <p>(+333) - 333 - 333333   —   (+333) - 333 - 33333</p>
                    <p><a href="#">info@bookmyspace.com</a></p>
                    <p><a href="#">http://bookmyspace.com</a></p>
                    <div class="moon-divider small"></div>
                    <div class="social-links">
                        <a class="social-link" href="#"><i class="fa fa-facebook"></i><i class="fa fa-facebook"></i></a>
                        <a class="social-link" href="#"><i class="fa fa-twitter"></i><i class="fa fa-twitter"></i></a>
                        <a class="social-link" href="#"><i class="fa fa-google-plus"></i><i class="fa fa-google-plus"></i></a>
                        <a class="social-link" href="#"><i class="fa fa-pinterest-p"></i><i class="fa fa-pinterest-p"></i></a>
                        <a class="social-link" href="#"><i class="fa fa-instagram"></i><i class="fa fa-instagram"></i></a>
                        <a class="social-link" href="#"><i class="fa fa-youtube"></i><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-sm-4 text-right">
                    <h3 class="subtitle"><strong>Newsletter</strong></h3>
                    <p>Cras dignissim, velit ut placerat pulvinar, metus justo ultricies lacus, ut consectetur neque augue maximus lectus. Phasellus non placerat nibh.</p>
                    <div class="inputs">
                        <div class="input-wrapper"><input type="text" id="email" name="email" placeholder="Enter your email here"></div>
                        <button><i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
       
    </footer>
  
  
  
  <div class="footer-lst">
<div class="container wid100">
<span>Copyright &copy; 2016 Bookmyspace</span>
<div class="row">
</div><!--row close-->
</div><!--container close-->
</div><!--footer-fst close-->
 

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="js/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

     <script src="bootstrap/js/bootstrap.js"></script>
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
   <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script src="http://www.jqueryscript.net/demo/jQuery-jQuery-UI-Based-Date-Range-Picker-Plugin/jquery.comiseo.daterangepicker.js"></script>
   
   
        <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
      


    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
 
    <script type="text/javascript" src="bm/js/plugins/canvas-to-blob.min.js"></script>
    <script src="bm/js/fileinput.min.js" type="text/javascript"></script>
    <script src="js/custom-calendar.js"></script>
     
    <script type="text/javascript" src="js/jquery.mask.js"></script>

  
     
     <script src="sm/dist/sweetalert2.min.js"></script>

     <script src="js/nouislider.js"></script>

     
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script src="js/custom.js"></script>
   
   
      <script src="js/forms.js"></script>

      <script src="js/forms2.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
   
   <script src="js/star-rating.min.js"></script>
  <!--<script src="js/bootstrap-select.js"></script> -->
  
  <script src="js/wow.js"></script>
<style>
  .ui-datepicker-unselectable span
  {
    background: rgba(188, 27, 27, 0.58) !important;
  }
  .ui-state-disabled
  {
    opacity: 100 !important;
  }
</style>
  <script>
  $(function() {
    var arrDisabledDates = {};
    <?php echo $assign_values;  echo $assign_values2; ?> 
    var today = new Date();

    $( "#datepicker" ).datepicker({  
        minDate: today,
      beforeShowDay: function (dt) {
            var bDisable = arrDisabledDates[dt];
            if (bDisable)
               return [false, '', ''];
            else
               return [true, '', ''];
        }
  });
    });
  </script>
  
    <script>
  $(function() {

     var arrDisabledDates = {};
    <?php echo $assign_values; echo $assign_values2;?> 
     var today = new Date();
    var tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);
    // arrDisabledDates[new Date('03/22/2016')] = new Date('03/22/2016');
    // arrDisabledDates[new Date('04/04/2016')] = new Date('04/04/2016');
    // arrDisabledDates[new Date('05/16/2016')] = new Date('05/16/2016');
    // arrDisabledDates[new Date('06/30/2016')] = new Date('06/30/2016');
    $('#datepicker1').datepicker({
      minDate: tomorrow,
        beforeShowDay: function (dt) {
            var bDisable = arrDisabledDates[dt];
            if (bDisable)
               return [false, '', ''];
            else
               return [true, '', ''];
        }
    });
  });
  $(function() {

     var today = new Date();
    $( "#datepicker2" ).datepicker( {

      minDate: today

    });
  });

// par value start HERE 

   $('.per_val').click(function(){
    var value = $(this).val();
    var placeid = $('.placeid_val').val();
    $.ajax({

      url: 'forms2.php?per_val='+value+'&placeid_value='+placeid,
      success: function(data)
      {
        $('.show_div').html(data);
        
        //picking datepicker 1

        $(function() {
    var arrDisabledDates = {};
    <?php echo $assign_values;echo $assign_values2; ?> 
    var today = new Date();

    $( ".picking" ).datepicker({  
        minDate: today,
      beforeShowDay: function (dt) {
            var bDisable = arrDisabledDates[dt];
            if (bDisable)
               return [false, '', ''];
            else
               return [true, '', ''];
        }
  });
    // picking datepicker 2
    var tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);
 $( ".picking1" ).datepicker({  
        minDate: tomorrow,
      beforeShowDay: function (dt) {
            var bDisable = arrDisabledDates[dt];
            if (bDisable)
               return [false, '', ''];
            else
               return [true, '', ''];
        }
  });

var arrDisabledDates = {};
    <?php echo $assign_values;echo $assign_values3; ?> 
    var today = new Date();

    $( "#hourdatepicker" ).datepicker({  
        minDate: today,
      beforeShowDay: function (dt) {
            var bDisable = arrDisabledDates[dt];
            if (bDisable)
               return [false, '', ''];
            else
               return [true, '', ''];
        }
  });

    });
 //picking datepicker both end here

 // according to night start HERE

if(value == 'night')
        {
       $('.picking1').change(function(){
    var date_val1 = $('.picking').val();
    var date_val2 = $(this).val();
    var price_cal = $('.ppnight').val();
    var placeid = $('.placeid_val').val();
    if(date_val1<date_val2)
    {
    $.ajax({
      url: 'forms2.php?date_val1='+date_val1+'&date_val2='+date_val2+'&placeid='+placeid+'&pervalues='+value,
      success: function(data)
      { 
        console.log('my data - '+data);
        // console.log("<h5>&#8377; <span class="price_cal">'.$match['p_p_n'].'</span> x <span class="calculated">1 Night</span></h5>");
        data1 = data.split('>>>');
        if(data1[3]=='0')
        {
          $('#book_button').css('display','block');
          $('.errormessage22').css('display','none');
          $('.errormessage').css('display','block');
        if(data1[1]=='0')
        {
          var specific_price2=0;
        }
        else
        {     
        var specific_price = data1[0];
        specific_price1 = specific_price.split(',');
        var specific_price2=0;
        var counter = specific_price1.length;
        console.log('counter'+counter);
        for(var i=0; i<counter; i++)
        {
          if(specific_price1[i]=="")
          {
            continue;
          }
          specific_price2 = parseInt(specific_price2)+parseInt(specific_price1[i]);
        }
        }
        // console.log(specific_price2);
        var counts = data1[1];
        var regular_price = data1[2];
        var r_days = parseInt(regular_price)-parseInt(counts);
        var total = parseInt(price_cal)*parseInt(r_days);
        var grand_total = parseInt(total)+parseInt(specific_price2);
        console.log("grand_total"+grand_total);
        var avg_p = parseInt(grand_total)/parseInt(regular_price);
        avg_p = Math.round(avg_p);
        $.ajax({
        url:'forms2.php?taxesid=00',
        success: function(taxes)
        {
          console.log(taxes);
          var texes1 = taxes.split('===');
          if(texes1[0]==0)
          {

          }
          else
          { 
            var texes2 = texes1[0].split(',');
            var title = texes1[1].split(',');
            var count = texes2.length;
            var tax_data="";
            var tax_value="0";
            for(var j=0;j<count;j++)
            {
              var final = parseInt(texes2[j])*parseInt(regular_price);
              tax_data =tax_data+'<div class="col-md-6 col-sm-6 col-xs-7 "><h5>&#8377; <span class=""></span> <span class="">'+title[j] +'</span></h5></div><div class="col-md-6 col-sm-6 col-xs-5"><h5 class="text-right"><span>&#8377; </span><span class="">'+final+'</span></h5></div>';
              tax_value = parseInt(tax_value)+parseInt(final);
            }
            console.log("tax value"+tax_value)
            $('#forappend').html(tax_data);
            var final_total = parseInt(tax_value)+parseInt(grand_total);
            console.log("final"+final_total);
          }
          $('#price_per_week').val(avg_p);
          $('.night_rupee').html(avg_p);
          $('.price_cal').html(avg_p);
        $('.total_price_cal').html(final_total);
        $('.totalprice').val(final_total);
        $('.total_price').html(grand_total);
        $('.calculated').html(regular_price+' Nights');
        }
        });
      }
      else
      { 
        $('#book_button').css('display','none');
        $('.errormessage22').html("<p>Those Dates Are Not available<p>");
        $('.errormessage22').css('display','block');
        $('.errormessage').css('display','none');
      }
      }
    });
  }
  else
  {
    $('#book_button').css('display','none');
        $('.errormessage22').html("<p>Those Dates Are Not available<p>");
        $('.errormessage22').css('display','block');
        $('.errormessage').css('display','none');
  }
  });

$('.picking').change(function(){
    var date_val1 = $(this).val();
    var date_val2 = $('.picking1').val();
    var price_cal = $('.ppnight').val();
    var placeid = $('.placeid_val').val();
    if(date_val2 > date_val1) {
    $.ajax({
      url: 'forms2.php?date_val1='+date_val1+'&date_val2='+date_val2+'&placeid='+placeid+'&pervalues='+value,
      success: function(data)
      {
        console.log('mydata-'+data);
        // console.log("<h5>&#8377; <span class="price_cal">'.$match['p_p_n'].'</span> x <span class="calculated">1 Night</span></h5>");
      data1 = data.split('>>>');
      if(data1[3]=="0")
        { 
          $('#book_button').css('display','block');
          $('.errormessage22').css('display','none');
          $('.errormessage').css('display','block');
        console.log(data1[0]);
        console.log(data1[1]);
        console.log(data1[2]);
        if(data1[1]=='0')
        {
          var specific_price2=0;
        }
        else
        {     
        var specific_price = data1[0];
        specific_price1 = specific_price.split(',');
        var specific_price2=0;
        var counter = specific_price1.length;
        console.log('counter'+counter);
        for(var i=0; i<counter; i++)
        {
          if(specific_price1[i]=="")
          {
            continue;
          }
          specific_price2 = parseInt(specific_price2)+parseInt(specific_price1[i]);
        }
        }
        // console.log(specific_price2);
        var counts = data1[1];
        var regular_price = data1[2];
        var r_days = parseInt(regular_price)-parseInt(counts);
        var total = parseInt(price_cal)*parseInt(r_days);
        var grand_total = parseInt(total)+parseInt(specific_price2);
        console.log("grand_total"+grand_total);
        var avg_p = parseInt(grand_total)/parseInt(regular_price);
        avg_p = Math.round(avg_p);
        $.ajax({
        url:'forms2.php?taxesid=00',
        success: function(taxes)
        {
          console.log(taxes);
          var texes1 = taxes.split('===');
          if(texes1[0]==0)
          {

          }
          else
          { 
            var texes2 = texes1[0].split(',');
            var title = texes1[1].split(',');
            var count = texes2.length;
            var tax_data="";
            var tax_value="0";
            for(var j=0;j<count;j++)
            {
              var final = parseInt(texes2[j])*parseInt(regular_price);
              tax_data =tax_data+'<div class="col-md-6 col-sm-6 col-xs-7 "><h5>&#8377; <span class=""></span> <span class="">'+title[j] +'</span></h5></div><div class="col-md-6 col-sm-6 col-xs-5"><h5 class="text-right"><span>&#8377; </span><span class="">'+final+'</span></h5></div>';
              tax_value = parseInt(tax_value)+parseInt(final);
            }
            console.log("tax value"+tax_value)
            $('#forappend').html(tax_data);
            var final_total = parseInt(tax_value)+parseInt(grand_total);
            console.log("final"+final_total);
          }
          $('#price_per_week').val(avg_p);
          $('.night_rupee').html(avg_p);
          $('.price_cal').html(avg_p);
        $('.total_price_cal').html(final_total);
        $('.totalprice').val(final_total);
        $('.total_price').html(grand_total);
        $('.calculated').html(regular_price+' Nights');
        }
        });


      }
      else
      { 
        $('#book_button').css('display','none');
        $('.errormessage22').css('display','block');
        $('.errormessage22').html("<p>Those Dates Are Not available<p>");
        $('.errormessage').css('display','none');
      }
      }
    });
  }
  else
  {
       $('#book_button').css('display','none');
        $('.errormessage22').css('display','block');
        $('.errormessage22').html("<p>Those Dates Are Not available<p>");
        $('.errormessage').css('display','none');
  }
  });



        }
        //according to night end here

        // according to week start here
        if(value == 'week')
        {

        $('.picking1').change(function(){
    var date_val1 = $('.picking').val();
    var date_val2 = $(this).val();
    var price_cal = $('.ppnight').val();

    var placeid = $('.placeid_val').val();
    $.ajax({
      url: 'forms2.php?date_val1='+date_val1+'&date_val2='+date_val2+'&placeid='+placeid+'&pervalues='+value,
      success: function(data)
      { 
        console.log('my data - '+data);
  
        data1 = data.split('>>>');
        if(data1[3]=='0')
        {
          $('#book_button').css('display','block');
          $('.errormessage22').css('display','none');
          $('.errormessage').css('display','block');
        console.log(data1[0]);
        console.log(data1[1]);
        console.log(data1[2]);
        if(data1[4]=='0')
        {
          var special_price_week=0;
        }
        else
        {    
          var avg_price_split = data1[4].split(',,');
          var avg_counter = avg_price_split.length;
          var special_price_week = 0;
          var total_specail_weeks=0;
          for(var m=0; m<avg_counter;m++)
          {
            total_specail_weeks++;
            special_price_week = parseInt(special_price_week)+parseInt(avg_price_split[m]);
          }
          special_price_week = parseInt(special_price_week)/parseInt(total_specail_weeks);
          console.log("money hddf h kjhfkjfd"+special_price_week);
        }
        // console.log(specific_price2);
        var counts = data1[1];
        var regular_price = data1[2];
        var weekly = ~~(parseInt(regular_price)/parseInt('7'));
        if(weekly<1)
        {
            $('#book_button').css('display','none');
           $('.errormessage22').css('display','block');
         $('.errormessage22').html("<p>Please Choose Atleast One Week<p>");
          $('.errormessage').css('display','none');
        }
        else
        { 
          var price_for_total = parseInt(special_price_week)/parseInt('7'); 
          price_for_total = Math.round(price_for_total);
          var price_for_total = price_for_total*counts;
          console.log("weekly_price"+price_for_total);
          
          var price_cal5 = parseInt(price_cal)/parseInt('7');  
          price_cal5 = Math.round(price_cal5);
          console.log("regular price"+price_cal5)
        }
        var r_days = parseInt(regular_price)-parseInt(counts);
        var total = parseInt(price_cal5)*parseInt(r_days);
        var grand_total = parseInt(total)+parseInt(price_for_total);
        console.log("grand_total"+grand_total);
        var avg_p = parseInt(grand_total)/parseInt(regular_price);
        avg_p = Math.round(avg_p);
        grand_total = parseInt(avg_p)*parseInt(regular_price);
        $.ajax({
        url:'forms2.php?taxesid=00',
        success: function(taxes)
        {
          console.log(taxes);
          var texes1 = taxes.split('===');
          if(texes1[0]==0)
          {

          }
          else
          { 
            var texes2 = texes1[0].split(',');
            var title = texes1[1].split(',');
            var count = texes2.length;
            var tax_data="";
            var tax_value="0";
            for(var j=0;j<count;j++)
            {
              var final = parseInt(texes2[j])*parseInt(regular_price);
              tax_data =tax_data+'<div class="col-md-6 col-sm-6 col-xs-7 "><h5>&#8377; <span class=""></span> <span class="">'+title[j] +'</span></h5></div><div class="col-md-6 col-sm-6 col-xs-5"><h5 class="text-right"><span>&#8377; </span><span class="">'+final+'</span></h5></div>';
              tax_value = parseInt(tax_value)+parseInt(final);
            }
            console.log("tax value"+tax_value)
            $('#forappend').html(tax_data);
            var final_total = parseInt(tax_value)+parseInt(grand_total);
            console.log("final"+final_total);
          }
          $('#price_per_week').val(avg_p);
          $('.night_rupee').html(avg_p);
          $('.price_cal').html(avg_p);
        $('.total_price_cal').html(final_total);
        $('.totalprice').val(final_total);
        $('.total_price').html(grand_total);
        $('.calculated').html(regular_price+' Nights');
        }
        });
      }
      else
      { 
        $('#book_button').css('display','none');
        $('.errormessage22').html("<p>Those Dates Are Not available<p>");
        $('.errormessage22').css('display','block');
        $('.errormessage').css('display','none');
      }
      }
    });
  });

    $('.picking').change(function(){
    var date_val1 = $(this).val();
    var date_val2 = $('.picking1').val();
    var price_cal = $('.ppnight').val();
    var placeid = $('.placeid_val').val();
     if(date_val2 > date_val1) {
    $.ajax({
      url: 'forms2.php?date_val1='+date_val1+'&date_val2='+date_val2+'&placeid='+placeid+'&pervalues='+value,
      success: function(data)
      { 
        console.log('my data - '+data);
  
        data1 = data.split('>>>');
        if(data1[3]=='0')
        {
          $('#book_button').css('display','block');
          $('.errormessage22').css('display','none');
          $('.errormessage').css('display','block');
        console.log(data1[0]);
        console.log(data1[1]);
        console.log(data1[2]);
        if(data1[4]=='0')
        {
          var special_price_week=0;
        }
        else
        { 
          var avg_price_split = data1[4].split(',,');
          var avg_counter = avg_price_split.length;
          var special_price_week = 0;
          var total_specail_weeks=0;
          for(var m=0; m<avg_counter;m++)
          {
            total_specail_weeks++;
            special_price_week = parseInt(special_price_week)+parseInt(avg_price_split[m]);
          }
          special_price_week = parseInt(special_price_week)/parseInt(total_specail_weeks);
          console.log("money hddf h kjhfkjfd"+special_price_week);
        }
        // console.log(specific_price2);
        var counts = data1[1];
        var regular_price = data1[2];
        var weekly = ~~(parseInt(regular_price)/parseInt('7'));
        if(weekly<1)
        {
          $('#book_button').css('display','none');
           $('.errormessage22').css('display','block');
         $('.errormessage22').html("<p>Please Choose Atleast One Week<p>");
          $('.errormessage').css('display','none');
        }
        else
        { 
          var price_for_total = parseInt(special_price_week)/parseInt('7'); 
          price_for_total = Math.round(price_for_total);
          var price_for_total = price_for_total*counts;
          console.log("weekly_price"+price_for_total);
          
          var price_cal5 = parseInt(price_cal)/parseInt('7');  
          price_cal5 = Math.round(price_cal5);
          console.log("regular price"+price_cal5)
        }
        var r_days = parseInt(regular_price)-parseInt(counts);
        var total = parseInt(price_cal5)*parseInt(r_days);
        var grand_total = parseInt(total)+parseInt(price_for_total);
        console.log("grand_total"+grand_total);
        var avg_p = parseInt(grand_total)/parseInt(regular_price);
        avg_p = Math.round(avg_p);
        grand_total = parseInt(avg_p)*parseInt(regular_price);
        $.ajax({
        url:'forms2.php?taxesid=00',
        success: function(taxes)
        {
          console.log(taxes);
          var texes1 = taxes.split('===');
          if(texes1[0]==0)
          {

          }
          else
          { 
            var texes2 = texes1[0].split(',');
            var title = texes1[1].split(',');
            var count = texes2.length;
            var tax_data="";
            var tax_value="0";
            for(var j=0;j<count;j++)
            {
              var final = parseInt(texes2[j])*parseInt(regular_price);
              tax_data =tax_data+'<div class="col-md-6 col-sm-6 col-xs-7 "><h5>&#8377; <span class=""></span> <span class="">'+title[j] +'</span></h5></div><div class="col-md-6 col-sm-6 col-xs-5"><h5 class="text-right"><span>&#8377; </span><span class="">'+final+'</span></h5></div>';
              tax_value = parseInt(tax_value)+parseInt(final);
            }
            console.log("tax value"+tax_value)
            $('#forappend').html(tax_data);
            var final_total = parseInt(tax_value)+parseInt(grand_total);
            console.log("final"+final_total);
          }
          $('#price_per_week').val(avg_p);
          $('.night_rupee').html(avg_p);
          $('.price_cal').html(avg_p);
        $('.total_price_cal').html(final_total);
        $('.totalprice').val(final_total);
        $('.total_price').html(grand_total);
        $('.calculated').html(regular_price+' Nights');
        }
        });
      }
      else
      {
       $('#book_button').css('display','none');
        $('.errormessage22').html("<p>Those Dates Are Not available<p>");
        $('.errormessage22').css('display','block');
        $('.errormessage').css('display','none');
      }
      }
    });
  }
  });
        }

        //according to week end here

        // according to hour start here
 if(value == 'hour')
        {
          $('#hourdatepicker').change(function(){
            var starttime = $('#basic').val();
            var endtime = $('#basic2').val();
    var date_val2 = $('#hourdatepicker').val();
    var price_cal = $('.ppnight').val();
    var placeid = $('.placeid_val').val();
    console.log("datedata"+date_val2)
    $.ajax({
      url: 'forms2.php?hoursdate_val1='+date_val2+'&placeid='+placeid+'&pervalues='+value+'&start_time='+starttime+'&end_time='+endtime,
      success: function(data)
      {
        console.log('my data - '+data);
        
        data1 = data.split('>>>');
        console.log(data1[0]);
        console.log(data1[1]);
        var j = data1[0].trim(' ');
        var av = data1[2].trim(' ');
        if(av=='1')
        {
          $('#book_button').css('display','none');
          $('.errormessage22').css('display','block');
          $('.errormessage22').html('<p>This Date is Not Available</p>');
          $('.errormessage').css('display','none');
        }
        else
        {
        if(data1[1]=='00')
        {
          $('#book_button').css('display','none');
          $('.errormessage22').css('display','block');
          $('.errormessage22').html('<p>Please Choose Valid Date</p>');
          $('.errormessage').css('display','none');
        }
        else
        {     
          $('#book_button').css('display','block');
              $('.errormessage22').css('display','none');
          $('.errormessage').css('display','block');    
          var hours=data1[1];
        }
        if(j=='0')
        {
        var per_hours =price_cal;
          var price = parseInt(hours)*parseInt(price_cal);
           console.log("defailt price"+price);
        }
        else
        { 
          // alert("please  time");
          var per_hours =data1[0];
          var price = parseInt(hours)*parseInt(data1[0]);
        }
        }
        $.ajax({
        url:'forms2.php?taxesid=00',
        success: function(taxes)
        {
          console.log(taxes);
          var texes1 = taxes.split('===');
          if(texes1[0]==0)
          {

          }
          else
          { 
            var texes2 = texes1[0].split(',');
            var title = texes1[1].split(',');
            var count = texes2.length;
            var tax_data="";
            var tax_value="0";
            for(var j=0;j<count;j++)
            {
              var final = texes2[j];
              tax_data =tax_data+'<div class="col-md-6 col-sm-6 col-xs-7 "><h5>&#8377; <span class=""></span> <span class="">'+title[j] +'</span></h5></div><div class="col-md-6 col-sm-6 col-xs-5"><h5 class="text-right"><span>&#8377; </span><span class="">'+final+'</span></h5></div>';
              tax_value = parseInt(tax_value)+parseInt(final);
            }
            // console.log("tax value"+tax_value)
            $('#forappend').html(tax_data);
            var final_total = parseInt(tax_value)+parseInt(price);
            console.log("final"+final_total);
          }
          $('#time1').val(starttime);
           $('#time2').val(endtime);
          $('#total_hour').val(hours);
          $('#price_per_week').val(per_hours);
          $('.night_rupee').html(per_hours);
          $('.price_cal').html(per_hours);
        $('.total_price_cal').html(final_total);
        $('.totalprice').val(final_total);
        $('.total_price').html(price);
        $('.calculated').html(hours+' hours');
        }
        });

        


      }
    });
  });
    }
        //according to hour end here
        

}
});
});
//end Here 
//
  </script>
<script>
/* Demo Scripts for Bootstrap Carousel and Animate.css article
* on SitePoint by Maria Antonietta Perna
*/
(function( $ ) {

  //Function to animate slider captions 
  function doAnimations( elems ) {
    //Cache the animationend event in a variable
    var animEndEv = 'webkitAnimationEnd animationend';
    
    elems.each(function () {
      var $this = $(this),
        $animationType = $this.data('animation');
      $this.addClass($animationType).one(animEndEv, function () {
        $this.removeClass($animationType);
      });
    });
  }
  
  //Variables on page load 
  var $myCarousel = $('#carousel-example-generic'),
    $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
    
  //Initialize carousel 
  $myCarousel.carousel();
  
  //Animate captions in first slide on page load 
  doAnimations($firstAnimatingElems);
  
  //Pause carousel  
  
  
  
  //Other slides to be animated on carousel slide event 
  $myCarousel.on('slide.bs.carousel', function (e) {
    var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
    doAnimations($animatingElems);
  });  
  
})(jQuery);
</script> 
     
<script>
// When the DOM is ready, run this function
$(document).ready(function() {
  //Set the carousel options
  $('#quote-carousel').carousel({
    pauseOnHover: true,
    interval: 2000,
  });

});
  </script>



  

 

    <script>
         var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0ceT-_kjPt8INNEKoVX9axkv3zw3miBY&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>