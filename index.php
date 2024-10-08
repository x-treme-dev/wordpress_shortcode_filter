 <?php get_header('header.php'); ?>

 <div class="content">
         <h1>Записи: </h1>
         <?php if(have_posts()): while(have_posts()): the_post();?>
         <h1><?php the_title();?></h1>
         <h4>Запись от <?php the_time('F jS, Y'); ?></h4>
         <p><?php the_content(_('(more...)'));?></p>
         <hr><?php endwhile;     else:?>

         <p><?php _e('Sorry, no posts');?></p>
         <?php endif; ?>
         </div>

 
 <?php 
  if ( have_posts() ) { while ( have_posts() ) { the_post();  
    $content = apply_filters( 'the_content', get_the_content() );
    echo apply_filters( 'content',  $content );
    } 
  }  
	 
  

 ?>
 <?php get_footer('footer.php'); ?>