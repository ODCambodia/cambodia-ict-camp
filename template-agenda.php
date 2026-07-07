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
                the_title('<h1 class="entry-title">', '</h1>');

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
    'post_per_page' => -1,
    'meta_key'     => 'start_time',
    'orderby'      => 'meta_value',
    'order'        => 'ASC',
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
                        <li class="<?php echo $class_active; ?>" role="presentation">
                            <a href="<?php echo get_site_url() . '#' . sanitize_title($date); ?>" aria-controls="<?php echo sanitize_title($date); ?>" role="tab" data-toggle="tab" style="text-decoration: none !important; font-size: 2rem !important; font-weight: bold !important; font-family: var(--font-heading-primary) !important;">
                                <?php // echo date('F j, Y', strtotime($date)); ?>
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
                            <h3><?php echo date('F j, Y', strtotime($date)); ?></h3>
                            <hr/>
                            <div class="agenda-list">
                                <?php
                                foreach ($sessions as $time => $session_details) {
                                ?>
                                    <h3><?php echo $time; ?></h3>
                                    <hr/>
                                    <?php
                                    foreach ($session_details as $session) {
                                    ?>
                                        <div class="agenda-item">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p style="margin-bottom: 0 !important;"><strong><?php echo $session['session_type']; ?></strong></p>
                                                    <p style="margin-bottom: 0 !important;"><?php echo $session['location']; ?></p>
                                                </div>
                                                <div class="col-md-8">
                                                    <span class="label label-primary" style="margin-bottom: 0 !important;"><?php echo $session['track']; ?></span>
                                                    <p style="margin-bottom: 0 !important;"><strong><?php echo $session['title']; ?></strong></p>
                                                    <!-- <a href="<?php echo $session['permalink']; ?>" style="text-decoration: none; margin-bottom: 0 !important;"><strong><?php echo $session['title']; ?></strong></a> -->
                                                    <div><?php echo apply_filters( 'the_content', $session['speakers'] ); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>

                                            <!-- <h4><?php echo $session['title']; ?></h4>
                                            <p><strong>Time:</strong> <?php echo $time; ?> - <?php echo $session['end_time']; ?></p>
                                            <p><strong>Location:</strong> <?php echo $session['location']; ?></p>
                                            <p><strong>Track:</strong> <?php echo $session['track']; ?></p>
                                            <p><strong>Type:</strong> <?php echo $session['session_type']; ?></p>
                                            <?php if (!empty($session['speakers'])) : ?>
                                                <p><strong>Speakers:</strong>
                                                    <?php
                                                    $speaker_names = [];
                                                    foreach ($session['speakers'] as $speaker) {
                                                        $speaker_names[] = get_the_title($speaker->ID);
                                                    }
                                                    echo implode(', ', $speaker_names);
                                                    ?>
                                                </p>
                                            <?php endif; ?>
                                            <p><?php echo $session['description']; ?></p>
                                    
                                            <hr/>
                                        </div> -->
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

<?php
get_footer();