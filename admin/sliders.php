       <?php include_once('../connect.php'); ?>
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
                                <p> Slider Background Updated Successfully.</p>
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
                        <div class="panel-body">
                      <?php
                           $query=mysqli_query($connection,'SELECT * FROM `slider` where slide_id='.$_REQUEST['code']);
                           $row=mysqli_fetch_array($query);
                        ?>   
            
                            <form action="update.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                           <input type="hidden" name="scode" value="<?php echo $_REQUEST['code']; ?>" />
                                <div class="form-group last">
                                    <label class="control-label col-md-3">Edit Slide</label>
                                    <div class="col-md-9">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 510px; height: 150px;">
                                                <img src="../image/slide/<?php echo $row["slide_image"]; ?>" alt="" style="height: 141px;"/>
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
                                 <!-- <div class="form-group last">
                                    <label class="control-label col-md-3">Edit Slide Description</label>
                                    <div class="col-md-9">
                                        <div><textarea name="slideheading" class="form-control" style="width:72.5%" ><?php echo $row['s_desc']; ?></textarea></div>
                                    </div>
                                </div> -->
                                
                                 <div class="form-group last">
                                     <div class="col-md-7" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="updateslide" style="float:right">Update Slide</button>
                                         <a href="slides.php" class="btn btn-warning" style="float:right;margin-right: 51px;">Back  </a>
                                    </div>
                                 </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end--> 