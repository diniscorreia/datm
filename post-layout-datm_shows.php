<?php
$showStartDate = get_post_meta($post->ID,'datm_show_start_date',true);
$showStartDate = strtotime($showStartDate);
$showEndDate = get_post_meta($post->ID,'datm_show_end_date',true);
$showEndDate = strtotime($showEndDate);
$city = get_post_meta($post->ID,'datm_show_city',true);
$country = get_post_meta($post->ID,'datm_show_country',true);
?>
<li class="item-wrapper">
  <article class="show item<?php if (has_post_thumbnail()) { echo " media"; } ?>">
    <header>
			<h1 class="item-primary-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="permalink"><?php the_title(); ?></a></h1>
			<h2 class="item-secondary-title"><time datetime="<?php echo date('Y-m-d\TH:i', $showStartDate).'-'.date('Y-m-d\TH:i', $showEndDate); ?>"><span class="month"><?php echo date('M', $showStartDate); ?></span> <span class="day"><?php echo date('d', $showStartDate); ?></span></time></h2>
			<h3 class="item-tertiary-title"><?php echo "$city, $country"; ?></h3>
		</header>
	</article>
</li>