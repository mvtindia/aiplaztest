 <?php include("../connect.php"); include("mainheader.php"); ?>
<body class="sticky-header">
<section>
<?php  session_start(); 
if(isset($_SESSION["id"]))
{ ?>
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
                            View Enquiry Details
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                     <?php     
                     $id=$_GET["id"];
                                $query=mysqli_query($connect,'SELECT * FROM `enquiry`,services where eid="'.$id.'" and sid=serviceid');
                                $row=mysqli_fetch_array($query);?>
                        <div class="panel-body">
                            <form  id="" method="post" class="form-horizontal" enctype="multipart/form-data">

                             
                                <div class="form-group last">
                                     <label class="control-label col-md-3">Name</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['stitle']; ?></label>
                                     </div>
                                 </div>


                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Service Contact</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['scontact']; ?></label>
                                     </div>
                                 </div>

                                   <div class="form-group last">
                                     <label class="control-label col-md-3">Enquiry Name</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['ename']; ?></label>
                                     </div>
                                 </div>

                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Date</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['date1']; ?></label>
                                     </div>
                                 </div>

                                <div class="form-group last">
                                     <label class="control-label col-md-3">Enquiry Email</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['eemail']; ?></label>
                                     </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Enquiry Mobile</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['emobile']; ?></label>
                                     </div>
                                 </div>

                                 

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Enquiry Budget</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['ebudget']; ?></label>
                                     </div>
                                 </div>

                                 <div class="form-group last">
                                     <label class="control-label col-md-3">No of Guest</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['nguest']; ?></label>
                                     </div>
                                 </div>

                                   <div class="form-group last">
                                     <label class="control-label col-md-3">Enquiry Details</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php echo $row['edetails']; ?></label>
                                     </div>
                                 </div>


                                  <div class="form-group last">
                                     <label class="control-label col-md-3">Events</label>
                                     <div class="col-md-5" class="iconic-input">
                                     <label class="control-label col-md-3"><?php
                                     $eve = $row['eventsid'];
                                     $eve1 = explode(',',$eve);
                                     for($i=0;$i<count($eve1);$i++)
                                     {
                                       $sql2 = mysqli_query($connect,"SELECT * FROM events WHERE  evid='".$eve1[$i]."'");
                                       $row2 = mysqli_fetch_array($sql2);
                                     
                                      echo $row2['etitle']; 
                                      } ?></label>
                                     </div>
                                 </div>
                                </div>
                               
                  

                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                     <a href="enquiries.php" class="btn btn-warning" >Back</a>
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