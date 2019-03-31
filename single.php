<?php get_header(); ?>
<div class="container secondary-background">
  <div class="row border-top border-bottom">
    <div class="col-md-12">
      <h4 class="text-light m-0 text-center pt-4 pl-5 pb-4 pr-4">
        <a href="/hello-world" class="text-dark">
          Link
        </a>
      </h4>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-md-6 offset-md-3 text-center">
      <form method="POST" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
        <input type="hidden" name="action" value="add_new_perspective">
        <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
        <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
        <div class="form-group">
          <textarea name="perspective" rows="8" cols="80" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" name="button" class="btn btn-primary">Add New Perspective</button>
        </div>
      </form>
    </div>
  </div>
  <div class="container ">
    <?php
    $args = array('post_id' => get_the_ID());
    foreach (get_comments($args) as $comment){ ?>
      <div class="row border-top">
        <div class="col-md-4">
          <p><?php echo $comment->comment_author; ?></p>
        </div>
        <div class="col-md-8">
          <?php echo $comment->comment_content; ?>
        </div>
      </div>
    <?php } ?>
  </div>
<?php get_footer(); ?>
