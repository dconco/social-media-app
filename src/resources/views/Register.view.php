<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Register | Social Media</title>
      <!-- CSS LINKS -->
      <link rel="stylesheet" href="<? asset('Styles::Login.css') ?>" type="text/css" />
   </head>
   <body>
      <div class="container">
         <div class="box">
            <div class="icon">
               <include path="../components/UserIcon.php" />
            </div>
            <h3>Create an Account</h3>

            <form action="<? route('auth.register') ?>" method="post">
               <div class="fields">
                  <input type="email" name="email" placeholder="Enter your Email" required />
                  <input type="password" name="password" placeholder="Enter your Password" required />
               </div>
               <div class="btn">
                  <button type="submit">Register</button>
               </div>
            </form>
         </div>
         <a href="<? route()->login ?>" class="or-link">@Login</a>
      </div>
   </body>
</html>