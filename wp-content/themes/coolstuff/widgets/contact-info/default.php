    <?php if( $title){ ?>
    <h3 class="widget-title"><span><?php echo trim($title); ?></span></h3>
    <?php } ?>
    <div class="contact-info">
      <?php
      foreach ($this->params as $key => $value) :
        if ($instance[$key]) : 
          switch ($key) { 
            case 'working-days':
            case 'working-hours':
            if(isset($instance[$key.'_class']) && !empty($instance[$key.'_class'])): ?>
            <div class="<?php echo esc_attr( $key ) ?>">
              <div class="contact-icon">
               <i class="<?php echo esc_attr( $instance[$key.'_class'] ); ?>" ></i>
             </div>
             <div class="contact-lable">
               <?php echo esc_html( $value ); ?>: <?php echo esc_html( $instance[$key] ); ?>
             </div>
           </div>
         <?php else: ?>
         <div class="<?php echo esc_attr( $key ) ?>">
           <?php echo esc_html( $value ) ?>: <?php echo esc_html( $instance[$key] ); ?>
         </div>
         <?php endif;
         break;
         if(isset($instance[$key.'_class']) && !empty($instance[$key.'_class'])): ?>
         <div class="<?php echo esc_attr( $key ) ?>">
           <div class="contact-icon">
            <i class="<?php echo esc_attr( $instance[$key.'_class'] ); ?>" ></i>
          </div>
          <?php echo esc_html( $value ) ?>: <?php echo esc_html( $instance[$key] ); ?>
        </div>
      <?php else: ?>
      <div class="<?php echo esc_attr( $key ) ?>">
       <?php echo esc_html( $value ); ?>: <?php echo esc_html( $instance[$key] ); ?>
     </div>
     <?php endif;
     break;
     case 'skype':
     if(isset($instance[$key.'_class']) && !empty($instance[$key.'_class'])): ?>
     <div class="<?php echo esc_attr( $key ) ?>">
       <div class="contact-icon">
        <i class="<?php echo esc_attr( $instance[$key.'_class'] ); ?>" ></i>
      </div>
      <?php echo esc_html( $value ) ?>: <?php echo esc_html( $instance[$key] ); ?>
    </div>
  <?php else: ?>
  <div class="<?php echo esc_attr( $key ) ?>"><?php echo esc_html( $value ) ?>: <?php echo esc_html( $instance[$key] ); ?></div>
  <?php endif;
  break;
  case 'title':
  case 'website-url':
  break;
  case 'email':
  if(isset($instance[$key.'_class']) && !empty($instance[$key.'_class'])): ?>
  <div class="<?php echo esc_attr( $key ) ?>">
    <div class="contact-icon">
     <i class="<?php echo esc_attr( $instance[$key.'_class'] ); ?>" ></i>
   </div>
   <?php echo esc_html( $value )?>: <a href="mailto:<?php echo sanitize_email( $instance['email-address'] ); ?>"><?php if($instance[$key]) { echo esc_html( $instance[$key] ); } ?></a>
 </div>
<?php else: ?>
 <div class="<?php echo esc_attr( $key ) ?>">
  <?php echo esc_html( $value ) ?>: <a href="mailto:<?php echo sanitize_email( $instance['email-address'] ); ?>"><?php if($instance[$key]) { echo esc_html( $instance[$key] ); } else { echo esc_html( $instance[$key] ); } ?></a>
</div>
<?php endif;
break;
case 'website':
if(isset($instance[$key.'_class']) && !empty($instance[$key.'_class'])): ?>
<div class="<?php echo esc_attr( $key ) ?>">
  <div class="contact-icon">
   <i class="<?php echo esc_attr( $instance[$key.'_class'] ); ?>" ></i>
 </div>
 <?php echo esc_html( $value ) ?>: <a href="<?php echo esc_url($instance['website-url']); ?>"><?php if($instance[$key]) { echo esc_html( $instance[$key] ); } else { echo esc_html( $instance[$key] ); } ?></a>
</div>
<?php else: ?>
  <div class="<?php echo esc_attr( $key ) ?>">
    <?php echo esc_html( $value ) ?> <a href="<?php echo esc_url($instance['website-url']); ?>"><?php if($instance[$key]) { echo esc_html( $instance[$key] ); } else { echo esc_html( $instance[$key] ); } ?></a>
  </div>
  <?php endif;
  break;

  case 'email-address':
  ?>
  <div class="<?php echo esc_attr( $key ) ?>">                        
    <a href="<?php echo esc_url($instance['email-address']); ?>"><?php if($instance[$key]) { echo esc_html( $instance[$key] ); } else { echo esc_html( $instance[$key] ); } ?></a>
  </div>
  <?php 
  break;

  case 'company':
  ?>
  <div class="<?php echo esc_attr( $key ) ?>"> 
    <div class="company-icon">
      <i class="fa fa-home"></i>
    </div>                       
    <div class="contact-label">
      <a href="<?php echo esc_url($instance['company']); ?>"><?php if($instance[$key]) { echo esc_html( $instance[$key] ); } else {
        echo esc_html( $instance[$key] ); } ?>
      </a>
    </div>
  </div>
  <?php 
  break;

  case 'phone':
  ?>  <div class="phone-number">   
  <div class="phone-icon">
    <i class="fa fa-phone"></i>
  </div>                
  <div class="contact-label"><span><?php if($instance[$key]) { echo esc_html( $instance[$key] ); } else { echo esc_html( $instance[$key] ); } ?></span></div>
  <?php 
  break;

  case 'mobile':
  ?>
  <div class="contact-label"><span><?php if($instance[$key]) { echo esc_html( $instance[$key] ); } else { echo esc_html( $instance[$key] ); } ?></span></div>
</div>
<?php 
break;

default: ?>
<div class="contact-label <?php echo esc_attr( $key ) ?>"><span><?php echo esc_html( $instance[$key] ); ?></span></div>
<?php }
endif;
endforeach; ?>
</div>