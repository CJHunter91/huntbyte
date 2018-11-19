<?php
   require("includes/config.php");
   
   $pageArray = array(
"name"  => "HuntByte - About",
"style" => "style/",
"images" => "images/",
"boot" => "bootstrap/css/");

include('includes/header.php');
include('includes/menu.php');
include('includes/leftbar.php');?>
<script>
$( "li:contains('About')" ).addClass("active");
</script>
               
        <div class="right">
            <h2><span>About</span></h2>
            <div class="columnContent" id="primaryContent">
            <script>
            $("document").ready(function() {
            	$('#primaryContent').load('content/about.html');
        		});
            
            </script>
            </div>
        </div>
<?php include('includes/footer.php');?>
