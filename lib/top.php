
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	
<link href="css/style.css" rel="stylesheet">
<link href="css/style2.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--	<link href="css/bootstrap-select.css" rel="stylesheet">-->
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
<link href="css/star-rating.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="sm/dist/sweetalert2.css">
<!--link href="https://www.jqueryscript.net/demo/jQuery-jQuery-UI-Based-Date-Range-Picker-Plugin/jquery.comiseo.daterangepicker.css" rel="stylesheet">-->
<link href="bm/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
     This must be loaded before fileinput.min.js -->

<!-- bootstrap.js below is only needed if you wish to use the feature of viewing details 
     of text file preview via modal dialog -->

<!-- optionally if you need translation for your language then include 
    locale file as mentioned below -->
	
 <!-- Bootstrap -->
<!--<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/bootstrap-datetimepicker.css" />-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
  		<script src="js/respond.min.js"></script>
    <![endif]-->
<link href="font/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>

<link href="css/nouislider.min.css" rel="stylesheet">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
<script src="https://apis.google.com/js/api:client.js"></script>
  <script>
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '1021417611119-7tco73rh4s5rs29463sgruetap5pl7sl.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignin(document.getElementById('customBtn'));
    });
  };

  function attachSignin(element) {
    //console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
          //document.getElementById('name').innerText = "Signed in: " +
          //    googleUser.getBasicProfile().getName();
          gfname = googleUser.getBasicProfile().getGivenName());
          glname = googleUser.getBasicProfile().getFamilyName()); 
          guserid = googleUser.getBasicProfile().getId());
          gemail = googleUser.getBasicProfile().getEmail());
          $.ajax({
                url: 'actions.php?gfname=' + gfname + '&glname=' + glname + '&guserid=' + guserid + '&gemail=' + gemail  
                cache: false,
                contentType: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {

                }
          });
        }, function(error) {
          alert(JSON.stringify(error, undefined, 2));
        });
  }
  </script>
  <?php 
  include_once('connect.php');
  ?>
       
