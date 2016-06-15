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
          <?php  if(isset($_REQUEST['adel']))
                      {
                         $id=$_REQUEST["adel"];
            $query=mysqli_query($connect,'DELETE FROM `area` WHERE areaid="'.$id.'"');
                          if($query>0){
                             echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Record Successfully Deleted</p>
                            </div>';
               }    else{
                 echo '<div class="alert alert-block alert-danger fade in">
                               <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Error!
                                </h4>
                                <p> Unable to Delete the Record.</p>
                            </div>';
                              } 
               }  //if isset                  
                            ?>
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
           Area
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
        <a href="addarea.php" class="btn btn-danger btn-xs" type="button">Add Area</a>
        <div class="adv-table">
        <table  class="display mytable table table-bordered table-striped" style="text-align:center" id="dynamic-table">
        <thead>
        <tr>
             <tr>
              <th style="text-align:center; display:none">Sr.no</th>
            <th style="text-align:center">Sr.no</th>
            <th style="text-align:center">Area Type</th>
            <th style="text-align:center">Action</th>
        </tr>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        $query=mysqli_query($connect,'SELECT * FROM `area` order by areaid desc');
        while($row=mysqli_fetch_array($query))
        {
            ?>
      
        <tr class="gradeX">
            <td style="width:10%;display:none"></td>
            <td style="width:10%"><?php echo $i++;?></td>
            <td style="width:10%"><?php echo $row['areatype'];?></td>
            <td style="width:20%" class="center hidden-phone">                
                <a href="editarea.php?id=<?php echo $row["areaid"];?>" class="btn btn-warning btn-xs" type="button">Edit</a>
                <a href="?adel=<?php echo $row["areaid"];?>" class="btn btn-danger btn-xs" type="button">Delete</a>
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