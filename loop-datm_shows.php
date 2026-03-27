<?php
/**
 * The loop that displays shows.
 */
?>          
          <?php query_posts('post_type=datm_shows&meta_key=datm_show_start_date&orderby=meta_value&order=DESC'); if (have_posts()) : ?>
          
          <?php while (have_posts()) : the_post(); ?>
          <?php
          $showStartDate = get_post_meta($post->ID,'datm_show_start_date',true);
          $showStartDate = strtotime($showStartDate);
          $showEndDate = get_post_meta($post->ID,'datm_show_end_date',true);
          $showEndDate = strtotime($showEndDate);
          $venue = get_post_meta($post->ID,'datm_show_venue',true);
          $address = get_post_meta($post->ID,'datm_show_address',true);
          $postalcode = get_post_meta($post->ID,'datm_show_postalcode',true);
          $city = get_post_meta($post->ID,'datm_show_city',true);
          $country = get_post_meta($post->ID,'datm_show_country',true);
          $geo = urlencode("$address, $city, $country");
          ?>
          <li class="item-wrapper">
            <article class="show item<?php if (has_post_thumbnail()) { echo " media"; } ?>">
              <header>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="permalink">
                  <?php if (has_post_thumbnail()) : ?>
                  <p class="thumb"><?php the_post_thumbnail(); ?></p>
                  <?php endif; ?>
                  <h1 class="primary-title"><?php the_title(); ?></h1>
                </a>
                <p class="date"><time datetime="<?php echo date('Y-m-d\TH:i', $showStartDate).'-'.date('Y-m-d\TH:i', $showEndDate); ?>"><?php echo date('l, d M, H:i', $showStartDate); ?> to <?php echo date('H:i', $showEndDate); ?> <sup>GMT</sup></time></p>
                <p class="place"><a href="http://maps.google.com/maps?q=<?php echo $geo; ?>" title="Google Maps"><?php echo "$venue, $city, $country"; ?></a></p>
                <p class="comments">&mdash; <a href="<?php comments_link(); ?> " title="<?php comments_number('no comments','1 comment','% comments'); ?>"><?php comments_number('no comments','1 comment','% comments'); ?></a> &mdash;</p>
              </header>
              
              <footer class="topics">
                <?php echo get_the_tag_list('<p>Topics: ',', ','.</p>'); ?>
              </footer>
            </article>
          </li>
          <?php endwhile; ?>
          <?php endif; wp_reset_query(); ?>