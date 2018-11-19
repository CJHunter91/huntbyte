<?php require('includes/config.php'); 
// array to store page information i.e which menu or page name
$pageArray = array(
"name"  => "Blog",
"menu"  => "usermenu.php",
"style" => "style/",
"sidebar" => "sidebar.php",
"mainImage" =>"images/exampleHeader.jpg",
"headerMount" => "stickyTape.png");
?>

<?php include('includes/header.php');?>
<script>
$( "li:contains('Blog')" ).addClass("active");
</script>

<div class="hasflex" id='main'>
			<?php
				try {

					$pages = new Paginator('5','p');

					$stmt = $db->query('SELECT postID FROM blog_posts_seo');

					//pass number of records to
					$pages->set_total($stmt->rowCount());

					$stmt = $db->query('SELECT postID, postTitle, postSlug, postDesc, postDate, postImage FROM blog_posts_seo ORDER BY postID DESC '.$pages->get_limit());
					while($row = $stmt->fetch()){
							echo '<div class="blogPost"><div id="postimage"><a href="'.$row['postImage'].'" data-lightbox="blog" data-title="'.$row["postTitle"].'">';
                            echo '<div class="rImgWrap"><img src ="admin/resizeImage/'.basename($row['postImage']).'" ></div>';
							echo '<p>'.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
							echo '</a></div>';
						echo '<div id="post">';
							echo '<h1><a href="'.$row['postSlug']. $lastPage.'">'.$row['postTitle'].'</a></h1>';
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
							echo '<p><a href="'.$row['postSlug']. $lastPage.'">Read More</a></p>';
						echo '</div></div>';
					}
					
					echo "<div id='hasflex paginator' class='blogPag'>";
					echo $pages->page_links();
					echo "</div>";

				} catch(PDOException $e) {
				    echo $e->getMessage();
				}
			?>

</div>
<?php include('includes/footer.php');?>