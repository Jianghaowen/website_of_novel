<?php get_header(); ?>
	<div class="middle">
		<div class="content">
			<div class="mokuai">
				<div class="mokuai-title mytax">
					<h2>您现在的位置：<?php lingfeng_breadcrumbs(); ?></h2>
				</div><!-- .mokuai-title -->
				<div class="mokuai-list">
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
					<div class="box">
						<div class="pic">
							<?php if ( has_post_thumbnail() ) : ?>
								 <a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'athumbnai1' ); ?>
								</a>
							<?php endif; ?>
						</div><!-- .pic -->
						<div class="txt">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="zuozhe"><?php the_terms(get_the_ID(), 'lingfeng_shujizuozhe', '', ',', '' ); ?>&nbsp;&nbsp;&nbsp;&nbsp;著</div><!-- .zuozhe -->
							<div class="jianjie">
								<?php echo lingfeng_strimwidth( get_the_content(), 30, 0, '' ) ?>
							</div><!-- .jianjie -->
						</div><!-- .txt -->
					</div><!-- .box -->
				<?php endwhile; ?>
				<?php endif; ?>
				<div class="clear"></div>
				</div><!-- .mokuailist -->
			</div><!-- .mokuai -->
			<?php lingfeng_pagenavi( $range = 4 ); ?>
		</div><!-- .content -->
		<div class="sidebar">
			<?php get_template_part('content', 'newbook'); ?>	
			<?php get_template_part('content', 'pop'); ?>	
		</div><!-- .sidebar -->
		<div class="clear"></div>
	</div><!-- .middle -->
<?php get_footer(); ?>