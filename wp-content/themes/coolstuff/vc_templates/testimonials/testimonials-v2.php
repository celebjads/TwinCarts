<div class="testimonials-wrap">		
	<div class="testimonials-body text-center">
	   <div class="testimonials-avatar radius-x">
		   <?php the_post_thumbnail('widget', '', 'class="radius-x"');?>
		</div>
	   <div class="testimonials-quote text-center"><?php the_content() ?></div>
    	<div class="testimonials-profile text-center"> 
        <h4 class="name"> <?php the_title(); ?></h4>
        <div class="job"><?php the_excerpt(); ?></div>
    	</div>
	</div>		
</div>
