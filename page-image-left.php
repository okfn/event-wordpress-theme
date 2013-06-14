<?php
/*
Template Name: Image Left
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
				
        
        
				<div id="main" class="span8 clearfix" role="main">
          <header>
						<?php echo do_shortcode('[featured_image height="276"]<h1>'.get_the_title().'</h1>[/featured_image]'); ?>
          </header> <!-- end article header -->
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<section class="post_content">
							<?php the_content(); ?>
					
						</section> <!-- end article section -->
						
						<footer>
							<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","bonestheme") . ': ', ', ', '</span>'); ?></p>
							<?php if(of_get_option('site_sharing', '1')) {?>
              <ul class="socialcount" data-url="<?php echo get_permalink( $post->ID ); ?>">
                <li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink( $post->ID ); ?>" title="Share on Facebook"><span class="icon icon-facebook"></span><span class="count">Like</span></a></li>
                <li class="twitter"><a href="https://twitter.com/intent/tweet?text=<?php echo get_permalink( $post->ID ); ?>" title="Share on Twitter"><span class="icon icon-twitter"></span><span class="count">Tweet</span></a></li>
                <li class="googleplus"><a href="https://plus.google.com/share?url=<?php echo get_permalink( $post->ID ); ?>" title="Share on Google Plus"><span class="icon icon-googleplus"></span><span class="count">+1</span></a></li>        
              </ul> 
          		<?php } ?>
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "bonestheme"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    		
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>