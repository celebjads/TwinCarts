<?php $thumbsize = isset($thumbsize)? $thumbsize : 'thumbnail';?>
<article class="post col-sm-12 col-md-6 space-20"><div class="row">
<?php
if ( has_post_thumbnail() ) {
    ?>
    <div class="col-sm-12 col-md-6">
        <figure class="entry-thumb">
            <a href="<?php the_permalink(); ?>" title="" class="entry-image zoom-2">
                <?php the_post_thumbnail( $thumbsize );?>
            </a>
            <!-- vote    -->
            <?php do_action('wpopal_show_rating') ?>
        </figure>
    </div>    
    <?php
}
?>
<div class="col-sm-12 col-md-6">
    <?php if (get_the_title()) { ?>
        <h4 class="entry-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h4>
    <?php } ?>
    <div class="entry-content-inner clearfix">
        <div class="entry-meta clearfix">
            <div class="entry-date pull-left">
                <span><?php the_time( 'd' ); ?></span>&nbsp;<?php the_time( 'M' ); ?>
            </div>
            <span class="meta-sep pull-left"> / </span>
            <span class="author pull-left"><?php esc_html_e('by', 'coolstuff'); the_author_posts_link(); ?></span>
            <span class="meta-sep pull-left"> / </span>
            <div class="entry-category pull-left">
                <?php esc_html_e('in', 'coolstuff'); the_category(); ?>
            </div>
        </div>
    </div>
   
</div>
</div></article>