<!DOCTYPE html>

<?php
use PhpSlides\Http\Request;

$request = new Request();

$oldEmail = $oldPwd = $errMsg = '';
if ($request->get('q') !== null) {
	$query = $request->get('q');
	$query = unserialize(base64_decode($query));

	$oldEmail = $query['email'];
	$oldPwd = $query['password'];
	$errMsg = $query['err'];
}
?>

<html>

<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login | Social Media</title>
   <!-- CSS LINKS -->
   <link rel="stylesheet" href="<? asset('Styles::Login.css') ?>" type="text/css" />
</head>

<body>
   <div class="container">
      <div class="box">
         <div class="icon">
            <include path="../components/UserIcon.php" />
         </div>
         <h3>Welcome Back</h3>

         <form action="<? route('auth.login') ?>" method="post">
            <div class="fields">
               <input type="email" name="email" value="<? $oldEmail ?>" placeholder="Enter your Email" required />
               <input type="password" name="password" value="<? $oldPwd ?>" placeholder="Enter your Password" required />
            </div>
            
            <div class="err-msg">
               <span><? $errMsg ?></span>
            </div>
            
            <div class="btn">
               <button type="submit">Login</button>
            </div>
         </form>
      </div>
      <a href="/register" class="or-link">@Register</a>
   </div>

   <script src="<? asset('Js::Global.js') ?>" type="text/javascript"></script>
</body>

</html>