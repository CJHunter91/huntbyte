<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo $pageArray["images"]; ?>favicon16.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo $pageArray["images"]; ?>favicon16.ico" type="image/x-icon" />
    <link href="<?php echo $pageArray["boot"]; ?>bootstrap.min.css" rel="stylesheet">
    <link  type="text/css" href="<?php echo $pageArray["style"]; ?>style.css" rel="stylesheet"/>
    <link rel="stylesheet" media="screen and (max-width: 700px)" href="<?php echo $pageArray["style"]; ?>narrow.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script src="getparamurl.js"></script>
<script>tinymce.init({selector:'textarea',width:'100%',height:'80%', plugins: "link"});</script>
    
    <title><?php echo $pageArray["name"]; ?></title>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-85549943-1', 'auto');
    ga('send', 'pageview');
	
	$(document).ready(function(){
		if($('.left').height() > $('.right').height() ){
			$('.right').height($('.left').height());
			}
		else{
			$('.left').height($('.right').height());
			}
		
		});  
    </script>
</head>
<body>
<div id="container">
    <div class="page-wrap">
        <div id="header">
            <a class="navbar-brand" href="index.php">HuntByte.com</a>
            <h2 id="name">Christopher James Hunter</h2>   
        </div>