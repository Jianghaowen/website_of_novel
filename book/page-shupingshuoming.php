<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title('-', true, 'right'); ?></title>
<?php wp_head(); ?>
</head>
<body class="all_element w-large">
<div class="wrapper1">
 <div class="layout_article">
   <div class="single_content">
   <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
     <div class="art-widget-box">
	   <div class="article-main-text">
		   <?php the_content(); ?>
		 </div>
	 </div>
	<?php endwhile; ?>
	<?php endif; ?>
	<a href="javascript:window.history.back();" class="back">返回</a>
   </div>
 </div>
</div>
<?php wp_footer(); ?>
</body>
</html>