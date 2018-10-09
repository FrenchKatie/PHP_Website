<?php

    if ($_POST) {
      // var_dump($_POST);
      // $name = $_POST["name"];
      // $email = $_POST["email"];
      // $message = $_POST["message"];
      // $subscribe = $_POST["subscribe"];


      extract($_POST);
      // var_dump($name);

      $errors = array();

      //first check if someone has input a value
      if (!$name){ //if there is not a name
          array_push($errors, "Name is required!"); //first prop is name of the array pushing to, second prop is what the error actually is
      } else if (strlen($name) < 2){ //if string length is less than 2
        array_push($errors, "Please enter at least 2 characters of your name");
      } else if (strlen($name) > 100){ //if string length is more than 100
        array_push($errors, "Your name can't be more than 100 characters");
      }

      if (!$email) {
        array_push($errors, "Email is required!");
      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "Invalid email");
      }

      if (!message) {
        array_push($errors, "Message is requeired");
      } else if (strlen($message) < 10){ //if string length is less than 2
        array_push($errors, "Message must be at least 10 chars long");
      } else if (strlen($message) > 1000){ //if string length is more than 100
        array_push($errors, "Message cant be more than 1000 chars long");
      }



      //spitting out the feedback
      if(empty($errors)){ //if there are no errors
        // var_dump("You are good to go");
        $to = $email;
        $subject = 'email enquiry';
        $emailMessage = "You have recieved an email<br>Here is the message";
        $emailMessage += $message;
        $headers = array(
          "From" => "frenchkatie8@gmail.com",
          "Reply-To" => "frenchkatie8@gmail.com",
          "X-Mailer" => "PHP/".phpversion()
        );
        mail($to,$subject,$emailMessage,$headers);
        header("Location: index.php");
      }
    }

    $page = "fourth";
    include("templates/header.php");
    // require();
 ?>
  <div class="text-center">
    <h1 class="header">Contact</h1>
    <?php if($_POST && !empty($errors)): ?>
      <div class="alert alert-danger" role="alert">
          <ul>
            <?php foreach($errors as $singleError): ?>
              <li class="itemStyle"><?= $singleError ?></li>
            <?php endforeach; ?>
          </ul>
      </div>
    <?php endif; ?>

    <form class="form" action="contact.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter your name..." value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>">
      </div>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="Enter your email address..." value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
      </div>
      <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" name="message" rows="3"><?php if(isset($_POST['message'])){echo $_POST['message'];} ?></textarea>
      </div>
      <div class="form-group form-check">
        <input type="checkbox" name="subscribe" class="form-check-input" id="subscribe" <?php echo (isset($_POST['subscribe'])?'checked="checked"':'') ?> />
        <label class="form-check-label" name="subscribe" for="subscribe">Subscribe to Newsletter</label>

      </div>
      <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>

    </form>

  </div>
  <?php
      include("templates/footer.php");
      // require();
   ?>
