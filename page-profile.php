<?php get_header(); ?>
<?php if(!is_user_logged_in()): ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p class="pt-5 text-light">
          Please <a href="/"> click here</a>  and return to front page to sign in.
        </p>
      </div>
    </div>
  </div>
<?php else: ?>
<div class="container">
  <div class="row">
    <div class="col-md-12 pt-3">
      <?php $comments = get_comments(array(get_current_user_id(), 'number' => '5')); ?>
      <h3 class="pb-3">Last <?php echo count($comments); ?> Comments:</h3>
      <?php for($loop_over_comments = 0; $loop_over_comments < 5; $loop_over_comments++){ ?>
        <h4>Comment # <?php echo $loop_over_comments + 1; ?></h4>
        <p>
          <?php
            $comment_tease = substr($comments[$loop_over_comments]->comment_content, 0, 500);
            echo check_comment_length($comment_tease) ? $comment_tease . "..." : $comment_tease;
          ?>
        </p>
      <?php } ?>
    </div>
    <div class="col-md-12 pt-3">
      <?php $loop = new WP_Query(array(	'post_type' => 'post', 'author' => get_current_user_id(), 'posts_per_page' => "5")); ?>
      <h3 class="pb-3">Last <?php echo $loop->found_posts; ?> Submissions:</h3>
        <?php
        $loop_posts_count = 1;
        while($loop->have_posts()) : $loop->the_post(); ?>
          <h4>Post # <?php echo $loop_posts_count; ?></h4>

          <p>
            <a href="<?php the_permalink();?>">
              <?php the_title() ?>
            </a>
          </p>
        <?php $loop_posts_count++; endwhile; ?>
    </div>
  </div>
</div>

<?php endif; ?>



<?php get_footer(); ?>
