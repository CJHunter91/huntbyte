<?php require('includes/config.php'); 



$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate, postImage FROM blog_posts_seo WHERE postSlug = :postSlug');
$stmt->execute(array(':postSlug' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
	header('Location: ./');
	exit;
}
// array to store page information i.e which menu or page name
$pageArray = array(
"name"  => "Blog",
"menu"  => "usermenu.php",
"style" => "style/",
"sidebar" => "sidebar.php",
"mainImage" => $row['postImage'],
"headerMount" => "stickyTape.png"
); ?>

<?php include('includes/header.php');?>
        <?php if(isset($_GET['c'])){
				echo '<p><a href="javascript:history.go(-1)">Blog Categories</a></p>';
		}
			else{
				echo '<p><a href="./blog.php'.$lastPage.'">Blog Entries</a></p>';
				}  ?>

		<div id='main'>
			<div id='pageImage'><img src="<?php echo str_replace(' ', '%20',$pageArray["mainImage"]); ?>"></div>
			<?php	
				echo '<div>';
					echo '<h1>'.$row['postTitle'].'</h1>';
					echo '<p>Posted in ';

						$stmt2 = $db->prepare('SELECT catTitle, catSlug	FROM blog_cats, blog_post_cats WHERE blog_cats.catID = blog_post_cats.catID AND blog_post_cats.postID = :postID');
						$stmt2->execute(array(':postID' => $row['postID']));

						$catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);

						$links = array();
						foreach ($catRow as $cat)
						{
						    $links[] = "<a href='c-".$cat['catSlug']."'>".$cat['catTitle']."</a>";
						}
						echo implode(", ", $links);

					echo '</p>';
					echo '<p>'.$row['postCont'].'</p>';				
				echo '</div>';
			?>

		</div>

<?php include('includes/footer.php'); ?>