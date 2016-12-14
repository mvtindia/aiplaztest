<?php

    require_once 'fbConfig.php';
    require_once 'user.php';
    error_log("fbLogin");
    //Get user profile data from facebook
    if(!isset($_REQUEST['state'])){
        $fbUser = NULL;
        $loginURL = $facebook->getLoginUrl(array('redirect_uri'=>$redirectURL,'scope'=>$fbPermissions));
        $output = '<a href="'.$loginURL.'"><button class="fb-btn"><i class="fa fa-facebook"></i>&nbsp;Join with Facebook</button></a>';
        echo $output;
    } else {
        error_log("fblogin2");
        try {
            $fbUserProfile = $facebook->api('/me?fields=id,first_name,last_name,email');
            }   catch (Exception $e) {
                error_log($e);
            }
    //Initialize User class
        $user = new User();
    
    //Insert or update user data to the database
        $fbUserData = array(
            'fuid'      => $fbUserProfile['id'],
            'fname'     => $fbUserProfile['first_name'],
            'lname'     => $fbUserProfile['last_name'],
            'email'     => $fbUserProfile['email']
        );
        $userData = $user->checkUser($fbUserData);
    
    //Put user data into session
    
        $_SESSION['u_id'] = $userData['uid'];
    }

?>
Hello World