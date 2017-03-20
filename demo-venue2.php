<?php include_once('connect.php');

if (isset($_REQUEST['placeid'])) {
?>
<!doctype html>
<html>
<head>
	<title>2Finda</title>
	<?php include 'lib/top.php';?>
	<link href="css/style2.css" rel="stylesheet">
	<style>
	.btn-4{
		width:50%;
	}
	#ui-datepicker-div{
		z-index:20 !important;
	}
	.footer-lst, .footer-media{
		margin-left:-15px;
		margin-right:-15px;
	}
	.baddt{
		 background : red;
		/*background-color: #DFFF00;*/
	}
	</style>
</head>

<body>
<div class="container-fluid"><!--container-fluid start-->
	<div class="row">


<!--==============menu header=========================-->

		<div class="menu-had">
			<?php include 'lib/header.php';?>
			<style>
				p {
					font-size: 13px !important;
				}
			</style>
		</div><!--menu-had close-->
<?php 
setlocale(LC_MONETARY, 'en_US');
$placeid=$_REQUEST['placeid'];
$checkin=$_REQUEST['checkin'];
$checkout=$_REQUEST['checkout'];
if (isset($_REQUEST['frtm'])) {
	$frtm=$_REQUEST['frtm'];
} else {
	$frtm="";
}
if (isset($_REQUEST['totm'])) {
	$totm=$_REQUEST['totm'];
} else {
	$totm="";
}


$query=mysqli_query($connect,'Select * from place where place_id="'.$placeid.'"') ;
//$query=mysqli_query($connect,'Select * from calenderdata inner join place on calenderdata.placeid = place.place_id 
//where calenderdata.placeid="'.$placeid.'" and calenderdata.status="Available" and ((date1 >= "'.$date1.'" and date1 < "'.$date2.'")
//|| (date1 <= "'.$date1.'" and date2 > "'.$date1.'")) order by date1') ;

//if rows place table
if($match=mysqli_fetch_array($query))
	{
		
		//$query2=mysqli_query($connect,'Select * from booking where placeid="'.$placeid.'" and checkin = "'.$_REQUEST['checkin'].'"');
		?>
<!--==============menu header close=========================-->

<!--=================slider========================-->
		<input type="hidden" class="placeid_val" value="<?php echo $placeid; ?>">
		<div class="">
			<div id="carousel-example-generic" class="carousel slide">

			<!-- Wrapper for slides -->
				<div class="carousel-inner hg-500" role="listbox">
	
		<?php 
		if(!empty($match['photo']))
		{
		 	$photo=explode(",", $match['photo']);
	  	for ($i=0; $i <count($photo) ; $i++)
	   		{ 
	  			if($photo[$i]=="")
	  			{
	  				continue;
	  			}
	  			if($i=="0")
	  			{
  		?>
					<style>
							.slide<?php echo $i; ?> {
								background: url("images/placephotos/<?php echo $photo[$i]; ?>");
								padding-top:100px !important;
								background-position:center;
								background-size:cover;
							}
    				</style>
        			<div class="item slide<?php echo$i; ?> active">
        				<div class="carousel-caption"></div>
        			</div> <!-- /.item -->
	  	<?php
	  			} else {
	  		  	?>
	  				<style>
							.slide<?php echo$i; ?> {
							background: url("images/placephotos/<?php echo $photo[$i]; ?>");
							padding-top:100px !important;
							background-position:center;
							background-size:cover;
						}
    				</style>
					<div class="item slide<?php echo$i; ?>">
						<div class="carousel-caption"></div>
					</div> <!-- /.item -->
	  	<?php
	  			}
	  		}
		} else {
	  	?>
							<style> .slide { background-color: #202935; } </style>
	<?php 
		} 
		?>
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div><!-- /.carousel-inner -->
			</div><!-- /.carousel -->

	<div class="col-md-12 col-sm-12 col-xs-12 h-name">
		<div class="col-md-6 col-sm-6">
	  	<h3 class="h-1"><?php echo $match['space_name'].",".$match['p_address'];?></h3>
	  	<div class="col-md-6 col-sm-6 mg-media">
	  		<i class="fa fa-users fa-2x"></i>&nbsp;&nbsp;
	  		<span class="s1"><?php echo $match['capacity']; ?></span>
	  	</div>
	  </div>
	  <div class="col-md-6 col-sm-6">
  		<div class="absolute-center">
    		<ul class="social-icons text-center">
      		<li>
        		<a target="_blank" href="http://facebook.com">
          		<i class="fa fa-facebook color1"></i>
        		</a>
      		</li>
      		<li>
        		<a target="_blank" href="http://twitter.com">
          		<i class="fa fa-twitter color1"></i>
        		</a>
      		</li>
      		<li>
        		<a target="_blank" href="#">
          		<i class="fa fa-instagram color1"></i>
        		</a>
      		</li>
	   			<li>
        		<a target="_blank" href="#">
          		<i class="fa fa-google-plus color1"></i>
        		</a>
      		</li>
    		</ul>
	  	</div>
	  </div>
	  
	</div>

</div><!-- /.container -->

<!--===================slider close==========================-->
<div class="col">
	<div class="container col-inner">
		<div class="col-md-6">

<!--========================================Left Side=====================================-->
			<div class="col-md-12">
				<h2 class="color1"><?php echo $match['space_name'];?></h2>
				<p>
<?php echo $match['p_address']; ?>
<!-- Kapila Matrix, Koregaon Park, Pune. 411001 --></p>
<div class="col-md-5">
	<?php $q28 = mysqli_query($connect,"select sum(`ratings`) as ratetotal from ratings where placeid=".$placeid);
	$r28 = mysqli_fetch_array($q28);

	$q29 = mysqli_query($connect,"select * from ratings where placeid=".$placeid);
	$r29 = mysqli_num_rows($q29);

	$revs = round($r28['ratetotal']/$r29);

	for($cc=0;$cc<$revs;$cc++)
	{
		 ?>
		 <i class="fa fa-star" style="color: #FDE16D"></i>
		 <?php 
	}
	for($cc1=5;$cc1>$revs;$cc1--)
	{
		 ?>
		 <i class="fa fa-star-o"></i>
		 <?php 
	}

	?>
</div>
<div class="col-md-7 mg-media">
<i class="fa fa-users fa-lg color1"></i>&nbsp;&nbsp;<span><?php echo $match['capacity']; ?></span>
</div>
<div class="clearfix"></div>
<div class="absolute-center">
    <ul class="social-icons2">
      <li>
        <a target="_blank" href="http://facebook.com">
          <i class="fa fa-facebook"></i>
        </a>
      </li>

      <li>
        <a target="_blank" href="http://twitter.com">
          <i class="fa fa-twitter"></i>
        </a>
      </li>

      <li>
        <a target="_blank" href="#">
          <i class="fa fa-instagram"></i>
        </a>
      </li>
	   <li>
        <a target="_blank" href="#">
          <i class="fa fa-google-plus"></i>
        </a>
      </li>

    </ul>

	  </div>
	  </div>	 
	  <!--===============About the Listing Details===============-->
	  <div class="col-md-12 col-sm-12 col-xs-12">
	  <div class="row">
	  <div class="col-md-12 col-sm-12 ">
	  <h4 class="color1 mg-top20">About This Listing</h4>
	   <h5 class="color1 mg-top20">Property Type</h5>
	  <?php
	   $property_type=explode(",", $match['property_typeid']);
	  for ($i=0; $i <count($property_type) ; $i++) { 
	  $q30 = mysqli_query($connect,"select * from property where pid=".$property_type[$i]);
	  	if($r30 = mysqli_fetch_array($q30))
	  	{
	  		echo '<p>'.$r30['ptype'].'</p>';
	  	}
	  } 
	  ?>
	  <h5 class="color1 mg-top20">Area</h5>
	  <p><?php echo $match['place_area'];
	  $qq = mysqli_query($connect,"select * from area where areaid=".$match['areatype']);
	  	if($rq = mysqli_fetch_array($qq))
	  	{echo " ".$rq['areatype'];}
	  		?>

	  </p>
	   <h5 class="color1 mg-top20">Accomodates</h5>
	  <p><?php echo $match['accomodates'];?></p>
	  <h5 class="color1 mg-top20">Common Ammenities</h5>
	  <?php 
	  $ammenties=explode(",", $match['ammenties_id']);
	  for ($i=0; $i <count($ammenties) ; $i++) { 
		$q30 = mysqli_query($connect,"select * from ammenities where aid=".$ammenties[$i]);
	  	if($r30 = mysqli_fetch_array($q30))
	  	{
	  		echo '<p>'.$r30['aname'].'</p>';
	  	}	  	
	  }
	  ?>
	  <h5 class="color1 mg-top20">Additional Ammenities</h5>
	   <?php 
	  $add_ammenties=explode(",", $match['add_ammenties']);
	  for ($i=0; $i <count($add_ammenties) ; $i++) { 
	  	$q30 = mysqli_query($connect,"select * from ammenities where aid=".$add_ammenties[$i]);
	  	if($r30 = mysqli_fetch_array($q30))
	  	{
	  		echo '<p>'.$r30['aname'].'</p>';
	  	}	  	
	  }
	  ?>
	   <h5 class="color1 mg-top20">Description</h5>
	  <p><?php echo $match['details'];?></p>


		<div class="clearfix"></div>
	  
	    <h4 class="color1 mg-top20">Best Suited for</h4>
		<div class="col-md-12 col-sm-12  icos">
	 
	 <?php
if(!empty($match['can_be_usedid'])) {
	  $usedfor=explode(",", $match['can_be_usedid']);
	  for ($j=0; $j < count($usedfor) ; $j++) {
	   $query1=mysqli_query($connect,'Select * from usedfor where ufid="'.$usedfor[$j].'"');
if($match1=mysqli_fetch_array($query1)){
	     echo "<div class=\"col-md-3 pd-lr-10\"><img src='img/".$match1['uficon']."'>&nbsp;".$match1['ufname']."</div>";
	 }
	   }  }else{echo "-";}?>
		</div>
	
	  </div>
	  </div>

	  <div class="clearfix"></div>
	  
	  <!---==========================Photos section=======================-->
	  
	  <div class="row">
	  <h4 class="color1 col-md-12 col-sm-12  mg-top20">Photos</h4>
	  <div class="col-md-12 col-sm-12 ">
	  
	  <?php if(!empty($match['photo'])){$photo=explode(",", $match['photo']);
	  for ($i=0; $i <count($photo) ; $i++) { 
	  	if($photo[$i]==""){
	  		continue;
	  	}
	  	echo '<div class="col-md-4 col-sm-4  mg-media"><img src="images/placephotos/'.$photo[$i].'" class="img-responsive"></div>';
	  }}else{echo "-";}?>
	  </div>
	  
	  </div>
	  
	  
	  <!---==========================Photos section Ends=======================-->

	  <!---==========================Video section=======================-->
	 
	  <div class="row">
	  <h4 class="color1 col-md-12 col-sm-12  mg-top20">Video(s)</h4>
	  <div class="col-md-12 col-sm-12 ">
	   <?php if(!empty($match['video'])) { ?>
	  <?php $video=explode(",", $match['video']);
	  $video_type = explode(',',$match['video_type']);
	  for ($i=0; $i <count($video) ; $i++) {
	  if($video[$i]==""){
	  		continue;
	  	} 
	  	echo '<div class="col-md-4 col-sm-4  mg-media">
	  	<video width="200" height="110" controls>
	  	<source src="video/'.$video[$i].'"> type="'.$video_type[$i].'"</video>
	  	</div>';
	  }?>
	  <?php }else{echo "-";} ?>
	  </div>
	  </div>
	  
	  
	  <!---==========================Video section Ends=======================-->	  
	  
	  <!---==========================Rules section=======================-->
	  	  <div class="row">
		  <div class="col-md-12">
	  <h4 class="color1  mg-top20">Rules</h4>
	 <h5 class="color1 mg-top20">Do's</h5><?php 
	 if(!empty($match['rules_doid'])) {
	 	$dos=explode(",", $match['rules_doid']);
	  for ($i=0; $i <count($dos) ; $i++) { 
	  	$q30 = mysqli_query($connect,"select * from rules where rid=".$dos[$i]);
	  	if($r30 = mysqli_fetch_array($q30))
	  	{
	  		echo '<p>'.$r30['rname'].'</p>';
	  	}
	  	
	  }}else{echo "-";}?>
	  <h5 class="color1 mg-top20">Dont's</h5><?php
	   if(!empty($match['rules_donotid'])) {
	    $donts=explode(",", $match['rules_donotid']);
	  for ($i=0; $i <count($donts) ; $i++) { 
	  		$q30 = mysqli_query($connect,"select * from rules where rid=".$donts[$i]);
	  	if($r30 = mysqli_fetch_array($q30))
	  	{
	  		echo '<p>'.$r30['rname'].'</p>';
	  	}
	  } }else{echo "-";}?>
		</div>
	  </div>
	  <!---==========================Rules section Ends=======================-->
	  
	 
	  <!---==========================Review section=======================-->

	  <?php
	  if($match['user_id'] != $_SESSION['u_id']) { 
	  	?>
	  <h4 class="color1 mg-top20">Leave Comment</h4>
	  <form id="place_ratings" method="post">
		<div class="col-md-12 mydiv">
		<input name="placeid" type="hidden" value="<?php echo $placeid; ?>">
		<input id="input-21d" value="2" type="number" name="ratings" class="rating" min=0 max=5 step=1 data-size="sm"/>
		 <div class="clearfix"></div>
			<textarea class="form-control" name="reviews" placeholder="Write your Reviews"></textarea>
		<button type="submit" class="btn-3 mg-top20">Comment</button>
	  </div>
	  </form>
	  <!-- compose msg Modal box start -->

	  <button class="btn btn-success btn-small"data-toggle="modal" data-target="#compose">Sent Message</button>
<div id="compose" class="modal fade" role="dialog">
  <div class="modal-dialog">
	
    <!-- Modal content-->
    	  <?php $sql_msg = mysqli_query($connect,"SELECT * FROM place p,users u WHERE p.place_id='".$placeid."' and p.user_id=u.uid");
    	  // if(mysqli_num_rows($sql_msg)>0)
    	  // {
    	  // 	echo"hello";
    	  // }
    	  // else
    	  // {
    	  // 	echo"not";
    	  // }
	  $row_msg = mysqli_fetch_array($sql_msg); ?>
    <div class="modal-content">
      <div class="modal-header password-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Compose Message</h4>
      </div>
      <form  id="compose_msg" method="post">
      <div class="modal-body">
      <input type="hidden" id="" class="form-control" value="<?php echo $row_msg['uid']; ?>" name="tos[]" required hidden="hidden">
      <div class="col-md-2">To</div>
      <div class="col-md-8">
   		<label for=""><?php
   		 echo $row_msg['fname']." ".$row_msg['lname']; ?></label></div>
       <!--  <input type="text" class="form-control" placeholder="To" name="to" required> -->
    <!-- <input type="text" class="form-control mg-top15" placeholder="" name="" required> -->

 <textarea class="form-control mg-top15" name="message" required="" placeholder="Type Your Message Here.."></textarea>

    <div class="text-center">
    <button class="btn-5 mg-top15" type="submit">Send</button>
    </div>
      </div>
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-default" data-dismiss="modal" name="change_pass">Close</button> -->
        
      </div>
      </form>
    </div>

  </div>
</div>
<!-- compose msg modal box close -->
	  <?php

	   } ?>
	  <div class="clearfix"></div>



	   <h4 class="color1 mg-top20">Reviews</h4>
	   <?php
	   $q26 = mysqli_query($connect,"select * from ratings where placeid=".$placeid);
	   if(mysqli_num_rows($q26) > 0) 
	   {
	   while($r26 = mysqli_fetch_array($q26)) { 
	   	$q27 = mysqli_query($connect,"select * from users where uid=".$r26['userid']);
	   	$r27 = mysqli_fetch_array($q27);
	   	?>
		<div class="col-md-12">
			<h5><?php echo $r27['fname'].' '.$r27['lname']; ?></h5>
		<?php for($st=0;$st<$r26['ratings']; $st++)
		{
			?>
			<i class="fa fa-star" style="color:#FDE16D"></i>
			<?php
			}
			for($sta=5;$sta > $r26['ratings']; $sta--)
			{
			?>
			<i class="fa fa-star-o"></i>
			<?php
			}


			 ?>
		 <div class="clearfix"></div>
	<p><?php echo $r26['comments']; ?></p>

	  </div>
	  <?php } } else {
	  	?>
	  	<div><h5>No Reviews</h5></div>
	  	<?php
	  	} ?>

 <div class="clearfix"></div>
	 
	  </div>
	  <div class="col-md-4">
	  </div>
	</div>
	  <!---==========================Review section Ends=======================-->



<!--===================================================Left Side CLose====================================-->


<!--==================================Right Side=================================-->
 <!-- right side -->
	  
	  <?php //if ($_SESSION['u_id'] != $match['user_id'])
	  if ((!isset($_SESSION['u_id'])) || ($_SESSION['u_id'] != $match['user_id']))
	  {
		  
		  $sql9=mysqli_query($connect,'Select * from calenderdata  where placeid="'.$placeid.'" 
		  and status="Available" and date(date1) <= "'.$checkin.'" and date(date2) >= "'.$checkout.'" order by date1, time1') ;
		  
	  //$sql9 = mysqli_query($connect,"SELECT * FROM calenderdata WHERE placeid='".$placeid."'");
      //if(mysqli_num_rows($sql9)>0)
	  $calrows = array();
	  $res9 = array();
	  $i = 0;
	  //figure out available times
	  while($res9=mysqli_fetch_array($sql9))
      {
		  $calrows[$i] = $res9;
		  $i++;
	  } 
	   if(!empty($res9[2]) || !empty($res9[3]))
	   {
		 $dt1time = date_format(date_create($res9['date1']), 'g:i a');
		 $dt2time = date_format(date_create($res9['date2']), 'g:i a');
	  }
	  $fees = mysqli_query($connect,"select * from fees where feefor='b'");	
	  $feeres = mysqli_fetch_array($fees);
	  $fee = $feeres['percentage'] * .01;
	    ?>
	  <div class="col-md-6 custom2">
	  <div class="price-table-demo ">
	  <div class="row">
	  	
	  	<div class="col-md-12 col-sm-12 col-xs-12 pd-top20 pd-bottom20">
	  	<?php //if(!empty($res9[3])) { ?>
	  	<div class="col-md-4 col-sm-4 col-xs-4">
			<input type="radio" value="hour" checked id="hour_label" class="per_val" name="types">
			<label for="hour_label" style="cursor: pointer;">Per Hour</label>
		</div>
		<?php //} 
		if(!empty($res9[2])) { ?>
		<!--<div class="col-md-4 col-sm-4 col-xs-4">
			<input type="radio" value="night" id="night_label" class="per_val" name="types">
			<label for="night_label" style="cursor: pointer;">Per Day</label>
		</div>-->
		<?php } 
		if(!empty($res9[4])) { ?>
		<!--<div class="col-md-4 col-sm-4 col-xs-4">
			<input type="radio" value="week" id="week_label" class="per_val" name="types">
			<label for="week_label" style="cursor: pointer;">Per Week</label>
		</div>-->
		<?php } ?>
		</div>

	  </div>
	  <?php //	if(!empty($res9[3])) { ?>



<div class="show_div">  <!--my div start-->

<link href="tm/jquery.timepicker.css" rel="stylesheet">
<!-- <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script> -->

<form class="book_form2_hour" method="post">
<div class="row bg-row">

<div class="col-md-6 col-sm-6 col-xs-6">
<input type="hidden" class="ppnight" value="">
<h4>$<?php echo $res9[3] ?></h4>
<!--<h4>&#8377; <span class="night_rupee"></span>/-</h4>-->
</div>
<div class="col-md-6 col-sm-6 col-xs-6">
<h4 class="text-right">Per Hour</h4>
</div>
</div>
<div class="row mg-top15 ">
<?php 
$chckin = date_format(date_create($checkin), 'Y-m-d');

$bresult = mysqli_query($connect, 'select * from `booking` where `placeid` = "'.$placeid.'" and `checkin` = "'.$chckin.'" order by `ftime` asc');
$bookrows = array();
$j = 0;
while ($bookres = mysqli_fetch_array($bresult)) {
	$bookrows[$j] = $bookres;
	$j++;
}
?>
<div> Available times for 
<?php
echo $chckin;
echo " : ";


if (mysqli_num_rows($bresult) == 0) {
	foreach ($calrows as $crow) {
		echo "<br>" . date_format(date_create($crow['time1']), 'g:i a') . " to " . date_format(date_create($crow['time2']), 'g:i a');
	}
	
} else {
	$k = 0;
	$l = 0;
	$timeray1 = array();
	$timeray2 = array();
	$calray1 = array();
	$calray2 = array();
	$dt1time2 = "";
	$dt2time2 = "";
	$dt1time2a = "";
	$dt2time2a = "";

//while ($bookres = mysqli_fetch_array($bresult)) {
foreach ($calrows as $crow2) {
	$dt1time2 = date_format(date_create($crow2['date1']), 'H:i');
	$dt2time2 = date_format(date_create($crow2['date2']), 'H:i');
	$calray1[$k] = $dt1time2;
	$calray2[$k] = $dt2time2;
	//error_log($bookrows[0]['ftime'] . " " . $bookrows[1]['ftime']);
	foreach ($bookrows as $brow) {
		$timeray1[$l] = date_format(date_create($brow['ftime']), 'H:i');
		$timeray2[$l] = date_format(date_create($brow['ltime']), 'H:i');
		$timehrs[$l] = $brow['hours'];
		
		if ($timeray1[$l] >= $calray1[$k] and $timeray1[$l] < $calray2[$k]) {
			error_log($timeray1[$l] . " " . $dt1time2);
			if ($timeray1[$l] == $dt1time2) {
					error_log('spota');
					$dt1time2 = $timeray2[$l];
			} else {
					error_log('spotb');
					$dt2time2 = $timeray1[$l];
					if ($dt1time2 != $dt2time2) {
						error_log('spotc');
						echo "<br>" . date_format(date_create($dt1time2), 'g:i a') . " to " . date_format(date_create($dt2time2), 'g:i a');
					}
					$dt1time2 = $timeray2[$l];
			}
			
		} else {
			if (isset($timeray2[$l-1])) {
				if ( $timeray2[$l-1] != $calray2[$k]) {
					if ( $calray2[$k] < $calray2[$k-1] ) {
						error_log('spotd');
						//echo "<br>" . date_format(date_create($timeray2[$l-1]), 'g:i a') . " to " . date_format(date_create($calray2[$k]), 'g:i a');
					} else {
						error_log('spote');
						//echo "<br>" . date_format(date_create($timeray2[$l-1]), 'g:i a') . " to " . date_format(date_create($calray2[$k-1]), 'g:i a');
						echo "<br>" . date_format(date_create($calray1[$k]), 'g:i a') . " to " . date_format(date_create($calray2[$k]), 'g:i a');
					}
				}
			} else if (isset($calray2[$k-1])) {
				error_log('spotf');
				echo "<br>" . date_format(date_create($timeray2[$l]), 'g:i a') . " to " . date_format(date_create($calray2[$k-1]), 'g:i a');
				if ($calray1[$k] != $calray2[$k] ) {
					echo "<br>" . date_format(date_create($calray1[$k]), 'g:i a') . " to " . date_format(date_create($calray2[$k]), 'g:i a');
				}
			}
			$l++;
	}
		
}
	//error_log($dt1time2 . " " . $calray2[$k]);
	if ($dt1time2 != $calray2[$k])
	{
		echo "<br>" . date_format(date_create($dt1time2), 'g:i a') . " to " . date_format(date_create($calray2[$k]), 'g:i a');
	}
	$k++;
}
//}
//$l--;
//$k--;

//if (isset($datetime2) {
	//error_log($timeray2[$i] . " " . $dt2time2a);
	
//}
}
?>
	
	
	<?php 
		
	 ?></div>
<div class="col-md-4 pd-lr-6">
<div class="input-group mg-top20">
    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
    <input type="text" id="basic" name="time"/ class="form-control" value="<?php echo $frtm ?>" placeholder="Start">
    <input type="text" id="basic2" name="time"/ class="form-control" value="<?php echo $totm ?>" placeholder="End">
</div>

</div>
<div class="col-md-4 pd-lr-6">

<div class="input-group mg-top20"> 
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	<input type="text" id="hourdatepicker" name="checkin" value="<?php echo date_format(date_create($_REQUEST['checkin']), 'm/d/Y') ?>" placeholder="CheckIn" class="form-control bord-0">
</div>

</div>
<div class="col-md-4 pd-lr-6">
<div class="input-group mg-top20">
    <span class="input-group-addon"><i class="fa fa-users"></i></span>
	<input type="number" min="1" max="'.$res9['capacity'].'" name="guests" placeholder="Guests" value="<?php echo $_REQUEST['guests']?>" class="form-control bord-0">
</div>


</div>
</div>
<div class="errormessage">
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-7 pricecel">
<h5>&#36;<span class="price_cal"><?php echo $res9[3] ?></span> x <span class="calculated">1 Hour</span></h5>
</div>
<div class="col-md-6 col-sm-6 col-xs-5">
<h5 class="text-right"><span>&#36;</span><span class="initprice"><?php echo $res9[3] ?> </span></h5>
</div>
</div>
	<div class="row" id="forappend"></div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-7">
		<h5>Convenience Fee</h5>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-5">
		<h5 class="text-right">&#36;<span class="conv_fee"><?php echo ($res9[3] * $fee) ?></span></h5>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-7">
		<h5>Processing Fee</h5>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-5">
		<h5 class="text-right">&#36;<span class="proc_fee"><?php echo ($res9[3] * .029) ?></span></h5>
	</div>

	
		<div class="col-md-6 col-sm-6 col-xs-7">
			<h5>Total</h5>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-5">
			<h5 class="text-right">&#36;<span class="total_price"><?php echo ($res9[3] + ($res9[3] * $fee)) ?> </span></h5>
		</div>
	
</div>
	<div class="errormessage22"></div>
<input name="package" value="hours" type="hidden"/>
<input type="text" name="time1" id="time1" value="00:00" hidden>
<input type="text" name="time2" id="time2" value="00:00" hidden>
<input name="price" value="'.$res9['p_p_h'].'" id="price_per_week" type="hidden" />
<input name="hours" value="0" id="total_hour" type="hidden" />
<input name="myplaceid" value="<?php echo $placeid ?>" type="hidden" />
<input name="totalprice" class="totalprice" value="<?php echo ($res9[3] + ($res9[3] * $fee)) ?>" type="hidden" />
<input name="checkout" value="" type="hidden" />
<input name="bfee" class="bfee" value=<?php echo $fee ?> type="hidden" />


<div class="text-center">
	<button type="submit" style="display:block;" id="book_button"  name="book_now_hour" class="btn-4">Book Now</button>
</div> </form>
<div style="display: none;">
	<form id="gotobook" action="booking-form.php" method="post">
		<input name="theplace" value="<?php echo $match['space_name'].",".$match['p_address'];?>" type="hidden" />
		<input id="bookid" name="bookid"  type="hidden" />
		<input name="placeid" value="<?php echo $placeid ?>" type="hidden" />
		<button id="bk-btn" type="submit">
	</form>
</div>

</div>  <!--my div end -->	
<!--<form class="book_form"  method="post">


    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <h4 class="text-right">Per Day</h4> </div>
</div>
<div class="row mg-top15 ">
<div class="col-md-4 pd-lr-6">

<div class="input-group mg-top20"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    <input type="text" id="datepicker" name="checkin" value="<?php //if(isset($_REQUEST['checkin'])) { echo $_REQUEST['checkin']; } else { echo date('m/d/Y'); } ?>" placeholder="CheckIn" class="form-control bord-0"> </div>

</div>
<div class="col-md-4 pd-lr-6">
<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	<input type="text" id="datepicker1" name="checkout" value="<?php //if(isset($_REQUEST['checkout'])) { echo $_REQUEST['checkout']; } else { $datetime = new DateTime('today');
//echo $datetime->format('m/d/Y'); } ?>" placeholder="CheckOut" class="form-control bord-0">
</div>

</div>
<div class="col-md-4 pd-lr-6">
<div class="input-group mg-top20">
    <span class="input-group-addon"><i class="fa fa-users"></i></span>
	<input name="guests" type="number" min="1" max="<?php //echo $match['capacity']; ?>" placeholder="Guests" value="1" class="form-control bord-0">
</div>

</div>
</div>
<div class="errormessage">
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-7">
<h5><?php //echo $currency ?> <span class="price_cal"><?php //echo $match['p_p_n']; ?></span> x <span class="calculated">1 Night</span></h5>
</div>
<div class="col-md-6 col-sm-6 col-xs-5">
<h5 class="text-right"><span><?php // echo $currency ?> </span><span class="total_price"><?php //echo $match['p_p_n']; ?> </span></h5>
</div>
</div>
<div class="row" id="forappend">
</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-7">
<h5>Total</h5>
</div>
<div class="col-md-6 col-sm-6 col-xs-5">
<h5 class="text-right"><span><?php // echo $currency ?> </span><span class="total_price_cal"><?php //echo $match['p_p_n']; ?> </span></h5>
</div>
</div>
</div>

</form>-->




<?php //} ?>
	</div>
</div>
	  <?php //}

	   //} 
	   //else {
	 ?>
	 <!--<div class="col-md-6 custom2"style="display: block;border-bottom: 0px solid #1BBC9B;border-left: 2px solid #1BBC9B;border-right: 2px solid #1BBC9B;padding-bottom: 0px;">
      
	  <?php  //$sql9 = mysqli_query($connect,"SELECT * FROM calenderdata WHERE placeid='".$placeid."'");
      //if(mysqli_num_rows($sql9)>0)
      { 
        ?>
        <!--<div class="row" style="background: #1BBC9B;
    padding: 13px 0px;
    color: white;
    font-weight: bolder;
    font-size: 19px;">
          <div class="col-md-3">From</div>
          <div class="col-md-3">To</div>
          <div class="col-md-2">ppn</div>
          <div class="col-md-2">pph</div>
          <div class="col-md-2">ppw</div>
        </div>-->
        <?php
        //$he = 1;
        //while($row9 = mysqli_fetch_array($sql9))
        //{
          ?><!--<div class="row for_re" style="    padding: 11px 0px 1px 0px;
    border-bottom: 2px solid #1BBC9B;">
            <div class="col-md-3 text-center"><?php //echo $row9['date1'] ?></div>
            <div class="col-md-3 text-center"><?php //echo $row9['date2'] ?></div>
            <?php /* if(($row9['p_p_n']=="")&&($row9['p_p_h']=="")&&($row9['w_p_p_n']==""))
            {
              ?>
<div class="col-md-6 text-center">Not Available</div>
<?php
            }
              else
              {*/
               ?>
            
          <?php
          //$he++;
          }
      }
      //else{
        //echo '<div class="row"style="padding: 11px 0px 1px 0px;
    //border-bottom: 2px solid #1BBC9B;">
    //<div class="col-md-8"></div> 
      //    </div>';
        //} ?>     

  </div>
	 <?php
	  //} ?> 

<!--=======================================Right Side close============================-->
</div>
  
</div>
</div>

<?php 
} else {
?>
	<div style="height: 250px;"></div>
<?php } 

	  //if isset ?>
<!--======footer======-->
	<?php include 'lib/footer.php';?>
	<script src="tm/jquery.timepicker.js"></script>
<script>
function formVal() {
                    var mess = "Please Enter Missing Information.";
					if (document.getElementById('basic').value) {
						var fn=Date(document.getElementById('basic').value);
					} else {
						var fn="";
					}
					if (document.getElementById('basic2').value) {
						var fo=Date(document.getElementById('basic2').value);
					} else {
						var fo="";
					}
					//console.log(fn + " " + fo);
    				if(fn == "" || fn > fo){		
        				document.getElementById('basic').style.borderColor = "red";
						return false;
						//$("#span1a").html(mess);
					}else if (fo == "") {
        				document.getElementById('basic2').style.borderColor = "red";
						return false;
					}
					return true;
}
$(document).ready(function(){

   $('#book_button').click(function(e){
	   if (!formVal()) {
		   e.preventDefault();
	   } else {
		   return true;
	   }
   });	
   $('#basic').timepicker({
		'timeFormat':'g:i a',
		step: 60,
		minTime:'<?php echo rtrim($calrows[0]['time1'], '00.000000') ?>',
		//maxTime:'<?php echo $calrows[$i]['time2'] ?>',
    	'scrollDefaultNow': 'true',
        'closeOnWindowScroll': 'true',
        'showDuration': false
	});
	$('#basic').change(function(){
// start here 
    var starttime = $('#basic').val();
    var endtime = $('#basic2').val();
    var date_val2 = $('#hourdatepicker').val();
    var price_cal = $('.ppnight').val();
    var placeid = $('.placeid_val').val();
	var fee = $('.bfee').val();
    //console.log("datedata"+date_val2)
    if(endtime!='')
    {
    	if(endtime>starttime)
    	{
    $.ajax({
      url: 'forms2.php?hoursdate_val1='+date_val2+'&placeid='+placeid+'&pervalues=hour&start_time='+starttime+'&end_time='+endtime,
      success: function(data)
      {
        //console.log('my data - '+data);
        
        data1 = data.split('>>>');
        //console.log(data1[0]);
        //console.log(data1[1]);
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
           //console.log("defailt price"+price);
        }
        else
        { 
          // alert("please  time");
          var per_hours =data1[0];
          var price = parseInt(hours)*parseInt(data1[0]);
        }
      }
       /* $.ajax({
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
        });*/

		var final_total = (price + (price * fee)).toFixed(2);
		$('#time1').val(starttime);
        $('#time2').val(endtime);
        $('#total_hour').val(hours);
        $('#price_per_week').val(per_hours);
        $('.night_rupee').html(per_hours);
        $('.price_cal').html(per_hours);
		$('.initprice').html(price);
		//$('.total_price_cal').html(Number(Math.round((price * fee)+'e2')+'e-2'));
		$('.conv_fee').html((price * fee).toFixed(2));
		$('.proc_fee').html((price * .029).toFixed(2));
		$('.total_price_cal').html((price * fee).toFixed(2));
		$('.totalprice').val(final_total);
		$('.total_price').html(final_total);
        $('.calculated').html(hours+' hours');
      }
    });
} 
}


//end here 

	var new_end = $(this).timepicker('getTime');
	//console.log(new_end);
   	var dd = new_end.setHours(new_end.getHours()+1);

    $('#basic2').timepicker({
    	'timeFormat':'g:i a',
    	step: 60,
    	minTime: new_end,
		maxTime:'<?php echo $dt2time ?>',
    });

    $('#basic2').change(function(){
    	var starttime = $('#basic').val();
		var endtime = $('#basic2').val();
	//if (starttime < endtime) {
		var date_val2 = $('#hourdatepicker').val();
		var price_cal = $('.ppnight').val();
		var placeid = $('.placeid_val').val();
		var fee = $('.bfee').val();
		//console.log("datedata"+date_val2)
		$.ajax({
		url: 'forms2.php?hoursdate_val1='+date_val2+'&placeid='+placeid+'&pervalues=hour&start_time='+starttime+'&end_time='+endtime,
		success: function(data)
		{
			//console.log('my data - '+data);
			
			data1 = data.split('>>>');
			//console.log(data1[0]);
			//console.log(data1[1]);
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
			
			}
			else
			{ 
			// alert("please  time");
			var per_hours =data1[0];
			var price = parseInt(hours)*parseInt(data1[0]);
			}
		}
			/*$.ajax({
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
			});*/
			var final_total = (price + (price * fee) + (price * .029 + .30)).toFixed(2);
			$('#time1').val(starttime);
			$('#time2').val(endtime);
			$('#total_hour').val(hours);
			$('#price_per_week').val(per_hours);
			$('.night_rupee').html(per_hours);
			$('.price_cal').html(per_hours);
			$('.initprice').html(price).toFixed(2);
			//$('.total_price_cal').html(Number(Math.round((price * fee)+'e2')+'e-2'));
			$('.conv_fee').html((price * fee).toFixed(2));
		    $('.proc_fee').html((price * .029 + .30).toFixed(2));
			$('.total_price_cal').html((price * fee).toFixed(2));
			$('.totalprice').val(final_total);
			$('.total_price').html(final_total);
			$('.calculated').html(hours+' hours');
		}
	});
	//}  
  	});
});
});
</script>
<!--======footer close======-->


</div><!--row close-->
</div><!--container-fluid close-->
	</div>
</body>	
</html>
<?php } ?>

<script>
	/*$(document).ready(function(){
		var date_val1 = $('#datepicker').val();
		var date_val2 = $('#datepicker1').val();
		var price_cal = $('.ppnight').val();
		var placeid = $('.placeid_val').val();
		if(date_val2>date_val1)
		{
		$.ajax({
			url: 'forms2.php?date_val1='+date_val1+'&date_val2='+date_val2+'&placeid='+placeid,
			success: function(data)
			{	
                console.log(date_val1);
                console.log(date_val2);
                console.log(placeid);
                
				console.log('my data - '+data);
				// console.log("<h5>&#8377; <span class="price_cal">'.$match['p_p_n'].'</span> x <span class="calculated">1 Night</span></h5>");
				data1 = data.split('>>>');
				if(data1[3]=='0')
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
							tax_data =tax_data+'<div class="col-md-6 col-sm-6 col-xs-7 "><h5>&#8377; <span class=""></span> <span class="">'+title[j]	+'</span></h5></div><div class="col-md-6 col-sm-6 col-xs-5"><h5 class="text-right"><span>&#8377; </span><span class="">'+final+'</span></h5></div>';
							tax_value = parseInt(tax_value)+parseInt(final);
						}
						console.log("tax value"+tax_value)
						$('#forappend').html(tax_data);
						var final_total = parseInt(tax_value)+parseInt(grand_total);
						console.log("final"+final_total);
					}
					$('.night_rupee').html(avg_p);
					$('.price_cal').html(avg_p);
				$('.total_price_cal').html(final_total);
				$('.totalprice').val(grand_total);
				$('.total_price').html(grand_total);
				$('.calculated').html(regular_price+' Nights');
				}
				});
			}
			else
			{	$('#book_button').css('display','none');
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
	});*/
</script>
