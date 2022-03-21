<div class="col-xs-12 col-sm-4 col-md-2">
    <?php
    $attributes = [
        'title' => get_the_title(),
        'class' => 'aligncenter img-circle margin-bottom-10-px',
    ];

    $profile = get_the_post_thumbnail( $post->ID, [200, 200], $attributes );
    $responsive_profile = preg_replace( '/(width|height)="\d*"\s/', '', $profile );
    $speaker_linked_in_link = get_post_meta( $post->ID, '_speakers_social_media_links_value_key', true );
    $speaker_expertise = get_post_meta( $post->ID, '_speakers_expertise_value_key', true );
    $speaker_organization = get_post_meta( $post->ID, '_speakers_organization_value_key', true );
    ?>

    <a href="#" data-toggle="modal" data-target="<?php echo '#' . $post->ID ?>">
        <?php echo $responsive_profile; ?>
    </a>

    <p class="text-center">
        <strong><?php echo get_the_title(); ?></strong>
        <br/>
        <em><?php _e( $speaker_expertise ); ?></em>
        <br/>
        <small><?php _e( $speaker_organization ); ?></small>
    </p>
    <br>

    <!-- Bio Modal -->
    <div class="modal fade" id="<?php echo $post->ID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php _e( get_the_title(), 'ict_camp' ) ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <?php echo $responsive_profile; ?>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <p>
                                <b>
                                    <?php 
                                    _e( get_the_title() );
                                    
                                    if ( $speaker_linked_in_link ) {
                                    ?>
                                        <a style="margin-left: 0.5em" target="_blank"
                                            href="<?php echo $speaker_linked_in_link; ?>"
                                            title="LinkedIn"
                                        >
                                            <i class="fa fa-linkedin-square fa-lg" aria-hidden="true"></i>
                                        </a>
                                    <?php } ?>
                                </b>
                                <br>
                                <em><?php _e( $speaker_expertise ); ?></em>
                                <br/>
                                <span><?php _e( $speaker_organization ); ?></span>
                            </p>
                            <?php _e( the_content() ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- END Bio Modal -->
</div>
