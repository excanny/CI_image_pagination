<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Image upload</title>
  <!-- Bootstrap CSS link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2 class="text-center" style="margin-top: 50px;">CodeIgniter Image Upload</h2>
    <br><br>
    <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
     
          <!-- validation message to display after form is submitted -->
             <!-- <?php /*echo validation_errors('<div class="alert alert-danger alert-dismissible" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>','</div>');*/
             ?>     -->
             <!-- image upload form      -->
             <form action="<?php echo base_url();?>index.php/image/store" method="post" enctype="multipart/form-data">
               <div class="form-group">
                 <label>Image Name</label>
                   <input type="text" class="form-control" id="image_name" name="name">
                 </div>
               <div class="form-group">
                 <label>Image</label>
                   <input type="file" class="form-control" id="userfile" name="userfile">
                 </div>
               <input type="submit" class="btn btn-primary" value="Upload">
            </form>

             <a href="<?php echo site_url('image/view_images') ?>" class="btn btn-success" style="margin-left: 20px;">View Images</a>  
        </div>
      <div class="col-lg-3"></div>
    </div> 
  </div>
  <!-- jQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <!-- Bootstrap JS links -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>