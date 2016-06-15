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
          <?php if($_GET["msz"]=='007')
           {
            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Image deleted successfully</p>
                            </div>';
               }             
                ?>
                <?php if($_GET["nomsg"]=='002')
                     {

                     echo '<div class="alert alert-block alert-danger fade in">
                               <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Transaction is rejected.</p>
                            </div>';
                              }             
                            ?>
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
                                <p>Image updated successfully.</p>
                            </div>';
               }             
                ?>

                <?php if($_GET["msg"]=='00002')
           {
            echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Image Added Successfully.</p>
                            </div>';
               }             
                ?>

                <?php if($_GET["nomsg"]=='009')
                     {

                     echo '<div class="alert alert-block alert-danger fade in">
                               <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> wrong file extension.</p>
                            </div>';
                              }             
                            ?>
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
           View Gallery Images
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
        <a href="addgpic.php" class="btn btn-danger btn-xs" type="button">Add More Images</a>
        <div class="adv-table">
        <table  class="display mytable table table-bordered table-striped" style="text-align:center" id="dynamic-table">
        <thead>
        <tr>
             <tr>
            <th style="text-align:center">Sr.no</th>
            <th style="text-align:center">Image</th>
            <th style="text-align:center" class="hidden-phone">Action</th>
        </tr>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        $query=mysqli_query($connection,'SELECT * FROM `gallery` order by gid asc');
        while($row=mysqli_fetch_array($query))
        {
            ?>
      
        <tr class="gradeX">
            <td style="width:10%"><?php echo $i++;?></td>
            <td style="width:40%"><img src="<?php echo "../img/".$row["img"]; ?>" class="img-responsive" style="width: 65%; padding-left: 31%;"></td>
              <td style="width:20%" class="center hidden-phone">
                
                <a href="editgpic.php?id=<?php echo $row["gid"];?>" class="btn btn-warning btn-xs" type="button">Edit</a>
                <a href="deleteslide.php?dgid=<?php echo $row["gid"];?>" class="btn btn-danger btn-xs" type="button">Delete</a>
            </td>
        </tr>
       <?php
       }?>
      
        </tfoot>
        </table>
        </div>
        </div>
        </section>
        </div>
        </div>
        </div>
        <!--body wrapper end-->
     <?php include("footer.php");?>