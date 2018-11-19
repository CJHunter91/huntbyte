<?php require('includes/config.php'); 
// array to store page information i.e which menu or page name
$pageArray = array(
"name"  => "Portfolio",
"menu"  => "usermenu.php",
"style" => "style/",
"sidebar" => "sidebar.php",
"mainImage" =>"images/exampleHeader.jpg",
"headerMount" => "photomount.png"
); ?>

<?php include('includes/header.php');?>
<script>
$( "li:contains('Portfolio')" ).addClass("active");
</script>
<div class="hasflex portMain" id='main'>
			<?php
				try {

					$pages = new Paginator('6','p');

					$stmt = $db->query('SELECT postID FROM portfolio_posts_seo');

					//pass number of records to
					$pages->set_total($stmt->rowCount());

					$stmt = $db->query('SELECT postID, postTitle, postSlug, postDesc, postDate, postImage FROM portfolio_posts_seo ORDER BY postID DESC '.$pages->get_limit());
					while($row = $stmt->fetch()){
							echo '<div class="portPost"><div id="postimage"><a href="'.$row['postImage'].'" data-lightbox="portfolio" data-title="'.$row["postTitle"].'">';
                            echo '<div class="rImgWrap"><img src ="admin/resizeImage/'.basename($row['postImage']).'" ></div>';
							echo '</a></div>';
						echo '<div id="post">';
							
						echo '</div></div>';
					}
					echo "<div id='hasflex paginator' class='portPag'>";
					echo $pages->page_links();
					echo "</div>";

				} catch(PDOException $e) {
				    echo $e->getMessage();
				}
			?>

</div>

<?php include('includes/footer.php');?>