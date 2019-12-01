<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title('-', true, 'right'); ?></title>
<?php wp_head(); ?>
</head>
<body style="background:none;" class="all_element">
<div class="home-user-card-el">
  <div class="home-user-card">
    <div class="user-card-avatar">
	 <span>
	   <?php echo get_avatar($authordata->ID,145);?>
	 </span>
	</div>
	<div class="user-card-info">
		<h2><?php the_author_meta('display_name');?></h2>
	    <p>
		<h3>邮箱:</h3>
		<?php $author_description=get_the_author_meta('user_email');
	      if($author_description){
        echo the_author_meta('user_email'); 
		}else{
		echo "没有填写个人邮箱";
       } 
	   ?>
		</p>
	</div>
	<div class="user-card-number">
		<strong>
		       <?php
			$author_ID=$authordata->ID;
			$posts = get_posts( 		
                               array (
							           'author'        => $author_ID,
							   )
			);
			echo count($posts);
		  ?>
		</strong>
		<span>书评</span>
	</div>
  </div>
</div>
<div class="home-user-body">
 <div class="home-content">
  <div class="J-items">
  <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
  <?php setPostViews( get_the_ID() ); ?>
   <div class="tashuo-item">
    <div class="tashuo-item-author">
	  <div class="author-avatar">
	    <span>
		 <?php echo get_avatar($authordata->ID,30);?>
		</span>
	  </div>
	  <div class="author-text"><?php the_author_meta('display_name');?>&nbsp;&nbsp;发布了书评</div>
	  <div class="action-time"><?php the_time('Y-m-d'); ?></div>
	</div>
	<div class="tashuo-item-title">
	 <a href="<?php the_permalink();?>" target="_blank"><?php the_title(); ?></a>
	</div>
	<div class="tashuo-item-content">
		<a href="<?php the_permalink();?>" target="_blank"><?php echo lingfeng_strimwidth( get_the_content(), 120, 0, '...' ) ?></a>
	</div>
	<div class="tashuo-item-operator">
	 <span class="tashuo-item-view">
		 <i>阅读</i>
		 <strong><?php echo getPostViews( get_the_ID() ); ?></strong>
	 </span>
	</div>
  </div>
  <?php endwhile; ?>
  <?php endif; ?><!-- 文章循环-->
 </div>
</div>
 <div class="home-sidebar">
  <div class="sidebar-item">
    <h3 class="item-title">个人介绍</h3>
	<div class="user-intro">
	 <div class="user-intro-brief">
	     <p>
	   <?php $author_description=get_the_author_meta('description');
	      if($author_description){
        echo the_author_meta('description'); 
		}else{
		echo "没有填写个人介绍";
       } 
	   ?>
	   </p>
	 </div>
	</div>
  </div>
</div>
</div>
<div class="author_fenye">
<?php lingfeng_pagenavi( $range = 4 ); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>