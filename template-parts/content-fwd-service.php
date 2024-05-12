<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php fwd_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();
        
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fwd' ),
				'after'  => '</div>',
			)
		);

        $args = array(
            'post_type'      => 'fwd-service',
            'posts_per_page' => -4,
            'orderby'        => 'title',
            'order'          => 'ASC'
        );
        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            while( $query->have_posts() ) {
                $query->the_post(); 
                ?>
                <h2><?php the_title(); ?></h2>
                <?php

                if ( function_exists( 'get_field' ) ) {
                    if ( get_field( 'service' ) ) {
                        the_field( 'service' );
                    }
                }
            }
            wp_reset_postdata();
        }    


		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php fwd_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
