<?php get_header(); ?>

<div class="row">
	<div class="col-sm-9">
		<div class="clearfix">
			<?php dynamic_sidebar('before-content-bar') ?>
			<hr />
		</div>
		<div class="clearfix row">
			<div class="announcements-exerpts col-sm-6">
				<!-- loopi per annoucements -->
				<?php query_posts('category_name=Announcements'); ?>
				<?php while(have_posts()): the_post(); ?>
				<section class="post-excerpt panel panel-info clearfix">
					<header class="panel-heading">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</header>
					<div class="panel-body">
						<p><?php the_excerpt(); ?></p>
					</div>
				</section>
				<?php endwhile; ?>
			</div>
			
			<div class="activities-exerpts col-sm-6">
				<?php rewind_posts(); ?>
				<?php query_posts('category_name=Activities'); ?>
				<!-- loopi per activities -->
				<?php while(have_posts()): the_post(); ?>
				<section class="post-excerpt panel panel-info clearfix">
					<header class="panel-heading">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</header>
					<div class="panel-body">
						<p><?php the_excerpt(); ?></p>
					</div>
				</section>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>