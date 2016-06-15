<?php include("../connect.php"); include("mainheader.php");?>
<body class="sticky-header">
<section>
   <?php include("sidebar.php");?>
     <!-- main content start-->
    <div class="main-content" >
 <?php include("header.php");?>
        <!--body wrapper start-->
        <!--body wrapper start-->
       
        <div class="wrapper">
        <div class="row">
          <?php 
           if(isset($_REQUEST['uphome1']))
          {
            $content = $_REQUEST['content'];//htmlentities();
            $query=mysqli_query($connect,"UPDATE `pages` SET `page_content`='".$content."' where page_title='video'");
            if($query)
            {
              echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Data updated successfully.</p>
                            </div>';
            }else{
              echo '<div class="alert alert-danger alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Error!
                                </h4>
                                <p>Unable to update data.</p>
                            </div>';
            }
          }//if isset
                     
                ?>
               
                            <style type="text/css">
                             <style>
.forvid iframe
{
height: 100px !important;
width: 300px !important;
}
                            .hello input 
                            {
                              width:700px;
                            }
                             .hello textarea 
                            {
                              width:700px;
                            }
                            </style>
        <div class="col-sm-12 hello">
        <section class="panel">
        <header class="panel-heading">
          Edit Video
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
  <form method="post" class="form-horizontal" enctype="multipart/form-data">

        <div class="adv-table">
      
  <?php
        $query=mysqli_query($connect,'SELECT * FROM `pages` where page_title="video"');
        $row=mysqli_fetch_array($query);
        
     ?>
   
                            <div class="form-group last">
                                <label class="control-label col-md-3">Video Path Url(Only webm files)</label>
                                <div class="col-md-8" class="iconic-input" class="form-control forvid">
                                <textarea name="content" style="width:100%" rows="20" cols="10" class="form-control ckeditor" required="required"> <?php echo $row["page_content"];?></textarea></div>
                                </div>
                            </div>
                             <input type="hidden" name="cid" class="form-control" value="<?php echo $row["page_id"];?>" required="required">
                              
                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="uphome1">Save</button>
                                    </div>
                                 </div>
                            </form>
        </div>
        </div>
        </section>
        </div>
        </div>
        </div>
        <!--body wrapper end-->
     <?php include("footer.php");?>