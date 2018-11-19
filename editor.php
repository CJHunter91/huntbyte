<?php 

require('includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); }
   $pageArray = array(
"name"  => "HuntByte - Editor",
"style" => "style/",
"images" => "images/",
"boot" => "bootstrap/css/");

include('includes/header.php');
include('includes/menu.php');

?>

<script>
$( "li:contains('Editor')" ).addClass("active");

	$(function() {
	
		var $selector	= $(".fichero"),
			$toLoad		= "",
			$saveTo		= $(document).getUrlParam("selector"),
			$form		= $("form"),
			$editWindow = $("#editWindow");	
		
		$selector.click(function (e) {
			console.log(this.id);
			$toLoad = this.id;
			
		});
	
	})

$( "li:contains('Editor')" ).addClass("active");
</script>	



    <div id="right">
    <h1>Edinburghrock & Huntbyte</h1>
    <h2>Online Content Manager</h2>
	<p>Choose the page to edit:</p>
	<div id="linkPanel"><?php
		foreach (glob("content/*.html") as $fichero) {
			$stripped = basename($fichero, ".html");
			echo "<div class='link'><a class='fichero' href='editor.php?selector=".$fichero."' id='".$stripped."' data-src='".$fichero."'>".$stripped."</a></div>";
		}	
	?></div>
	<div id="editWindow">
    	<form method="post" action="save_file.php<?php echo "?saveTo=".$_GET['selector'];?>">
    		<textarea id="editor"  name="contents"><?php
					if ($_GET["selector"] != "") {
						$loadedData = file_get_contents($_GET["selector"], FILE_USE_INCLUDE_PATH);						
						}else{					
					$loadedData = "Please load a page";
						}
					echo $loadedData;
				?></textarea>
        	<input type="submit" id="submit" value="Submit Changes">
		</form>
	</div>
    </div>
<?php include('includes/footer.php');?>