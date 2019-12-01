<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title('-', true, 'right'); ?></title>
<?php wp_head(); ?>
</head>
<body class="all_element w-large">
<div class="home-user-body">
  <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" target="_blank" style="overflow:hidden;">
	<input type="text" value="搜索用户" name="s" id="s" style="width:150px; float:right; margin-top:10px; margin-right:100px;" />
	<a class="tubiao" href="#" name="submit" onclick="document.getElementById('searchform').submit();return false" id="shousuo" style="left:858px; top:10px;">f</a>
  </form>
  <div class="home-user-card all_book_comments all_user_introduce" style="width:945px;">
	<div class="user-card-info left-adjust">
		<h2>最新用户</h2>
	</div>
  </div>
</div>
<div class="wrapper2" style="min-width:950px;">
	  <div class="layout_article" style="width:950px;">
<?php 
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$paged -= 1;
		$limit = 20;
		$offset = $paged * $limit;
        $user_query = new WP_User_Query(array(
							'role__not_in'=>'subscriber',
							'number' => $limit,
                            'offset' => $offset,
						));
      $authors = $user_query->get_results();						
   
    if ($authors): ?>
	  <?php foreach ($authors as $author) : ?>
	    <div class="article_slide all_user">
		  <div class="author-wrapper">
		   <div class="author_introduce">
			 <a href="<?php echo get_author_posts_url($author->ID); ?>" target="_blank">
			   <div class="author-photo">
				 <span>
				  <?php echo get_avatar($author->ID,60);?>
				 </span>
			   </div>
			   <div class="infor">
				<h5 class="name" title="<?php echo $author->display_name; ?>"><?php echo $author->display_name; ?>
				</h5>
				<p class="intro">
					<?php $author_description=get_the_author_meta('description',$author->ID);
					  if($author_description){
						echo the_author_meta('description',$author->ID); 
						}else{
						echo "还没有填写个人介绍";
			   } ?>
			   </p>
			   </div>
			 </a>
		   </div>
		  </div>
		 </div>
		 <?php endforeach; ?>
        <?php endif; ?>
            <?php
				wp_pagenavi(array(
					'query' => $user_query,
					'type' => 'users'
				));
			?>		
	  </div>
	</div>
<?php wp_footer(); ?>
</body>
</html>