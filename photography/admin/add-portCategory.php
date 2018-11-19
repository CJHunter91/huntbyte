<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

$pageArray = array(
"name"  => "Add Categories",
"menu"  => "menu.php",
"style" => "../style/",
"sidebar" => "none"
); ?>

<?php include('../includes/adminHeader.php');?>

<div class="hasflex" id='main'>
	<p><a href="categories.php">Categories Index</a></p>

	<h2>Add Portfolio Category</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);

		//very basic validation
		if($catTitle ==''){
			$error[] = 'Please enter the Category.';
		}

		if(!isset($error)){

			try {

				$catSlug = slug($catTitle);

				//insert into database
				$stmt = $db->prepare('INSERT INTO portfolio_cats (catTitle,catSlug, catDesc) VALUES (:catTitle, :catSlug, :catDesc)') ;
				$stmt->execute(array(
					':catTitle' => $catTitle,
					':catSlug' => $catSlug,
					':catDesc' => $catDesc
				));

				//redirect to index page
				header('Location: categories.php?action=added');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post'>

		<p><label>Title</label><br />
		<input type='text' name='catTitle' value='<?php if(isset($error)){ echo $_POST['catTitle'];}?>'></p>
        <textarea name="catDesc" value='<?php if(isset($error)){ echo $_POST['catDesc'];}?>'></textarea>

		<p><input type='submit' name='submit' value='Submit'></p>

	</form>

</div>
<?php include('../includes/adminFooter.php');?>