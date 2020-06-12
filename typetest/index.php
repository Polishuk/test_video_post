<?php get_header(); ?>

	<div id="primary" class="container">
		<main id="main" class="row">
			<div class="col-12">
				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>
						<div>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</div>
						<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) :
						the_post(); ?>

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

				<?	endwhile;

					the_posts_navigation();

				else :

					echo 'Новостей на сайте нету';

				endif;
				?>
			</div>
		</main>
	</div>

<?php
get_footer();
