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
                      if(isset($_REQUEST['addfees']))
          {
              $percentage=$_POST['percentage'];             
              $description=$_POST['description'];

                          
          $query=mysqli_query($connect,'INSERT INTO `fees` (`feefor`, `percentage`, `description`) VALUES ("'.$_POST['feefor'].'","'.$percentage.'", "'.$description.'")');
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
                           Add Fees
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                      
                        <div class="panel-body">
                            <form  method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group last">
                                     <label class="control-label col-md-3">Buy/Sell</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <!--<input type="text" name="title" placeholder="Title" class="form-control" value="" required="required">-->
                                    <div class="col-md-4 col-sm-4 col-xs-4">
			                            <input type="radio" value="s" checked id="hour_label" class="per_val" name="feefor">
			                            <label for="hour_label" style="cursor: pointer;">Sell</label>
		                            </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
			                            <input type="radio" value="b" id="hour_label" class="per_val" name="feefor">
			                            <label for="hour_label" style="cursor: pointer;">Buy</label>
		                            </div>
                                    </div>
                                 </div>
                                <div class="form-group last">
                                    <label class="control-label col-md-3">Title</label>
                                    <div class="col-md-5" class="iconic-input">
                                        <input type="text" name="description" placeholder="Title" class="form-control"  required="required">
                                    </div>
                                 </div>
                                

                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Percentage</label>
                                     <div class="col-md-5" class="iconic-input">
                                   <input type="number" name="percentage" placeholder="Percentage" class="form-control" value="" required="required">
                                     
                                    </div>
                                 </div>
                                <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="addfees">Add Fees</button>
                                         <a class="btn btn-warning" type="button" href="fees.php">Back</a>
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