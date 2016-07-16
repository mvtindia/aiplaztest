
<?php
session_start();
include_once('connect.php');
	
// get taxes here
if(isset($_GET['taxesid']))
{
	$sql = mysqli_query($connect,"SELECT * FROM taxes");
	$title ="";
	$tax = '0';
	while($row = mysqli_fetch_array($sql))
	{
		$tax = $tax.$row['charges'].",";
		$title = $title.$row['title'].",";
	}
	$tax = rtrim($tax,",");
	$title = rtrim($title,",");
	echo $tax."===".$title;
}

// end here
	// get nights code start

	if(isset($_REQUEST['date_val1']))
	{
		$placeid = $_REQUEST['placeid'];
		$pervalues = $_REQUEST['pervalues'];
		$d1 = $_REQUEST['date_val1'];
		$date11 = date('Y-m-d',strtotime($d1));
		$d2 = $_REQUEST['date_val2'];
    //Booking Start HEre 
     $money="0";
 $sql_footer2 = mysqli_query($connect,"SELECT * FROM booking WHERE placeid='".$placeid."'");
 if(mysqli_num_rows($sql_footer2)>0)
  {
     
          $days12 = "";
          $st = date('Y-m-d',strtotime($d1));
          $et = date('Y-m-d',strtotime($d2));

          $st1    = new DateTime($st);
          $et1    = new DateTime($et);
          $in1 = new DateInterval('P1D'); // 1 day interval
          $per1   = new DatePeriod($st1, $in1, $et1);
          foreach ($per1 as $day) 
          {
            // Do stuff with each $day...
                  $days12 .= $day->format('Y-m-d').',';
          }    
         $days12 = rtrim($days12,',');
          $chinout = explode(',',$days12);
          $final_ppn_price="";
          $final_w_ppn__price="";
          $counting=0;
      while($rw2 = mysqli_fetch_array($sql_footer2))
          {      
            $days="";
            $newdays = "";
            $start    = new DateTime($rw2['checkin']);
            $end_date = $rw2['checkout'];
            $end      = new DateTime($rw2['checkout']);
            $interval = new DateInterval('P1D'); // 1 day interval
            $period   = new DatePeriod($start, $interval, $end);
            foreach ($period as $day)
            {
                // Do stuff with each $day...
                $days .= $day->format('Y-m-d').',';
            }    
            $days = $days.$end_date.'<br>';
            $newdays = explode('<br>', $days);
            
             // $ppn_money = "0";
             // $w_ppn_money = "0";
            
            foreach ($newdays as $range)  
            { 
              // $ppn2 = "";
              // $w_ppn2 = "";
                $ranges = explode(',',$range);
                         
                for($ik = 0 ; $ik<count($chinout); $ik++)
                { 

                   if(in_array($chinout[$ik], $ranges))
                  {   
              $money = "1";
               // if in array end
            }
                } // ik for end
                // $ppn_money = $ppn_money.$ppn2;
                // $w_ppn_money = $w_ppn_money.$w_ppn2;
            } // $range foreach end
             // $final_ppn_price=$final_ppn_price.$ppn_money.",";
             // $final_w_ppn__price=$final_w_ppn__price.$w_ppn_money.",";
      }
      // $final_ppn_price = rtrim($final_ppn_price,",");
      // $final_w_ppn__price = rtrim($final_w_ppn__price,",");
    
    }
		$sql = mysqli_query($connect,"SELECT * FROM calenderdata WHERE placeid='".$placeid."'");
		if(mysqli_num_rows($sql)>0)
		{
      		$days1 = "";
      		$st = date('Y-m-d',strtotime($d1));
      		$et = date('Y-m-d',strtotime($d2));

      		$st1    = new DateTime($st);
      		$et1    = new DateTime($et);
      		$in1 = new DateInterval('P1D'); // 1 day interval
      		$per1   = new DatePeriod($st1, $in1, $et1);
      		foreach ($per1 as $day) 
      		{
            // Do stuff with each $day...
           				$days1 .= $day->format('Y-m-d').',';
      		}    
     		 $days1 = rtrim($days1,',');
       		$chinout = explode(',',$days1);
       		$final_ppn_price="";
       		$final_w_ppn__price="";
       		$counting=0;
			while($rw = mysqli_fetch_array($sql))
      		{      
        		$days="";
        		$newdays = "";
        		$start    = new DateTime($rw['date1']);
        		$end_date = $rw['date2'];
        		$end      = new DateTime($rw['date2']);
        		$interval = new DateInterval('P1D'); // 1 day interval
        		$period   = new DatePeriod($start, $interval, $end);
        		foreach ($period as $day)
        		{
           		 	// Do stuff with each $day...
           			$days .= $day->format('Y-m-d').',';
        		}    
        		$days = $days.$end_date.'<br>';
        		$newdays = explode('<br>', $days);
        		
        		 $ppn_money = "0";
        		 $w_ppn_money = "0";
						
        		foreach ($newdays as $range) 	
        		{	
        			$ppn2 = "";
        			$w_ppn2 = "";
          			$ranges = explode(',',$range);
          			         
          			for($ik = 0 ; $ik<count($chinout); $ik++)
          			{ 

                       	if(in_array($chinout[$ik], $ranges))
            			{   
            				if($rw['status']=="Available")
            				{
            				$w_ppn2 = $rw['w_p_p_n'];
            				$counting = $counting+1;        
							$ppn2 = $ppn2+$rw['p_p_n'];
							}
							else if($rw['status']=="Not Available")
							{
							$money = "1";
                        	} // if in array end
						}
          			} // ik for end
          			$ppn_money = $ppn_money.$ppn2;
          			$w_ppn_money = $w_ppn_money.$w_ppn2;
        		} // $range foreach end
        		 $final_ppn_price=$final_ppn_price.$ppn_money.",";
        		 $final_w_ppn__price=$final_w_ppn__price.$w_ppn_money.",";
			}
			$final_ppn_price = rtrim($final_ppn_price,",");
			$final_w_ppn__price = rtrim($final_w_ppn__price,",");
		
		}

		$date22 = date('Y-m-d',strtotime($d2));
		$date1=date_create($d1);
		$date2=date_create($d2);
		$diff=date_diff($date2,$date1);

		if($pervalues == 'night') {
			echo $final_ppn_price;
			echo">>>";
			echo $counting;
			echo">>>"; 
		echo $diff->format("%a");
		echo ">>>";
		echo $money; 	
	}

	else if($pervalues == 'week') {

		// $interval = $date1->diff($date2);

		// $cal_week = (int)(($interval->days) / 7);

		// if($cal_week <= 1)
		// {
		// 	echo $cal_week.' Week';
		// }
		// else
		// {
		// 	echo $cal_week.' Weeks';
		// }
			echo $final_ppn_price;
			echo">>>";
			echo $counting;
			echo">>>"; 
		echo $diff->format("%a");
		echo ">>>";
		echo $money;
		echo">>>";
		echo $final_w_ppn__price;
	}

	else
	{
echo $final_ppn_price;
			echo">>>";
			echo $counting;
			echo">>>";
		$diff=date_diff($date2,$date1);	
		echo $diff->format("%a");
		echo ">>>";
		echo $money;
	}


}
// get hours code start here
	if(isset($_REQUEST['hoursdate_val1']))
	{
		 $start_time = $_REQUEST['start_time'];
		 $end_time = $_REQUEST['end_time'];

// Example 

   $strStart = '2013-06-19 '.$start_time; 
   $strEnd   = '06/19/13 '.$end_time; 
   $dteStart = new DateTime($strStart); 
   $dteEnd   = new DateTime($strEnd); 
   $dteDiff  = $dteStart->diff($dteEnd); 
		$placeid = $_REQUEST['placeid'];
		$pervalues = $_REQUEST['pervalues'];
		$d1 = $_REQUEST['hoursdate_val1'];


//Booking disable start here

   $money="0";




		$sql = mysqli_query($connect,"SELECT * FROM calenderdata WHERE placeid='".$placeid."'");
		if(mysqli_num_rows($sql)>0)
		{	    
      		$st = date('Y-m-d',strtotime($d1));
       		$price="0";
			while($rw = mysqli_fetch_array($sql))
      		{  
          $days=""; 
          $newdays="";   
        		$start    = new DateTime($rw['date1']);
        		$end_date = $rw['date2'];
        		$end      = new DateTime($rw['date2']);
        		$interval = new DateInterval('P1D'); // 1 day interval
        		$period   = new DatePeriod($start, $interval, $end);
        		foreach ($period as $day)
        		{
           		 	// Do stuff with each $day...
           			$days .= $day->format('Y-m-d').',';
        		}    
        		$days = $days.$end_date.'<br>';
        		$newdays = explode('<br>', $days);
        		
        		 $ppn_money = "";
						
        		foreach ($newdays as $range) 
        		{	
        			$ppn2 = "";
          			$ranges = explode(',',$range);
          			         	
          			for($ik = 0 ; $ik<count($st); $ik++)
          			{ 
                  if(in_array($st, $ranges))
            			{  
                  if($rw['status']=="Available")
                    { 
               				$price = $rw['p_p_h'];
                    }
                    elseif($rw['status']=="Not Available")
                    {
                      $money=1;
                    }
                  } // if in array end
          			} // ik for end
      
        		} // $range foreach end
        
			}

       $sql_footer2 = mysqli_query($connect,"SELECT * FROM booking WHERE placeid='".$placeid."'");
if(mysqli_num_rows($sql_footer2)>0)
    {     
          $st = date('Y-m-d',strtotime($d1));
      while($rw2 = mysqli_fetch_array($sql_footer2))
          {  
          $days=""; 
          $newdays="";   
            $start    = new DateTime($rw2['checkin']);
            $end_date = $rw2['checkout'];
            $end      = new DateTime($rw2['checkout']);
            $interval = new DateInterval('P1D'); // 1 day interval
            $period   = new DatePeriod($start, $interval, $end);
            foreach ($period as $day)
            {
                // Do stuff with each $day...
                $days .= $day->format('Y-m-d').',';
            }    
            $days = $days.$end_date.'<br>';
            $newdays = explode('<br>', $days);
            foreach ($newdays as $range) 
            { 
      
                $ranges = explode(',',$range);
                          
                for($ik = 0 ; $ik<count($st); $ik++)
                { 
                  if(in_array($st, $ranges))
                  {  
                    if($rw2['hours']=='0')
                    {
                       $money=1;
                    }
                    else
                    {                      
                    }         
                  } // if in array end
                } // ik for end
      
            } // $range foreach end
        
      }
       
    }
// End Here    



			echo $price;
			echo">>>";
			echo $dteDiff->format("%H");
      echo">>>";
      echo $money; 
				
		}

	}


//end here

	// get nights code end


	if(isset($_REQUEST['per_val']))
	{
		$value = $_REQUEST['per_val'];
		$placeid = $_REQUEST['placeid_value'];

		$q = mysqli_query($connect,'Select * from place where place_id="'.$placeid.'"');
		$match= mysqli_fetch_array($q);
		$datetime = new DateTime('tomorrow');
		$weeklater = date("m/d/Y", strtotime("+1 week"));
		if($value == 'hour')
		{
?>
<?php
?>
<link href="tm/jquery.timepicker.css" rel="stylesheet">
<!-- <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script> -->
<script src="tm/jquery.timepicker.js"></script>
<?php
		echo '
		<form class="book_form2_hour" method="post">
<div class="row bg-row">

<div class="col-md-6 col-sm-6 col-xs-6">
<input type="hidden" class="ppnight" value="'.$match['p_p_h'].'">
<h4>&#8377; <span class="night_rupee">'.$match['p_p_h'].'</span>/-</h4>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
<h4 class="text-right">Per Hour</h4>
</div>
</div>
<div class="row mg-top15 ">
<div class="col-md-4 pd-lr-6">
<div class="input-group mg-top20">
    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>';
    ?>
    <input type="text" id="basic" name="time"/ class="form-control" placeholder="Start">
    <input type="text" id="basic2" name="time"/ class="form-control"placeholder="End">
<script>
	
    $(document).ready(function(){
   $('#basic').timepicker({
	'timeFormat':'H:i',
       show2400: true,
	step: 60,
	maxTime:'23:00',
    'scrollDefaultNow': 'true',
        'closeOnWindowScroll': 'true',
        'showDuration': true
});
$('#basic').change(function(){
// start here 
    var starttime = $('#basic').val();
    var endtime = $('#basic2').val();
    var date_val2 = $('#hourdatepicker').val();
    var price_cal = $('.ppnight').val();
    var placeid = $('.placeid_val').val();
    console.log("datedata"+date_val2)
    if(endtime!='')
    {
    	if(endtime>starttime)
    	{
    $.ajax({
      url: 'forms2.php?hoursdate_val1='+date_val2+'&placeid='+placeid+'&pervalues=hour&start_time='+starttime+'&end_time='+endtime,
      success: function(data)
      {
        console.log('my data - '+data);
        
        data1 = data.split('>>>');
        console.log(data1[0]);
        console.log(data1[1]);
        var j = data1[0].trim(' ');
         var av = data1[2].trim(' ');
        if(av=='1')
        { $('#book_button').css('display','none');
          $('.errormessage22').css('display','block');
          $('.errormessage22').html('<p>This Date is Not Available</p>');
          $('.errormessage').css('display','none');
        }
        else
        {

         if(data1[1]=='00')
        { $('#book_button').css('display','none');
          $('.errormessage22').css('display','block');
          $('.errormessage22').html('<p>Please Choose Valid Date</p>');
          $('.errormessage').css('display','none');
        }
        else
        {  $('#book_button').css('display','block');
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
}
}


//end here 







    var new_end = $(this).timepicker('getTime');
   var dd = new_end.setHours(new_end.getHours()+1);

    $('#basic2').timepicker({
    	'timeFormat':'H:i',
    	  show2400: true,
    	step: 60,
    	minTime:new_end,
    	maxTime:'23:59',
    });
    	$('#basic2').change(function(){
            var starttime = $('#basic').val();
            var endtime = $('#basic2').val();
    var date_val2 = $('#hourdatepicker').val();
    var price_cal = $('.ppnight').val();
    var placeid = $('.placeid_val').val();
    console.log("datedata"+date_val2)
    $.ajax({
      url: 'forms2.php?hoursdate_val1='+date_val2+'&placeid='+placeid+'&pervalues=hour&start_time='+starttime+'&end_time='+endtime,
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
    })
});
</script>
<?php
echo'</div>

</div>
<div class="col-md-4 pd-lr-6">

<div class="input-group mg-top20"> 
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	<input type="text" id="hourdatepicker" name="checkin" value="'.date('m/d/Y').'" placeholder="CheckIn" class="form-control bord-0">
</div>

</div>
<div class="col-md-4 pd-lr-6">
<div class="input-group mg-top20">
    <span class="input-group-addon"><i class="fa fa-users"></i></span>
	<input type="number" min="1" max="'.$match['capacity'].'" name="guests" placeholder="Guests" value="1" class="form-control bord-0">
</div>


</div>
</div>
<div class="errormessage">
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-7 pricecel">
<h5>&#8377; <span class="price_cal">'.$match['p_p_h'].'</span> x <span class="calculated">1 Hour</span></h5>
</div>
<div class="col-md-6 col-sm-6 col-xs-5">
<h5 class="text-right"><span>&#8377; </span><span class="total_price">'.$match['p_p_h'].' </span></h5>
</div>
</div>
	<div class="row" id="forappend"></div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-7">
<h5>Total</h5>
</div>
<div class="col-md-6 col-sm-6 col-xs-5">
<h5 class="text-right"><span>&#8377; </span><span class="total_price_cal">'.$match['p_p_h'].' </span></h5>
</div>
</div>
	</div>
	<div class="errormessage22"></div>
<input name="package" value="hours" type="hidden"/>
<input type="text" name="time1" id="time1" value="00:00" hidden>
<input type="text" name="time2" id="time2" value="00:00" hidden>
<input name="price" value="'.$match['p_p_h'].'" id="price_per_week" type="hidden" />
<input name="hours" value="0" id="total_hour" type="hidden" />
<input name="myplaceid" value="'.$match['place_id'].'" type="hidden" />
<input name="totalprice" class="totalprice" value="" type="hidden" />
<div class="text-center">

	<button type="submit" style="display:none;" id="book_button"  name="book_now_hour" class="btn-4">Book Now</button>
</div> </form>
<script src="js/custom.js"></script>';
	?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.10/jquery.timepicker.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.10/jquery.timepicker.min.js"></script> -->
<?php
} // hour if end

else if($value == 'night')
		{
		echo '<form class="book_form" method="post">
<div class="row bg-row">

<div class="col-md-6 col-sm-6 col-xs-6 ">
<input type="hidden" class="ppnight" value="'.$match['p_p_n'].'">
<h4>&#8377; <span class="night_rupee">'.$match['p_p_n'].'</span>/-</h4>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
<h4 class="text-right">Per Night</h4>
</div>
</div>
<div class="row mg-top15 ">
<div class="col-md-4 pd-lr-6">

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	<input type="text" id="" value="'.date('m/d/Y').'" name="checkin" placeholder="CheckIn" class="form-control bord-0 picking">
</div>

</div>
<div class="col-md-4 pd-lr-6">
<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	<input type="text" id="" name="checkout" value="'.$datetime->format('m/d/Y').'" placeholder="CheckOut" class="picking1 form-control bord-0">
</div>

</div>
<div class="col-md-4 pd-lr-6">
<div class="input-group mg-top20">
    <span class="input-group-addon"><i class="fa fa-users"></i></span>
	<input type="number" min="1" max="'.$match['capacity'].'" name="guests" placeholder="Guests" value="1" class="form-control bord-0">
</div>


</div>
</div>
<div class="errormessage">
<div class="row" >
<div class="col-md-6 col-sm-6 col-xs-7 pricecel">
<h5>&#8377; <span class="price_cal">'.$match['p_p_n'].'</span> x <span class="calculated">1 Night</span></h5>
</div>
<div class="col-md-6 col-sm-6 col-xs-5">
<h5 class="text-right"><span>&#8377; </span><span class="total_price">'.$match['p_p_n'].' </span></h5>
</div>
	</div>
	<div class="row" id="forappend">
	</div>


<div class="row">
<div class="col-md-6 col-sm-6 col-xs-7">
<h5>Total</h5>
</div>
<div class="col-md-6 col-sm-6 col-xs-5">
<h5 class="text-right"><span>&#8377; </span><span class="total_price_cal">'.$match['p_p_n'].' </span></h5>
</div>
</div>
	</div>
<div class="errormessage22"></div>
<input name="package" value="night" type="hidden" />
<input name="price" value="'.$match['p_p_n'].'" id="price_per_week" type="hidden" />
<input name="myplaceid" value="'.$match['place_id'].'" type="hidden" />
<input name="totalprice" class="totalprice" value="" type="hidden" />
<div class="text-center">

	<button style="display:none;" type="submit" name="book_now" id="book_button" class="btn-4">Book Now</button>
</div></form>
<script src="js/custom.js"></script>';
} // night if end

else if($value == 'week')
		{

		echo '<form class="book_form"  method="post">
<div class="row bg-row">

<div class="col-md-6 col-sm-6 col-xs-6">
<input type="hidden" class="ppnight" value="'.$match['w_p_p_n'].'">
<h4>&#8377; <span class="night_rupee">'.$match['w_p_p_n'].'</span>/-</h4>
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
<h4 class="text-right">Per Week</h4>
</div>
</div>
<div class="row mg-top15 ">
<div class="col-md-4 pd-lr-6">

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	<input type="text" id="" name="checkin" value="'.date('m/d/Y').'" placeholder="CheckIn" class="form-control bord-0 picking">
</div>

</div>
<div class="col-md-4 pd-lr-6">
<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	<input type="text" id="" name="checkout" value="'.$weeklater.'" placeholder="CheckOut" class="form-control bord-0 picking1">
</div>

</div>
<div class="col-md-4 pd-lr-6">
<div class="input-group mg-top20">
    <span class="input-group-addon"><i class="fa fa-users"></i></span>
	<input type="number" min="1" max="'.$match['capacity'].'" name="guests" placeholder="Guests" value="1" class="form-control bord-0">
</div>


</div>
</div>
<div class="errormessage">
<div class="row" >

<div class="col-md-6 col-sm-6 col-xs-7 pricecel">
<h5>&#8377; <span class="price_cal">'.$match['p_p_n'].'</span> x <span class="calculated">1 Night</span></h5>
</div>
<div class="col-md-6 col-sm-6 col-xs-5">
<h5 class="text-right"><span>&#8377; </span><span class="total_price">'.$match['p_p_n'].' </span></h5>
</div>
	</div>
	<div class="row" id="forappend">
	</div>
	
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-7">
<h5>Total</h5>
</div>
</div>
<div class="col-md-6 col-sm-6 col-xs-5">
<h5 class="text-right"><span>&#8377; </span><span class="total_price_cal">'.$match['w_p_p_n'].' </span></h5>
</div>
</div>
<div class="errormessage22"></div>
<input name="package" value="week" type="hidden" />
<input name="price" value="'.$match['w_p_p_n'].'" id="price_per_week" type="hidden" />
<input name="myplaceid" value="'.$match['place_id'].'" type="hidden" />
<input name="totalprice" class="totalprice" value="" type="hidden" />
<div class="text-center">

	<button type="submit" style="display:none;" id="book_button" name="book_now" class="btn-4">Book Now</button>
</div></form>
<script src="js/custom.js"></script>';
} // week if end


	}


	// // book form 1 start

	// if(isset($_REQUEST['book_now']))
	// {
	// 	$hours = $_REQUEST['hours'];
	// 	$package = $_REQUEST['package'];
	// 	$price = $_REQUEST['price'];
	// 	$checkin = date('Y-m-d', strtotime($_REQUEST['checkin']));
	// 	$checkout = date('Y-m-d', strtotime($_REQUEST['checkout']));
	// 	$placeid = $_REQUEST['myplaceid'];
	// 	$guests = $_REQUEST['guests'];
	// 	$totalprice = $_REQUEST['totalprice'];


	// 	$q = mysqli_query($connect,"INSERT INTO `booking`(`placeid`, `userid`, `package`, `price`, `checkin`, `checkout`, `hours`, `guests`, `online`, `hotel`) VALUES ('".$placeid."','".$_SESSION['u_id']."','".$package."','".$price."','".$checkin."','".$checkout."','".$hours."','".$guests."','".$totalprice."','".$totalprice."')");
	// 	$last_id = $connect->insert_id;
	// 	header('location:booking-form.php?booking_id='.$last_id);
	// }


	// booking form 2 start

	if(isset($_REQUEST['booking']))
	{
		echo $method = $_REQUEST['method'];
		echo $booking_id = $_REQUEST['booking_id'];
		echo 'hello';

		$q = mysqli_query($connect,"update booking set method='".$method."' where bookid=".$booking_id);
		if($q)
		{
			header('location:index.php');
		}
	}

?>
