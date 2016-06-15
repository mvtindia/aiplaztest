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
           <?php      if(isset($_REQUEST['editsafety']))
                      {
                        $sid=$_POST["sid"];
                         $sname=$_REQUEST["sname"];

                          $query=mysqli_query($connect,'UPDATE `safety` SET `sname`="'.$sname.'" WHERE sid='.$sid);
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
                            Edit Safety
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                     <?php     $id=$_GET["id"];
                                $query=mysqli_query($connect,'SELECT * FROM `safety` where sid="'.$id.'"');
                                $row=mysqli_fetch_array($query);?>
                        <div class="panel-body">
                            <form  id="" method="post" class="form-horizontal" enctype="multipart/form-data">

                             
                                <div class="form-group last">
                                     <label class="control-label col-md-3">Name</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="sname" placeholder="Name" class="form-control" value="<?php echo $row['sname']; ?>" required="required">
                                     
                                    </div>
                                 </div>

                                     <input type="hidden" name="sid" class="form-control" value="<?php echo $row["sid"]; ?>" required="required">

                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                     <a href="safety.php" class="btn btn-warning" >Back</a>
                                         <button class="btn btn-info" type="submit" name="editsafety" >Update</button>
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