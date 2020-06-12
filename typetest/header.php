<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo wp_get_document_title(); ?></title>
		  
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header>
	  <nav class="navbar navbar-expand-md navbar-dark  bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="container collapse navbar-collapse" id="navbarCollapse">
			<?php wp_nav_menu( [ 
				'menu_class' => 'navbar-nav mr-auto',
				'theme_location'  => 'menu-header',
				'container'       =>  false,
				'menu_id'   => 'nav'
			] ); ?>		
		</div>
	  </nav>
	</header>

	<main role="main">