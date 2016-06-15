<!doctype html>
<html>
<head>
	<title>Dashboard</title>
	<?php include 'lib/top.php';?>
</head>

<body>
<?php session_start();
include_once('connect.php');
if(isset($_SESSION['u_id']))
{ ?>
<div class="container-fluid"><!--container-fluid start-->
<div class="row">

<!--==============menu header=========================-->
<div class="menu-had2">
<?php include 'lib/header.php';?>
</div><!--menu-had close-->
<!--==============menu header close=========================-->
<?php include 'lib/deshboardmenu.php';?>
<?php  if(isset($_GET['del']))
{
  $id = $_GET['del'];
  $sql = mysqli_query($connect,"SELECT * FROM booking WHERE bookid='".$id."'");
  if(mysqli_num_rows($sql)>0)
  { 
    $row = mysqli_fetch_array($sql);
    echo "SELECT * FROM users u,place p WHERE u.uid='".$row['userid']."' and placeid='".$row['pid']."'";
    $sql3 = mysqli_query($connect,"SELECT * FROM users u,place p WHERE u.uid='".$row['userid']."' and placeid='".$row['pid']."'");
    $row3 = mysqli_fetch_array($sql3);
    $sql2 = mysqli_query($connect,"DELETE FROM booking WHERE bookid='".$id."'");
    if($sql>0)
    {
        $message ="Dear ".$row3['fname']." ".$row3['lname'].", You have Received this mail from Bookmyspace. \n\n Your Booking Request for".$row3['space_name']." has Been Rejected\n\n";

      $headers = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail = mail($row3['email'], 'Bookmyspace [Booking Info]', $message, $headers);

      echo"<script>swal('Success','Successfully Rejected','success');</script>";
    }
    else
    {
    echo"<script>swal('Error','Unable to Reject','error');</script>";
    }
  }
  else
  {

  }
  } ?>
<!--========================center part=================================-->
<div class="container">
<div class="row">
<div class="center-main">
<!--==============left panel=========-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border1">
<div class="main-side-panel">
<div class="pd-bottom20 ">
<?php $q1 = mysqli_query($connect,"select * from users where uid='".$_SESSION['u_id']."'");
$res = mysqli_fetch_array($q1); ?>
<div class="col-md-2">
        <figure class="snip1205">
   <img class="img-responsive" src="img/<?php if(!empty($res['profile'])){echo $res['profile'];}else{echo "default-user.png";} ?>">
    <i class="fa fa-edit fa-2x" data-toggle="modal" data-target="#myModal"></i>
</figure>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1BBC9B;color: white;">
        <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">UPDATE PROFILE PIC</h4>
      </div>  
      <div class="modal-body">
            <div id="messages">
                
            </div>
        <form id="upload_profile">
            <label class="control-label">Select Image</label>
                <input id="input-4" name="input4" type="file" class="file-loading">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" style="background: #1BBC9B;
    color: white;"class="btn btn-default"id="forclose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
<div class="col-md-3">
<h3 class="text-center"><?php echo $res['fname']." ".$res['lname']; ?></h3>
<p class="text-center">
<a id="a7" class="color3">Edit Profile</a>
</p>
</div>
<div class="col-md-7">
<div class="text-center">
<button class="btn-3" data-toggle="modal" data-target="#myModal3">Change Password</button>
</div>
</div>
</div>
<div class="clearfix"></div>
</div>
</div>
<!--==============left panel close=========-->
<!--==============right panel=========-->
<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-lr-0 mg-bottom20">
<div class="main-panel">
<!-- =========Enquiry Block=============== -->
<div id="b1" class="welcome col-md-12 pd-lr-0 mg-top20 border1 tab_in_dash">
<div class="col-md-12 backcolor3 pd-top10">
<p class="bold">My Places</p>
</div>
<div class="col-md-12 mg-top20">
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Place Name</th>
                <th>Location</th>
                <th>Property Type</th>
                <th>Capacity</th>
				        <th>Action</th>
            </tr>
        </thead>
		
		    <tbody>
           <?php 
           $se = 1 ;
           $q21 = mysqli_query($connect,"select * from place where user_id=".$_SESSION['u_id']);
           while($r21 = mysqli_fetch_array($q21)) 
           {
            ?>
            <tr>
              <td> <?php echo $se++; ?> </td>
              <td> <?php echo $r21['space_name']; ?> </td>
              <td> <?php echo $r21['p_address']; ?> </td>
              <td> <?php $q22 = mysqli_query($connect,"select * from property where pid =".$r21['property_typeid']); $r22 = mysqli_fetch_array($q22); echo $r22['ptype'];  ?> </td>
              <td> <?php echo $r21['capacity']; ?> </td>
              <td> <a href="demo-venue.php?placeid=<?php echo $r21['place_id']; ?>"><button class="btn-success"><i class="fa fa-eye"></i>&nbsp;</button></a>
              <a href="edit-place.php?placeid=<?php echo $r21['place_id']; ?>"><button class="btn-primary"><i class="fa fa-pencil"></i>&nbsp;</button></a>
              <a href="new-actions.php?delete_place=<?php echo $r21['place_id']; ?>"><button class="btn-danger"><i class="fa fa-trash"></i>&nbsp;</button></a>
            </tr>
            <?php
           }
           ?>           
          
        </tbody>

        
    </table>
</div>

</div>
<!-- Enquiry close -->




<!-- Booking Block -->
<div id="b2" class="welcome col-md-12 pd-lr-0 mg-top20 border1 tab_in_dash">
<div class="col-md-12 backcolor3 pd-top10">
<p class="bold">My Bookings</p>
</div>
<div class="col-md-12 mg-top20">
<table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Checkin Date</th>
                <th>Checkout Date</th>
                <th>Venue</th>
                <th>Total</th>
               <!--  <th>Action</th> -->
	
            </tr>
        </thead>
		
		<tbody>
           <?php 
           $serial = 1;
          
             $q19 = mysqli_query($connect,"select * from booking where userid='".$_SESSION['u_id']."' order by bookid asc");
             while($r19 = mysqli_fetch_array($q19)) { ?>
              <tr>
                <td><?php echo $serial++; ?></td>
                <td><?php echo date('d/m/Y',strtotime($r19['checkin'])); ?></td>
                <td><?php if($r19 == '0000-00-00') { echo $r19['hours']; } else { echo date('d/m/Y',strtotime($r19['checkout'])); } ?></td>
                <td><?php $q20 = mysqli_query($connect,"select * from place where place_id=".$r19['placeid']);
                $r20 = mysqli_fetch_array($q20); echo $r20['space_name']; ?></td>
                
                <td><?php echo $r19['online']; ?></td>
                <!-- <td><a href="#">View</a></td> -->
            </tr>
            <?php } ?>
        </tbody>

        
    </table>
</div>

</div>
<!-- Booking Block close -->


<!-- User Booking Block -->
<div id="b10" class="welcome col-md-12 pd-lr-0 mg-top20 border1 tab_in_dash">
<div class="col-md-12 backcolor3 pd-top10">
<p class="bold">User Bookings</p>
</div>
<div class="col-md-12 mg-top20">
<table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Checkin Date</th>
                <th>Checkout Date</th>
                <th>User</th>
                <th>Venue</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
    
    <tbody>
           <?php 
           $serial = 1;
             $q19 = mysqli_query($connect,"select * from booking b, place p, users u where p.user_id='".$_SESSION['u_id']."' and p.place_id=b.placeid and b.userid=u.uid order by bookid asc");
             while($r19 = mysqli_fetch_array($q19)) { ?>
              <tr>
                <td><?php echo $serial++; ?></td>
                <td><?php echo date('d/m/Y',strtotime($r19['checkin'])); ?></td>
                <td><?php if($r19 == '0000-00-00') { echo $r19['hours']; } else { echo date('d/m/Y',strtotime($r19['checkout'])); } ?></td>
                <td><?php echo $r19['fname']." ".$r19['lname']; ?></td>
                <td><?php  echo $r19['space_name']; ?></td>
                <td><?php echo $r19['online']; ?></td>
                <td><a href="dashboard.php?del=<?php echo $r19['bookid']; ?>">Reject</a></td>
            </tr>
            <?php } ?>
        </tbody>

        
    </table>
</div>

</div>
<!-- Booking Block close -->


<!-- Enquries Block -->
<div id="b9" class="welcome col-md-12 pd-lr-0 mg-top20 border1 tab_in_dash" style="display: none;">
<div class="col-md-12 backcolor3 pd-top10">
<p class="bold">My Enquiries</p>
</div>
<div class="col-md-12 mg-top20">
<table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Checkin Date</th>
                <th>Enquiry Name</th>
                <th>Service</th>
                <th>Guests</th>
           <!--      <th>Action</th> -->
  
            </tr>
        </thead>
    
    <tbody>
           <?php 
           $serial = 1;
          
             $q19 = mysqli_query($connect,"select * from enquiry where uid='".$_SESSION['u_id']."' order by eid desc");
             while($r19 = mysqli_fetch_array($q19)) { ?>
              <tr>
                <td><?php echo $serial++; ?></td>
                <td><?php echo date('d/m/Y',strtotime($r19['date1'])); ?></td>
                <td><?php echo(arg1) ?></td>
                <td><?php $q20 = mysqli_query($connect,"select * from services where sid=".$r19['serviceid']);
                $r20 = mysqli_fetch_array($q20); echo $r20['stitle']; ?></td>
                
                <td><?php echo $r19['nguest'];  ?></td>
                <!-- <td><a href="viewenquiry.php?id=<?php echo $r19['eid']; ?>">View</a></td> -->
            </tr>
            <?php } ?>
        </tbody>

        
    </table>
</div>

</div>
<!-- Enquries Block close -->






<!-- Services Block -->
<div id="b7" class="welcome col-md-12 col-sm-12 col-xs-12 pd-lr-0 mg-top20 border1 tab_in_dash" style="display: none;">
<div class="col-md-12 col-sm-12 col-xs-12 backcolor3 pd-top10">
<p class="bold">My Services</p>
</div>

<div class="col-md-12 mg-top20">
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Service Name</th>
                <th>Image</th>
                <th>Location</th>
                <th>Action</th>
            </tr>
        </thead>
    
        <tbody>
           <?php 
          $se = 1 ;
          $q26 = mysqli_query($connect,"select * from services where rid=".$_SESSION['u_id']);
          while($r26 = mysqli_fetch_array($q26))
          {
            $pics = explode(',',$r26['photo']);
            ?>
            <tr>
              <td> <?php echo $se++;
                if($pics[0]=="")
                {
            $image = "img/no_img.jpg";
                }
                else
                {
                if(file_exists("images/services/$pics[0]"))
                { 
                  $image = "images/services/".$pics[0];
                }
                else
                {
                  $image = "img/no_img.jpg";
                }
                }
               ?> </td>
              <td> <img src="<?php echo $image; ?>" class="img-responsive" style="height: 100px; width: 100px"> </td>
              <td> <?php echo $r26['stitle']; ?> </td>
              
              <td> <?php echo $r26['city'].','.$r26['state'].','.$r26['country']; ?> </td>
              <td> <a href="demo-service.php?serviceid=<?php echo $r26['sid'];?>"><button class="btn-success"><i class="fa fa-eye"></i>&nbsp;</button></a>
              <a href="edit-service.php?sid=<?php echo $r26['sid']; ?>"><button class="btn-primary"><i class="fa fa-pencil"></i>&nbsp;</button></a>
              <a href="new-actions.php?delete_service=<?php echo $r26['sid']; ?>"><button class="btn-danger"><i class="fa fa-trash"></i>&nbsp;</button></a>
              </td>
            </tr>
            <?php
           }
           ?>           
          
        </tbody>

        
    </table>
</div>

</div>
<!-- =========Services Block close=============== -->






<!--=========Reviews Block===============-->
<div id="b3" class="welcome col-md-12 pd-lr-0 mg-top20 border1 tab_in_dash">
<div class="col-md-12 backcolor3 pd-top10">
<p class="bold">My Reviews</p>
</div>
<div class="col-md-12 mg-top20">
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Venue or Service</th>
                <th>Review</th>
                <th>Comment</th>
            </tr>
        </thead>
    
        <tbody>
           <?php 
          $se = 1 ;
          $q24 = mysqli_query($connect,"select * from ratings where userid=".$_SESSION['u_id']);
while($r24 = mysqli_fetch_array($q24)) 
{
            $pics = explode(',',$r26['photo']);
            ?>
            <tr>
              <td> <?php echo $se++; ?> </td>
              <td> <?php
              if($r24['serviceid']=="0")
              {
              $sql = mysqli_query($connect,"SELECT * FROM place WHERE place_id='".$r24['placeid']."'");
              $row = mysqli_fetch_array($sql);
               echo $row['space_name']; }
               elseif($r24['placeid'])
                {
            $sql = mysqli_query($connect,"SELECT * FROM services WHERE sid='".$r24['serviceid']."'");
              $row = mysqli_fetch_array($sql);
               echo $row['stitle'];
                }
                ?> </td>             
  
              <td> <h4 class="color3"><a href="demo-venue.php?placeid=<?php echo $r25['place_id']; ?>"><?php echo $r25['space_name']; ?></a></h4>
<?php for($star = 0; $star < $r24['ratings']; $star++ )
{
  ?>
  <i class="fa fa-star" style="color: #F9BC39"></i>
  <?php
  } 

  for($star1 = 5; $star1 > $r24['ratings']; $star1-- )
  {
  ?>
  <i class="fa fa-star-o"></i>
  <?php
  }
  ?>
              </td>
              <td><?php echo $r24['comments']; ?></td>
            </tr>
            <?php
           }
           ?>           
          
        </tbody>

        
    </table>
</div>


</div>
</div>
</div>

</div>
<!-- =========Reviews Block close=============== -->

<!--=========Favourites Block===============-->
<div id="b4" class="welcome col-md-12 col-sm-12 col-xs-12 pd-lr-0 mg-top20 border1 tab_in_dash">
<div class="col-md-12 col-sm-12 col-xs-12 backcolor3 pd-top10">
<p class="bold">My Favourites</p>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 mg-top20 border-bottom pd-bottom20">
<div class="col-md-12 col-sm-12 col-xs-12 pd-lr-0">
<div class="col-md-2 col-sm-3 col-xs-12">
<img src="img/wedding1.jpg" class="img-responsive">
</div>
<div class="col-md-9 col-sm-8 col-xs-10">
<h4 class="color3">Overseas villa</h4>
<p class="mg-bottom3">Bhugaon, Pune</p>
<p class="mg-bottom3">Capacity 60</p>
</div>
<div class="col-md-1 col-sm-1 col-xs-2">
<i class="fa fa-lg fa-times color3"></i>
</div>

</div>
</div>


<div class="col-md-12 col-sm-12 col-xs-12 mg-top20 border-bottom pd-bottom20">
<div class="col-md-12 col-sm-12 col-xs-12 pd-lr-0">
<div class="col-md-2 col-sm-3 col-xs-12">
<img src="img/wedding1.jpg" class="img-responsive">
</div>
<div class="col-md-9 col-sm-8 col-xs-10">
<h4 class="color3">lorem ipsum villa</h4>
<p class="mg-bottom3">Bhugaon, Pune</p>
<p class="mg-bottom3">Capacity 60</p>
</div>
<div class="col-md-1 col-sm-1 col-xs-2">
<i class="fa fa-lg fa-times color3"></i>
</div>

</div>
</div>

</div>
<!----=========Favourites Block close===============-->





<!----=========Inbox Block===============-->
<div id="b5" class="welcome col-md-12 pd-lr-0 mg-top20 border1 tab_in_dash">
<div class="col-md-12 backcolor3 pd-top10">
<p class="bold"> <span style="font-size: 15px">Inbox </span>
 <!--  <span><button style="float: right; margin-bottom: 1%;" class="btn-3" data-toggle="modal" data-target="#compose">Compose</button></span> --></p>
<p><!-- <div class="col-md-7">
<div class="text-center">

</div>
</div> --></p>
</div>
<?php $q3 = mysqli_query($connect,"select * from messages m,users u where m.mto='".$_SESSION['u_id']."' and m.mto=u.uid");
while($res3 = mysqli_fetch_array($q3)){
  if($res3['mstatus'] == 'N') {
  ?>
<div class="col-md-12 mg-top20 border-bottom pd-bottom20 unread pd-top20" data-msgid="<?php echo $res3['mid']; ?>" style="background: #f9f9f9; cursor: pointer;">
<?php } else { ?>
<div class="col-md-12 mg-top20 border-bottom pd-bottom20">
<?php } ?>
<div class="col-md-12 pd-lr-0">
<div class="col-md-2">
<img src="img/<?php echo $res3['profile']; ?>" class="img-responsive">
</div>
<div class="col-md-10">
<h4 class="color3"><?php echo $res3['fname']; ?></h4>
<p class="mg-bottom3"><?php echo $res3['msg']; ?></p>
<form method="post" id="rpl_form">
<input name="to_msg" value="<?php echo $res3['mfrom']; ?>" type="hidden">
  <div class="hides">
 <textarea required="" class="form-control height90" name="reply_msg" placeholder="Type Your Message Here.."></textarea>
   </div>
    <button class="btn-reply more-btn mg-top10" type="button"><i class="fa fa-reply"></i>&nbsp;Reply</button>
    <button class="btn-reply send_btn mg-top10" type="submit" style="display: none;"><i class="fa fa-share-square-o"></i>&nbsp;Send</button>
    <button class="btn-reply cancel_btn mg-top10" type="button" style="display: none;"><i class="fa fa-times"></i>&nbsp;Cancel</button>
    </form>
</div>

</div>
</div>
<?php }//while ?>

<!-- <div class="col-md-12 mg-top20 border-bottom pd-bottom20">
<div class="col-md-12 pd-lr-0">
<div class="col-md-2">
<img src="img/wedding1.jpg" class="img-responsive">
</div>
<div class="col-md-10">
<h4 class="color3">Overseas villa</h4>
<p class="mg-bottom3">Your request is rejected</p>
<div class="hides1">
 <textarea class="form-control height90" placeholder="Reply"></textarea>
   </div>
<button class="btn-reply more-btn1 mg-top10"><i class="fa fa-reply"></i>&nbsp;Reply</button>
</div>

</div>
</div> -->

</div>
<!--=========Inbox Block close===============-->




<!--=========Transaction History Block===============-->
<div id="b8" class="welcome col-md-12 pd-lr-0 mg-top20 border1 tab_in_dash">
<div class="col-md-12 backcolor3 pd-top10">
  <?php $qr = mysqli_query($connect,"select count(`nid`) as total from notes where userid=".$_SESSION['u_id']." and nstatus='N'");
    $rw = mysqli_fetch_array($qr);

     ?>
<p class="bold"><h3>Notifications <?php if($rw['total'] != 0) { ?><span class="badge notes_count"> <?php echo $rw['total']; ?></span><?php } ?></h3></p>
</div>
<div class="col-md-12 mg-top20">

<ul style="list-style-type: none;padding: 0px;">
<?php $q31 = mysqli_query($connect,"Select * from notes where userid=".$_SESSION['u_id']);
while($r31 = mysqli_fetch_array($q31)) {
  $q32 = mysqli_query($connect,"select * from booking book , place p where book.bookid='".$r31['bookid']."' and book.placeid=p.place_id");
  $r32 = mysqli_fetch_array($q32);
  if($r31['nstatus'] == 'N')
  {

 ?>
  <li class="note-click" id="note<?php echo $r31['nid']; ?>" data-note="<?php echo $r31['nid']; ?>" style="padding: 1%; background: rgba(238, 238, 238, 0.61); cursor: pointer; border: 1px solid #eeeeee">
  <?php } else { ?>  <li class="" style="padding: 1%;cursor: pointer; border: 1px solid #eeeeee"> <?php } ?>
    <p><i class="fa fa-bell"></i> Your Booking For Place-<?php echo $r32['space_name']; ?> Has Been Cancelled Due To Some Circumstances.</p>
  </li>
  <?php } ?>
</ul>

</div>

</div>
<!-- =========Transaction History Block close ===============-->




<!-- =========Edit Profile=============== -->
<div id="b6" class="welcome col-md-12 pd-lr-0 mg-top20 border1 tab_in_dash">
<div class="col-md-12 backcolor3 pd-top10">
<p class="bold">Edit Profile</p>
</div>
<div class="col-md-12 mg-top20">
<form class="form-group" id="updatedata">
<div class="col-md-6 mg-top15">
<input type="text" class="form-control" placeholder="First Name" name="fname"required value="<?php echo $res['fname']; ?>">
</div>

<div class="col-md-6 mg-top15">
<input type="text" class="form-control" placeholder="Last Name" name="lname" required value="<?php echo $res['lname']; ?>">
</div>

<div class="col-md-6 mg-top15">
<input type="text" class="form-control" placeholder="Mobile" name="contact" required value="<?php echo $res['contact']; ?>">
</div>

<div class="col-md-6 mg-top15">
<!-- <select name="city" class="form-control">
  <option value="">-Select City-</option>
<?php 
$q2 = mysqli_query($connect,"select * from city");
while($res2 = mysqli_fetch_array($q2)){
  echo '<option value="'.$res2['cityid'].'">'.$res2['cityname'].'</option>';
}//while
?>
</select> -->
<input type="text" class="form-control" placeholder="City" name="city" required value="<?php echo $res['city']; ?>">
</div>

<div class="col-md-6 mg-top15">
<input type="text" class="form-control datePicker" placeholder="Date of birth" name="dob" value="<?php echo $res['dob']; ?>">
</div>
<div class="col-md-12 mg-top15 mg-bottom20">
<button class="btn-3" type="submit" name="update">Save</button>
</div>
</form>
</div>

</div>
<!----=========Edit Profile Block close===============-->






</div>

</div>
<!--==============Right Panel close=========-->
</div><!--center-main close-->
</div><!--row close-->
</div><!--container close-->

<!-- change pwd Modal box start -->
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header password-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <form  id="change_pass">
      <div class="modal-body">
      
        <input type="password" class="form-control" placeholder="Current Password" name="curepassword" required>
		<input type="password" class="form-control mg-top15" placeholder="New Password" name="newpassword" required>
		<input type="password" class="form-control mg-top15" placeholder="Confirm Password" name="confpassword" required>
		<div class="text-center">
		<button class="btn-5 mg-top15" type="submit">Save</button>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" name="change_pass">Close</button>
        
      </div>
      </form>
    </div>

  </div>
</div>
<!-- change pwd modal box close -->


<!-- compose msg Modal box start -->
<div id="compose" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header password-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Compose Message</h4>
      </div>
      <form  id="compose_msg" method="post">
      <div class="modal-body">
      <select id="select1" class="form-control" multiple="multiple" name="tos[]" required >
     <!--  <option value="" hidden>Select Uses</option> -->
    <?php $query=mysqli_query($connect,'Select * from users where uid !='.$_SESSION['u_id']);
while($match=mysqli_fetch_array($query)){?>
    <option value="<?php echo $match['uid'];?>"><?php echo $match['email'];?></option>
<?php }//while ?>
</select>
       <!--  <input type="text" class="form-control" placeholder="To" name="to" required> -->
    <!-- <input type="text" class="form-control mg-top15" placeholder="" name="" required> -->

 <textarea class="form-control mg-top15" name="message" required="" placeholder="Type Your Message Here.."></textarea>

    <div class="text-center">
    <button class="btn-5 mg-top15" type="submit">Send</button>
    </div>
      </div>
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-default" data-dismiss="modal" name="change_pass">Close</button> -->
        
      </div>
      </form>
    </div>

  </div>
</div>
<!-- compose msg modal box close -->


<?php }
else
{
    header('location:index.php');
    }?>
<!--========================center part close=================================-->
<!--======footer======-->
	<?php include 'lib/footer.php';?>
	
<!--======footer close======-->
</div><!--row close-->
</div><!--container-fluid close-->
<style>
  .multiselect-selected-text
  {
    max-width: 100%;
    display: inline-block;
    overflow: hidden;
    text-overflow: ellipsis;
  }

</style>
</body>	
</html>

<?php if(isset($_REQUEST['msg']))
{
  ?>
  <script type="text/javascript">
    $(document).ready(function(){
      swal('Success','Record Deleted Successfully','success');
    });
  </script>
  <?php
  } ?>