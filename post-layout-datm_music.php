<?php
$musicReleaseDate = get_post_meta($post->ID,'datm_release_date',true);
$musicReleaseDate = strtotime($musicReleaseDate);
$musicRecordLabel = get_post_meta($post->ID,'datm_record_label',true);
?>

<li class="item-wrapper">
  <article class="musci item">
    <header>
    	<hgroup>
    		<h1 class="item-primary-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="permalink"><?php the_title(); ?></a></h1>
    		<?php if($musicReleaseDate || $musicRecordLabel) : ?>
    		<h2 class="item-secondary-title">Release: <?php if($musicReleaseDate) : ?><time datetime="<?php echo date('Y-m-d', $musicReleaseDate); ?>"><?php echo date('M dS, Y', $musicReleaseDate); ?></time><?php endif; ?><?php if($musicRecordLabel) : ?> (<?php echo $musicRecordLabel; ?>)<?php endif; ?></h2>
    		<?php endif; ?>
    	</hgroup>
    </header> 
    <div class="item-prose">
			<?php the_content('More'); ?>        
    </div>
  </article>
</li>