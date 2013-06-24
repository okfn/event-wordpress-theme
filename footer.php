			<footer role="contentinfo">
			
				<div id="inner-footer" class="clearfix">
		          <hr />
		          <div id="widget-footer" class="clearfix row">
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
		            <?php endif; ?>
		          </div>
					
					<nav class="clearfix">
						<?php bones_footer_links(); // Adjust using Menus in Wordpress Admin ?>
					</nav>
				
				</div> <!-- end #inner-footer -->
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
				
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>
    
    <?php if(of_get_option('search_bar', '1')) {?>
    <script type='text/javascript'>
		  $("div.navbar-search a").click(function(){
			  $("div.navbar-search").toggleClass("active");
			});
		</script>   
    <?php } ?>
    
    <!-- Dot Dot Dot -->
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/jquery.dotdotdot-1.5.6-packed.js"></script>
    
    <?php if(of_get_option('site_sharing', '1')) {?>
    <!-- SocialCount -->
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/socialcount.js"></script>
    <?php } ?>
    
    <!-- Image Placeholder -->
    <script src="<?php echo get_template_directory_uri(); ?>/library/js/holder.js"></script>
    
    <!--[if lt IE 10]>
      <script src="<?php echo get_template_directory_uri(); ?>/library/js/css3-multi-column.js"></script>
    <![endif]-->

	</body>
</html>