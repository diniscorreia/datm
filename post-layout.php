<li class="item-wrapper">
  <article class="post item">
    <header>
    	<hgroup>
      	<h1 class="item-primary-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="permalink"><?php the_title(); ?></a></h1>
      	<h2 class="item-secondary-title"><time pubdate datetime="<?php the_time('Y-m-d') ?>"><?php the_time('M dS, Y') ?></time></h2>
    	</hgroup>
    </header>            
    <div class="item-prose">
      <?php the_content('More'); ?> 
    </div>
    <footer>
    	<?php echo get_the_tag_list('<p class="item-topics"><strong>Topics:</strong> ',', ','</p>'); ?>
    </footer>
  </article>
</li>