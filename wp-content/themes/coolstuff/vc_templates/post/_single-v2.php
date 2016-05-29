 <?php $thumbsize = isset($thumbsize)? $thumbsize : 'small';?>
 <?php
  $post_category = "";
  $categories = get_the_category();
  $separator = ' ';
  $output = '';
  if($categories){
    foreach($categories as $category) {
      $output .= '<a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'coolstuff' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
    }
  $post_category = trim($output, $separator);
  }      
?>
<article class="post row">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <?php
    if ( has_post_thumbnail() ) {
        ?>
            <figure class="entry-thumb">
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
  </div>
  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    <h4 class="entry-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h4>
    <p class="entry-description"><?php echo coolstuff_fnc_excerpt(150,'...');; ?></p>
    <div class="entry-meta">
        <span class="category'"><?php echo trim($post_category); ?></span> <span class="symbol"> . </span> <span> <?php the_time( 'M d, Y' ); ?> </span>
    </div>
  </div>
</article>