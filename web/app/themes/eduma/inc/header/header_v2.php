<!-- <div class="main-menu"> -->
<div class="container">
	<div class="row">
		<div class="navigation col-sm-12">
			<div class="tm-table">
				<div class="width-logo table-cell sm-logo">
					<?php
					do_action( 'thim_logo' );
					do_action( 'thim_sticky_logo' );
					?>
				</div>
				<nav class="header-top-menu table-cell table-right">
					<?php get_template_part( 'inc/header/menu-right-header-v2' ); ?>
				</nav>
				<div class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</div>
			</div>
			<nav class="width-navigation">
				<?php get_template_part( 'inc/header/main-menu' ); ?>
			</nav>
			<!--end .row-->
		</div>
	</div>
</div>