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
          <?php if(isset($_REQUEST["calsave"]))
           {
            $data=htmlentities($_REQUEST['data']);
            $query=mysqli_query($connection,"INSERT INTO `admin_calendar`( `cal_data`, `regid`) VALUES('".$_REQUEST['data']."','".$_SESSION['id']."')");
            if($query>0){
            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Data is added succesfully.</p>
                            </div>';
                            echo '<script>window.location.href="cal.php";</script>';
                        }else{
                            echo '<div class="alert alert-danger alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Error!
                                </h4>
                                <p> Unable to add the data.</p>
                            </div>';
                        }
               } 



               if(isset($_REQUEST["updatecal"]))
           {
            $data=htmlentities($_REQUEST['data1']);
            $query=mysqli_query($connection,"UPDATE `admin_calendar` SET `cal_data`='".$_REQUEST['data1']."' where `regid`='".$_SESSION['id']."'");
            if($query>0){
            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Data is updated succesfully.</p>
                            </div>';
                            echo '<script>window.location.href="cal.php";</script>';
                        }else{
                            echo '<div class="alert alert-danger alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Error!
                                </h4>
                                <p> Unable to update the data.</p>
                            </div>';
                        }
               }     ?>    
                <form action="cal.php" method="post">
                                                 
 <?php 
 $query=mysqli_query($connection,"select * from admin_calendar where regid='".$_SESSION['id']."'");
                               
                                //$count=mysqli_num_rows($query);
                                if( $row=mysqli_fetch_array($query))
                                {?>
                            <div class="row">
                                 <div class="col-md-8">
                                 <?php echo html_entity_decode($row['cal_data']);?>
                                 </div>
                                  <span class="btn btn-info" name="edit" id="edit"  style="float:right;">Edit</span>
                                 <div class="col-md-4 rd"  style="display:none;float:right;">
                                
                                 <button type="submit" class="btn btn-info" name="updatecal" id="updatecal">Save</button>
                                 <span class="btn btn-info" name="close" id="close">Close</span>
                                  <textarea placeholder="Edit your code here" class="form-control" name="data1" id="data1" rows="7" ><?php echo $row['cal_data'];?></textarea>
                                 </div>
                                 
                             </div>


                            <?php    }else{

                                ?>  
                               
                                            
                                         
<div class="row">

     <div class="col-md-12">
                  <img class="img-responsive" height="500px" src="../images/calendar-steps.jpg">
                </div>
               
                <div class="col-md-12">
               
                <div class="col-md-12" style="margin-top: 25px;">
                    <textarea placeholder="Place your code here" class="form-control" name="data" required></textarea>
                </div>
                <div class="col-md-12" style="margin-top: 25px;">
                    <button class="btn-btn-info" type="submit" name="calsave">Save</button>
                </div>
     
                </div>

</div>
      
   <?php     
                                }//else

?>
 </form>
            </div>
        </div>
        <!--body wrapper end-->

     <?php include("footer.php");?>
     <?php

 }
else{//header("location:fb.php");}
echo '<script>window.location.href="login.php";</script>';}
  ?>