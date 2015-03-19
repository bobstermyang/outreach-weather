<ul class="collection with-header">
	<li class="collection-header"><h5><?php echo $language->home->sidebar->latest; ?></h5></li>
	
	<?php 
	$result = $database->query("SELECT `location` FROM `searches` ORDER BY `id` DESC LIMIT 5");
	while($search = $result->fetch_object()) echo '<li class="collection-item"><a href="#" data-location="' . $search->location . '">' . $search->location . '</a></li>'
	?>

</ul>