<?php require('includes/config.php'); 
// array to store page information i.e which menu or page name
   $pageArray = array(
"name"  => "HuntByte - Blog",
"style" => "style/",
"images" => "images/",
"boot" => "bootstrap/css/");
?>

<?php include('includes/header.php');
	include('includes/menu.php');
	include('includes/leftbar.php');?>
<script>
$( "li:contains('Blog')" ).addClass("active");
</script>

<div class="right">
			<?php
				try {

					$pages = new Paginator('3','p');

					$stmt = $db->query('SELECT postID FROM blog_posts_seo');

					//pass number of records to
					$pages->set_total($stmt->rowCount());

					$stmt = $db->query('SELECT postID, postTitle, postSlug, postDesc, postDate FROM blog_posts_seo ORDER BY postID DESC '.$pages->get_limit());
					while($row = $stmt->fetch()){
						echo '<div id="post">';
							echo '<h1><a href="'.$row['postSlug'].$lastPage.'">'.$row['postTitle'].'</a></h1>';
							echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate']));


							echo '</p>';
                            
							echo '<p>'.$row['postDesc'].'</p>';				
							echo '<p><a href="'.$row['postSlug'].$lastPage.'">Read More</a></p>';
						echo '</div>';
					}

					echo $pages->page_links();

				} catch(PDOException $e) {
				    echo $e->getMessage();
				}
			?>

</div>
<?php include('includes/footer.php');?>