<?php
	
	global $mc4wp;
	$image_link = (isset($image) && $image)? $image : get_template_directory_uri() . '/images/bg_popup_newsletter.jpg';
	$style = 'background: url(\''.($image_link).'\') no-repeat 0 0 transparent';
?>
<div class="popupnewsletter hidden-xs hidden-sm">	
	 <button type="button" class="btn btn-default btn-flying-right" data-toggle="modal" data-target="#popupNewsletterModal">
	 	<i class="fa fa-envelope-o"></i>
	</button>

	<!-- Modal -->
	<div class="modal fade" id="popupNewsletterModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content" style="<?php echo ($style);?>">
	   	 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      <div class="modal-body">
	      		 <div class="widget popupnewsletter-widget heading__center"><div>
					<?php if(!empty($title)){ ?>
						<h3 class="widget-title">
							<span><?php echo esc_html( $title ); ?></span>
						</h3>
					<?php } ?>
					
					<?php if(!empty($description)){ ?>
						<p class="description">
							<?php echo trim( $description ); ?>
						</p>
					<?php } ?>		
					
					<?php
						mc4wp_show_form('');
					?>
				</div></div>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<script type="text/javascript">
    jQuery(window).load(function(){
    	setTimeout(function(){
    		var hiddenmodal = getCookie('hiddenmodal');
	    	if (hiddenmodal == "") {
		        jQuery('#popupNewsletterModal').modal('show');
		    }
    	}, 3000);
    });
    jQuery(document).ready(function($){
		$('#popupNewsletterModal').on('hidden.bs.modal', function () {
		    setCookie('hiddenmodal', 1, 30);
		});
    });
</script>