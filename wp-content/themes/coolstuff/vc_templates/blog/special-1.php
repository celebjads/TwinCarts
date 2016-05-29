<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <help@wpopal.com, info@wpopal.com?>
 * @copyright  Copyright (C) 2015 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('nice-style'); ?>>
        <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <?php endif; ?>
        <div class="post-container">
            <div class="blog-post-detail blog-post-grid">
                <figure class="entry-thumb">
                    <?php coolstuff_fnc_post_thumbnail(); ?>
                    
                </figure>
                <div class="information-post">
                     <div class="entry-meta">
                        <span class="entry-date">
                            <span class="date"><?php echo get_the_date('d'); ?></span>
                            <span class="month"><?php echo get_the_date('M'); ?></span>
                        </span>
                        <span class="comment-count">
                            <?php comments_popup_link(esc_html__(' 0 comment', 'coolstuff'), esc_html__(' 1 comment', 'coolstuff'), esc_html__(' % comments', 'coolstuff')); ?>
                        </span>                       
                    </div>
                     <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                </div>
            </div>
        </div>
    </article>
