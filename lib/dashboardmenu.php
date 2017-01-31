<?php
session_start();
include_once('connect.php');
?>
<div class="deshboard-menu-bg">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
 <nav class="navbar navbar-inverse cus-nav">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar1">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
  
    </div>

    <div class="collapse navbar-collapse" id="myNavbar1">
      <ul class="nav navbar-nav">
		<li id="one" class="same-class active"><a id="a1" class="b1">My Places</a></li>
		<li id="two" class="same-class"><a id="a2" class="b2">My Booking</a></li>
    <li id="two" class="same-class"><a id="a11" class="b10">User Booking</a></li>

    <li id="two" class="same-class"><a id="e2" class="b9">My Enquiries</a></li>
      <li id="two" class="same-class"><a id="a8" class="b7">My Services</a></li>
		<li id="three" class="same-class"><a id="a3" class="b3">My Reviews</a></li>
		<!-- <li id="four" class="same-class"><a id="a4">My Rating</a></li> -->
		<!-- <li id="five" class="same-class"><a id="a5">My Favourites</a></li> -->
    <?php $q = mysqli_query($connect,"select count(`nid`) as total from notes where userid=".$_SESSION['u_id']." and nstatus='N'");
    $r = mysqli_fetch_array($q);

     ?>

    <li id="two" class="same-class"><a id="a10" class="b8">Notifications <?php if($r['total'] != 0) { ?><span class="badge notes_count"> <?php echo $r['total']; ?></span><?php } ?></a></li>
    <?php $q = mysqli_query($connect,"select count(`mid`) as total from messages where mto=".$_SESSION['u_id']." and mstatus='N'");
    $r = mysqli_fetch_array($q);

     ?>
      <li id="two" class="same-class"><a id="a9" class="b5">Inbox <?php if($r['total'] != 0) { ?><span class="badge inbox_count"> <?php echo $r['total']; ?></span><?php } ?></a></li>
        
		<li id="six" class="same-class"><a id="a6" class="b6">Edit Profile</a></li>

      </ul>
      
    </div>
 
</nav>

</div>

</div><!--row close-->
</div><!--container close-->

</div>