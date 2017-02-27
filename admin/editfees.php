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
           <?php      if(isset($_REQUEST['editfees']))
                      {
                        $feeid=$_POST["feeid"];
                        $feefor=$_POST['feefor'];
                         $description=$_POST["title"];
                         $percentage=trim($_POST["percentage"], '%');
                         
                          $query=mysqli_query($connect,'UPDATE `fees` SET `feefor` = "'.$feefor.'", `percentage`="'.$percentage.'", `description` = "'.$description.'" WHERE feeid="'.$feeid.'"');
                         if($query>0){                          
                           echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Record updated Successfully.</p>
                            </div>';
                          }
                       else
                       {
                           echo '<div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Oh snap!</strong> Unable to update the record.
                            </div>';
                       } 
                     
                     
                      }//if isset          
                            ?>
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit Fees
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                     <?php     $id=$_GET["id"];
                                $query=mysqli_query($connect,'SELECT * FROM `fees` where feeid="'.$id.'"');
                                $row=mysqli_fetch_array($query);?>
                        <div class="panel-body">
                            <form  id="" method="post" class="form-horizontal" enctype="multipart/form-data">

                                <div class="form-group last">
                                     <label class="control-label col-md-3">Title</label>
                                     <div class="col-md-5" class="iconic-input">
                                        <input type="text" name="title" placeholder="Title" class="form-control" value="<?php echo $row['description']; ?>" required="required">                        
                                    </div>
                                </div>
                                <div class="form-group last" style="margin: 150px, 0;">
                                    <label class="control-label col-md-3">Buy/Sell</label>
                                    <div class="col-md-5" class="iconic-input">
                                    <input type="radio" value="s" <?php if ($row['feefor'] == 's') { echo 'checked';} ?> id="hour_label" class="per_val" name="feefor">
                                    <label for="hour_label" style="cursor: pointer;">Sell</label>
                                    <input type="radio" value="b" <?php if ($row['feefor'] == 'b') { echo 'checked';} ?> id="hour_label" class="per_val" name="feefor">
                                    <label for="hour_label" style="cursor: pointer;">Buy</label>
                                    </div>
                                </div>
                                <div class="form-group last">
                                     <label class="control-label col-md-3">Percentage</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <input type="text" name="percentage" placeholder="Charges" class="form-control" value="<?php echo $row['percentage']; ?>%" required="required">
                                    </div>
                                </div>

                                <input type="hidden" name="feeid" class="form-control" value="<?php echo $row["feeid"]; ?>" required="required">

                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                     <a href="fees.php" class="btn btn-warning" >Back</a>
                                         <button class="btn btn-info" type="submit" name="editfees" >Update</button>
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