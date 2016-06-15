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
                            View Place Details
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                     <?php     $id=$_GET["id"];
                                $query=mysqli_query($connect,'SELECT * FROM `place`,users where place_id="'.$id.'" and uid=user_id');
                                $row=mysqli_fetch_array($query);?>
                        <div class="panel-body">
                            <form  id="" method="post" class="form-horizontal" enctype="multipart/form-data">

                             
                                <div class="form-group last">
                                     <label class="control-label col-md-3">Name</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['p_name']; ?></label>
                                     </div>
                                 </div>


                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Contact</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['p_contact']; ?></label>
                                     </div>
                                 </div>

                                   <div class="form-group last">
                                     <label class="control-label col-md-3">Postcode</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['postal_code']; ?></label>
                                     </div>
                                 </div>

                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Location</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['p_location']; ?></label>
                                     </div>
                                 </div>

                                <div class="form-group last">
                                     <label class="control-label col-md-3">Address</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['p_address']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Country</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['p_country']; ?></label>
                                     </div>
                                 </div>

                                 

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">City</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['p_city']; ?></label>
                                     </div>
                                 </div>

                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Code</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['p_code']; ?></label>
                                     </div>
                                 </div>

                                   <div class="form-group last">
                                     <label class="control-label col-md-3">State</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['p_state']; ?></label>
                                     </div>
                                 </div>


                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Place Name</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['space_name']; ?></label>
                                     </div>
                                 </div>
                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Capacity</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['capacity']; ?></label>
                                     </div>
                                 </div>

                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Property Type</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3">  
                                     <?php $query1=mysqli_query($connect,'SELECT * FROM `property`');
              while($row1=mysqli_fetch_array($query1)){
              if($row1['pid']==$row['property_typeid']){echo $row1['ptype']."<br>";}}?></label>
                                     </div>
                                 </div>


                                <div class="form-group last">
                                     <label class="control-label col-md-3">Event</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php 
                                        if(!empty($row['can_be_usedid']))
                                        {
                                           $ufid=explode(",", $row['can_be_usedid']);
                                           for ($i=0; $i < count($ufid) ; $i++) 
                                           { 
                                             $query2=mysqli_query($connect,'SELECT * FROM `usedfor` where ufid="'.$ufid[$i].'" ');
                                             $row2=mysqli_fetch_array($query2);
                                             echo $row2['ufname']."<br>";
                                           }
                                         }
                                        
                                         ?></label>
                                     </div>
                                 </div>

                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Accomodates</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['accomodates']; ?></label>
                                     </div>
                                 </div>
                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Area</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['place_area']; ?></label>
                                     </div>
                                 </div>
                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Common Ammenities</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-5">
                                          <?php 
                                          $aid=explode(",",$row['ammenties_id']);
                                          for ($i=0; $i < count($aid) ; $i++) { 
                                          $query1=mysqli_query($connect,'SELECT * FROM `ammenities` where atype="common" and aid="'.$aid[$i].'"');
                                      if($row1=mysqli_fetch_array($query1)){
                                      echo $row1['aname']."<br>";
                                  }
                                      }//for?>
                                                             </label>
                                     </div>
                                 </div>
                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Additional Ammenities</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-5">
                                   <?php 
                                          $aid=explode(",",$row['add_ammenties']);
                                          for ($i=0; $i < count($aid) ; $i++) { 
                                          $query1=mysqli_query($connect,'SELECT * FROM `ammenities` where atype="additional" and aid="'.$aid[$i].'"');
                                      if($row1=mysqli_fetch_array($query1)){
                                      echo $row1['aname']."<br>";
                                  }
                                      }//for?>                                                                
                                     </label>
                                     </div>
                                 </div>
                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Details</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-5"><?php echo $row['details']; ?></label>
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
                                        echo '<img src="../images/placephotos/'.$photo[$i].'" height="100" width="100">';
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
                                     <label class="control-label col-md-3">Rules Do</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-5">
                                          <?php 
                                          $rules=explode(",",$row['rules_doid']);
                                          for ($i=0; $i < count($rules) ; $i++) { 
                                          $query1=mysqli_query($connect,'SELECT * FROM `rules` where rtype="do" and rid="'.$rules[$i].'"');
                                      if($row1=mysqli_fetch_array($query1)){
                                      echo $row1['rname']."<br>";
                                  }
                                      }//for?>   
                                     </label>
                                     </div>
                                 </div>


                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Rules Dont</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-5">
                                          <?php 
                                          $rules=explode(",",$row['rules_doid']);
                                          for ($i=0; $i < count($rules) ; $i++) { 
                                          $query1=mysqli_query($connect,'SELECT * FROM `rules` where rtype="dont" and rid="'.$rules[$i].'"');
                                      if($row1=mysqli_fetch_array($query1)){
                                      echo $row1['rname']."<br>";
                                  }
                                      }//for?>   
                                     </label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Currency</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['currency']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Price Per Night</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['p_p_n']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Price Per Hour</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['p_p_h']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Price Per Week</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['w_p_p_n']; ?></label>
                                     </div>
                                 </div>

                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Safety</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-5">
                                          <?php 
                                          $safety=explode(",",$row['saftyid']);
                                          for ($i=0; $i < count($safety) ; $i++) { 
                                          $query1=mysqli_query($connect,'SELECT * FROM `safety` where sid="'.$safety[$i].'"');
                                      if($row1=mysqli_fetch_array($query1)){
                                      echo $row1['sname']."<br>";
                                  }
                                      }//for?> 
                                     </label>
                                     </div>
                                 </div>
                               
                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Fire Extinguisher</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['fire_extinguisher']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Fire Alarm</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['fire_alarm']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Gas Valve</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['gas_valve']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Exit Extinguisher</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['exit_extinguisher']; ?></label>
                                     </div>
                                 </div>
                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Date</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['timestampdate']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Special Pricing For Particular Dates</label>

                                   <div class="col-md-5">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="dir-info">
                            <?php   $query1=mysqli_query($connect,'SELECT * FROM `place` p,`calenderdata` cd where p.place_id="'.$id.'" and p.place_id=cd.placeid');
                                while($row1=mysqli_fetch_array($query1)){  ?>
                                <div class="row">
                                    <div class="col-xs-5" class="iconic-input">
                                        <div class="avatar">
                                        <?php echo $row1['label'];?>
                                            <!-- <img src="images/photos/user2.png" alt=""/> -->
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <h5>PPH:<?php echo $row['currency']." ".$row1['p_p_h'];?></h5>
                                        <h5>PPN:<?php echo $row['currency']." ".$row1['p_p_n'];?></h5>
                                        <h5>PPW:<?php echo $row['currency']." ".$row1['w_p_p_n'];?></h5>
                                        <span>
                                            From <a href="#" class="small"> <?php echo $row1['date1']." - ".$row1['date2'];?></a><br>
                                             Timings: <a href="#" class="small"> <?php echo $row1['time1']." - ".$row1['time2'];?></a>
                                        </span>
                                    </div>
                                    <div class="col-xs-5">
                                        <a class="dir-like" href="#">
                                            <span class="small"><?php echo $row1['status']." ".$row1['repetition'];?></span>
                                            <i class="fa fa-heart"><?php echo " On ".$row1['timestampdate'];?></i>
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
                                     <a href="places.php" class="btn btn-warning" >Back</a>
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