<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

$pageArray = array(
"name"  => "Edit Categories",
"menu"  => "menu.php",
"style" => "../style/",
"sidebar" => "none"
); ?>

<?php include('../includes/adminHeader.php');?>

<div class="hasflex" id='main'>
	<p><a href="categories.php">Categories Index</a></p>

	<h2>Edit Category</h2>


	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);

		//very basic validation
		if($catID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($catTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if(!isset($error)){

			try {

				$catSlug = slug($catTitle);

				//insert into database
				$stmt = $db->prepare('UPDATE '.$_GET["c"].'_cats SET catTitle = :catTitle, catSlug = :catSlug, catDesc = :catDesc WHERE catID = :catID') ;
				$stmt->execute(array(
					':catTitle' => $catTitle,
					':catSlug' => $catSlug,
					':catID' => $catID, 
					':catDesc' => $catDesc
				));

				//redirect to index page
				header('Location: categories.php?action=updated');
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

			$stmt = $db->prepare('SELECT catID, catTitle, catDesc FROM '.$_GET["c"].'_cats WHERE catID = :catID') ;
			$stmt->execute(array(':catID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post'>
		<input type='hidden' name='catID' value='<?php echo $row['catID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='catTitle' value='<?php echo $row['catTitle'];?>'></p>
		<textarea name='catDesc' cols='60' rows='10'><?php echo $row['catDesc'];?></textarea>
		<p><input type='submit' name='submit' value='Update'></p>

	</form>

</div>

<?php include('../includes/adminFooter.php');?>