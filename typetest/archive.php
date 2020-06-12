<?php
	get_header();
?>

	<div id="primary" class="container">
		<main id="main" class="row">
		<div class="col-12">
			<?php if ( have_posts() ) : ?>

				<div class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</div>

				<?php while ( have_posts() ) : the_post(); 
					$post_thumbnail_id=get_post_thumbnail_id();
					$image_post_url = wp_get_attachment_image_src($post_thumbnail_id,'thumbnail');					
				?>

						<div id="post-<?php the_ID()?>" class="post-item">
							<div class="post-title">
								<a href="<?php echo  get_permalink()?>">
									<?php the_title()?>
								</a>
							</div>
							<div class="post-thumbnail">
								<?php if($image_post_url) {?>
									<img src="<?php echo $image_post_url[0]?>" alt="<?php the_title()?>">
								<?php } else {?>
									<img src="<?php echo get_template_directory_uri(); ?>/img/theme-file/no-photo-full.jpg" alt="<?php the_title()?>">
								<?php }?>
							</div>
							<div class="post-data">
								<?php the_time('d.m.Y')?>
							</div>
							<div class="post-description">
								<?php
									$content = get_the_content();
									$trimmed_content = wp_trim_words( $content, 20);
									echo $trimmed_content;				   
								?>
							</div>			
						</div>

				<?php endwhile;

					the_posts_navigation();

					else :

						echo 'Категория пустая';

					endif;
				?>
			</div>
		</main>
	</div>

<?php get_footer();
