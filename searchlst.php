<?php include_once('connect.php');
//if(isset($_REQUEST['searching'])) { 
  if (isset($_POST['chin'])) {
    $chinvar = date_format(date_create($_POST['chin']), 'Y-m-d');
  }
  if (isset($_POST['chout'])) {
    $choutvar = date_format(date_create($_POST['chout']), 'Y-m-d');
  }
  if(!empty($_REQUEST['place_loc'])){
    $place_loc = $_REQUEST['place_loc'];
  } else {
    $place_loc = "";
  }
  if(!empty($_REQUEST['my-lat'])){
    $mylat = $_REQUEST['my-lat'];
  } else {
    $mylat = 	41.881832;
  }
  if(!empty($_REQUEST['my-lng'])){
    $mylng = $_REQUEST['my-lng'];
  } else {
    $mylng = -87.623177;
  }
  if(!empty($_REQUEST['events'])){
    $events='';
    foreach($_REQUEST['events'] as $event)
    {
      $events .= $event.',';
    }
    $events = rtrim($events,',');
  } else {
    $events='';
    $sq1 = mysqli_query($connect,"select * from usedfor");
    while ($rrw=mysqli_fetch_array($sq1)) {
      $events .= $rrw['ufid'].",";
    }
    $events = rtrim($events,',');
  }
  if(!empty($_REQUEST['daterange'])){
 //$daterange = $_REQUEST['daterange'];
    $dates = explode(',',$_REQUEST['daterange']);
    $sep = explode(':', $dates[0]);
    $sep1 = explode(':', $dates[1]);
    $pdate1 = date('Y-m-d',strtotime(substr($sep[1],1,strlen($sep[1])-2)));
    $pdate2 = date('Y-m-d',strtotime(substr($sep1[1],1,strlen($sep1[1])-3)));
  } else {
    $pdate1 = date('Y-m-d');
    $pdate2 = date('Y-m-d');
  }

  if(!empty($_REQUEST['guests'])){
    $gue = explode(' ',$_REQUEST['guests']);
    $guests = $gue[0];  
  } else {
    $guests = 1;
  }

  if(!empty($_REQUEST['minbud'])){
    $minbud = $_REQUEST['minbud'];
  } else {
    $minbud = 1;
  }
  if(!empty($_REQUEST['maxbud'])){
    $maxbud = $_REQUEST['maxbud'];
  } else {
    $maxbud = 50000;
  }
  $chinvarpl = date('Y-m-d', strtotime($chinvar . "+1 days"));
  error_log($chinvar);
  error_log($chinvarpl);
//echo "select * from place where p_address like '%".$place_loc."%' and capacity >= '".$guests."' and ((p_p_h between ".$minbud." and ".$maxbud.") or (p_p_n between ".$minbud." and ".$maxbud.") or (w_p_p_n between ".$minbud." and ".$maxbud."))";
 $q21 = mysqli_query($connect,"select distinct a.place_id, a.p_address, a.p_city, a.p_state, a.p_country, a.postal_code, a.photo, a.space_name, a.capacity, a.p_p_h, a.p_p_n from place a, calenderdata b where place_id = placeid and user_id != '".$_SESSION['u_id']."' and status = 'Available' and p_address like '%".$place_loc."%' and capacity >= '".$guests."' and b.date1 >= '".$chinvar."' and b.date1 < '".$chinvarpl."' and ((b.p_p_h between ".$minbud." and ".$maxbud.") or (b.p_p_n between ".$minbud." and ".$maxbud.")) order by a.place_id"); 
  //$q21 = mysqli_query($connect,"select * from place where p_address like '%".$place_loc."%' "); 
?>
<!doctype html>
<html>
<head>

	<title>Book a Space</title>
	<?php include 'lib/top.php';?>

	<style>
  .btn .caret{
    margin-top:-10px !important;
  }
  #map_canvas{
    position: fixed !important;
    width:41.45% !important;
    height:100% !important;
  }
	.container-custom{
		 
		width:100% !Important;
	}
  .multiselect-selected-text
  {
    max-width: 100%;
    display: inline-block;
    overflow: hidden;
    text-overflow: ellipsis;
  }
	.wid100{
		width:100% !important;
	}
	.main-center-data{
		padding-bottom:0px;
	}
	footer{
		margin-left: -11px;
    margin-right: -13px;
	}
	.footer-lst{
		margin-left: -11px;
    margin-right: -13px;
	}
	@media (max-width:768px)
	{
		.footer-media{
		margin-left: -30px;
		margin-right: -30px;
		}
		.footer-lst{
			margin-left: -30px;
		margin-right: -30px;
		}
	}
	
	</style>

</head>

<body>
<div class=""><!--container-fluid start-->
  <div class="">

<!--==============menu header=========================-->
    <div class="menu-had2" style="position: fixed;
      z-index: 20;
      top: 0px;
      width: 100%;">
      <?php include 'lib/header.php';?>
    </div><!--menu-had close-->
<!--==============menu header close=========================-->

    <div class="">
      <div class="main-center-data" style="margin-top: 129px;">
        <div class="search-lst-data">
          <div class="col-md-5 pd-l-0 hidden-sm hidden-xs">
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0ceT-_kjPt8INNEKoVX9axkv3zw3miBY&libraries=places"></script>
      <!--      <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAHOSxxua5IIFTA1-WiZbenpWIj0yv9hU8"></script> -->          
            <div id="map_canvas"></div>
          </div>
        </div>
        <!--<div class="col-md-7 col-sm-12 col-xs-12" style="border: solid 1px;">-->
        <div class="col-md-7 col-sm-12 col-xs-12" style="border: solid 1px;">
          <h1 class="search-had"><?php echo $place_loc; ?></h1>
<!--<div class="moon-divider2 small"></div>-->

          <form method="post" action="searchlst.php">
          <div class="had-frm" >Search</div>
          <div class="row">
            <div class="col-md-2">
              <p>Budget</p>
            </div>
            <div class="col-md-4" style="padding-left:0px">
              <input type="hidden" name="my-address" id="my-address" value="<?php echo $place_loc;?>">
              <input type="hidden" name="mylat" id="mylat" value="<?php if($mylat=='')
{
 echo 17.3700;
$mylng = 78.4800;
}
else
{

  echo $mylat; 
  }
  ?>">
              <input type="hidden" name="mylng" id="mylng" value="<?php  if($mylng=='')
{
echo  78.4800;
}
else
{

  echo $mylng; 
  } ?>">

              <input style="width:50%;float:left" type="number" id="input-select" name="minbud" class="form-control">
              <input style="width:50%;" class="form-control" type="number" min="1" max="50000" name="maxbud" step="1" id="input-number">
            </div>
            <div class="col-md-6">
              <div id="html5" class="noUi-target noUi-ltr noUi-horizontal noUi-background"></div>
              </div>
            </div>

            <div class="row mg-top20">
              <div class="col-md-2">
                <p>Date</p>
              </div>
              <div class="col-md-4" style="padding-left:0px">
<?php 
if(!empty($_REQUEST['daterange']))
{
  $dates = explode(',',$_REQUEST['daterange']);
  $sep = explode(':', $dates[0]);
  $sep1 = explode(':', $dates[1]);
  $final = date('m/d/Y',strtotime(substr($sep[1],1,strlen($sep[1])-2)));
  $final1 = date('m/d/Y',strtotime(substr($sep1[1],1,strlen($sep1[1])-3)));
} else {
  $final = date('m/d/Y');
  $final1 = date('m/d/Y');
}

 ?>
                <input  style="width:50%;float:left" type="text" id="datepicker" value="<?php 
echo $final; ?>" name="chin" class="form-control" placeholder="From">
                <input style="width:50%;" type="text" id="datepicker1" value="<?php 
echo $final1; ?>" name="chout" class="form-control" placeholder="To">
              </div>

              <div class="col-md-2">
                <p>Location</p>
              </div>
              <div class="col-md-4">
                <input type="text" value="<?php echo $place_loc; ?>" id="autocomplete" name="place_loc" onFocus="geolocate();" onchange="geolocate()" class="form-control" >
                <input type="hidden" name="my-lat" id="my-lat" value="">
                <input type="hidden" name="my-lng" id="my-lng" value="">
              </div>
            </div>

            <div class="row mg-top20">
              <div class="col-md-2">
                <p>Guests</p>
              </div>
              <div class="col-md-4" style="padding-left:0px">
                <input type="text" value="<?php echo $guests; ?> Guests" name="guests" class="form-control" />
              </div>

              <div class="col-md-2">
                <p>Events</p>
              </div>
              <div class="col-md-4">
 <!-- <input type="text" class="form-control bord" placeholder="Event"> -->
                          <select id="select1" class="form-control bord" multiple="multiple" name="events[]" >
                               <!--  <option value="" hidden>Select Uses</option> -->
                              <?php $query=mysqli_query($connect,'Select * from usedfor');
                                while($match=mysqli_fetch_array($query)){

                                  if(in_array($match['ufid'], $_REQUEST['events']))
                                {
                              ?>
                                <option selected value="<?php echo $match['ufid'];?>">
                                  <?php echo $match['ufname'];?>
                                </option>
                              <?php
                                  } else {
                              ?>
                                <option value="<?php echo $match['ufid'];?>"><?php echo $match['ufname'];?></option>
                              <?php
                                  }
                                }//while 
                              ?>
                          </select> 
              </div>
            </div>
<!-- <div class="row mg-top20">
<div class="col-md-2">
<p>Sort by</p>
</div>
<div class="col-md-10">
  <div class="btn-group" data-toggle="buttons">
      <label class="btn btn-success">
				<input type="checkbox" name="filters[]" value="Recommended">Recommended&nbsp;<i class="fa fa-angle-down"></i>
			</label>
			<label class="btn btn-success">
				<input type="checkbox" name="filters[]" value="Price">Price&nbsp;<i class="fa fa-angle-down"></i>
			</label>
			<label class="btn btn-success">
				<input type="checkbox" name="filters[]" value="Rating">Rating&nbsp;<i class="fa fa-angle-down"></i>
			</label>
			<label class="btn btn-success">
				<input type="checkbox" name="filters[]" value="Review">Review&nbsp;<i class="fa fa-angle-down"></i>
			</label>
			
      </div>
</div>
</div> -->
            <button class="btn-3 mg-top20 mg-bottom20" type="submit">Search</button>
          </form>
            <div class="row">
              <?php 
                $count = 0;
                $days1 = "";
                $st = date('Y-m-d',strtotime($final));
                $et = date('Y-m-d',strtotime($final1));
                $dtz = new DateTimeZone('America/Chicago');
                $st1    = new DateTime($st, $dtz);
                $et1    = new DateTime($et, $dtz);
                $in1 = new DateInterval('P1D'); // 1 day interval
                $per1   = new DatePeriod($st1, $in1, $et1);
                foreach ($per1 as $day) 
                {
            // Do stuff with each $day...
                  $days1 .= $day->format('Y-m-d').',';
                }    
                $days1 = $days1.$et;
                $chinout = explode(',',$days1);
                if(mysqli_num_rows($q21)>0){
                  while($r21 = mysqli_fetch_array($q21)) {
                    $canbe = explode(',', $r21['can_be_usedid']);
                    $images = explode(',',$r21['photo']);
                    $marker_addresses .= $r21['p_address'].">>>";
                    $marker_location .= $r21['p_city'].",".$r21['p_state'].",".$r21['p_country'].">>>";
//echo "block1";
              ?>
<?php error_log($chinvar) ?>
              <div class="col-md-6 col-sm-6 col-xs-12 pd-lr-4">
                <a href="demo-venue2.php?placeid=<?php echo $r21['place_id']; ?>&checkin=<?php if (isset($chinvar)) {echo $chinvar;} else { echo $st; } ?>&checkout=<?php if (isset($choutvar)) {echo $choutvar;} else { echo $et; } ?>">
                <div class="border-box">
                  <div id="myCarousel<?php echo $r21['place_id']; ?>" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
                    <div class="carousel-inner inner1" role="listbox">
                      <?php foreach($images as $photos) {
                        if($photos=="")
                        { continue;  
                        } 
                      ?>
                        <div class="item">
                          <img src="images/placephotos/<?php echo $photos; ?>">
                        </div>
                      <?php } ?>
                        </div>
                      <?php if(count($images)>1){?>
            <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel<?php echo $r21['place_id']; ?>" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel<?php echo $r21['place_id']; ?>" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      <?php }?>
                    </div>
                    <?php
/*if(empty($r21['p_p_h']) && empty($r21['p_p_n']) && empty($r21['w_p_p_n'])){
$que = mysqli_query($connect,"select * from calenderdata where placeid=".$r21['place_id']." group by placeid");
      if(mysqli_num_rows($que)>0){
      while($rw = mysqli_fetch_array($que))
      {
          $sppn=$rw['p_p_n'];
          $spph=$rw['p_p_h'];
          $sppw=$rw['w_p_p_n'];
      }//while que
      }//if que numrows
          }*///calenderdata table prices 
                    ?>
                    <?php $spacename=$r21['space_name'];?>
                    <h4 class="hotel-name">
                      <?php 
                        if(strlen($spacename)>10){echo substr($spacename,0,10)."..." ;}else{echo $spacename;} 
                      ?>
                    </h4>
<!--
          <div class="req-cus rat-star">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
          <i class="fa fa-star-o"></i>
          </div>
-->
                    <?php
                      $country = $r21['p_country'] ;
                                       //  echo $country;
                      switch ($country) {
                        case "United States":  $currency= "&#36;"; break; 
                        case "United Kingdom":  $currency= "&163;"; break; 
                        case "India": $currency= "&#8377;";
                      }
                    ?>      
        
                    <div class="req-cus"><i class="fa fa-map-marker icncolor"></i> 
                      <?php 
                        $paddress=$r21['p_address'];
                        if(strlen($paddress)>40){echo substr($paddress,0,30)."..." ;}else{echo $paddress;} 
                      ?>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 no-pad req-cus">
                      <?php 
                        if(!empty($r21['p_p_h']))
                        {
                          echo $currency;
                          echo '' .$r21['p_p_h'].' Per  Hour<br>';
                        }else{ echo "<br>";//'<i class="fa fa-inr icncolor"></i> ' .$spph.' Per  Hour<br>';
                        }
                        if(!empty($r21['p_p_n']))
                        {
                          echo $currency;
                          echo ''.$r21['p_p_n'].' Per Night<br>';
                        } else { 
                          echo "<br>";//'<i class="fa fa-inr icncolor"></i> ' .$sppn.' Per  Night<br>';
                        }
                        if(!empty($r21['w_p_p_n']))
                        {
                          echo $currency;
                          echo ''.$r21['w_p_p_n'].' Per Week';
                        } else { 
                          echo "<br>";//'<i class="fa fa-inr icncolor"></i> ' .$sppw.' Per  Week<br>';
                        }
                      ?> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 no-pad cap-txt req-cus">
                      <i class="fa fa-users icncolor"></i>  Capacity: <?php echo $r21['capacity']; ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </a>
              </div>
              <?php
                      }  //while end 
                    } else {
                      echo "<p><font color='red'>No Result Found</font></p>";
                    }
              ?>

              <input type="hidden" name="marker_addresses" id="marker_addresses" value="<?php echo rtrim($marker_addresses,">>>");?>" placeholder="">
              <input type="hidden" name="marker_location" id="marker_location" value="<?php echo rtrim($marker_location,">>>");?>" placeholder="">
            </div>

	          <?php include 'lib/footer.php';?>
            <script src="js/forms-map.js"></script>
            <script>
              initAutocomplete();
            </script>
          </div>
          <div class="clearfix"></div>
        </div>
      </div><!--main-center-data close-->
  </div><!--row close-->
	
<!--======footer close======-->

</div><!--container-fluid close-->
</body>
</script>
<?php 
   //if(!isset($_SESSION['u_id'])) {
?>
<script>
     //$("#myModal2").modal();
</script>
<?php   //}
?>

</html>

<?php /*} // if(isset - searching end)
else{echo "no input";}*/
?>
