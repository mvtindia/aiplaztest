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
           <?php      if(isset($_REQUEST['editevents']))
                      {
                        $sid=$_POST["sid"];
                         $title=htmlentities($_REQUEST["title"]);
                         $details=htmlentities($_REQUEST["details"]);

                        $sdate = trim($_REQUEST['sdate']);
                        $edate = trim($_REQUEST['edate']);

                          $ex = explode('-',$sdate);
                          $sdate = $ex[2].'-'.$ex[1].'-'.$ex[0];

                           $ex1 = explode('-',$edate);

                           $edate = $ex1[2].'-'.$ex1[1].'-'.$ex1[0];


                        $filename=$_FILES['file']['name'];
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../images/events/".$filename;
                       $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                      if(!empty($filename))
                      {
                      if (in_array($ext, $supported_image))
                         {
                         
                          $query=mysqli_query($connect,'UPDATE `events` SET `etitle`="'.$title.'",`edesc`="'.$details.'",`epic`="'.$filename.'",`estart`="'.$sdate.'",`eend`="'.$edate.'" WHERE evid='.$sid);
                         if($query>0){
                         $mv=move_uploaded_file($filetmp,$filepath);
                          
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
                                <strong>Oh snap!</strong> wrong file extension of image.
                            </div>';
                              } 
                       }
                     }
                     else
                     {
                      $query=mysqli_query($connect,'UPDATE `events` SET `etitle`="'.$title.'",`edesc`="'.$details.'",`estart`="'.$sdate.'",`eend`="'.$edate.'" WHERE evid='.$sid);
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
                      }//if isset          
                            ?>
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit Events
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                     <?php     $id=$_GET["id"];
                                $query=mysqli_query($connect,'SELECT * FROM `events` where evid="'.$id.'"');
                                $row=mysqli_fetch_array($query);?>
                        <div class="panel-body">
                            <form  id="" method="post" class="form-horizontal" enctype="multipart/form-data">

                              <div class="form-group last">
                                    <label class="control-label col-md-3">Upload Image</label>
                                    <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?php echo "../images/events/".$row["epic"]; ?>" alt="" style="height: 141px;"/>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                   <input type="file" class="default" name="file" />
                                                   </span>
                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                            </div>
                                        </div>
                                        <br/>
                                        <span class="label label-danger ">NOTE!</span>
                                             <span>
                                             Attached image should be jpg,jpeg,gif,png
                                             </span>
                                    </div>
                                </div>

                                <div class="form-group last">
                                     <label class="control-label col-md-3">Title</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="title" placeholder="Title" class="form-control" value="<?php echo $row['etitle']; ?>" required="required">
                                     
                                    </div>
                                 </div>


                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Start Date</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="sdate" style=" background: #eee !important; border: #ccc solid 1px !important;" placeholder="Start Date" class="form-control datepicker" value="<?php $start = explode('-',$row['estart']); echo $start[2].'-'.$start[1].'-'.$start[0]; ?>" required="required">
                                     
                                    </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">End Date</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="edate" style=" background: #eee !important; border: #ccc solid 1px !important;" placeholder="End Date (optional)" class="form-control datepicker" value="<?php if($row['eend'] != '0000-00-00') { $end = explode('-',$row['eend']); echo $end[2].'-'.$end[1].'-'.$end[0]; } ?> ">
                                     
                                    </div>
                                 </div>



                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Details</label>
                                     <div class="col-md-5" class="iconic-input">
                                   
                                     <textarea name="details" class="form-control ckeditor" placeholder="Event Details" required><?php echo $row['edesc']; ?></textarea>
                                    </div>
                                    <input type="hidden" name="sid" class="form-control" value="<?php echo $row["evid"]; ?>" required="required">
                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                     <a href="events.php" class="btn btn-warning" >Back</a>
                                         <button class="btn btn-info" type="submit" name="editevents" >Update</button>
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