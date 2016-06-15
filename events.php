<!doctype html>
<html>
<head>

	<title>List a Service</title>
	<?php include 'lib/top.php';?>
	
</head>

<body>
<div class="container-fluid"><!--container-fluid start-->
<div class="row">


<!--==============menu header=========================-->
<div class="menu-had2">
<?php include 'lib/header.php';?>
</div><!--menu-had close-->
<!--==============menu header close=========================-->

<div class="container">
<div class="col-md-12">

<div class="container">
<div class="row">
    
    <div class="col-md-12">
          	
      <!-- tabs left -->
      <div class="tabbable tabs-left">

       <!--  <ul class="nav nav-tabs col-md-2 col-xs-12">
		<h3>List a Service</h3>
          <li class="active"><a href="#a" data-toggle="tab"><img class="ico" src="img/wedding.png">&nbsp;Wedding</a></li>
          <li ><a href="#b" data-toggle="tab"><img class="ico" src="img/party.png">&nbsp;Party</a></li>
          <li><a href="#c" data-toggle="tab"><img class="ico" src="img/business.png">&nbsp;Business</a></li>
		   <li><a href="#d" data-toggle="tab"><img class="ico" src="img/other.png">&nbsp;Others</a></li>
        </ul> -->

        <div class="tab-content col-md-12 col-xs-12"><!--------Main Tab Starts------------>
		
         <div class="tab-pane active" id="a"><!--------Wedding Tab Starts------------>
		 <h3>Select Your Events</h3>
		
		<div class="row">
		
		<?php
        $query1=mysqli_query($connect,'SELECT * FROM `usedfor`');
        while ($row1=mysqli_fetch_array($query1)){        
            ?><!---First Row of wedding------>
		 <div class="col-md-3">
		<figure class="snip1205">
	
      
<img class="img-responsive" src="../bookmyspace/images/events/<?php echo $row1['ufimage'];?>" >

<?php ?>
	<i class="fa fa-search"></i>
	 <a href="eventenquiry.php?id=<?php echo $row1['ufid'];?>"></a>
	<h4 class="f1"><?php echo $row1['ufname'];?></h4>
		 </div>
		 
<?php }?>
		 
		 </div>
		 
		 
		 
		 
		 
		 
		<!-- <!--  <div class="row"> <!---Second Row of wedding------>

		
		 
		 
		
		 
		 		
		 
		 
		 
		
		 
		 
		 
	
		
		 </div>
		 
	


		 </div>
		 </div>
		 </div>
		 </div>
</div><!--container close-->

</div><!--row close-->
</div><!--container-fluid close-->

</body>	
	


<!--======footer======-->
	<?php include 'lib/footer.php';?>
<!--======footer close======-->
</div>
</div>



  
	
	
</html>
