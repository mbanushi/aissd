<?php get_header(); ?>

<section class="jumbotron">
	<div id="home-slider" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#home-slider" data-slide-to="0" class="active"></li>
    <li data-target="#home-slider" data-slide-to="1"></li>
    <li data-target="#home-slider" data-slide-to="2"></li>
    <li data-target="#home-slider" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
		<?php $slide_query = new WP_Query(array(
			'post_type' => 'carousel-slide',
			'posts_per_page' => 4,
		)); ?>
		
		<?php $nr_slide = 0; ?>
		<?php while($slide_query->have_posts()): ?>
			<?php $this_post = $slide_query->the_post(); ?>
			<div class="item <?php if($nr_slide++ === 0) echo 'active'; ?>">
				<?php echo get_the_post_thumbnail($this_post->ID, array(600,375), array('class' => 'img-responsive')) ;?>
				<div class="carousel-caption">
					<h2><?php the_title(); ?></h2>
					<h3><?php the_excerpt(); ?></h3>
				</div>
			</div>
		<?php endwhile; ?>

  </div>

  <!-- Controls -->
  <!-- <a class="left carousel-control" href="#home-slider" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#home-slider" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a> -->
</div>
</section>

<section id="homepage-wrapper">
	<?php the_post(); ?>
	<?php the_content(); ?>
</section>


<?php get_footer(); ?>