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
                      if(isset($_REQUEST['addevents']))
          {
              $title=htmlentities($_REQUEST["etitle"]);
              $ex = explode('-',$_REQUEST['sdate']);
              $sdate = $ex[2].'-'.$ex[1].'-'.$ex[0];

               $ex1 = explode('-',$_REQUEST['edate']);
              $edate = $ex1[2].'-'.$ex1[1].'-'.$ex1[0];

              $details=htmlentities($_REQUEST["edetails"]);
              $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                        $filename=$_FILES['file']['name'];
                        $filetmp=$_FILES['file']['tmp_name']; 
                        $filepath="../images/events/".$filename;
                      
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                      if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connect,'INSERT INTO `events`(`etitle`, `edesc`, `epic`, `estart`, `eend`) VALUES ("'.$title.'","'.$details.'","'.$filename.'","'.$sdate.'","'.$edate.'")');
                          $mv=move_uploaded_file($filetmp,$filepath);
                          if($query>0){
                          if($mv>0){
                            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Event Added Successfully.</p>
                            </div>';
                          }
                          else{
                             echo '<div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong> Unable to Add Event.
                            </div>';
                          }
                      }//if query
                      }
                       else
                       {
                           echo '<div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Oh snap!</strong> wrong file extension.
                            </div>';;
                       }
          }
          if($_GET["msg"]=='001')
           {
            
               }             
                ?>
                <?php if($_GET["nomsg"]=='002')
                     {

                    
                              }             
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
                                     <label class="control-label col-md-3">Title</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="etitle" placeholder="Title" class="form-control" value="" required="required">
                                     
                                    </div>
                                 </div>


                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Start Date</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="sdate" style=" background: #eee !important; border: #ccc solid 1px !important;" placeholder="Start Date" class="form-control datepicker" value="" required="required">
                                     
                                    </div>
                                 </div>

                                  <div class="form-group last">
                                     <label class="control-label col-md-3">End Date</label>
                                     <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="edate" style=" background: #eee !important; border: #ccc solid 1px !important;" placeholder="End Date (optional)" class="form-control datepicker" value="">
                                     
                                    </div>
                                 </div>

                                 <div class="form-group last">
                                     <label class="control-label col-md-3">Details</label>
                                     <div class="col-md-5" class="iconic-input">
                                   
                                     <textarea name="edetails" class="form-control ckeditor" placeholder="News Details" required></textarea>

                                     
                                    </div>
                                 </div>


                                  


                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="addevents">Add Event</button>
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