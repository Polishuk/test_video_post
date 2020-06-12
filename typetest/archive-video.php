<?php
	get_header();
?>

	<div id="primary" class="container">

		<div class="jumbotron">
			<div class="container">
			
				<?php
					the_archive_title( '<h1 class="display-3 page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			
				<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
					<div>
						<label>
							<input type="radio" name="order" value="ASC" /> Order: ASC
						</label>
					</div>
					<div>
						<label>
							<input type="radio" name="order" value="DESC" selected="Order" /> Date: DESC
						</label>
					</div>
					<div>
						<div class="loader"></div>
					</div>
					<input type="hidden" name="action" value="myfilter">
				</form>
				
			</div>
		</div>

	
		<main id="response" class="row">
	
			<?php if ( have_posts() ) : ?>


				<?php while ( have_posts() ) : the_post(); 
					$post_thumbnail_id=get_post_thumbnail_id();
					$image_post_url = wp_get_attachment_image_src($post_thumbnail_id,'video-post-image');					
				?>
					
						<div class="col-md-4">
						  <div id="video-post-<?php the_ID()?>" class="card mb-4 shadow-sm">
							
							<div class="card-body">
								<p class="card-title">	<?php the_title()?></p>
								<small class="text-muted"><?php the_time('d.m.Y')?></small>
							</div>
							
							<?php if($image_post_url) {?>
								<img class="bd-placeholder-img card-img-top" src="<?php echo $image_post_url[0]?>" alt="<?php the_title()?>">
							<?php } else {?>
								<img class="bd-placeholder-img card-img-top" src="<?php echo get_template_directory_uri(); ?>/img/theme-file/no-photo-full.jpg" alt="<?php the_title()?>">
							<?php }?>							
							
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
									  <button type="button" class="btn btn-sm btn-outline-secondary">Order - <?php the_field('order')?></button>
									  <button type="button" class="btn btn-sm btn-outline-secondary">Автор - <?php the_field('autor')?></button>
									</div>
									
								</div>
							</div>
						  </div>
						</div>						
						

				<?php endwhile;

					the_posts_navigation();

					else :

						echo 'Категория пустая';

					endif;
				?>
		</main>
	</div>

<?php get_footer();
