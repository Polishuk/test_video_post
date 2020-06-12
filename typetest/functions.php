<?php
if ( ! function_exists( 'clean_setup' ) ) :
	function clean_setup() {

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'custom-logo', [
			'height'      => 132,
			'width'       => 79,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => '',
		] );
		
		add_theme_support( 'align-wide' );
		
		add_theme_support( 'responsive-embeds' );
		
		register_nav_menus( array(
			'menu-header' => esc_html__( 'Header menu' )
		) );
	}
endif;
add_action( 'after_setup_theme', 'clean_setup' );

define("THEME_DIR", get_template_directory_uri());

remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
remove_action( 'wp_head', 'wp_resource_hints', 2);
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('template_redirect', 'wp_shortlink_header');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

add_filter('the_generator', '__return_empty_string'); 
remove_action( 'wp_head', 'wp_resource_hints', 2); 
remove_action( 'wp_head','locale_stylesheet');

function site_scripts() {
    wp_enqueue_style( 'font-awesome', THEME_DIR .    '/moduls/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_style( 'bootstrap-min', THEME_DIR .   '/css/bootstrap.min.css' );
    wp_enqueue_style( 'site-style', THEME_DIR .      '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'site_scripts' );

add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){
    wp_localize_script('jquery-vendor', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php')
            //js url: myajax.url,
        )
    );
}

function my_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', THEME_DIR .              '/js/jquery-3.0.0.js', false, null, false);
	wp_enqueue_script( 'jquery-migrate', THEME_DIR .      '/js/jquery-migrate-3.0.1.js', false, null, false);
    wp_enqueue_script( 'jquery-custom', THEME_DIR .       '/js/custom.js', array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method', 11 );

add_filter( 'get_the_archive_title', 'artabr_remove_name_cat' );
function artabr_remove_name_cat( $title ){
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif (is_tax()){
        $title = single_term_title( '', false );
    } elseif ( is_tax('category-products') ) {
        $title = single_tag_title( '', false );
    }
    return $title;
}


add_image_size('video-post-image',800, 400, true  );   

add_filter( 'get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
}); // убираем слова Архив 

// удалить атрибут type у scripts и styles
add_filter('style_loader_tag', 'clean_style_tag');
function clean_style_tag($src) {
    return str_replace("type='text/css'", '', $src);
}

add_filter('script_loader_tag', 'clean_script_tag');
function clean_script_tag($src) {
    return str_replace("type='text/javascript'", '', $src);
}

function create_video() {
    register_post_type( 'video',
        array(
            'labels' => array(
                'name' => 'Видео',
                'singular_name' => 'Видео'
            ),
			'hierarchical' => true,
            'public' => true,
            'menu_position' => 21,
            'supports' => array( 'title','thumbnail'),
            'menu_icon' => 'dashicons-format-video',
            'show_tagcloud' => true,
            'rewrite' => array( 'slug' => 'video' ),
            'has_archive' => true
        )
    );
}
add_action( 'init', 'create_video' );

function true_custom_fields() {
	add_post_type_support( 'video', 'custom-fields'); 
}
 
add_action('init', 'true_custom_fields');


add_filter( 'nav_menu_css_class', 'filter_nav_menu_css_classes', 10, 4 );
function filter_nav_menu_css_classes( $classes, $item, $args, $depth ) {
	if ( $args->theme_location === 'menu-header' ) {

		$classes = [
			'nav-item '
		];		
	
		if ( $item->current ) {
			$classes[] = 'active';
		}
	}
	return $classes;
}

add_filter( 'nav_menu_link_attributes', 'filter_nav_menu_link_attributes', 10, 4 );
function filter_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
	if ( $args->theme_location === 'menu-header' ) {

		$atts['class'] = 'nav-link';
	}
	return $atts;
}



add_action('wp_ajax_myfilter', 'custom_filter_function'); 
add_action('wp_ajax_nopriv_myfilter', 'custom_filter_function');
 
function custom_filter_function(){
	$args = array(
		'post_type'   => 'video',
		'orderby'     => 'meta_value_num',
		'meta_key'    => 'order',  
		'order'       => $_POST['order'] 
	);
 
	$query = new WP_Query( $args );
 
	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();
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
		wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;
 
	die();
}
