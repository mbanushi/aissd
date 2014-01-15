<?php get_header(); ?>

<div class="row">
	<div class="col-sm-9">
		<div class="clearfix">
			<?php dynamic_sidebar('before-content-bar') ?>
			<hr />
		</div>
		<div class="clearfix row">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<section class="post-excerpt col-sm-8 col-sm-offset-2 panel panel-info">
					<header class="panel-heading">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</header>
					<div class="panel-body">
						<p><?php the_excerpt(); ?></p> <!-- ne fund te excerpt printohet edhe linku Read More automatikisht -->
					</div>
				</section>
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
		</div>
	</div>
	<div class="col-sm-3">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>