			</div> <!-- .content -->
		</div> <!-- #mid-zone -->
		<div class="bot-zone-top-border"></div>
		<div id="bot-zone">
			<div class="container">
				<footer>
					<?php cpwpbs_wp_nav_menu( array( 
							'theme_location' => 'footer-menu', 
							'menu_class' => 'row list-unstyled well', 
							'container' => '',
							'depth' => 2,
							
						) 
					); ?>
					<hr class="clearfix" />
					<div id="footer-links-copyright" class="row">
						<?php dynamic_sidebar('footer-links') ?>
					</div>
				</footer>
			</div>
    </div>
		
		<?php wp_footer(); ?>
		
  </body>
</html>