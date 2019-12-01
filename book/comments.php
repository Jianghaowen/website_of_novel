<?php
    if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');
?>
<!– Comment’s List –>
<div class="comments-area">
	<div class="comments_number">
			 <h3>评论<span>(<?php echo get_comments_number();?>)</span></h3>
	 </div>
<?php
   if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
       // if there's a password
       // and it doesn't match the cookie
   ?>
   <li class="decmt-box">
       <p><a href="#addcomment">请输入密码再查看评论内容哦.</a></p>
   </li>
   <?php
       } else if ( !comments_open() ) {
   ?>
   <li class="decmt-box">
       <p><a href="#addcomment">评论功能已经关闭了哦!</a></p>
   </li>
   <?php
       } else if ( !have_comments() ) {
   ?>
   <li class="decmt-box">
       <p><a href="#addcomment">还没有评论啊,快来说两句吧^_^</a></p>
   </li>
   <?php
       } else {
           wp_list_comments('type=comment&callback=aurelius_comment');
       }
   ?>
</div>
   <!– Comment Form –>
   
<?php if ( comments_open() ) : ?>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p class="do_you_know_I_how_love_you"><?php printf(__('你需要先 <a href="%s" class="do_not_like_red">登录</a> 才能发表评论.'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
<?php else : ?>
<?php $defaults = array(
    'comment_notes_before' => '',
    'label_submit'         => __( '提交评论' ),
    'comment_notes_after' =>''
);
comment_form(array(
      'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( '通过<a href="%1$s" class="do_not_like_red">%2$s</a>登陆&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="%3$s" title="登出" class="do_not_like_red" >登出</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
	  'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="70" rows="8" aria-required="true"></textarea></p>',
	));
 endif;
else :  ?>
<p><?php _e('对不起评论已经关闭.'); ?></p>
<?php endif; ?>