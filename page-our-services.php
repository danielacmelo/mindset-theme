<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
        ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->
            
                <?php fwd_post_thumbnail(); ?>
            
                <div class="entry-content">
                    <?php
                    the_content();

                    // Display  Nav Services
                    $args = array(
                        'post_type'      => 'fwd-service',
                        'posts_per_page' => -1,
                        'orderby'        => 'title',
                        'order'          => 'ASC',
                    );
            
                    $query = new WP_Query( $args );
            
                    if ( $query->have_posts() ) {
                        echo "<nav class='service-links'>";
                        while( $query->have_posts() ) {
                            $query->the_post(); 
                            echo '<a href="#'. esc_attr( get_the_ID() ) .'">'. esc_html( get_the_title() ) .'</a>';   
                        }
                        wp_reset_postdata();
                        echo "</nav>";
                    }   
                    
                    // Display Services
                    $taxonomy = 'fwd-service-category';
                    $terms = get_terms( 
                        array(
                            'taxonomy' => $taxonomy
                        ) 
                    );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        foreach ( $terms as $term ) {
                            $args = array(
                                'post_type'      => 'fwd-service',
                                'posts_per_page' => -1,
                                'orderby'        => 'title',
                                'order'          => 'ASC',
                                'tax_query'      => array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field'    => 'slug',
                                        'terms'    => $term->slug,
                                    )
                                )
                            );
                            $query = new WP_Query( $args );
                    
                            if ( $query->have_posts() ) {
                                echo '<h2>' . esc_html( $term->name ) . '</h2>';
                                while( $query->have_posts() ) {
                                    $query->the_post(); 
                                    if ( function_exists( 'get_field' ) ) {
                                        echo '<h3 id="'. esc_attr( get_the_ID() ) .'">'. esc_html( get_the_title() ) .'</h3>';
                                        if ( get_field( 'service' ) ) {
                                            the_field( 'service' );
                                        }
                                    }
                                }
                                wp_reset_postdata();
                            }    
                        }
                    }   
            
                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fwd' ),
                            'after'  => '</div>',
                        )
                    );
                            ?>
                </div><!-- .entry-content --> 

                <?php get_template_part( 'template-parts/work-categories' ); ?>

            </article>      

        <?php endwhile; // End of the loop.?>

	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
