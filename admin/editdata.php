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
                                <p> Product Updated Successfully.</p>
                            </div>';
               }             
                ?>
                <?php if($_GET["msg"]=='002')
                     {

                     echo '<div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Oh snap!</strong> wrong file extension of featured image.
                            </div>';
                              }             
                            ?>
                               <?php if($_GET["nomsg"]=='002')
                     {

                     echo '<div class="alert alert-block alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Oh snap!</strong> wrong file extension of supplement featured image.
                            </div>';
                              }             
                            ?>
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Enter Sub-Data
                          <span class="tools pull-right">
                            <a class="fa fa-chevron-down" href="javascript:;"></a>
                            <a class="fa fa-times" href="javascript:;"></a>
                         </span>
                        </header>
                     <?php     $id=$_GET["id"];
                                $query=mysqli_query($connection,'SELECT * FROM `infodata` where dataid="'.$id.'"');
                                $row=mysqli_fetch_array($query);?>
                        <div class="panel-body">
                            <form  id="" action="upproduct.php" method="post" class="form-horizontal" enctype="multipart/form-data">

                                 <div class="form-group last">
                                <label class="control-label col-md-3">Select Category Name</label>
                                <div class="col-md-5" class="iconic-input">
                                   <select name="category" class="form-control" >
                                   <?php // echo $row["cat_id"];
                                     $query1=mysqli_query($connection,'SELECT * FROM `infocat` where catid="'.$row["catid"].'"');
                                    $row1=mysqli_fetch_array($query1);?>
                                    <option value="<?php echo $row["catid"];?>" hidden><?php echo $row1["catname"];?></option>
                                     <?php $queryn=mysqli_query($connection,'select * from `infocat`');
                                     while($rown=mysqli_fetch_array($queryn))
                                     {?>
                                        <option value="<?php echo $rown["catid"];?>"><?php echo $rown["catname"];?></option>

                                 <?php 
                                    }
                                     ?>
                                   </select>
                                </div>
                            </div>
                                 <input type="hidden" name="sid" class="form-control" value="<?php echo $row["dataid"]; ?>" required="required">
                               <div class="form-group last">
                                <label class="control-label col-md-3">Title</label>
                                <div class="col-md-5" class="iconic-input">
                                    <input type="text" name="product" class="form-control" value="<?php echo $row["title"]; ?>" required="required">
                                </div>
                            </div>
							 
							 <div class="form-group last">
                                <label class="control-label col-md-3">Product Description</label>
                                <div class="col-md-5" class="iconic-input">
                                <textarea class="form-control ckeditor" name="editor1" rows="6" placeholder="Description" required="required">
                                <?php echo $row["ddesc"]; ?></textarea>
                                </div>
                            </div>
                                 <div class="form-group last">
                                     <div class="col-md-5" class="iconic-input">
                                         <button class="btn btn-info" type="submit" name="updata" >Update Data </button>
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