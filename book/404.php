<?php get_header(); ?>
	<div class="middle">
		<div class="content">
			<div class="mokuai">
				<div class="mokuai-title mytax">
					<h2>您现在的位置：<?php lingfeng_breadcrumbs(); ?></h2>
				</div><!-- .mokuai-title -->
				<div class="mokuai-list">
					<p style="line-height:200%;">对不起，您访问的页面不存在或者已经移除。</p>
					<p style="line-height:200%;margin-bottom:30px;">你可以通过关键词，搜索您感兴趣的内容……</p>
				</div><!-- mokuai-list -->
			</div><!-- mokuai -->
		</div><!-- .content -->
		<div class="sidebar">
			<?php get_template_part('content', 'newbook'); ?>	
			<?php get_template_part('content', 'pop'); ?>	
		</div><!-- .sidebar -->
		<div class="clear"></div>
	</div><!-- .middle -->
<?php get_footer(); ?>