
<ul class="hasflex" id='usermenu'>
	<li><a href='index.php' class="noCat">Home</a></li>
	<li><a href='about.php' class="noCat">About</a></li>
	<li><a href='blog.php' class="hasCat">Blog</a><?php $catId=array("c","blog"); include('sidebar.php');?></li>
	<!--Will add php scipt to auto populate li item for portfolios eventually -->
	<li><a href='portfolio.php' class="hasCat">Portfolio</a><?php $catId=array("cp","portfolio"); include('sidebar.php');?></li>
	<li><a href='contact.php' class="noCat">Contact</a></li>
</ul>
