<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title('-', true, 'right'); ?></title>
<?php wp_head(); ?>
</head>
<?php 
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$paged -= 1;
		$limit = 20;
		$offset = $paged * $limit;
        $user_query = new WP_User_Query(array(
							'role__not_in'=>'subscriber',
							'number' => $limit,
                            'offset' => $offset,
							'search'=>get_search_query(),
						));
      $authors = $user_query->get_results();	?>	
<?php
					$my_query1 = new WP_Query( array(
						's'								=>	get_query_var('s'),
						'post_type'				=>	'page',
						'posts_per_page'	=>	-1,
						'post__not_in' => array(30218,35373,35372,35371,35354,35346,35339,35339,35340,35784), 
					) );
				?>
<body style="background:none;" class="all_element">
<div class="home-user-card-el">
	<div class="home-user-body" style="width:700px;">
	 <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>"target="_blank">
		<input type="text" value="搜索书评小说或用户" name="s" id="s" style="width:150px; float: right; margin-right: 30px;"/>
		<a class="tubiao" href="#" name="submit" onclick="document.getElementById('searchform').submit();return false" id="shousuo" style="left:647px;">f</a>
	 </form>
	</div>
  <div class="home-user-card all_book_comments" style="width:700px;">
	<div class="user-card-info left-adjust">
		<h2>搜索结果</h2>
	</div>
  </div>
</div>
 <div class="home-user-body" style="width:700px;">
 <div class="bianhua4"> 
  <a class="bianhua3" href="javascript:void(0);">书评或小说</a>
  <span>|</span>
  <a class="bianhua5" href="javascript:void(0);">用户</a>
 </div> 
 <div class="home-content bianhua">
  <?php if($my_query1 ) {?>
  <?php if($my_query1->have_posts() ) : while( $my_query1->have_posts() ) : $my_query1->the_post(); ?>
  <?php setPostViews( get_the_ID() ); ?>
   <div class="tashuo-item">
    <div class="tashuo-item-author">
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
   <?php else: ?>
   <div class="bianhua7">查找不到您要寻找的书评或小说^-^,请重新输入或者核对文字。</div>
  <?php endif; ?>
</div>
<div class="home-content bianhua2">
<div class="bianhua7">
<?php if ($authors): ?>			
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
		 <?php else: ?>
      查找不到您要寻找的用户^-^,请重新输入或者核对文字。
        <?php endif; ?>
            <?php
				wp_pagenavi(array(
					'query' => $user_query,
					'type' => 'users'
				));
			?>
        </div>			
	  </div>
</div>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>