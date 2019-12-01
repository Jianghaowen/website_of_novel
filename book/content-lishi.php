<div class="mokuai lishi">
				<?php 
					$my_term = get_term_by('name', '外国穿越历史', 'lingfeng_shujileibie');
					$my_term_id = $my_term->term_id;
					$my_term_name = $my_term->name;
					$my_term_link = get_term_link( $my_term_id, 'lingfeng_shujileibie' );
				?>
				<div class="mokuai-title">
					<h2><a href="<?php echo $my_term_link; ?>"><?php echo $my_term_name; ?></a></h2>
					<a class="title-right" href="<?php echo $my_term_link; ?>">更多>></a>
				</div><!-- .mokuai-title -->
				<div class="mokuai-list">
				<?php
					$my_query = new WP_Query( array(
						'post_type'		=>	'page',
						'tax_query'		=>	array(
															array(
																'taxonomy'		=>	'lingfeng_shujileibie',
																'field'				=>	'term_id',
																'terms'				=>	array( $my_term_id ),
																'include_children'	=>	true,
																'operator'		=>	'IN',
															),
						),
						'posts_per_page'	=>	6,	
					) );				
				?>
				<?php if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post(); ?>
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
				</div><!-- .mokuai-list -->
			</div><!-- .mokuai junshi -->