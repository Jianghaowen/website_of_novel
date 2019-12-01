<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title('-', true, 'right'); ?></title>
<?php wp_head(); ?>
</head>
<body>
<div id="background">
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
			<div class="book mulu">
				<div class="page-top">
					<h2>
					您现在的位置：<?php lingfeng_breadcrumbs(); ?>
					</h2>				
				</div><!-- .page-top -->
				<div class="page-bom mchapter singlechap">
					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
					<?php setPostViews( get_the_ID() ); ?>
					<h1><?php the_title(); ?></h1>
					<div class="chapinfo">
						时间：<?php the_time('Y-m-d'); ?>	|
						浏览次数：<?php echo getPostViews( get_the_ID() ); ?>次	|
						<?php comments_popup_link( '暂无评论', '1条评论', '%条评论', '', '评论已关闭' ); ?>
					</div><!-- chapinfo -->
					<div class="chapdetail"><?php the_content(); ?></div><!-- chapdetail -->
					<div class="next">
						<?php previous_post_link( '上一章：%link', '%title' , true, '', 'category'); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php next_post_link( '下一章：%link', '%title' , true, '', 'category'); ?>
						<?php if (function_exists('dw_reactions')) { dw_reactions(); } ?>
				    </div><!-- .next -->
					<?php endwhile; ?>
					<?php endif; ?>
				</div><!-- .page-bom -->
			</div><!-- book mulu -->
			<div class="book pinglun">
				<div class="page-top">
					<h2>
						章节评论
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