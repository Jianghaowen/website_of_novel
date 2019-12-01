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
		<div class="header-top">
			<?php bloginfo('description'); ?>
		</div>
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
				<div class="page-bom mchapter">
					<?php 
						$my_query = new WP_Query(array(
							'cat'							=>	get_query_var( 'cat' ),
							'posts_per_page'	=>	-1,
							'post_type'				=>	'post',
							'order'						=>	'ASC',
						));
					?>
					<ul>
					<?php if( $my_query->have_posts() ) :while( $my_query->have_posts() ) :$my_query->the_post(); ?>
						<li><a target="_blank" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
					<?php endif; ?>
					</ul>
					<div class="clear"></div>
				</div><!-- .page-bom -->
			</div><!-- book mulu -->
		</div><!-- .content -->
		<div class="sidebar">
			<?php get_template_part('content', 'newbook'); ?>	
			<?php get_template_part('content', 'pop'); ?>	
		</div><!-- .sidebar -->
		<div class="clear"></div>
	</div><!-- .middle -->
<?php get_footer(); ?>