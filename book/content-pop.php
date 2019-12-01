			<div class="widget popbook">
				<h3><span>最受欢迎</span></h3>
				<ul>
				<?php 
					$my_query = new WP_Query( array( 
						'post_type'				=>	'page',
						'posts_per_page'	=>	15,
						'orderby'					=>	'comment_count',
						'order'						=>	'DESC',
						'post__not_in' => array(26402,34720,30218,35373,35372,35371,35354,35346,35339,35339,35340,35784), 
					) );
				?>
				<?php if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post(); ?>
					<li>[<?php the_terms( get_the_ID(), 'lingfeng_shujileibie', '', ',', '' ); ?>]&nbsp;<a class="biaoti" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				<?php endif; ?>
				</ul>
			</div><!-- .widget .newbook -->