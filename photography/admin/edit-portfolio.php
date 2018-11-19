<?php //include config
require_once('../includes/config.php');
include 'upload.php';

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

$pageArray = array(
"name"  => "Edit Portfolio",
"menu"  => "menu.php",
"style" => "../style/",
"sidebar" => "none"
); ?>

<?php include('../includes/adminHeader.php');?>

<div class="hasflex" id='main'>
	<p><a href="adminPortfolio.php">Portfolio Admin Index</a></p>

	<h2>Edit Portfolio</h2>


	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);
        		if(isset($_FILES['mainUpload']) &&($_FILES['mainUpload']["name"] == $_FILES['thumbUpload']["name"])){
			//if the files in main and thumb are the same for upload
				$mainArray = uploadFile('mainUpload');
				$imageFile = $mainArray[0];
				$imageThumbFile = $imageFile;
				$actionMainImage = $mainArray[1];
			}
		else{
			//send to function to check if the uploads have any errors
		$mainArray = uploadFile('mainUpload');
		$thumbArray = uploadFile('thumbUpload');
		if(!$mainArray[0] && $_FILES['mainUpload']['size'] != 0 ){
			 echo $mainArray[1];
			 exit;
			}
			if(!$thumbArray[0] && $_FILES['thumbUpload']['size'] != 0 ){
			 echo $thumbArray[1];
			 exit;
			}
		}
		
		if ($_POST['mainImage'] != "Nothing Selected" && $_POST['thumbImage'] != "Nothing Selected" ){
			//if both images from site
			$imageFile = 'admin/uploads/'. $_POST['mainImage'];
			$imageThumbFile = 'admin/uploads/'. $_POST['thumbImage'];
        
		}elseif($_FILES['mainUpload']['size'] != 0 && $_POST['thumbImage'] != "Nothing Selected" ){
			//if mainupload and site thumb selected
			$imageFile = $mainArray[0];
			$actionMainImage = $mainArray[1];
			$imageThumbFile = 'admin/uploads/'. $_POST['thumbImage'];
		
		
		}elseif($_FILES['thumbUpload']['size'] != 0 && $_POST['mainImage'] != "Nothing Selected" ){
			//if thumbupload and site main selected
			$imageThumbFile = $thumbArray[0];
			$actionThumbImage = $thumbArray[1];
			$imageFile = 'admin/uploads/'. $_POST['mainImage'];
		}
		elseif($_FILES['mainUpload']["name"] != $_FILES['thumbUpload']["name"]){
			//if the the files in main and thumb are different for upload
				$imageFile = $mainArray[0];;
				$imageThumbFile = $thumbArray[0];
				$actionMainImage = $mainArray[1];
				$actionThumbImage = $thumbArray[1];

			}
		//logic for only one image selected
		elseif($_FILES['mainUpload']['size'] != 0){
			//*** potentially add evgenias logo to the unelected image
			$imageFile = $mainArray[0];
			$imageThumbFile = "Nothing Selected";
			}
		elseif($_FILES['thumbUpload']['size'] != 0){
			$imageFile = "Nothing Selected";
			$imageThumbFile = $thumbArray[0];
			}
		elseif($_POST['thumbImage'] != "Nothing Selected"){
			$imageThumbFile = 'admin/uploads/'. $_POST['thumbImage'];
			$imageFile = "Nothing Selected";
			}
		elseif($_POST['mainImage'] != "Nothing Selected"){
			$imageFile = 'admin/uploads/'. $_POST['mainImage'];
			$imageThumbFile = "Nothing Selected";
			}
			
        
		//very basic validation
		if($postID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)){

			try {

				$postSlug = slug($postTitle);

				//insert into database
				$stmt = $db->prepare('UPDATE portfolio_posts_seo SET postImage = :postImage, postTitle = :postTitle, postSlug = :postSlug, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
				$stmt->execute(array(
                    ':postImage' => $imageFile,
					':postTitle' => $postTitle,
					':postSlug' => $postSlug,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postID' => $postID
				));

				//delete all items with the current postID
				$stmt = $db->prepare('DELETE FROM portfolio_post_cats WHERE postID = :postID');
				$stmt->execute(array(':postID' => $postID));

				if(is_array($catID)){
					foreach($_POST['catID'] as $catID){
						$stmt = $db->prepare('INSERT INTO portfolio_post_cats (postID,catID)VALUES(:postID,:catID)');
						$stmt->execute(array(
							':postID' => $postID,
							':catID' => $catID
						));
					}
				}

				//redirect to index page
				header('Location: adminPortfolio.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>


	<?php
	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {
			//get post data from db
			$stmt = $db->prepare('SELECT postThumb, postImage, postID, postTitle, postDesc, postCont FROM portfolio_posts_seo WHERE postID = :postID') ;
			$stmt->execute(array(':postID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>
	<!-- Trigger/Open The Image Modal -->
    <div id="buttons" class="imageSelect">
	<p>Select image to upload from website:</p>
	<button id="myBtn" onclick="openModal(['mainImage','mainUpload'])">Choose Main Image</button>
   <!-- <button id="myBtn" onclick="openModal(['thumbImage','thumbUpload'])">Choose Thumbnail Image</button>-->
    <button id="clearSelect">Clear Selection</button>
    </div>   
<?php include('modal.php');?>

	<form id="postForm" action='' method='post' enctype="multipart/form-data">
		<!-- edit Post Form -->
        <div id="selectBox" class="hasflex imageSelect">
        <input type="text" name="mainImage" value='<?php echo basename($row['postImage']);?>' readonly>
        <!--<input type="text" name="thumbImage" value='<?php// echo basename($row['postThumb']);?>' readonly>-->
        </div>
        <div id="uploadFiles" class="hasflex imageSelect">
        <p>Select image to upload from computer:</p>
        <label>Main Image:</label>
        <input type="file" name="mainUpload" onchange="setfield(['mainImage','Nothing Selected']);">
        <label>Thumbnail:</label>
       <!-- <input type="file" name="thumbUpload" onchange="setfield(['thumbImage','Nothing Selected']);">-->
		</div>
		
		<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

		<p><label>Description</label><br />
		<textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p>

		<fieldset>
			<legend>Categories</legend>

			<?php

			$stmt2 = $db->query('SELECT catID, catTitle FROM portfolio_cats ORDER BY catTitle');
			while($row2 = $stmt2->fetch()){

				$stmt3 = $db->prepare('SELECT catID FROM portfolio_post_cats WHERE catID = :catID AND postID = :postID') ;
				$stmt3->execute(array(':catID' => $row2['catID'], ':postID' => $row['postID']));
				$row3 = $stmt3->fetch(); 

				if($row3['catID'] == $row2['catID']){
					$checked = 'checked=checked';
				} else {
					$checked = null;
				}

			    echo "<input type='checkbox' name='catID[]' value='".$row2['catID']."' $checked> ".$row2['catTitle']."<br />";
			}

			?>

		</fieldset>

		<p><input type='submit' name='submit' value='Update'></p>

		

	</form>

</div>

<?php include('../includes/adminFooter.php');?>
