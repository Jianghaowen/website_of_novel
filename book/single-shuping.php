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
	 <?php setPostViews( get_the_ID() ); ?>
	   <div class="art-widget-box">
	     <div class="caption">
			<?php the_title(); ?>
		 </div>
		 <div class="caption-sub">
			 <div class="caption-info">
			   发布：<?php the_time('Y-m-d  G:i:s'); ?> <span class="edit_the_article"><?php edit_post_link('[编辑]'); ?></span>
			 </div>
			 <div class="caption-numbers">
			   <span>
				阅读
				<strong><?php echo getPostViews( get_the_ID() ); ?></strong> 
			   </span>
			 </div>
		 </div>
		 <div class="article-main-text">
		   <?php the_content(); ?>
		 </div>
		 <span class="single_reaction"><?php if (function_exists('dw_reactions')) { dw_reactions(); } ?></span>
	   </div>
	   <?php endwhile; ?>
	   <?php endif; ?>
	   <div class="page-bom mcommtents article_comments">
					<?php comments_template(); ?>
       </div><!-- page-bom --> 
	 </div> 
	 <div class="article_slide">
	  <div class="author-wrapper">
	   <div class="author_introduce">
	     <a href="<?php echo get_author_posts_url($authordata->ID); ?>" target="_blank">
		   <div class="author-photo">
		     <span>
			  <?php echo get_avatar($authordata->ID,60);?>
			 </span>
		   </div>
		   <div class="infor">
			<h5 class="name" title="<?php the_author(); ?>"><?php the_author(); ?></h5>
			<p class="intro">
			<?php $author_description=get_the_author_meta('description');
	      if($author_description){
        echo the_author_meta('description'); 
		}else{
		echo "还没有填写个人介绍";
       } 
	   ?></p>
		   </div>
		 </a>
	   </div>
	  </div>
	 </div> 
  </div>
</div>
<?php wp_footer(); ?>
</body>
</html>