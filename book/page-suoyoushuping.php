<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title('-', true, 'right'); ?></title>
<?php wp_head(); ?>
</head>
<body style="background:none;" class="all_element">
<div class="home-user-card-el">
  <div class="home-user-body" style="width:700px;">
	 <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>"  target="_blank">
		<input type="text" value="搜索书评或小说" name="s" id="s" style="width:150px;  float: right; margin-right: 30px;"/>
		<a class="tubiao" href="#" name="submit" onclick="document.getElementById('searchform').submit();return false" id="shousuo" style="left:647px;">f</a>
	 </form>
  </div>
  <div class="home-user-card all_book_comments" style="width:700px;">
	<div class="user-card-info left-adjust">
		<h2>所有书评</h2>
	</div>
  </div>
</div>  
  <?php 
						$my_query = new WP_Query(array(
							'cat'							=>	91,
							'posts_per_page'	=>	-1,
							'post_type'				=>	'post',
							'order'						=>	'DESC',
						));
					?><!--查询作者书评-->
 <div class="home-user-body" style="width:700px;">
 <div class="home-content">
  <div class="J-items">
  <?php if($my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post(); ?>
  <?php setPostViews( get_the_ID() ); ?>
   <div class="tashuo-item">
    <div class="tashuo-item-author">
	  <div class="author-avatar">
	    <span>
		<a href="<?php echo get_author_posts_url($authordata->ID); ?>" target="_blank">
		 <?php echo get_avatar($authordata->ID,30);?>
		</a>
		</span>
	  </div>
	  <div class="author-text">
	   <a href="<?php echo get_author_posts_url($authordata->ID); ?>" target="_blank"><?php the_author_meta('display_name');?></a>&nbsp;&nbsp;发布了书评
	  </div>
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
  <?php endif; ?><!-- 书评循环-->
 </div>
</div>
</div>
<div class="author_fenye">
<?php lingfeng_pagenavi( $range = 4 ); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>