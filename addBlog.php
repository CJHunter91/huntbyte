<?php
    require('includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); }	
   $pageArray = array(
"name"  => "HuntByte - Add Blog",
"style" => "style/",
"images" => "images/",
"boot" => "bootstrap/css/");

include('includes/header.php');
include('includes/menu.php');?>
<script>
$( "li:contains('View')" ).addClass("active");
</script>

        <div class="right">
            <h2><span>Add Blog</span></h2>
            <div class="columnContent" id="primaryContent">
				<?php
	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		
		extract($_POST);
		//basic validation
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
				$stmt = $db->prepare('INSERT INTO blog_posts_seo (postTitle,postSlug,postDesc,postCont,postDate) VALUES (:postTitle, :postSlug, :postDesc, :postCont, :postDate)') ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postSlug' => $postSlug,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postDate' => date('Y-m-d H:i:s')
				));
				$postID = $db->lastInsertId();

				//add categories
				if(is_array($catID)){
					foreach($_POST['catID'] as $catID){
						$stmt = $db->prepare('INSERT INTO blog_post_cats (postID,catID)VALUES(:postID,:catID)');
						$stmt->execute(array(
							':postID' => $postID,
							':catID' => $catID
						));
					}
				}

				//redirect to index page + add extra action details i.e what images
				header('Location: viewBlogs.php?action=Post added');
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
    <form id="postForm" action='' method='post' enctype="multipart/form-data">
		<!-- Add Post Form -->
		<p><label>Title</label><br />
		<input type='text' name='postTitle' placeholder="Insert Title" value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

		<p><label>Description</label><br />
		<textarea name='postDesc' cols='60' rows='10' placeholder="Insert Description"><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10' placeholder="Insert Content"><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>


		<p><input type='submit' name='submit' value='Submit'></p>

	</form>
        </div>
    </div>
       <?php include('includes/footer.php'); ?>