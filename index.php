<?php
    require('includes/config.php');
   $pageArray = array(
"name"  => "HuntByte - Home",
"style" => "style/",
"images" => "images/",
"boot" => "bootstrap/css/");

include('includes/header.php');
include('includes/menu.php');
include('includes/leftbar.php');?>
<script>
$( "li:contains('Home')" ).addClass("active");
</script>

        <div class="right">
            <h2><span>Welcome</span></h2>
            <div class="columnContent" id="primaryContent">
            <script>
            
            $("document").ready(function() {
            	$('#primaryContent').load('content/home.html');
        		});
            
            </script>
            </div>
        </div>
       <?php include('includes/footer.php'); ?>