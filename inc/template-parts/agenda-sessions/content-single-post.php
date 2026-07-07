<?php
global $event_star_customizer_all_values;

$content_from = $event_star_customizer_all_values['event-star-blog-archive-content-from'];

$no_blog_image = '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="content-wrapper">

        <div class="<?php echo $no_blog_image; ?>">
            <?php
            if ( 'post' === get_post_type() ) : ?>
                <header class="entry-header <?php echo $no_blog_image; ?>">
                    <div class="entry-meta">
                        <?phps
                        // event_star_cats_lists()
                        ?>
                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->
            <?php
            endif; ?>

            <p class="label label-info" style="font-size: 100% !important;">
                <?php echo get_field('session_type'); ?>
            </p>

            <div class="entry-header-title">
                <?php the_title( sprintf( '<h2 class="entry-title">' ), '</h2>' ); ?>
            </div>
            
            <hr/>

            <div class="row">
                <div class="col-md-2">
                    <p class="label label-default" style="font-size: 100% !important;">
                        <?php _e('Schedule', 'ict_camp'); ?>
                    </p>
                </div>
                <div class="col-md-10">
                    <?php $date = get_field('session_date'); ?>
                    <p><?php echo date('j F Y', strtotime($date)); ?></p>
                    <p><?php echo get_field('start_time') . ' - ' . get_field('end_time'); ?></p>
                    <p><?php echo get_field('location'); ?></p>
                </div>
            </div>

            <hr/>

            <?php if ( !empty( get_the_content() ) ): ?>
                <div class="row">
                    <div class="col-md-2">
                        <p class="label label-default" style="font-size: 100% !important;">
                            <?php _e('Description', 'ict_camp'); ?>
                        </p>
                    </div>
                    <div class="col-md-10">
                        <div class="wysiwyg-field">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <hr/>
            <?php endif; ?>

            <?php if( !empty( get_field('session_track') ) ) : ?>
                <div class="row">
                    <div class="col-md-2">
                        <p class="label label-default" style="font-size: 100% !important;">
                            <?php _e('Track', 'ict_camp'); ?>
                        </p>
                    </div>
                    <div class="col-md-10">
                        <div><?php echo get_field('session_track'); ?></div>
                    </div>
                </div>
                <hr/>
            <?php endif; ?>

            <?php if( !empty( get_field('speakers') ) ) : ?>
                <div class="row">
                    <div class="col-md-2">
                        <p class="label label-default" style="font-size: 100% !important;">
                            <?php _e('Speakers', 'ict_camp'); ?>
                        </p>
                    </div>
                    <div class="col-md-10">
                        <div class="wysiwyg-field">
                            <?php echo get_field('speakers'); ?>
                        </div>
                    </div>
                </div>
                <hr/>
            <?php endif; ?>
            
        </div><!-- .entry-content -->

        <div class="clearfix"></div>
    </div>
</article><!-- #post-## -->