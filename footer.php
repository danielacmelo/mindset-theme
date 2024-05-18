<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FWD_Starter_Theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-contact">
            <?php
            if ( function_exists( 'get_field' ) ) {
                if ( ! is_page('contact') ) {
                    if ( get_field('physical_address', 17) ) {
                    echo '<div class="footer-contact-left">';
                        get_template_part( 'images/location' );
                        the_field('physical_address', 17);
                    echo '</div>';
                }
                if ( get_field('email', 17) ) {
                    $email  = get_field( 'email', 17 );
                    $mailto = 'mailto:' . $email;
                    ?>
                    <div class="footer-contact-right">
                        <?php get_template_part( 'images/email' ); ?> 
                        <p><a href="<?php echo esc_url( $mailto ); ?> "><?php echo esc_html( $email ); ?></a></p>
                    </div>
                    <?php
                }   
                }   
            }
            ?>
                
		</div><!-- .footer-contact -->

		<div class="footer-menus">
            <nav id="footer-navigation" class="footer-navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'footer-left') ); ?>
            </nav>     
            <nav id="footer-navigation" class="footer-navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'footer-right') ); ?>
            </nav>		
		</div><!-- .footer-menus -->
		<div class="site-info">
            <?php the_privacy_policy_link(); ?><br>
	        <?php esc_html_e( 'Created by ', 'fwd' ); ?><a href="<?php echo esc_url( __( 'https://wp.bcitwebdeveloper.ca/', 'fwd' ) ); ?>"><?php esc_html_e( 'Jonathon Leathers, Dani Melo', 'fwd' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<button id="scroll-top" class="scroll-top">
	<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24">
		<path d="M23.677 18.52c.914 1.523-.183 3.472-1.967 3.472h-19.414c-1.784 0-2.881-1.949-1.967-3.472l9.709-16.18c.891-1.483 3.041-1.48 3.93 0l9.709 16.18z"/>
	</svg>
	<span class="screen-reader-text">Scroll To Top</span>
</button>

<?php wp_footer(); ?>

</body>
</html>
