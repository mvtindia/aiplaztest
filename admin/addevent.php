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
                      if(isset($_REQUEST['addusedfor']))
          {
              $ufname=$_REQUEST["ufname"];
               $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                      //image
                        $filename=$_FILES['file']['name'];
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../images/events/".$filename;
                      
                      //icon
                        $filename1=$_FILES['file1']['name'];
                        $filetmp1=$_FILES['file1']['tmp_name']; 
                        $filepath1="../img/".$filename1;


                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                      if(!empty($filename)&& empty($filename1)){
                      if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connect,'INSERT INTO `usedfor`(`ufname`,`ufimage`) VALUES ("'.$ufname.'","'.$filename.'")');
                        }//if in array
                           
                        }//if image and no icon
                        else if(!empty($filename)&& !empty($filename1)){
                          
                          $query=mysqli_query($connect,'INSERT INTO `usedfor`(`ufname`,`uficon`,`ufimage`) VALUES ("'.$ufname.'","'.$filename1.'","'.$filename.'")');
                         
                        }//if in array

                                            if($query>0){
                             move_uploaded_file($filetmp,$filepath);
                             if(!empty($filename1)){
                             move_uploaded_file($filetmp1,$filepath1);

                             }
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
                           Add Event
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                      
                        <div class="panel-body">
                            <form  method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group last">
                                     <label class="control-label col-md-3">Title</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="ufname" placeholder="Title" class="form-control" value="" required="required">
                                     
                                    </div>
                                 </div>

                                   <div class="form-group last">
                                    <label class="control-label col-md-3">Add Image</label>
                                    <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="images/no_img.jpg" alt="" style="height: 141px;"/>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                   <input type="file" class="default" name="file" required />
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
                                    <label class="control-label col-md-3">Add Icon</label>
                                    <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;">
                                                <img src="images/no_img.jpg" alt="" style="height: 50px;"/>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 50px; max-height: 50px; line-height: 20px;"></div>
                                            <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select icon</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                   <input type="file" class="default" name="file1"  />
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
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="addusedfor">Add Event</button>
                                         <a class="btn btn-warning" type="button" href="event.php">Back</a>
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