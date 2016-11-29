<!DOCTYPE html>
<html>
<head>

<script src="js/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>


</head>
<body>
<div class="hide1" id="third-block">
  <form class="form-group" action="/actions.php" id="signup_form" method="POST">
  
  <div class="input-group">
    
    <span class="input-group-addon"><i class="fa fa-user"></i></span>
  <input type="text" class="form-control form-height40 bord-0" name="fname" placeholder="First Name" required/>
</div>

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-user"></i></span>
  <input type="text" class="form-control form-height40 bord-0" name="lname" placeholder="Last Name" required/>
</div>


<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-at"></i></span>
  <input type="email" class="form-control form-height40 bord-0" name="email" placeholder="Email Address" required/>
</div>

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" class="form-control form-height40 bord-0 pwd" minlength="6" name="pwd" id="pwd" placeholder="Password" required/>
</div>

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
<input type="text"  maxlength="15" class="form-control form-height40 bord-0 phone" name="contact" placeholder="Mobile" required/>
</div>  

  
  <div class="text-center mg-top10">
  <button type="submit" name="signup" id="signup" class="btn-4">Signup</button>
  <button type="button" class="btn-back">Back</button>
  </div>

      
  </form>
  </div>
</body>
<!--<script src="test.js"></script>-->
</html>