<?php
 /*
 Template Name: Template [Contacts page]
 */
get_header(); ?>
	
	<div id="primary" class="container pt-5 pb-5">
		<main id="main" class="row">
			<div class="col-12">
				<div id="post-<?php the_ID()?>" class="page-content">
					<?php while ( have_posts() ) { the_post(); 
						$post_thumbnail_id=get_post_thumbnail_id();
						$image_post_url = wp_get_attachment_image_src($post_thumbnail_id,'full');							
					?>
						<div class="page-header">
							<?php the_title( '<h1 class="page-title">', '</h1>' );?>
						</div>
						<div class="page-images">
							<?php if($image_post_url) {?>
								<img src="<?php echo $image_post_url[0]?>" alt="<?php the_title()?>">
							<?php } else {?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/theme-file/no-photo-full.jpg" alt="<?php the_title()?>">
							<?php }?>
						</div>
						<div class="page-text pt-5">
							<?php the_content();?>
						</div>
					<?php } ?>
				</div>
			</div>
		</main>
	</div>
	
<?php get_footer(); ?>