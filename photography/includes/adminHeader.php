<!doctype html>
<html lang="en"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $pageArray["name"]; ?></title>
   <link rel="stylesheet" href="<?php echo $pageArray["style"]; ?>image-picker.css">
  <link rel="stylesheet" href="<?php echo $pageArray["style"]; ?>main.css">
  <link rel="stylesheet" href="<?php echo $pageArray["style"]; ?>admin.css">
  <link rel="stylesheet" href="<?php echo $pageArray["style"]; ?>adminMobile.css" media="screen and (max-width: 900px)">
  <script src="https://code.jquery.com/jquery-3.0.0.min.js" type="text/javascript"></script>
  <script src="<?php echo $pageArray["style"]; ?>image-picker.js"></script>
  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"> </script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
			  convert_urls: false,
			  menubar:false,
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>
</head>
<body class="hasflex">
	<div class="hasflex" id="wrapperLeft"> <img src="../images/wrapperLeftBack.png"> </div>
	<div class="hasflex" id="wrapper">
        
		

        <h1><?php echo $pageArray["name"]; ?></h1>
        <?php include($pageArray["menu"]);
		?>