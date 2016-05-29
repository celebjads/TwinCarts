<?php $thumbsize = isset($thumbsize)? $thumbsize : 'large';?>
<?php
  $post_category = "";
  $categories = get_the_category();
  $separator = ' | ';
  $output = '';
  if($categories){
    foreach($categories as $category) {
      $output .= '<a href="'.esc_url( esc_url( get_category_link( $category->term_id ) ) ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'coolstuff' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
    }
  $post_category = trim($output, $separator);
  }      
?>
<article class="post">
    <?php
    if ( has_post_thumbnail() ) {
        ?>
            <figure class="entry-thumb effect-v6">
                <a href="<?php the_permalink(); ?>" title="" class="entry-image zoom-2">
                    <?php the_post_thumbnail( $thumbsize );?>
                </a>
                <!-- vote    -->
                <?php do_action('wpopal_show_rating') ?>
                 <div class="category-highlight hidden">
                    <?php echo trim($post_category); ?>
                </div>
            </figure>
        <?php
    }
    ?>
    <div class="entry-content">
        <?php
            if (get_the_title()) {
            ?>
                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php
        }
        ?>
        <div class="entry-content-inner clearfix">
            <div class="entry-meta">
                <div class="entry-category hidden">
                    <?php the_category(); ?>
                </div>
            
                <ul class="entry-comment list-inline hidden">
                    <li class="comment-count">
                        <?php comments_popup_link(esc_html__(' 0 ', 'coolstuff'), esc_html__(' 1 ', 'coolstuff'), esc_html__(' % ', 'coolstuff')); ?>
                    </li>
                </ul>

                 <div class="entry-create">
                    <span class="author"><?php esc_html_e('By', 'coolstuff'); the_author_posts_link(); ?></span>
                    <span class="entry-date"><?php the_time( 'M d, Y' ); ?></span>
                </div>
            </div>
        </div>

        <?php
            if (! has_excerpt()) {
                echo "";
            } else {
                ?>
                    <p class="entry-description"><?php echo coolstuff_fnc_excerpt(135,'...'); ?></p>
                <?php
            }
        ?>

    </div>
</article>