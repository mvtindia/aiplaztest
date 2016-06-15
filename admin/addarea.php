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
                      if(isset($_REQUEST['addarea']))
          {
              $areatype=$_REQUEST["areatype"];

                          $query=mysqli_query($connect,'INSERT INTO `area`(`areatype`) VALUES ("'.$areatype.'")');
                          if($query>0){
                         
                            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Record Added Successfully.</p>
                            </div>';
                        }
                          else{
                             echo '<div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong> Unable to Add Record.
                            </div>';
                          }
                     
          }//if query
          ?>
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Add Area Type
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                      
                        <div class="panel-body">
                            <form  method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group last">
                                     <label class="control-label col-md-3">Area Type</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="areatype" placeholder="Area Type" class="form-control" value="" required="required">
                                     
                                    </div>
                                 </div>

       <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="addarea">Add Area</button>
                                         <a class="btn btn-warning" type="button" href="area.php">Back</a>
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