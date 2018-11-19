<?php require('includes/config.php'); 


$stmt = $db->prepare('SELECT catID,catTitle, catDesc FROM portfolio_cats WHERE catSlug = :catSlug');
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
"headerMount" => "photomount.png",
"isCat" => true
); 
include('includes/header.php');
?>
<script>
$( "li:contains('Portfolio')" ).addClass("active");
$( "li:contains(<?php echo $row['catTitle'] ?>)" ).removeClass("notactive");


</script>

		<div id='main' class="hasflex portMain">
        <p><?php echo $row['catTitle']; ?></p>
		<p><?php echo $row['catDesc']; ?></p>
			<?php	
			try {

				$pages = new Paginator('6','p');

				$stmt = $db->prepare('SELECT portfolio_posts_seo.postID FROM portfolio_posts_seo, portfolio_post_cats WHERE portfolio_posts_seo.postID = portfolio_post_cats.postID AND portfolio_post_cats.catID = :catID');
				$stmt->execute(array(':catID' => $row['catID']));

				//pass number of records to
				$pages->set_total($stmt->rowCount());

				$stmt = $db->prepare('
					SELECT 
						portfolio_posts_seo.postID, portfolio_posts_seo.postTitle, portfolio_posts_seo.postSlug, portfolio_posts_seo.postDesc, portfolio_posts_seo.postImage, portfolio_posts_seo.postDate 
					FROM 
						portfolio_posts_seo,
						portfolio_post_cats
					WHERE
						 portfolio_posts_seo.postID = portfolio_post_cats.postID
						 AND portfolio_post_cats.catID = :catID
					ORDER BY 
						postID DESC
					'.$pages->get_limit());
				$stmt->execute(array(':catID' => $row['catID']));
				while($row = $stmt->fetch()){
					echo '<div class="portPost"><div id="postimage"><a href="'.$row['postImage'].'" data-lightbox="portfolio" data-title="'.$row["postTitle"].'">';
                            echo '<div class="rImgWrap"><img src ="admin/resizeImage/'.basename($row['postImage']).'" ></div>';
							//echo '<p>'.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
							echo '</a></div>';
					echo '<div id="post">';
						//echo '<h1><a href="p-'.$row['postSlug'].$lastPage.'">'.$row['postTitle'].'</a></h1>';
						//echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).' in ';

							$stmt2 = $db->prepare('SELECT catTitle, catSlug	FROM portfolio_cats, portfolio_post_cats WHERE portfolio_cats.catID = portfolio_post_cats.catID AND portfolio_post_cats.postID = :postID');
							$stmt2->execute(array(':postID' => $row['postID']));

							$catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);

							$links = array();
							foreach ($catRow as $cat)
							{
							    $links[] = "<a href='cp-".$cat['catSlug']."'>".$cat['catTitle']."</a>";
							}
							echo implode(", ", $links);

						echo '</p>';
						echo '<p>'.$row['postDesc'].'</p>';				
						echo '<p><a href="p-'.$row['postSlug'].$lastPage.'">Read More</a></p>';				
					echo '</div></div>';

				}
				echo "<div id='hasflex paginator' class='portPag'>";
					echo $pages->page_links('cp-'.$_GET['id'].'&');
					echo "</div>";
					

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

			?>
					
		</div>
        
        <div id="mainText">
		<a href="./portfolio.php"><p>Portfolio Index</p></a>
        </div>

<?php include('includes/footer.php');?>