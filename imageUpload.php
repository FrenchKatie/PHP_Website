  <?php
      // phpInfo();
      // die();

      // include composer autoload
      require 'vendor/autoload.php';

      // import the Intervention Image Manager Class
      use Intervention\Image\ImageManager;

      $errors = array();

      if(isset($_FILES["image"])){
        $fileSize = $_FILES["image"]["size"];      // is the image too large?
        $fileTmp =  $_FILES["image"]["tmp_name"];  // what is the temporary name?
        $fileType = $_FILES["image"]["type"];      // what is it? PDF etc


        if($fileSize > 5000000){ //if the file is larger than 5mb
          array_push($errors, "File is too large, Must be under 5MB");
        }

        //check to see if the image is the right file type
        $validExtensions = array("jpeg", "jpg", "png");
        //Expode() = tell it a specific character or characters - warningill read a string, find a point (we will explode on ".") and once it finds that it will break it into an array
        $fileNameArray = explode(".", $_FILES["image"]["name"]); //what we will get out of this is "filename", "extensiontype" so "myimage", "jpg".
        $fileExt = strtolower(end($fileNameArray)); //converts entire string to lower case - take the end of a file name array which should be a JPG or PNG etc
        if (in_array($fileExt, $validExtensions) === false) { //needs to values: what were searching for and what we are searching in
          array_push($errors, "File type not allowed, can only be a JPG or a PNG");
        }

        if (empty($errors)) {
          $destination = "images/uploads";
          if (! is_dir($destination)) { //checking to see if the folder exists
            mkdir("images/uploads/", 0777, true); //if the folder does not exist then make it. Always good to have this as you would probably put your uploads folder in your gitignore file
          }
          //create a random name for the saved image - for example if multiple people were to upload an image with the same name we would have errors
          $newFileName = uniqid() .".". $fileExt; //keep the same extension as you dont want to lose things like transparancy if it was a png
          // move_uploaded_file($fileTmp, $destination."/".$newFileName);

          $manager = new ImageManager();

          $mainImage = $manager->make($fileTmp);
          $mainImage->save($destination . "/" . $newFileName, 100);



          //creating thumbnail image
          $thumbDestination = "images/uploads/thumbnails";

          if (! is_dir($thumbDestination)) { //checking to see if thumbnail folder exists - if not, make it
            mkdir("images/uploads/thumbnails/", 0777, true);
          }

          $thumbnailImage = $manager->make($fileTmp);

          $thumbnailImage->resize(300, null, function($constraint){ //resizes the width of the image to 300px for the thumbnail version
            $constraint->aspectRatio();
            $constraint->upsize();
          });
          $thumbnailImage->save($thumbDestination . "/" . $newFileName, 100); //save function has two props - where and keep quality percent. so keep the quality at 100%



        }

        die();

      } else {
        array_push($errors, "File not found, please upload an image");
      }

      $page = "imageUpload";
      include("templates/header.php");
   ?>

  <div class="text-center">

    <h1 class="header">Upload an Image</h1>


    <?php if($_FILES && !empty($errors)): ?>
      <div class="alert alert-danger" role="alert">
          <ul>
            <?php foreach($errors as $singleError): ?>
              <li class="itemStyle"><?= $singleError ?></li>
            <?php endforeach; ?>
          </ul>
      </div>
    <?php endif; ?>

    <form class="form" action="imageUpload.php" method="post" enctype="multipart/form-data">

      <div class="form-group">
        <label for="">Upload an Image</label>
        <input type="file" name="image" class="form-control-file">
      </div>

      <button type="submit" class="btn btn-outline-dark btn-block">Submit</button>

    </form>



    </div>
  <?php
      include("templates/footer.php");
   ?>
