<?php

/**
 * event_star_action_after_content hook
 * @since Event Star 1.0.0
 *
 * @hooked null
 */
do_action( 'event_star_action_after_content' );

/**
 * event_star_action_before_footer hook
 * @since Event Star 1.0.0
 *
 * @hooked null
 */
do_action( 'event_star_action_before_footer' );

/**
 * event_star_action_footer hook
 * @since Event Star 1.0.0
 *
 * @hooked event_star_footer - 10
 */
do_action( 'event_star_action_footer' );

/**
 * event_star_action_after_footer hook
 * @since Event Star 1.0.0
 *
 * @hooked null
 */
do_action( 'event_star_action_after_footer' );

/**
 * event_star_action_after hook
 * @since Event Star 1.0.0
 *
 * @hooked event_star_page_end - 10
 */
do_action( 'event_star_action_after' );
?>

<?php function initialize_aos_script() { ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                AOS.init({
                    duration: 800,          // Values from 0 to 3000, with step 50ms
                    easing: 'ease-in-out',  // Default easing for AOS animations
                    offset: window.innerWidth > 768 ? 750 : 50,
                    once: true              // Whether animation should happen only once - while scrolling down
                });
            });
        </script>
<?php }
add_action('wp_footer', 'initialize_aos_script');

wp_footer();
?>
</body>
</html>