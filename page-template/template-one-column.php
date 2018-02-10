<?php
/**
 * Template Name:1カラム
 * Template Post Type:post,page
 * Description:ワンカラムテンプレート
 */
get_header(); ?>
<div class="container">
	<div class="content-area content__wrap">
		<main id="main" class="site-main content__main">
			<?php
			while ( have_posts() ) : the_post();
				if( is_page() ){
					get_template_part( 'template-parts/content/page' );
				} else {
					get_template_part( 'template-parts/content/single' );
				}
			endwhile;
			?>
		</main><!-- .site-main -->
		<?php //get_sidebar(); ?>
	</div><!-- .content-area -->
</div><!-- .container -->
<?php get_footer(); ?>