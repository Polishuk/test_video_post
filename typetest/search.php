<?php get_header(); ?>

	<div id="primary" class="container">
		<main id="main" class="row">
			<div class="col-12">
				<div class="page-header">
					<h1 class="page-title">
						<?php
							printf( esc_html__( 'Результаты поиска: %s', 'clean' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</div>			
				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>

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

				<?php	endwhile;

					the_posts_navigation();

				else : ?>
					
					<p>
						По данному запросу ничего не обнаружено на сайте. Измените Ваш запрос и попробуйте снова.
					</p>
					<p>
						<?php get_search_form(); ?>
					</p>
					<a class="btn btn-outline-success" href="<?php echo get_home_url(); ?>">
						Вернутся на главную 
					</a>			

				<?php endif; ?>
			</div>
		</main>
	</section>

<?php get_footer();
