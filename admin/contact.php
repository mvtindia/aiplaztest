 <?php include("mainheader.php");include("../connect.php");?>
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
           <?php 
            if(isset($_REQUEST['upcdata']))
              {
                 $address=$_REQUEST["address"];
                 $cemail=$_REQUEST["email"];
                 $c1=$_REQUEST["contact"];
                 $map=$_REQUEST["map"];

                 $query = mysqli_query($connection,"UPDATE `contactinfo` SET `address`='".$address."',`contact1`='".$c1."',`email`='".$cemail."',`map`='".$map."'");
                 if($query)
                 {
                  echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Contact Details Updated Successfully.</p>
                            </div>';
                 }
                 else
                  {

                     echo '<div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Oh snap!</strong> wrong file extension.
                            </div>';
                              } 
              }//isset

                                 
                            ?>
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Edit Contact Details
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                     <?php
                                $query=mysqli_query($connection,"Select * from contactinfo LIMIT 1");
                                $row=mysqli_fetch_array($query);
                                 ?>
                        <div class="panel-body">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            
                             <input type="hidden" name="sid" value="<?php echo $row["sid"];?>">
                             
                                  <div class="form-group last">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="email" class="form-control" value="<?php echo $row["email"];?>">
                                </div>
                            </div>

                            <div class="form-group last">
                                <label class="control-label col-md-3">Contact No.</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="contact" class="form-control" value="<?php echo $row["contact1"];?>">
                                </div>
                            </div>

                            <div class="form-group last">
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="address" class="form-control" value="<?php echo $row["address"];?>">
                                </div>
                            </div>

                              <div class="form-group last">
                                <label class="control-label col-md-3">Map</label>
                                <div class="col-md-5" class="iconic-input">
                                    <textarea name="map" rows="5" class="form-control"><?php echo $row["map"];?></textarea>
                                </div>
                            </div> 


                             <div class="form-group last">
                                <div class="col-md-5" class="iconic-input">
                                    <button class="btn btn-success btn-xs" name="upcdata" type="submit">Update Details</button>
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