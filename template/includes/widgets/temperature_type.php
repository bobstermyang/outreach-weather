<ul class="collection with-header">	
	<li id="change_degree_type" data-default-degree-type="<?php echo $settings->degree_type; ?>" class="collection-item pointer">
		<?php 
		$degree_type = (isset($_COOKIE['degree_type'])) ? $_COOKIE['degree_type'] : $settings->degree_type;

		echo $language->home->sidebar->degree_type . ' <span id="degree_type_value">' . $degree_type . '</span>'; 

		?>
	</li>
</ul>