<?php include_once('../connect.php');
if(isset($_REQUEST['statusval']))
{
 $regid = $_REQUEST['statusval'];
	$q = mysqli_query($connection,"update register set status='Active' where reg_id=".$regid);
	if($q)
	{
		$qq = mysqli_query($connection,"select * from register where reg_id=".$regid);
		if($rr = mysqli_fetch_array($qq))
		{
			//mail to email
				$message ="Dear ".$rr['name'].", You have Received this mail from Zeppter. \n\n Congrats, Your Account with us has been Activated. Now you can Login into your Account. \n\n Your Crediential Details are: \n\n Email- ".$rr['email']."\n\n Password: ".$rr['pwd']."\n\n";
				
				$headers = 'From: no-reply@vismaadlabs.in' . "\r\n" .
		    	'Reply-To: no-reply@vismaadlabs.in' . "\r\n" .
		    	'X-Mailer: PHP/' . phpversion();
				$mail = mail($rr['email'], 'Zeppter [Account Activation]', $message, $headers);
		}
		echo '<script>window.location.href="inactive.php?msg=changed";</script>';
		
		//header('location:inactive.php?msg=changed');
	}
}


if(isset($_REQUEST['activestatus']))
{
 $regid = $_REQUEST['activestatus'];
	$q = mysqli_query($connection,"update register set status='Inactive' where reg_id=".$regid);
	if($q)
	{
		$qq = mysqli_query($connection,"select * from register where reg_id=".$regid);
		if($rr = mysqli_fetch_array($qq))
		{
			//mail to email
				$message ="Dear ".$rr['name'].", You have Received this mail from Zeppter. \n\n Your Account with us has been Deactivated because someone has marked your account as Report Abused.";
				
				$headers = 'From: no-reply@vismaadlabs.in' . "\r\n" .
		    	'Reply-To: no-reply@vismaadlabs.in' . "\r\n" .
		    	'X-Mailer: PHP/' . phpversion();
				$mail = mail($rr['email'], 'Zeppter [Account Deactivation]', $message, $headers);
		}
		echo '<script>window.location.href="active.php?msg=changed";</script>';
		
		//header('location:inactive.php?msg=changed');
	}
}


 if(isset($_POST["editslide"]))
                      {
                        $id= $_POST['imageid'];
                        /* 
                          $slidetext = $_REQUEST['slidetext'];
                    $slideheading = $_REQUEST['slideheading'];
                    $btntext = $_REQUEST['btntext'];
                    $btnlink = $_REQUEST['btnlink'];*/
              $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                        $filename=$_FILES['imageid']['name'];
                        $save="../img/".$filename;
                        $filetmp=$_FILES['imageid']['tmp_name']; 
                        $filepath="../img/".$filename;
                      
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
          
                      if (in_array($ext, $supported_image) and !empty($filename))
                         {               
                 $query=mysqli_query($connect,'UPDATE `slider` SET slide_image="'.$filename.'" WHERE slide_id="'.$id.'"');
                  move_uploaded_file($filetmp,$filepath);
                   header("location:slides.php?msg=001");
             }
                          else
                           {
                             header("location:addslide.php?nomsg=002");
                           } 
                      }

?>