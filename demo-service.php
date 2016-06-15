<?php include_once('connect.php');
if(isset($_REQUEST['serviceid'])) {
?>
<!doctype html>
<html>
<head>

	<title>Book My Space</title>
	<?php include 'lib/top.php';?>
	<link href="css/style2.css" rel="stylesheet">
	<style>
	.btn-4{
		width:50%;
	}
	#ui-datepicker-div{
		z-index:20 !important;
	}
	</style>
</head>

<body>
<div class="container-fluid"><!--container-fluid start-->
<div class="row">


<!--==============menu header=========================-->
<div class="menu-had">
<?php include 'lib/header.php';?>

</div><!--menu-had close-->
<?php 
$serviceid=$_REQUEST['serviceid'];

$query=mysqli_query($connect,'Select * from services where sid="'.$serviceid.'"');
if($match=mysqli_fetch_array($query)){
	?>
<!--==============menu header close=========================-->

<!--=================slider========================-->
<input type="hidden" class="serviceid_val" value="<?php echo $serviceid; ?>">
<div class="">
  <div id="carousel-example-generic" class="carousel slide">
     

      <!-- Wrapper for slides -->
      <div class="carousel-inner hg-500" role="listbox">
	

        <!-- First slide -->
        <?php if(!empty($match['photo']))
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
	.slide<?php echo$i; ?> {
		background: url("images/services/<?php echo $photo[$i]; ?>");
		padding-top:100px !important;
	background-position:center;
	background-size:cover;
}
        </style>
              <div class="item slide<?php echo$i; ?> active">
          <div class="carousel-caption">
				
          </div>
        </div> <!-- /.item -->
	  	<?php
	  	}else
	  	{
	  		  	?>
	  <style>
	.slide<?php echo$i; ?> {
		background: url("images/services/<?php echo $photo[$i]; ?>");
		padding-top:100px !important;
	background-position:center;
	background-size:cover;
}
        </style>
              <div class="item slide<?php echo$i; ?>">
          <div class="carousel-caption">
				
          </div>
        </div> <!-- /.item -->
	  	<?php
	  	}
	
	  }
	}
	else
	{
		?>
		  <style>
	.slide1{
		background: url("img/no_img.jpg");
		padding-top:100px !important;
	background-position:center;
	background-size:cover;
}
        </style>
              <div class="item active slide1">
          <div class="carousel-caption">
				
          </div>
        </div> <!-- /.item -->
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
	  <h1 class="h-1"><?php echo $match['stitle'].",".$match['city'];?></h1>
	  <div class="col-md-6 col-sm-6 ">
	  </div>
	  <div class="col-md-6 col-sm-6 mg-media">
	  <i class="fa fa-users fa-2x"></i>&nbsp;&nbsp;
	  <span class="s1"><?php echo $match['sdesc']; ?><span>
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
<div class="col-md-12">

<!--========================================Left Side=====================================-->
<div class="col-md-7">
<h2 class="color1"><?php echo $match['stitle'];?></h2>
<p>
<?php echo $match['city'].",".$match['postcode'].",".$match['state'].",".$match['country']; ?>
<!-- Kapila Matrix, Koregaon Park, Pune. 411001 --></p>
<div class="col-md-3">
	<?php $q28 = mysqli_query($connect,"select sum(`ratings`) as ratetotal from ratings where serviceid=".$serviceid);
	$r28 = mysqli_fetch_array($q28);

	$q29 = mysqli_query($connect,"select * from ratings where serviceid=".$serviceid);
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
<!-- <div class="col-md-9 mg-media">
<i class="fa fa-users fa-lg color1"></i>&nbsp;&nbsp;<span><?php echo $match['capacity']; ?></span>
</div> -->
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

	  <!-- right side -->
	  
	  <?php if($_SESSION['u_id'] != $match['rid']) { if(!empty($match['ppn']) || !empty($match['pph']) || !empty($match['ppw'])) { ?>
	  <div class="col-md-5 custom2">
	  <div class="price-table-demo ">
	  <div class="row">

	  </div>
	  <?php if(!empty($match['ppn']) || !empty($match['pph']) || !empty($match['ppw'])) { ?>
<div class="show_div"> <!-- my div start -->
<form class="enquiry_form" method="post">

<div class="row bg-row">

<div class="col-md-12 col-sm-12 col-xs-12">
<h4 class="text-center">Send Enquiry</h4>
</div>
</div>
<div class="row mg-top15 ">
<div class="col-md-12 pd-lr-6">
<select id="select1" class="wid100" multiple="multiple" name="canbe[]" required>
<!--       <option value="" hidden>Select Events</option>
 -->   
  <?php

$ufids=explode(",", $match['seventid']);
for ($m=0; $m < count($ufids) ; $m++) { 
   $query=mysqli_query($connect,'Select * from usedfor where ufid="'.$ufids[$m].'"');
if($match=mysqli_fetch_array($query)){?>
    <option value="<?php echo $match['ufid'];?>"><?php echo $match['ufname'];?></option>
<?php }//if 
}//for?>
</select>	
</div>
<div class="col-md-12 pd-lr-6">

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	<input type="text" id="datepicker" name="date1" value="<?php //if(isset($_REQUEST['checkin'])) { echo $_REQUEST['checkin']; } else { 
		echo date('m/d/Y');// } ?>" placeholder="Event Date" required class="form-control bord-0">
</div>

</div>
<!-- <div class="col-md-6 pd-lr-6">
<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	<input type="text" id="datepicker1" name="checkout" value="<?php if(isset($_REQUEST['checkout'])) { echo $_REQUEST['checkout']; } else { $datetime = new DateTime('tomorrow');
echo $datetime->format('m/d/Y'); } ?>" placeholder="CheckOut" class="form-control bord-0">
</div>

</div> -->
</div>
<div class="row mg-top15">
<div class="col-md-6 pd-lr-6">
<input type="number"  placeholder="Guests"  name="nguest" required class="form-control">
</div>

<div class="col-md-6 pd-lr-6">
<input type="number"  placeholder="Budget"  name="ebudget" required class="form-control">
</div>
</div>


<div class="row mg-top15">
<div class="col-md-12 pd-lr-6">
<input type="text"  placeholder="Name"  name="ename" required class="form-control">
</div>
</div>

<div class="row mg-top15">
<div class="col-md-12 pd-lr-6">
<input type="email"  placeholder="Email" name="eemail"  required class="form-control">
</div>
</div>

<div class="row mg-top15">
<div class="col-md-12 pd-lr-6">
<input type="text"  placeholder="Mobile" name="emobile" required class="form-control phone">
</div>
</div>

<div class="row mg-top15">
<div class="col-md-12 pd-lr-6">
<textarea  placeholder="Event Details" name="edetails" required class="form-control"></textarea>
</div>
</div>

<!-- <input name="package" value="night" type="hidden" />
<input name="price" value="<?php echo $match['p_p_n']; ?>" type="hidden" />
<input name="myplaceid" value="<?php echo $placeid; ?>" type="hidden" />
<input name="totalprice" class="totalprice" value="<?php echo $match['p_p_n']; ?>" type="hidden" /> -->
<input name="serviceid" value="<?php echo $match['ppn']; ?>" type="hidden" />

<div class="text-center mg-top15">
	<button type="submit" name="senquiry" class="btn-4">Send Enquiry</button>
</div>
</form>
</div> <!-- my div end -->
<?php } ?>
	</div>
</div>
	  <?php } } ?> 
	  <div class="clearfix"></div>
	  <!--===============About the Listing Details===============-->
	  <div class="col-md-12 col-sm-12 col-xs-12">
	  <div class="row">
	  <div class="col-md-12 col-sm-12 ">

	   <h5 class="color1 mg-top20">Description</h5>
	  <p><?php echo $match['sdesc'];?></p>


		<div class="clearfix"></div>
	  
	    <h4 class="color1 mg-top20">Best Suited for</h4>
		<div class="col-md-12 col-sm-12  icos">
	 
	 <?php

	  $usedfor=explode(",", $match['seventid']);
	  for ($j=0; $j < count($usedfor) ; $j++) {
	   $query1=mysqli_query($connect,'Select * from usedfor where ufid="'.$usedfor[$j].'"');
if($match1=mysqli_fetch_array($query1)){
	     echo "<div class=\"col-md-3 pd-lr-10\"><img src='img/".$match1['uficon']."'>&nbsp;".$match1['ufname']."</div>";
	 }
	   }  ?><!-- Bachelor Party -->
		</div>
	
	  </div>
	  </div>

	  <div class="clearfix"></div>
	  
	  <!---==========================Photos section=======================-->
	  <?php 
	  if(!empty($match['photo'])) { ?>
	  
	  <div class="row">
	  <h4 class="color1 col-md-12 col-sm-12  mg-top20">Photos</h4>
	  <div class="col-md-12 col-sm-12 ">
	  
	  <?php 
	  $sphoto=explode(",", $match['photo']);
	  for ($i=0; $i <count($sphoto) ; $i++) { 
	  	echo '<div class="col-md-4 col-sm-4  mg-media" ><img src="images/services/'.$sphoto[$i].'" height="150" width="150" class="img-responsive"></div>';
	  }?>
	  </div>
	  
	  </div>
	  <?php } ?>
	  
	  
	  <!---==========================Photos section Ends=======================-->

	  <!---==========================Video section=======================-->
	  <?php if(!empty($match['video'])) { ?>
	  <div class="row">
	  <h4 class="color1 col-md-12 col-sm-12  mg-top20">Video(s)</h4>
	  <div class="col-md-12 col-sm-12 ">
	  
	  <?php $video=explode(",", $match['video']);
	  $video_type = explode(',',$match['video_type']);
	  for ($i=0; $i <count($video) ; $i++) { 
	  	echo '<div class="col-md-4 col-sm-4  mg-media">
	  	<video width="200" height="110" controls>
	  	<source src="video/'.$video[$i].'"> type="'.$video_type[$i].'"</video>
	  	</div>';
	  }?>
	  </div>
	  </div>
	  <?php } ?>
	  
	  <!---==========================Video section Ends=======================-->	  
	 	 <?php $query1=mysqli_query($connect,'SELECT * FROM `services` s,`servicedata` sd where s.sid="'.$serviceid.'" and s.sid=sd.sid');?>
	 	   <div class="row">
	  <h4 class="color1 col-md-12 col-sm-12  mg-top20">Special Pricing</h4>
	   <?php   
                                while($row1=mysqli_fetch_array($query1)){  ?>
	  <div class="col-md-12 col-sm-12 ">
	   
                                 <h5>PPH:<?php echo $row['currencyid']." ".$row1['pph'];?></h5>
                                        <h5>PPN:<?php echo $row['currencyid']." ".$row1['ppn'];?></h5>
                                        <h5>PPW:<?php echo $row['currencyid']." ".$row1['ppw'];?></h5>
                                        <span>
                                            <a href="#" class="small"> <?php echo $row1['date1']." - ".$row1['date2'];?></a>
                                        </span>
                                        <a class="dir-like" href="#">
                                            <span class="small"><?php echo $row1['status'];?></span>
                                            <i class="fa fa-heart"><?php echo " On ".$row1['scurdate'];?></i>
                                        </a>
	  </div>
	  <?php }?>
	</div>
	 
	  <!---==========================Review section=======================-->

	  <?php
	  if($match['rid'] != $_SESSION['u_id']) { 
	  	?>
	  <h4 class="color1 mg-top20">Leave Comment</h4>
	  <form id="place_ratings" method="post">
		<div class="col-md-12 mydiv">
		<input name="serviceid" type="hidden" value="<?php echo $serviceid; ?>" hidden>
		<input id="input-21d" value="2" type="number" name="ratings" class="rating" min=0 max=5 step=1 data-size="sm"/>
		 <div class="clearfix"></div>
			<textarea class="form-control" name="reviews" placeholder="Write your Reviews"></textarea>
		<button type="submit" class="btn-3 mg-top20">Comment</button>
	  </div>
	  </form>
	  <?php } ?>
	  <div class="clearfix"></div>



	   <h4 class="color1 mg-top20">Reviews</h4>
	   <?php
	   $q26 = mysqli_query($connect,"select * from ratings where serviceid=".$serviceid);
	   if(mysqli_num_rows($q26) > 0) {
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
	  	<div><h3>No Reviews</h3></div>
	  	<?php
	  	} ?>

 <div class="clearfix"></div>
	 
	  </div>
	  <div class="col-md-4">
	  </div>
	  <!---==========================Review section Ends=======================-->



<!--===================================================Left Side CLose====================================-->


<!--==================================Right Side=================================-->


<!--=======================================Right Side close============================-->
</div>
</div>
</div>

<?php }//if isset ?>
<!--======footer======-->
	<?php include 'lib/footer.php';?>
<!--======footer close======-->


</div><!--row close-->
</div><!--container-fluid close-->
</body>	
</html>
<?php } ?>
