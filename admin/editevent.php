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
           <?php      if(isset($_REQUEST['editoccassion']))
                      {
                        $ufid=$_POST["ufid"];
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
                          $query=mysqli_query($connect,'UPDATE `usedfor` SET `ufname`="'.$ufname.'",`ufimage`="'.$filename.'" WHERE ufid='.$ufid);
                        
                      }
                  }
                   else if(!empty($filename)&& !empty($filename1)){
                       $query=mysqli_query($connect,'UPDATE `usedfor` SET `ufname`="'.$ufname.'",`ufimage`="'.$filename.'",`uficon`="'.$filename1.'" WHERE ufid='.$ufid);

                   }
                    else if(empty($filename)&& empty($filename1)){
                       $query=mysqli_query($connect,'UPDATE `usedfor` SET `ufname`="'.$ufname.'" WHERE ufid='.$ufid);

                   }
                    else if(empty($filename)&& !empty($filename1)){
                       $query=mysqli_query($connect,'UPDATE `usedfor` SET `ufname`="'.$ufname.'",`uficon`="'.$filename1.'" WHERE ufid='.$ufid);

                   }
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
                            Edit Event
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                     <?php     $id=$_GET["id"];
                                $query=mysqli_query($connect,'SELECT * FROM `usedfor` where ufid="'.$id.'"');
                                $row=mysqli_fetch_array($query);?>
                        <div class="panel-body">
                            <form  id="" method="post" class="form-horizontal" enctype="multipart/form-data">

                             
                                <div class="form-group last">
                                     <label class="control-label col-md-3">Name</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="ufname" placeholder="Name" class="form-control" value="<?php echo $row['ufname']; ?>" required="required">
                                     
                                    </div>
                                 </div>

                                     <input type="hidden" name="ufid" class="form-control" value="<?php echo $row["ufid"]; ?>" required="required">

                              <div class="form-group last">
                                    <label class="control-label col-md-3">Upload Image</label>
                                    <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?php echo "../images/events/".$row["ufimage"]; ?>" alt="" style="height: 141px;"/>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                   <input type="file" class="default" name="file"/>
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
                                    <label class="control-label col-md-3">Upload Icon</label>
                                    <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?php echo "../img/".$row["uficon"]; ?>" alt="" style="height: 141px;"/>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                                   <span class="btn btn-default btn-file">
                                                   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                   <input type="file" class="default" name="file1" />
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
                                     <a href="event.php" class="btn btn-warning" >Back</a>
                                         <button class="btn btn-info" type="submit" name="editoccassion" >Update</button>
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