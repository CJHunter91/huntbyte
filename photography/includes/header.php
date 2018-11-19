<!doctype html>
<html lang="en"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $pageArray["name"]; ?></title>
   <link rel="stylesheet" href="<?php echo $pageArray["style"]; ?>lightbox.css">
  <link rel="stylesheet" href="<?php echo $pageArray["style"]; ?>image-picker.css">
  <link rel="stylesheet" href="<?php echo $pageArray["style"]; ?>main.css">
  <link rel="stylesheet" href="<?php echo $pageArray["style"]; ?>mobile.css" media="screen and (max-width: 900px)">
  <link rel="stylesheet" href="<?php echo $pageArray["style"]; ?>slideshow.css">
  <script src="https://code.jquery.com/jquery-3.0.0.min.js" type="text/javascript"></script>
  <script src="<?php echo $pageArray["style"]; ?>lightbox.js"></script>
  <script src="<?php echo $pageArray["style"]; ?>image-picker.js"></script>

  <?php 
  if ($_GET['p'] && $pageArray['isCat']){
	  $lastPage = '?p='.$_GET['p'].'&'.'c';
	  }
	elseif ($_GET['p']){
		$lastPage = '?p='.$_GET['p'];
		}
	elseif($pageArray['isCat']){
		$lastPage = '?c';
		}
	
  
  ?>
</head>
<body class="hasflex">
	<div class="hasflex" id="social">
    	<a href="https://www.facebook.com/evgeniya.kornichuk" target="_blank"><img src="images/SMicons/fb.png"></a>
        <a href="https://be.linkedin.com/pub/evgenia-rigaut/8/753/ba9" target="_blank"><img src="images/SMicons/linkedin.png"></a>
        <a href="https://instagram.com/zheniadina/" target="_blank"><img src="images/SMicons/instagram.png"></a>
    </div>
	<div class="hasflex" id="wrapperLeft"> <img src="images/wrapperLeftBack.png"> </div>
	<div class="hasflex" id="wrapper">
            
			<div id="photoFrame" style="background-image:url(<?php echo str_replace(' ', '%20',$pageArray["mainImage"]); ?>);">
            		<?php $tapeArray = array("photoTapeTL","photoTapeTR","photoTapeBL","photoTapeBR");
					foreach($tapeArray as $corner){
						echo '<div id="'.$corner.'"><img src="images/'.$pageArray["headerMount"].'" width="138" height="138"></div>';
						}
					?>
                    <a id="headerLink" href="<?php echo str_replace(' ', '%20',$pageArray["mainImage"]); ?>" data-lightbox="header"></a>
            </div>
        
        
		
		<div id="title">
        <h1><?php echo $pageArray["name"]; ?></h1>
        </div>

        <?php include($pageArray["menu"]);
		?>
        
