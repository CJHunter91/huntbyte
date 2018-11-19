<?php require('includes/config.php'); 


$stmt = $db->prepare('SELECT catID,catTitle,catDesc FROM blog_cats WHERE catSlug = :catSlug');
$stmt->execute(array(':catSlug' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['catID'] == ''){
	header('Location: ./');
	exit;
}
// array to store page information i.e which menu or page name
$pageArray = array(
"name"  => $row["catTitle"],
"menu"  => "usermenu.php",
"style" => "style/",
"sidebar" => "sidebar.php",
"mainImage" =>"images/exampleHeader.jpg",
"headerMount" => "stickyTape.png", 
"isCat" => true
); 
include('includes/header.php');
?>
<script>
$( "li:contains('Blog')" ).addClass("active");
$( "li:contains('Portfolio')" ).removeClass("active");
$( "li:contains(<?php echo $row['catTitle'] ?>)" ).removeClass("notactive");

</script>
		<p><?php echo $row['catTitle']; ?></p>
        <p><?php echo $row['catDesc']; ?></p>
        
		<p><a href="./blog.php">Blog Entries</a></p>
            

		<div id='main'>

			<?php	
			try {

				$pages = new Paginator('6','p');

				$stmt = $db->prepare('SELECT blog_posts_seo.postID FROM blog_posts_seo, blog_post_cats WHERE blog_posts_seo.postID = blog_post_cats.postID AND blog_post_cats.catID = :catID');
				$stmt->execute(array(':catID' => $row['catID']));

				//pass number of records to
				$pages->set_total($stmt->rowCount());

				$stmt = $db->prepare('
					SELECT 
						blog_posts_seo.postID, blog_posts_seo.postTitle, blog_posts_seo.postSlug, blog_posts_seo.postDesc, blog_posts_seo.postImage,blog_posts_seo.postDate 
					FROM 
						blog_posts_seo,
						blog_post_cats
					WHERE
						 blog_posts_seo.postID = blog_post_cats.postID
						 AND blog_post_cats.catID = :catID
					ORDER BY 
						postID DESC
					'.$pages->get_limit());
				$stmt->execute(array(':catID' => $row['catID']));
				while($row = $stmt->fetch()){
					echo '<div class="blogPost"><div id="postimage"><a href="'.$row['postImage'].'" data-lightbox="blog" data-title="'.$row["postTitle"].'">';
                            echo '<div class="rImgWrap"><img src ="admin/resizeImage/'.basename($row['postImage']).'" ></div>';
							echo '<p>'.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
							echo '</a></div>';
					echo '<div id="post">';
						echo '<h1><a href="'.$row['postSlug'].$lastPage.'">'.$row['postTitle'].'</a></h1>';
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
						echo '<p>'.$row['postDesc'].'</p>';				
						echo '<p><a href="'.$row['postSlug'].$lastPage.'">Read More</a></p>';				
					echo '</div></div>';

				}
				echo "<div id='hasflex paginator' class='blogPag'>";
					echo $pages->page_links('c-'.$_GET['id'].'&');
					echo "</div>";
				

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

			?>

		</div>

<?php include('includes/footer.php');?>