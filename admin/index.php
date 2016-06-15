<?php session_start(); if(!isset($_SESSION['id'])) {
      header("Location: login.php"); 
  } elseif(isset($_SESSION["id"]))
  { include("mainheader.php");    
 
?>
<style type="text/css">
    .sst{
        color:white;
        text-decoration: none;
    }
    .sst:hover{
        color:gray;
        text-decoration: none;
    }
</style>
<body class="sticky-header">

<section>
<?php include("../connect.php");?>
   <?php include("sidebar.php");?>
    
    <!-- main content start-->
    <div class="main-content" >
 <?php include("header.php");?>


        <!--body wrapper start-->
        <div class="wrapper">
          <?php if($_GET["msg"]=='001')
           {
            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Welcome Admin</p>
                            </div>';
               }    ?>         
          
            <div class="row states-info">
            <div class="col-md-3">
                <div class="panel red-bg">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                              <i class="fa fa-home"></i>
                            </div>
                            <div class="col-xs-8">
                                <span class="state-title"><a class="sst" href="city.php">City </a></span>
                                <?php $query=mysqli_query($connect,"select count(cityid) as total from city ");
                                $row=mysqli_fetch_array($query);?>
                                <h4><?php echo $row["total"];?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel blue-bg">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-bars"></i>
                            </div>
                            <div class="col-xs-8">
                               <span class="state-title"><a class="sst" href="events.php">Events </a></span>
                                <?php $query=mysqli_query($connect,"select count(evid) as total from events ");
                                $row=mysqli_fetch_array($query);?>
                                <h4><?php echo $row["total"];?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel green-bg">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div class="col-xs-8">
                                <span class="state-title"><a class="sst" href="places.php"> List Places  </a></span>
                                <?php $query=mysqli_query($connect,"select count(place_id) as total from place");
                                $row=mysqli_fetch_array($query);?>
                                <h4><?php echo $row["total"];?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-md-3">
    <div class="panel green-bg">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4">
                    <i class="fa fa-users"></i>
                </div>
                <div class="col-xs-8">
                    <span class="state-title"> <a class="sst" href="users.php"> Users </a> </span> 
                     <?php $query=mysqli_query($connect,"select count(uid) as total from users");
                                $row=mysqli_fetch_array($query);?>
                                <h4><?php echo $row["total"];?></h4>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
<div class="row">
     <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="calendar-block ">
                                <div class="cal1">

                                </div>
                            </div>

                        </div>
                    </div>
     </div>

<!--      <div class="col-md-8">
                    <div class="panel deep-purple-box">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-7 col-sm-7 col-xs-7">
                                    <div id="graph-donut" class="revenue-graph"></div>

                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-5">
                                    <ul class="bar-legend">
                                        <li><span class="blue"></span> Clients</li>
                                        <li><span class="green"></span> Agents</li>
                                        <li><span class="purple"></span> Posted Jobs</li>
                                        <li><span class="red"></span> Ads</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

</div>
   
            </div>
        </div>
        <!--body wrapper end-->

     <?php include("footer.php");?>
     <?php

 }
else{//header("location:fb.php");}
echo '<script>window.location.href="login.php";</script>';}
  ?>