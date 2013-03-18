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
    <?php if(of_get_option('okf_ribbon', '1')) {?>
    <!-- OKF Ribbon -->
		<script language="javascript" src="http://assets.okfn.org/themes/okfn/okf-panel.js" type="text/javascript"></script>
		<?php }
		if(of_get_option('hashtag_tweets', '1')) {?>
		<!-- Tweet -->
		<script language="javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/jquery.tweet.js" type="text/javascript"></script>
		<script type='text/javascript'>
		jQuery(function($){
				$("#ticker").tweet({
					query: "#<?php echo of_get_option('site_hashtag') ?>",
					page: 1,
					avatar_size: 32,
					count: 20,
					loading_text: ""
				}).bind("loaded", function() {
					var ul = $(this).find(".tweet_list");
					var ticker = function() {
						setTimeout(function() {
							ul.find('li:first').animate( {marginTop: '-4em'}, 500, function() {
							$(this).detach().appendTo(ul).removeAttr('style');
							});
							ticker();
						}, 6000);
						};
						ticker();
						});
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

	</body>
</html>