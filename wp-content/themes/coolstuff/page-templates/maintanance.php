<?php
/*
*Template Name: Maintanance Mode
*
*/
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body>
    <div class="container-fluid">
            <?php while ( have_posts() ) : the_post(); ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                <?php the_content(); ?>
              </article>
            <?php endwhile; ?>
    </div>
    <div class="container">
        <p class="pull-left"><?php esc_html_e('Copyright &copy; - Cool Stuff - All right reserved. Powered by WordPress.', 'coolstuff'); ?>
            
        </p>
        <p class="pull-right"><a class="text-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Back to home', 'coolstuff'); ?></a></p>
    </div>
    <?php wp_footer(); ?>
</body>
</html>