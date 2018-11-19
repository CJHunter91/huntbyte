<?php //include config
require_once('../includes/config.php');
include 'upload.php';

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
$pageArray = array(
"name"  => "User Upload",
"menu"  => "menu.php",
"style" => "../style/",
"sidebar" => "none"
); ?>

<?php include('../includes/adminHeader.php');?>

<div class="hasflex" id='main'>

	<p><a href="./">Blog Admin Index</a></p>

	<h2>Upload</h2>
    		<?php
	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		
		extract($_POST);
		//assign a value to imageFile and thumbFile
		//send to function to check if the uploads have any errors
		$mainArray = uploadFile('mainUpload');
		if(!isset($_FILES['mainUpload'])){
			echo '<p class="error">Please select an image</p>';
			}
		if(!$mainArray[0] && $_FILES['mainUpload']['size'] != 0 ){
			
			 echo $mainArray[1];
			 exit;
			}
		else{
			
		header('Location: index.php?action=Image uploaded');
				exit;
		
		}}
		?>
        
    <form id="uploadForm" action='' method='post' enctype="multipart/form-data">
        <div id="uploadFiles" class="hasflex imageSelect">
        <p>Select image to upload from computer:</p>
        <label>Main Image:</label>
        <input type="file" name="mainUpload" onchange="setfield(['mainImage','Nothing Selected']);">
  		</div>
		

		<p><input type='submit' name='submit' value='Submit'></p>

	</form>

</div>
<?php include('../includes/adminFooter.php');?>