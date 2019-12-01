<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title('-', true, 'right'); ?></title>
<?php wp_head(); ?>
</head>
<body>
<div id="background">
<div class="background2">
<div class="wrap">
	<div class="header">
		<!-- header-top -->
		<div class="header-mid">
		   <!--
			<h1 class="header-logo">
				<a href="<?php bloginfo('url'); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" />
				</a>
			</h1>
			-->
			<!-- .header-logo -->
			<div class="header-search">
				<?php get_search_form(); ?>
			</div><!-- .header-search -->
			<div class="clear"></div>
		</div><!-- .header-mid -->
		<div class="header-nav">
			<?php
			wp_nav_menu( array(
			  'theme_location'	=> 'zhudaohang',			//[保留]
			  'menu'					=> '',									//[可删]
			  'container'				=> false,							//[可删]
			  'container_class'	=> '',									//[可删]
			  'container_id'		=> '',									//[可删]
			  'menu_class'		=> 'menu',						//[可删]
			  'menu_id'				=> '',									//[可删]
			  'echo'					=> true,							//[可删]
			  'fallback_cb'			=> 'wp_page_menu',		//[可删]
			  'before'					=> '',									//[可删]
			  'after'						=> '',									//[可删]		
			  'link_before'			=> '',									//[可删]
			  'link_after'				=> '',									//[可删]
			  'items_wrap'			=> '<ul id="%1$s" class="%2$s">%3$s</ul>',	//[可删]
			  'depth'					=> 2,								//[可删]
			  'walker'					=> ''									//[可删]			
			) );
			?>
			<div class="shuxian"></div><!-- .shuxian -->
		</div><!-- .header-nav -->
	</div><!-- .header -->
	<div class="middle">
		<div class="content">
			<div class="book description">
				<div class="page-top">
					<h2>
					您现在的位置：<?php lingfeng_breadcrumbs(); ?>
					</h2>
				</div><!-- .page-top -->
				<div class="page-bom">
				<?php if ( have_posts() ) :while( have_posts() ) :the_post(); ?>
					<div class="book_pic" style="width:10px; height:100px; margin-right:130px; margin-left:30px;">
						<div class="pic_box" style="width:10px; height:100px;">
							<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									 <?php the_post_thumbnail( 'dthumbnai1' ); ?>
								<?php endif; ?>
							</a>
						</div><!-- .pic_box -->
						<div class="opt" style="display:none;">
							<ul>
								<li><a class="read" target="_blank" href="javascript:;">点击阅读</a></li>
								<li><a class="chaps" target="_blank" href="javascript:;">全部目录</a></li>
							</ul>
						</div><!-- .opt -->
					</div><!-- .book_pic -->
					<div class="book_info">
						<h3><?php the_title(); ?></h3>
						<div class="meta_info">
							<?php the_terms( get_the_ID(), 'lingfeng_shujileibie', '分类：' , ',', ''); ?>&nbsp;&nbsp;&nbsp;
							<?php the_terms( get_the_ID(), 'lingfeng_shujizuozhe', '作者：', ',', '' ); ?>
						</div><!-- .meta_info -->
						<div class="book_desc"><?php the_content(); ?></div><!-- .book_desc -->
					</div><!-- .book_info -->
					<div class="clear"></div>
				<?php endwhile; ?>
				<?php endif; ?>
				</div><!-- .page-bom -->
			</div><!--  -->
			<div class="book chapters" style="display:none;">
				<div class="page-top">
					<h2>
					章节列表
					<?php
						//$my_post = get_post( get_query_var('page_id') );
						//$my_post_name = $my_post->post_title;
						//获取页面的标题
						//var_dump($wp_query);

						//$posts变量，存储wordpress数据调用中的所有的文章或者页面信息
						//var_dump($posts);
						
						//$post变量，存储一篇信息。
						//var_dump($post);
						$my_post_name = $post->post_title;
						//echo $my_post_name;
						$my_cat = get_term_by('name', $my_post_name, 'category');
						$my_cat_id =  $my_cat->term_id;
						$my_cat_link = get_term_link( $my_cat_id, 'category' );
					?>
					<a href="<?php echo $my_cat_link; ?>">[进入目录页]</a>
					</h2>
				</div><!-- .page-top -->
				<div class="page-bom mchapter">
				<?php
					$my_query = new WP_Query( array(
						'cat'								=>	$my_cat_id,
						'posts_per_page'		=>	-1,
						'post_type'					=>	'post',
						'order'							=>	'ASC',
					) );				
				?>
					<ul>
					<?php if( $my_query->have_posts() ) :while( $my_query->have_posts() ) :$my_query->the_post(); ?>
						<li><a target="_blank" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
					<?php endif; ?>
					</ul>
					<div class="clear"></div>
				</div><!-- page-bom -->
			</div><!--  -->
			<div class="book pinglun">
				<div class="page-top">
					<h2>
						作品评分
					</h2>
				</div><!-- .page-top -->	
				<div class="page-bom mcommtents">
					<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
				</div><!-- page-bom -->
			</div><!-- book pingfen			-->
			<div class="book pinglun">
				<div class="page-top">
					<h2>
						说明
					</h2>
				</div><!-- .page-top -->	
				<div class="page-bom mcommtents">
					因为网上不好找到相关资源（有的资源有其它网站广告在小说阅读的时候，我不想扒那样的），如果想阅读请自行搜索。
					I believe you can find that just using Baidu search.
					简单来说你百度搜民国往事小说第一个就能看（一般来说）。。。我测试过。。。
				</div><!-- page-bom -->
			</div><!-- book pinglun -->
			<div class="book pinglun">
				<div class="page-top">
					<h2>
						作品评论
					</h2>
				</div><!-- .page-top -->	
				<div class="page-bom mcommtents">
					<?php comments_template(); ?>
				</div><!-- page-bom -->
			</div><!-- book pinglun -->
		</div><!-- .content -->
		<div class="sidebar">
			<?php get_template_part('content', 'newbook'); ?>	
			<?php get_template_part('content', 'pop'); ?>	
		</div><!-- .sidebar -->
		<div class="clear"></div>
	</div><!-- .middle -->
<?php get_footer(); ?>