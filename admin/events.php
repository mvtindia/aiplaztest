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
          <?php  if(isset($_REQUEST['edel']))
                      {
                         $id=$_REQUEST["edel"];
            $query=mysqli_query($connect,'DELETE FROM `events` WHERE  evid="'.$id.'"');
                          if($query>0){
                             echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p>Event Record Deleted Successfully</p>
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
                                <p> Unable to Delete the Event Record.</p>
                            </div>';
                              } 
               }  //if isset                  
                            ?>
        <div class="col-sm-12">
        <section class="panel">
        <header class="panel-heading">
           Events
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
        <a href="addevents.php" class="btn btn-danger btn-xs" type="button">Add Events</a>
        <div class="adv-table">
        <table  class="display mytable table table-bordered table-striped" style="text-align:center" id="dynamic-table">
        <thead>
        <tr>
             <tr>
            <th style="text-align:center; display:none">Sr.no</th>

            <th style="text-align:center">Sr.no</th>
            <th style="text-align:center">Title</th>
            <th style="text-align:center">Image</th>
            <th style="text-align:center">Description</th>
            <th style="text-align:center">Date</th>
            <th style="text-align:center" class="hidden-phone">Action</th>
        </tr>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        $query=mysqli_query($connect,'SELECT * FROM `events` order by evid desc');
        while($row=mysqli_fetch_array($query))
        {
            ?>
      
        <tr class="gradeX">
            <td style="width:10%;display:none"></td>

            <td style="width:10%"><?php echo $i++;?></td>
            <td style="width:10%"><?php echo $row['etitle'];?></td>

            <td style="width:25%"><img src="<?php echo "../images/events/".$row["epic"]; ?>" class="img-responsive" style="width: 65%; padding-left: 31%;"></td>
            <td style="width:30%"><?php 

            $old = html_entity_decode($row['edesc']);
            $desc = substr($old,0,50);
            if(strlen($old) > 50)
            {
            	echo $desc.'...';
            }
            else
            {
            	echo $old;
            }
			
			?></td>
            <td style="width:10%"><?php $start = explode('-',$row['estart']); echo $start[2].'-'.$start[1].'-'.$start[0]; 
            if($row['eend'] != '0000-00-00') { $end = explode('-',$row['eend']); echo '<br><i>To</i><br>'.$end[2].'-'.$end[1].'-'.$end[0]; } ?></td>



              <td style="width:20%" class="center hidden-phone">                
                <a href="editevents.php?id=<?php echo $row["evid"];?>" class="btn btn-warning btn-xs" type="button">Edit</a>
                <a href="?edel=<?php echo $row["evid"];?>" class="btn btn-danger btn-xs" type="button">Delete</a>
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