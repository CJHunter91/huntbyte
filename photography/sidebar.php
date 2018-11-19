
<?php
//$stmt = $db->query('SELECT postTitle, postSlug FROM blog_posts_seo ORDER BY postID DESC LIMIT 5');
//while($row = $stmt->fetch()){
//	echo '<li><a href="'.$row['postSlug'].'">'.$row['postTitle'].'</a></li>';}
?>



<ul class="hasflex" id="catbar">
<?php
//echo '<li class="titleLi">'.ucfirst($catId[1]).'</li>';
$stmt2 = $db->query('SELECT catTitle, catSlug FROM '.$catId[1].'_cats ORDER BY catID DESC');
while($row2 = $stmt2->fetch()){
	echo '<li class="notactive"><a href="'.$catId[0].'-'.$row2['catSlug'].'">'.$row2['catTitle'].'</a></li>';}
?>
</ul>

<?php
//$stmt = $db->query("SELECT Month(postDate) as Month, Year(postDate) as Year FROM blog_posts_seo GROUP BY Month(postDate), Year(postDate) ORDER BY postDate DESC");
//while($row = $stmt->fetch()){
//	$monthName = date("F", mktime(0, 0, 0, $row['Month'], 10));
//	$slug = 'a-'.$row['Month'].'-'.$row['Year'];
//	echo "<li><a href='$slug'>$monthName</a></li>";}
?>
