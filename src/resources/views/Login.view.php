<!DOCTYPE html>
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
                  <input type="email" name="email" placeholder="Enter your Email" required />
                  <input type="password" name="password" placeholder="Enter your Password" required />
               </div>
               <div class="btn">
                  <button type="submit">Login</button>
               </div>
            </form>
         </div>
         <a href="/register" class="or-link">@Register</a>
      </div>
   </body>
</html>