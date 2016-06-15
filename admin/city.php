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
           if(isset($_REQUEST['ndel']))
         {
                         $id=$_REQUEST["ndel"];
            $query=mysqli_query($connect,'DELETE FROM `city` WHERE cityid="'.$id.'"');
            if($query>0){
                           echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Record Deleted Successfully</p>
                            </div>';
               }
               else{
                 echo '<div class="alert alert-block alert-danger fade in">
                               <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Failure!
                                </h4>
                                <p> Unable to delete the record.</p>
                            </div>';
                              } 
               }//if isset                             
                            ?>
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
           City
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
        <a href="addcity.php" class="btn btn-danger btn-xs" type="button">Add City</a>
        <div class="adv-table">
        <table  class="display mytable table table-bordered table-striped" style="text-align:center" id="dynamic-table">
        <thead>
        <tr>
             <tr>
            <th style="text-align:center; display:none">Sr.no</th>
            <th style="text-align:center">Sr.no</th>
            <th style="text-align:center">City</th>
            <th style="text-align:center">Image</th>
            <th style="text-align:center">Latitude</th>
            <th style="text-align:center">Longitude</th>
            <th style="text-align:center" class="hidden-phone">Action</th>
        </tr>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        $query=mysqli_query($connect,'SELECT * FROM `city` order by cityid desc');
        while($row=mysqli_fetch_array($query))
        {
            ?>
      
        <tr class="gradeX">
            <td style="width:10%;display:none"></td>

            <td style="width:10%"><?php echo $i++;?></td>
            <td style="width:10%"><?php echo $row['cityname'];?></td>

            <td style="width:30%"><img src="<?php echo "images/".$row["photo"]; ?>" class="img-responsive" style="width: 65%; padding-left: 31%;"></td>
            <td style="width:10%"><?php echo $row['latitude'];?></td>
            <td style="width:10%"><?php echo $row['longitude'];?></td>
             
              <td style="width:20%" class="center hidden-phone">                
                <a href="editcity.php?id=<?php echo $row["cityid"];?>" class="btn btn-warning btn-xs" type="button">Edit</a>
                <a href="?ndel=<?php echo $row["cityid"];?>" class="btn btn-danger btn-xs" type="button">Delete</a>
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