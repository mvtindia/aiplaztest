 <?php include("../connect.php"); include("mainheader.php");?>
<body class="sticky-header">
<section>
<?php  session_start(); if(isset($_SESSION["id"]))
{?>
   <?php include("sidebar.php");?>
     <!-- main content start-->
    <div class="main-content" >
 <?php include("header.php");?>
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div id="message"></div>
        
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            View Service Details
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                     <?php     $id=$_GET["id"];
                                $query=mysqli_query($connect,'SELECT * FROM `services`,usedfor,users where sid="'.$id.'" and seventid=ufid and uid=rid');
                                $row=mysqli_fetch_array($query);?>
                        <div class="panel-body">
                            <form  id="" method="post" class="form-horizontal" enctype="multipart/form-data">

                             
                                <div class="form-group last">
                                     <label class="control-label col-md-3">Title</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['stitle']; ?></label>
                                     </div>
                                 </div>

                                <div class="form-group last">
                                     <label class="control-label col-md-3">Event</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['ufname']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Contact</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['scontact']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Description</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['sdesc']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Country</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['country']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">IPAddress</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['ip']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Location</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['location']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">City</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['city']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Postcode</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['postcode']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">State</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['state']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Currency</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['currencyid']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Price Per Night</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['ppn']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Price Per Hour</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['pph']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Price Per Week</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['ppw']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Date</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['scurdate']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Name</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['fname']." ".$row['lname']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Photo</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php 
                                     if(!empty($row['photo']))
                                      {
                                        $photo=explode(",", $row['photo']);
                                      }
                                      for ($i=0; $i < count($photo) ; $i++) { 
                                        echo '<img src="../images/services/'.$photo[$i].'" height="100" width="100">';
                                         } ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Video</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <?php if(!empty($row['video'])){?>
                                     <video width="320" height="240" controls>
                                        <source src="../video/<?php echo $row['video']; ?>" type="<?php echo $row['video_type']; ?>">
                                        Your browser does not support the video tag.
                                      </video>
                                      <?php }?>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Special Pricing For Particular Dates</label>

                                   <div class="col-md-5">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="dir-info">
                            <?php   $query1=mysqli_query($connect,'SELECT * FROM `services` s,`servicedata` sd where s.sid="'.$id.'" and s.sid=sd.sid');
                                while($row1=mysqli_fetch_array($query1)){  ?>
                                <div class="row">
                                    <div class="col-xs-5" class="iconic-input">
                                        <div class="avatar">
                                        <?php echo $row1['label'];?>
                                            <!-- <img src="images/photos/user2.png" alt=""/> -->
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <h5>PPH:<?php echo $row['currencyid']." ".$row1['pph'];?></h5>
                                        <h5>PPN:<?php echo $row['currencyid']." ".$row1['ppn'];?></h5>
                                        <h5>PPW:<?php echo $row['currencyid']." ".$row1['ppw'];?></h5>
                                        <span>
                                            <a href="#" class="small"> <?php echo $row1['date1']." - ".$row1['date2'];?></a>
                                        </span>
                                    </div>
                                    <div class="col-xs-5">
                                        <a class="dir-like" href="#">
                                            <span class="small"><?php echo $row1['status'];?></span>
                                            <i class="fa fa-heart"><?php echo " On ".$row1['scurdate'];?></i>
                                        </a>
                                    </div>
                                </div>
                                <?php }//while ?>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                     <a href="services.php" class="btn btn-warning" >Back</a>
                                    </div>
                                 </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end-->
     <?php include("footer.php");?>
       <?php
}else{//header("location:login.php");
echo '<script>window.location.href="login.php";</script>';}
  ?>