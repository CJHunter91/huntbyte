<?php require('includes/config.php'); 



$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate, postImage FROM blog_posts_seo WHERE postSlug = :postSlug');
$stmt->execute(array(':postSlug' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./blog.php');
	exit;
}
// array to store page information i.e which menu or page name
   $pageArray = array(
"name"  => "HuntByte - Blog",
"style" => "style/",
"images" => "images/",
"boot" => "bootstrap/css/"); ?>

<?php include('includes/header.php');
	include('includes/menu.php');
	include('includes/leftbar.php');?>



		<div class='right'>
		<p><a href='./blog.php'>Blog Entries</a></p>
			<?php	
				echo '<div>';
					echo '<h1>'.$row['postTitle'].'</h1>';
					echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate']));

					echo '</p>';
					echo '<p>'.$row['postCont'].'</p>';				
				echo '</div>';
			?>

		</div>

<?php include('includes/footer.php'); ?>