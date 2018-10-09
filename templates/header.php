<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title><?= $page ?> page</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link <?php if($page === 'home'): ?> active <?php endif; ?>" href="index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($page === 'second'): ?> active <?php endif; ?>" href="second.php">Second</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($page === 'third'): ?> active <?php endif; ?>" href="third.php">Third</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($page === 'fourth'): ?> active <?php endif; ?>" href="contact.php">Contact</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($page === 'imageUpload'): ?> active <?php endif; ?>" href="imageUpload.php">Image Upload</a>
  </li>
</ul>
