<nav class="indigo lighten-2">
	<div class="container">
		<div class="nav-wrapper">

			<a href="index" class="brand-logo"><?php echo $settings->title; ?></a>

			<ul id="nav-mobile" class="right side-nav">
				<li><a href="index"><?php echo $language->global->menu->home; ?></a></li>

				<?php if(User::logged_in() && User::is_admin($account_user_id)) { ?>

					<li><a class="dropdown-button" href="#!" data-activates="menu1"><?php echo $language->global->menu->admin; ?><i class="mdi-navigation-arrow-drop-down right"></i></a></li>

					<li><a href="logout"><?php echo $language->global->menu->logout; ?></a></li>

				<?php } ?>
			</ul>

			<a class="button-collapse" href="#" data-activates="nav-mobile"><i class="mdi-navigation-menu"></i></a>

		</div>
	</div>
</nav>

<ul id="menu1" class="dropdown-content">
	<li><a href="settings/password"><?php echo $language->change_password->menu; ?></a></li>
	<li><a href="admin/users-management"><?php echo $language->admin_users_management->menu; ?></a></li>
	<?php if(User::get_type($account_user_id) > 1) { ?>
	<li><a href="admin/website-settings"><?php echo $language->admin_website_settings->menu; ?></a></li>
	<?php } ?>
</ul>