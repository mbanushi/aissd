<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description') ?>">
    <meta name="author" content="Communication Progress ltd">
    <!--<link rel="shortcut icon" href="">-->

    <title><?php wp_title('|',1,'right'); bloginfo('name'); ?></title>

    <!-- Le styles -->
    <link href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

		<?php wp_enqueue_script("jquery"); ?>
			
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
		
		<?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
		<div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url(); ?>"><img id="logo" class="img-responsive" src="<?php echo get_template_directory_uri() . '/bootstrap/img/logo.png'; ?>" alt="<?php bloginfo('name'); ?>" /></a>
        </div>
        <div class="navbar-collapse collapse" id="header-collapse">
          <?php get_search_form(); ?>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
		<div class="navbar-bot-border"></div>
		<div id="top-zone">
			<div class="container">
				<header>
					<?php wp_nav_menu( array( 
							'theme_location' => 'header-menu', 
							'menu_class' => 'nav top-menu list-inline', 
							'container' => '',
						) 
					); ?>
				</header>
			</div>
		</div>
		
		<div id="mid-zone">
			<div class="content container">