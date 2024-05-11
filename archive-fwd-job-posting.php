<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
            <?php
            $args = array(
                'post_type'      => 'fwd-job-posting',
                'posts_per_page' => -1,
            );
            $query = new WP_Query( $args );

            if ( $query->have_posts() ) {
                while( $query->have_posts() ) {
                    $query->the_post(); 
                    ?>
                    <article>
                        <h2><?php the_title(); ?></h2>
                        <a href="<?php the_permalink(); ?>">    
                        </a>
                        <?php the_excerpt(); ?>
                    </article>
                    <?php
                }
                wp_reset_postdata();
            } 
            ?>
            
        <?php 
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
