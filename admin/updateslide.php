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
           <?php if($_GET["msg"]=='001')
           {
            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Category  inserted Successfully.</p>
                            </div>';
               }             
                ?>
                <?php if($_GET["nomsg"]=='002')
                     {

                     echo '<div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Oh snap!</strong> wrong file extension.
                            </div>';
                              }             
                            ?>
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Edit Slide
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                      <?php    $id=$_GET["id"];
                                $query=mysqli_query($connection,'SELECT * FROM `slider` where sid='.$id.'');
                                $row=mysqli_fetch_array($query);
                                 $row["slide_id"];?>
                        <div class="panel-body">
                            <form action="updateslidequery.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                            
                             <input type="hidden" name="sid" value="<?php echo $row["sid"];?>">
                             
                                <div class="form-group last">
                                    <label class="control-label col-md-3">Change image one</label>
                                    <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?php echo "../".$row["simg1"]; ?>" alt="" style="height: 141px;"/>
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
                                <label class="control-label col-md-3">Heading one</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="hone" class="form-control" value="<?php echo $row["sheading1"];?>" required="required">
                                </div>
                            </div>
                              <div class="form-group last">
                                <label class="control-label col-md-3">Sub Heading</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="htwo" class="form-control" value="<?php echo $row["sheading2"];?>" required="required">
                                </div>
                            </div>
                               <div class="form-group last">
                                <label class="control-label col-md-3">Content</label>
                                <div class="col-md-5" class="iconic-input">
                                   <textarea class="form-control" name="con"> <?php echo $row["scontent"];?></textarea>
                                </div>
                            </div>
                              <div class="form-group last">
                                <label class="control-label col-md-3">Button Text</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="txt" class="form-control" value="<?php echo $row["sbtntext"];?>" required="required">
                                </div>
                            </div>
                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="submit">Update </button>
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