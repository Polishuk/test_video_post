<?php
 /*
 Template Name: Template [Home page]
 */
get_header(); ?>
	
<div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Hello, world!</h1>
      <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
    </div>
</div>


<div class="blog ">
    <div class="container">
		<h2 class="mt-5">Новости</h2>		
			
		<div class="row">
		 <?php 
			$args = array(
				'post_type'         => 'post',
				'post_status'       => 'publish',
				'posts_per_page' => 4
			);
			$query = new WP_Query( $args );
				 while ( $query->have_posts() ) {
					$query->the_post();   
						$post_thumbnail_id=get_post_thumbnail_id();
						$image_post_url = wp_get_attachment_image_src($post_thumbnail_id,'video-post-image');						
					?> 
				<div class="col-md-6">
				  <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
					<div class="col-12 d-none d-lg-block">
						<?php if($image_post_url) {?>
							<img class="bd-placeholder-img" src="<?php echo $image_post_url[0]?>" alt="<?php the_title()?>">
						<?php } else {?>
							<img class="bd-placeholder-img" src="<?php echo get_template_directory_uri(); ?>/img/theme-file/no-photo-full.jpg" alt="<?php the_title()?>">
						<?php }?>						  
					</div>					
					<div class="col-12 p-4 d-flex flex-column position-static">
					    <h3 class="mb-0"><?php the_title() ?></h3> 
					    <p class="card-text mb-auto">								
							<?php
								$content = get_the_content();
								$trimmed_content = wp_trim_words( $content, 20);
								echo $trimmed_content;				   
							?>
						</p>
					  <a href="<?php echo get_permalink() ?>" class="stretched-link">Подробнее</a>
					</div> 
				  </div>
				</div>
			<?php } ?>
		</div>
    </div>
</div>
	
<?php get_footer(); ?>