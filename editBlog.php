<?php
    require('includes/config.php');
if(!$user->is_logged_in()){ header('Location: login.php'); }	
   $pageArray = array(
"name"  => "HuntByte - Edit Blog",
"style" => "style/",
"images" => "images/",
"boot" => "bootstrap/css/");

include('includes/header.php');
include('includes/menu.php');?>
<script>
$( "li:contains('View')" ).addClass("active");
</script>

        <div class="right">
            <h2><span>Edit Blog</span></h2>
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
				$stmt = $db->prepare('UPDATE blog_posts_seo SET postTitle = :postTitle, postSlug = :postSlug, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
					':postSlug' => $postSlug,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postID' => $postID
				));

				//redirect to index page
				header('Location: viewBlogs.php?action=updated');
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
			$stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont FROM blog_posts_seo WHERE postID = :postID') ;
			$stmt->execute(array(':postID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>
    <form id="postForm" action='' method='post' enctype="multipart/form-data">
		<!-- Add Post Form -->
		<input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='postTitle' value='<?php echo $row['postTitle'];?>'></p>

		<p><label>Description</label><br />
		<textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc'];?></textarea></p>

		<p><label>Content</label><br />
		<textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea></p>


		<p><input type='submit' name='submit' value='Update'></p>

	</form>
            </div>
            <div id="cv">
                <a href="/files/Chris_Hunter_CV.pdf" download="Chris_Hunter_CV.pdf" onclick="myFunction()">Here is a download link for my CV</br></a>
                </br>
                <p id="cons" style = "display:none">Thanks for your consideration.</p>
            </div>
        </div>
       <?php include('includes/footer.php'); ?>