<?php

/**
 * Template Name: Camp Agenda Template
 */

get_header();

global $event_star_customizer_all_values;

$event_star_hide_front_page_header = $event_star_customizer_all_values['event-star-hide-front-page-header'];

if (
    (is_front_page() && 1 != $event_star_hide_front_page_header)
    || !is_front_page()
) {
?>
    <div class="wrapper inner-main-title">
        <div id="particles-js"></div>
        <div class="container">
            <header class="entry-header init-animate">
                <?php
                the_title('<h1 class="entry-title" data-aos="fade-down" data-aos-delay="200" data-aos-offset="50">', '</h1>');

                if (1 == $event_star_customizer_all_values['event-star-show-breadcrumb']) {
                    event_star_breadcrumbs();
                }
                ?>
            </header><!-- .entry-header -->
        </div>
    </div>
<?php
}
?>

<?php
// Get the current post's camp year taxonomy term
$camp_year = get_the_terms( get_the_ID(), 'camp_year' );

$args = [
    'post_type'     => 'agenda-session',
    'posts_per_page' => -1,
    'meta_key'     => 'start_time',
    'orderby'      => [
        'meta_value'    => 'ASC',
        'menu_order'    => 'ASC',
    ],
    // 'meta_query' => [
    //     'relation' => 'AND',
    //     'date_clause' => [
    //         'key'     => 'session_date',
    //         'compare' => 'EXISTS',
    //     ],
    //     'time_clause' => [
    //         'key'     => 'start_time',
    //         'compare' => 'EXISTS',
    //     ],
    // ],
    // 'orderby' => [
    //     'date_clause' => 'ASC',
    //     'time_clause'   => 'ASC',
    // ],
    'tax_query'    => [
        [
            'taxonomy' => 'camp_year',
            'field'    => 'name',
            'terms'    => $camp_year[0]->name,
        ],
    ],
];

$sessions = new WP_Query($args);

// Prepare an array to hold the agenda data
$agenda_data = [];

if ($sessions->have_posts()) {
    while ($sessions->have_posts()) {
        $sessions->the_post();

        // Get the start and end time from the custom fields
        $date = get_field('session_date');
        $time = get_field('start_time');

        $agenda_data[$date][$time][] = [
            'id'            => get_the_ID(),
            'title'         => get_the_title(),
            'end_time'      => get_field('end_time'),
            'location'      => get_field('location'),
            'track'         => get_field('session_track'),
            'session_type'  => get_field('session_type'),
            'speakers'      => get_field('speakers'),
            'description'   => get_the_content(),
            'permalink'     => get_permalink(),
        ];
    }
    wp_reset_postdata();
}

// Sort the agenda data by date and time
ksort($agenda_data);
?>

<!-- Agenda Content -->
<div id="content" class="site-content container clearfix">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <!-- Agenda Tabs -->
            <?php if (!empty($agenda_data)) : ?>
                <ul class="nav nav-tabs nav-justified no-margin" role="tab-list">
                    <?php
                    $counter = 0;
                    $class_active = 'active';

                    foreach ($agenda_data as $date => $sessions) {
                        if ($counter != 0) {
                            $class_active = '';
                        } else {
                            $day_active_in = sanitize_title($date);
                        }
                    ?>
                        <li class="<?php echo $class_active; ?>" role="presentation" data-aos="fade-down" data-aos-delay="400" data-aos-offset="50">
                            <a href="<?php echo '#' . sanitize_title($date); ?>" data-toggle="tab" style="text-decoration: none !important; font-size: 2rem !important; font-weight: bold !important; font-family: var(--font-heading-primary) !important;">
                                <?php _e( 'Day ' . $counter );?>
                            </a>
                        </li>
                    <?php
                        $counter++;
                    }
                    ?>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    <?php
                    $counter = 0;
                    
                    foreach ($agenda_data as $date => $sessions) {
                        if ($counter != 0) {
                            $class_active = '';
                        } else {
                            $class_active = 'active';
                        }
                    ?>
                        <div role="tabpanel" class="tab-pane <?php echo $class_active; ?>" id="<?php echo sanitize_title($date); ?>">
                            <?php
                            if ( ictcamp_localize_manager()->get_current_language() == 'km' ) {
                                // $date = ictcamp_localize_manager()->khmer_date( $date );
                                $date = date('j F Y', strtotime($date));
                            } else {
                                $date = date('j F Y', strtotime($date));
                            }
                            ?>

                            <h3 data-aos="fade-down" data-aos-delay="200" data-aos-offset="50"><?php echo $date; ?></h3>

                            <hr data-aos="fade-right" data-aos-delay="200" data-aos-offset="50" />
                            <div class="agenda-list">
                                <?php
                                foreach ($sessions as $time => $session_details) {
                                ?>
                                    <h3 data-aos="fade-right" data-aos-delay="200" data-aos-offset="50"><?php echo $time; ?></h3>
                                    <hr data-aos="fade-right" data-aos-delay="200" data-aos-offset="50"/>
                                    <?php
                                    foreach ($session_details as $session) {
                                    ?>
                                        <div class="agenda-item" data-aos="fade-right" data-aos-delay="200" data-aos-offset="50">
                                            <div class="row">
                                                <div class="col-md-8 col-md-push-4">
                                                    <?php if ( !empty( $session['track'] ) ) : ?>
                                                        <p class="label label-success desktop-only text-left" style="font-size: 100% !important">
                                                            <?php echo __($session['track'], 'ict_camp'); ?>
                                                        </p>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ( !empty( $session['description'] ) ) : ?>
                                                        <h5 style="margin-top: 0">
                                                            <a href="<?php echo $session['permalink']; ?>" style="text-decoration: none; font-family: var(--fs-heading-primary) !important;">
                                                                <?php echo _e( $session['title'], 'ict_camp' ); ?>
                                                            </a>
                                                        </h5>
                                                    <?php else: ?>
                                                        <h5 style="margin-top: 0">
                                                            <?php echo _e( $session['title'], 'ict_camp' ); ?>
                                                        </h5>
                                                    <?php endif; ?>

                                                    <div><?php echo apply_filters( 'the_content', __( $session['speakers'], 'ict_camp' ) ); ?></div>
                                                </div>
                                                <div class="col-md-4 col-md-pull-8">
                                                    <?php if ( !empty( $session['session_type'] ) ) : ?>
                                                        <p><strong><?php echo _e( $session['session_type'], 'ict_camp' ); ?></strong></p>
                                                    <?php endif; ?>

                                                    <?php if ( !empty( $session['location'] ) ) : ?>
                                                        <p><?php echo _e( $session['location'], 'ict_camp' ); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <hr data-aos="fade-right" data-aos-delay="200" data-data-aos-offset="50" />
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                        $counter++;
                    }
                    ?>
                </div>
            <?php endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- #content -->

<script>
    // Assign specific hash for the URL of each tab content
    window.onload = function () {

        function switchTab(hash) {
            if (!hash) return;

            // Strip the '#' symbol from the start to extract the raw ID string (e.g., "20260919")
            var rawId = hash.substring(1);

            // Safely fetch by ID using getElementById to bypass the numeric CSS selector limitation
            var targetPane = document.getElementById(rawId);

            // Use an attribute selector to safely locate the nav link link
            var targetLink = document.querySelector('.nav-tabs a[href="' + hash + '"]');

            if (targetPane && targetLink) {
                // 1. Deactivate all active tab panes
                var panes = targetPane.parentElement.querySelectorAll('.tab-pane');
                panes.forEach(function (pane) {
                    pane.classList.remove('active', 'in');
                });

                // 2. Deactivate all active navigation list items
                var listItems = targetLink.closest('.nav-tabs').querySelectorAll('li');
                listItems.forEach(function (li) {
                    li.classList.remove('active');
                });

                // 3. Activate the chosen tab pane and its nav link container
                targetPane.classList.add('active', 'in');
                targetLink.parentElement.classList.add('active');
            } else {
                console.error("Tab switch failed: Elements matching " + hash + " not found.");
            }
        }

        // Execute immediately on page load
        if (window.location.hash) {
            setTimeout(function() {
                switchTab(window.location.hash);
            }, 10);
        }

        // Track when users click links manually
        var tabLinks = document.querySelectorAll('.nav-tabs a');
        tabLinks.forEach(function (link) {
            link.addEventListener('click', function (e) {
                var hash = this.getAttribute('href');
                if (hash && hash.startsWith('#')) {
                    if (history.pushState) {
                        history.pushState(null, null, hash);
                    } else {
                        window.location.hash = hash;
                    }
                    switchTab(hash);
                }
            });
        });
    };
</script>

<?php
get_footer();