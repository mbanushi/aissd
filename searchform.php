<form role="search" method="get" class="search-form navbar-form navbar-right" action="<?php echo home_url( '/' ); ?>">
	<div class="form-group">
		<span class="screen-reader-text hidden">Search for:</span>
		<div class="search-wrapper">
			<span class="glyphicon glyphicon-search"></span>
			<input type="search" class="search-field" placeholder="<?php _e( 'Search ...', 'cpwpbs');  ?>" value="" name="s" title="Search for:" />
		</div>
	</div>
	<input type="submit" class="search-submit hidden" value="Search" />
</form>