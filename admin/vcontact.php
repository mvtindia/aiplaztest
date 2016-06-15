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
                                <p>Contact Details Updated Successfully.</p>
                            </div>';
               }             
                ?>
                <?php if($_GET["msg"]=='002')
                     {

                     echo '<div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Oh snap!</strong> wrong file extension of featured image.
                            </div>';
                              }             
                            ?>
                               <?php if($_GET["nomsg"]=='002')
                     {

                     echo '<div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Oh snap!</strong> wrong file extension of supplement featured image.
                            </div>';
                              }             
                            ?>
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            View Contact Info
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                     <?php     $id=$_GET["id"];
                                $query=mysqli_query($connection,'SELECT * FROM `contactinfo`');
                                $row=mysqli_fetch_array($query);?>
                        <div class="panel-body">
                            <form  id="" action="upproduct.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                                 <input type="hidden" name="sid" class="form-control" value="<?php echo $row["coid"]; ?>" required="required">
                               
                             <div class="form-group last">
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-5" class="iconic-input">
                                <textarea class="form-control ckeditor" readonly name="address" rows="4" placeholder="Address" required="required">
                                <?php echo $row["address"]; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group last">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="email" name="cemail" readonly placeholder="Email Address" class="form-control" value="<?php echo $row["email"]; ?>" required="required">
                                </div>
                            </div>

                            <div class="form-group last">
                                <label class="control-label col-md-3">Contact No. (1)</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="tel" name="c1" readonly placeholder="Contact No. (1)" class="form-control" value="<?php echo $row["contact1"]; ?>" required="required">
                                </div>
                            </div>
                             <div class="form-group last">
                                <label class="control-label col-md-3">Contact No. (2)</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="tel" name="c2" readonly class="form-control" placeholder="Contact No. (2)" value="<?php echo $row["contact2"]; ?>" required="required">
                                </div>
                            </div>

                            <div class="form-group last">
                                <label class="control-label col-md-3">Map(Iframe Source)</label>
                                <div class="col-md-5" class="iconic-input">
                                <textarea class="form-control ckeditor" readonly name="map" rows="6" placeholder="MAp Iframe Source" required="required"><?php echo $row["map"]; ?></textarea>
                                </div>
                            </div>

                                 <div></div>
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