<!DOCTYPE html>
<?php session_start(); ?>

<html>

<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Social Media | Index Page</title>
   <!-- CSS LINKS -->
   <link rel="stylesheet" href="<? asset('Styles::Index.css') ?>" type="text/css" />
</head>

<body>
   <div class="body-content">
      <div class="content">
         <div class="top">
            <h2>Welcome to our Social Media Index Page</h2>
            <img src="<? asset('Images::bg-icon.png') ?>" />
         </div>

         <div class="btns">
            <?php if (isset($_SESSION['__uid'])): ?>
               <a href="<? route('') ?>">
                  <button>Dashboard</button>
               </a>
            <?php else: ?>
               <a href="<? route('login') ?>">
                  <button>Login</button>
               </a>
               <a href="<? route('register') ?>">
                  <button>Register</button>
               </a>
            <?php endif; ?>
         </div>
      </div>
   </div>
</body>

</html>