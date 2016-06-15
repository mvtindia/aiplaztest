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
                           View Customer Details
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                     <?php     $regid=$_GET["regid"];
                                $query=mysqli_query($connection,'SELECT * FROM `register` where rid="'.$regid.'"');
                                $row=mysqli_fetch_array($query);?>
                        <div class="panel-body">
                            <form  id="addtypeform1" method="post" class="form-horizontal">

                                 <input type="hidden" name="sid" class="form-control" value="<?php echo $row["prid"]; ?>" required="required">
                               <div class="form-group last">
                                <label class="control-label col-md-3">First Name</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="fname" class="form-control" value="<?php echo $row["fname"]; ?>" required="required" readonly>
                                </div>
                            </div>
                            
							 <div class="form-group last">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="email" class="form-control" value="<?php echo $row["email"]; ?>" readonly>
                                </div>
                            </div>
                
							 <div class="form-group last">
                                <label class="control-label col-md-3">Phone</label>
                                <div class="col-md-5" class="iconic-input">
                                <input type="text" name="phone" class="form-control" value="<?php echo $row["phone"]; ?>" readonly>
                                </div>
                            </div>
                        <?php if($row['aptno'] != "") { ?>
                            <div class="form-group last">
                                <label class="control-label col-md-3">Apartment/Flat No.</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="price" class="form-control" value="<?php echo $row["aptno"]; ?>" readonly >
                                </div>
                            </div>
                            <?php } ?>

                              <div class="form-group last">
                                <label class="control-label col-md-3">Street</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="price" class="form-control" value="<?php echo $row["street"]; ?>" readonly >
                                </div>
                            </div>
                             <div class="form-group last">
                                <label class="control-label col-md-3">City/State/Country</label>
                                <div class="col-md-5" class="iconic-input">
         <input type="text" name="rec" class="form-control" value="<?php echo $row["city"]."/".$row["state"]."/".$row["country"]; ?>" readonly >
                                </div>
                            </div>

                             <div class="form-group last">
                                <label class="control-label col-md-3"> Zip Code</label>
                                <div class="col-md-5" class="iconic-input">
             <input type="text" name="price" class="form-control" value="<?php echo $row["lname"]; ?>" readonly >
                                </div>
                            </div>

                            <div class="form-group last">
                                <label class="control-label col-md-3">Account Number</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="type" class="form-control" value="<?php echo $row["accno"]; ?>" readonly>
                                </div>
                            </div>
                           
                              <div class="form-group last">
                                <label class="control-label col-md-3">Timestamp</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="type" class="form-control" value="<?php echo $row["times"]; ?>" readonly>
                                </div>
                            </div>
                             <div class="form-group last">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="vendor" class="form-control" value="<?php echo $row['active']; ?>" readonly>
                                </div>
                            </div>
<?php if($row['ratings'] != "")
{
    ?>
                             <div class="form-group last">
                                <label class="control-label col-md-3">Ratings</label>
                                <div class="col-md-5" class="iconic-input" style=" padding-top: .7%;">
                                   <?php   
                                   for($j = 0;$j<$row['ratings'];$j++)
                    {
                        echo '<i class="fa fa-star" style="color:green"></i>';
                    } ?>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group last">
                                <div class="col-md-5" class="iconic-input">
                                    <a href="viewsingleuserbills.php?regid1=<?php echo $row["rid"]; ?>" style="width: 25%;height:45px;font-size: 16px;padding-top: 2%;"  class="btn btn-success btn-xs pull-right" type="button">View Bills</a>
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