<?php

$end = $loop->post_count;
if ( $loop->have_posts() ) : ?>
	<div>
		<?php $_count = 1; while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
			<?php if ( $_count <= 4 ): ?>
				<?php if ($_count == 1): ?>
					<div class="row">
				<?php endif; ?>

					<div class="col-md-3 col-sm-6 col-xs-12 product"><?php wc_get_template_part( 'content', 'frontproducts' ); ?></div>

				<?php if ( $_count == 4 || ($end < 4 && $_count == $end) ): ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( $_count > 4 && $_count <= 9): ?>

				<?php if ($_count == 5): ?>
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12 product"><?php wc_get_template_part( 'content', 'frontproducts' ); ?></div>
				<?php else: ?>


		 				<?php if ($_count == 6): ?>
		 					<div class="col-md-6 col-sm-12 col-xs-12 product">
		 						<div class="row">
		 				<?php endif; ?>
		 					
		 					<div class="col-sm-6 col-xs-12 product"><?php wc_get_template_part( 'content', 'frontproducts' ); ?></div>

		 				<?php if ( $_count == 9 || ($end < 9 && $_count == $end) ): ?>
								</div>
							</div>
						<?php endif; ?>

				<?php endif; ?>
				<?php if ( $_count == 9 || ($end < 9 && $_count == $end) ): ?>
					</div>
				<?php endif; ?>

			<?php endif; ?>

			<?php if ( $_count > 9 && $_count <= 14): ?>
				<?php if ($_count == 10): ?>
					<div class="row">
				<?php endif; ?>
				<?php if ($_count == 14): ?>
						<div class="col-md-6 col-sm-12 col-xs-12 product"><?php wc_get_template_part( 'content', 'frontproducts' ); ?></div>
				<?php else: ?>
		 				<?php if ($_count == 10): ?>
		 					<div class="col-md-6 col-sm-12 col-xs-12 product">
		 						<div class="row">
		 				<?php endif; ?>
		 					<div class="col-sm-6 col-xs-12 product"><?php wc_get_template_part( 'content', 'frontproducts' ); ?></div>
		 				<?php if ( $_count == 13 || ($end < 13 && $_count == $end) ): ?>
								</div>
							</div>
						<?php endif; ?>
				<?php endif; ?>

		 		<?php if ( $_count == 14 || ($end < 14 && $_count == $end) ): ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>

		<?php  $_count++ ; endwhile; ?>

		<?php wp_reset_postdata(); ?>
	</div>
<?php endif; ?>