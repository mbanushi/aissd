<?php get_header(); ?>

<div class="row">
	<div class="col-sm-9">
		<div class="clearfix">
			<?php dynamic_sidebar('before-content-bar') ?>
			<hr />
		</div>
		<div class="clearfix">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<article><?php the_content(); ?></article>
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, this page no longer exists.'); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-sm-3">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>