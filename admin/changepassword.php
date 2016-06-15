<?php include("mainheader.php"); include("../connect.php");?>
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
          <div class="result" style='display:none;'>
            
          </div>
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Change Password
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                        <div class="panel-body">
                      <?php    $sql="select * from admin where admin_id='1'";
                  $result=mysqli_query($connect,$sql);
                $row=mysqli_fetch_array($result);
                  ?> 
                            <form method="post" class="form-horizontal"  id="events_form" enctype="multipart/form-data">
                            <div class="form-group last">
                                <label class="control-label col-md-3">Old Password</label>
                                <div class="col-md-5" class="iconic-input">
                                <input type="hidden" id="pswrd" value="1">
                                    <input type="password" name="oldpass" id="oldpass" class="form-control" value="" >
                                </div>
                            </div>
                             
                            <div class="form-group last">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="password" name="pass" id="pass" class="form-control" value="">
                                </div>
                            </div>
                                 <div class="form-group last">
                                <label class="control-label col-md-3">Confirm Password</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="password" name="cpass" id="cpass" class="form-control"  value="">
                                    <div class="cpasserr" style='display:none;'>Passwords do not match.</div>
                                </div>
                            </div>
                              
                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" id="passsubmit" name="submit">Change </button>
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