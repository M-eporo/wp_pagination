<?php
  $args = array(
    'mid_size' => 2,
    'prev_text' => '前へ',
    'next_text' => '次へ',
    'type' => 'list',
  );
  echo paginate_links($args);
?>

<?php 
  the_posts_pagination();
?>

<?php 
  //WP-PageNavi
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => '10',
    'paged' => '$paged',
    'post_status' => 'publish',
  );
  $the_query = new WP_Query($args);
  if($the_query->have_posts()): 
?>
  <ul class="news-list">
    <?php while($the_query->have_posts()): the_query->the_post(); ?>
    <?php 
      get_template-part('parts', 'archiveposts');
    ?>
    <?php endwhile; ?>
  </ul>
<?php else: ?>
  <p>記事はありません。</p>
<?php endif; ?>
<?php 
  if(function_exists('wp_pagenavi')):
    wp_pagenavi(array('query' => $the_query));
  endif;
?>
<?php wp_reset_postdata(); ?>