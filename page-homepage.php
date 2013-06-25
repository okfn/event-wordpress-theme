<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="span12 clearfix" role="main">

			
<?php $use_carousel = of_get_option('showhidden_slideroptions');
      if ($use_carousel) {
  
			$args = array(  
					'numberposts' => -1, // Using -1 loads all posts  
					'orderby' => 'menu_order', // This ensures images are in the order set in the page media manager  
					'order'=> 'ASC',  
					'post_mime_type' => 'image', // Make sure it doesn't pull other resources, like videos  
					'post_parent' => $post->ID, // Important part - ensures the associated images are loaded 
					'post_status' => null, 
					'post_type' => 'attachment'  
			);  
				
			$images = get_children( $args );  
			
			if($images){
			$item_num = 0;
			$homepageTagline = get_post_meta($post->ID, 'custom_tagline' , true)
			 ?>  
					<div id="homeCarousel" class="carousel<?php if (empty($homepageTagline)) { echo ' slide carousel-fade';} ?>">
						<!-- Carousel items -->
						<div class="carousel-inner">
							<?php foreach($images as $image){ 
							$item_num += 1;
							?>
							<div class="item<?php if($item_num == 1){ echo ' active'; } ?>">
								<img src="<?php echo $image->guid; ?>" alt="<?php echo $image->post_title; ?>" title="<?php echo $image->post_title; ?>" /> 
								<?php if (empty($homepageTagline)) { ?>
                  <div class="carousel-caption">
                    <?php echo $image->post_excerpt; ?>
                  </div>
                <? } ?>
							</div>
							<?php    } ?> 
						</div>
            <?php if (!empty($homepageTagline)) { echo '<div class="homepage-tagline">'.$homepageTagline.'</div>';} ?>
					</div>
			<?php } ?>  
	<? } else { ?>
    <div class="hero-unit">
      <div class="inner">
          <?php //the_post_thumbnail( 'wpbs-featured-home' ); ?>
          
          <?php echo get_post_meta($post->ID, 'custom_tagline' , true);?>
      </div>
    </div>
  <? } ?>
					
					<?php /*

					$use_carousel = of_get_option('showhidden_slideroptions');
      				if ($use_carousel) {

					?>

					<div id="myCarousel" class="carousel">

					    <!-- Carousel items -->
					    <div class="carousel-inner">

					    	<?php
							global $post;
							$tmp_post = $post;
							$show_posts = of_get_option('slider_options');
							$args = array( 'numberposts' => $show_posts ); // set this to how many posts you want in the carousel
							$myposts = get_posts( $args );
							$post_num = 0;
							foreach( $myposts as $post ) :	setup_postdata($post);
								$post_num++;
								$post_thumbnail_id = get_post_thumbnail_id();
								$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-carousel' );
							?>

						    <div class="<?php if($post_num == 1){ echo 'active'; } ?> item">
						    	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'wpbs-featured-carousel' ); ?></a>

							   	<div class="carousel-caption">

					                <h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					                <p>
					                	<?php
					                		$excerpt_length = 100; // length of excerpt to show (in characters)
					                		$the_excerpt = get_the_excerpt(); 
					                		if($the_excerpt != ""){
					                			$the_excerpt = substr( $the_excerpt, 0, $excerpt_length );
					                			echo $the_excerpt . '... ';
					                	?>
					                	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="btn btn-primary">Read more &rsaquo;</a>
					                	<?php } ?>
					                </p>

				                </div>
						    </div>

						    <?php endforeach; ?>
							<?php $post = $tmp_post; ?>

					    </div>

					    <!-- Carousel nav -->
					    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				    </div>

				    <?php } // ends the if use carousel statement */ ?>

					
					<?php if(of_get_option('hashtag_tweets', '1') && (is_plugin_active('jm-last-twit-shortcode/jm-ltsc.php'))) {?>
            <div class="twitter-ticker">
              <a href="https://twitter.com/#!/search/%23<?php echo of_get_option('site_hashtag') ?>" class="hash-link">#<?php echo of_get_option('site_hashtag') ?></a>
              <div id="twitterCarousel" class="carousel slide">
							  <? echo apply_filters("the_content","[jmlt count='20']") ?>
              </div>
            </div>
          <?php } ?>
                

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<section class="row post_content">
						
							<div class="span12">
						
								<?php the_content(); ?>
								
							</div>
							
							<?php //get_sidebar('sidebar2'); // sidebar 2 ?>
													
						</section> <!-- end article header -->
						
						<?php if(of_get_option('home_blog', '1')) {?>
              <section class="blog-latest">
      				  <div class="row">
									<?php
									if (of_get_option('home_blog_number')) {
									  $postnumber = of_get_option('home_blog_number');
									}
									else {
										$postnumber = '4';
									}
									$postcolumn = 12 / $postnumber;
                  $poststoshow = 'numberposts='.$postnumber;
									if (get_the_title( get_option('page_for_posts', true) )) {
                	  $ribbontext = get_the_title( get_option('page_for_posts', true) );
									} else {
										$ribbontext = 'blog-test';
									}
									
                  $postslist = get_posts($poststoshow);
                  foreach ($postslist as $post) :
                    setup_postdata($post);
                  ?>
                   
                  <?php 
                  if (wp_get_attachment_url( get_post_thumbnail_id($post->ID) )) {
                    $imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                  }
                  else {
                    $imgurl = '?holder.js/460x276/text:image&nbsp;coming&nbsp;soon';
                  }
                  ?>
                  
                    <div class="span<? echo $postcolumn ?>">
                      <a class="post holderjs" href="<?php the_permalink(); ?>" style="background-image:url(<?php echo $imgurl ?>)">
                        <span class="text highlight accent">
													<?php the_title(); ?>
                          <?php //the_excerpt() ?>
                        </span>
                        <span class="ribbon">
                          <span class="inner">
                            <?php echo $ribbontext; ?>
                          </span>
                        </span>
                      </a>
                    </div>
                  
                  <?php endforeach ?>
                </div>
          	 </section>
            <?php } ?>
          
						<footer>
							<p class="clearfix"><?php //the_tags('<span class="tags">' . __("Tags","bonestheme") . ': ', ', ', '</span>'); ?></p>
							<?php if(of_get_option('site_sharing', '1') && of_get_option('home_sharing')) {?>
              <ul class="socialcount" data-url="<?php echo get_permalink( $post->ID ); ?>">
                <li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink( $post->ID ); ?>" title="Share on Facebook"><span class="icon icon-facebook"></span><span class="count">Like</span></a></li>
                <li class="twitter"><a href="https://twitter.com/intent/tweet?text=<?php echo get_permalink( $post->ID ); ?>" title="Share on Twitter"><span class="icon icon-twitter"></span><span class="count">Tweet</span></a></li>
                <li class="googleplus"><a href="https://plus.google.com/share?url=<?php echo get_permalink( $post->ID ); ?>" title="Share on Google Plus"><span class="icon icon-googleplus"></span><span class="count">+1</span></a></li>        
              </ul>
              <?php } ?>
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
          
          
					<?php 
						// No comments on homepage
						//comments_template();
					?>
					
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
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<script>
    $('#homeCarousel').carousel({
    interval: 3000
    })
		$(".twitter-ticker #twitterCarousel .tweetfeed").addClass("carousel-inner");
		$(".twitter-ticker #twitterCarousel .tweetfeed > li").addClass("item");
		$(".twitter-ticker #twitterCarousel .tweetfeed > li:first-of-type").addClass("active");
		$('#twitterCarousel').carousel({
    interval: 6000
    })
</script>
<?php get_footer(); ?>