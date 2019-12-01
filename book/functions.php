<?php
/**
* 数字分页函数
* 因为wordpress默认仅仅提供简单分页
* 所以要实现数字分页，需要自定义函数
* @Param int $range			数字分页的宽度
* @Return string|empty		输出分页的HTML代码		
*/
function lingfeng_pagenavi( $range = 4 ) {
	global $paged,$wp_query;
	if ( !$max_page ) {
		$max_page = $wp_query->max_num_pages;
	}
	if( $max_page >1 ) {
		echo "<div class='fenye'>"; 
		if( !$paged ){
			$paged = 1;
		}
		if( $paged != 1 ) {
			echo "<a href='".get_pagenum_link(1) ."' class='extend' title='跳转到首页'>首页</a>";
		}
		previous_posts_link('上一页');
		if ( $max_page >$range ) {
			if( $paged <$range ) {
				for( $i = 1; $i <= ($range +1); $i++ ) {
					echo "<a href='".get_pagenum_link($i) ."'";
				if($i==$paged) echo " class='current'";echo ">$i</a>";
				}
			}elseif($paged >= ($max_page -ceil(($range/2)))){
				for($i = $max_page -$range;$i <= $max_page;$i++){
					echo "<a href='".get_pagenum_link($i) ."'";
					if($i==$paged)echo " class='current'";echo ">$i</a>";
					}
				}elseif($paged >= $range &&$paged <($max_page -ceil(($range/2)))){
					for($i = ($paged -ceil($range/2));$i <= ($paged +ceil(($range/2)));$i++){
						echo "<a href='".get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";
					}
				}
			}else{
				for($i = 1;$i <= $max_page;$i++){
					echo "<a href='".get_pagenum_link($i) ."'";
					if($i==$paged)echo " class='current'";echo ">$i</a>";
				}
			}
		next_posts_link('下一页');
		if($paged != $max_page){
			echo "<a href='".get_pagenum_link($max_page) ."' class='extend' title='跳转到最后一页'>尾页</a>";
		}
		echo '<span>共['.$max_page.']页</span>';
		echo "</div>\n";  
	}
}

/**
* lingfeng_breadcrumbs()函数
* 功能是输出面包屑导航HTML代码
* @Param null			不需要输入任何参数
* @Return string		输出HTML代码
*/
function lingfeng_breadcrumbs() {
	/* === OPTIONS === */
	$text['home']     = '网站首页'; // text for the 'Home' link
	$text['category'] = '%s'; // text for a category page
	$text['search']   = '"%s"的搜索结果'; // text for a search results page
	$text['tag']      = '%s'; // text for a tag page
	$text['author']   = '%s'; // text for an author page
	$text['404']      = '404错误'; // text for the 404 page

	$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home   = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title     = 1; // 1 - show the title for the links, 0 - don't show
	$delimiter      = ' &raquo; '; // delimiter between crumbs
	$before         = '<span class="current">'; // tag before the current crumb
	$after          = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$home_link    = home_url('/');
	$link_before  = '<span typeof="v:Breadcrumb">';
	$link_after   = '</span>';
	$link_attr    = ' rel="v:url" property="v:title"';
	$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	$parent_id    = $parent_id_2 = $post->post_parent;
	$frontpage_id = get_option('page_on_front');

	if (is_home() || is_front_page()) {

		if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

	} else {

		echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
		if ($show_home_link == 1) {
			echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			if ($cat) {
				$cats = get_category_parents($cat, TRUE, $delimiter);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;

		} elseif ( has_post_format() && !is_singular() ) {
			echo get_post_format_string( get_post_format() );
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div><!-- .breadcrumbs -->';

	}
} 


/**
* getPostViews()函数
* 功能：获取阅读数量
* 在需要显示浏览次数的位置，调用此函数
* @Param object|int $postID   文章的id
* @Return string $count		  文章阅读数量
*/
function getPostViews( $postID ) {
	 $count_key = 'post_views_count';
	 $count = get_post_meta( $postID, $count_key, true );
	 if( $count=='' ) {
		 delete_post_meta( $postID, $count_key );
		 add_post_meta( $postID, $count_key, '0' );
		 return "0";
	 }
	return $count;
 }


/**
* setPostViews()函数  
* 功能：设置或更新阅读数量
* 在内容页(single.php，或page.php )调用此函数
* @Param object|int $postID   文章的id
* @Return string $count		  文章阅读数量
*/
 function setPostViews( $postID ) {
	 $count_key = 'post_views_count';
	 $count = get_post_meta( $postID, $count_key, true );
	 if( $count=='' ) {
		 $count = 0;
		 delete_post_meta( $postID, $count_key );
		 add_post_meta( $postID, $count_key, '0' );
	 } else {
		 $count++;
		 update_post_meta( $postID, $count_key, $count );
	 }
 }


/**
* lingfeng_strimwidth( ) 函数
* 功能：字符串截取，并去除字符串中的html和php标签
* @Param string $str			要截取的原始字符串
* @Param int $len				截取的长度
* @Param string $suffix		字符串结尾的标识
* @Return string					处理后的字符串
*/
function lingfeng_strimwidth( $str, $len, $start = 0, $suffix = '……' ) {
	$str = str_replace(array(' ', '　','&nbsp;', '\r\n'), '', strip_tags( $str ));
	if ( $len>mb_strlen( $str ) ) {
		return mb_substr( $str, $start, $len );
	}
	return mb_substr($str, $start, $len) . $suffix;
}


/*
register_nav_menu( $location, $description )
函数功能：开启导航菜单功能
@参数 string $location, 导航菜单的位置
@参数 string $description, 导航菜单的描述
开启多个位置的导航菜单，只需要重复调用此函数即可
*/
register_nav_menu( 'zhudaohang', '网站的顶部导航' );     //注册一个菜单

/**
* 加载前台脚本和样式表
* 加载主样式表style.css
*/
add_action('wp_enqueue_scripts', 'lingfeng_scripts');
function lingfeng_scripts() {
	/**
	* wp_enqueue_style( $handle, $src, $deps, $ver, $media );
	* 功能：添加样式表
	* @Param string $handle				【必填】样式表的标识符（名称）
	* @Param string $src						【可选】样式表的所在地址（url）
	* @Param array $deps					【可选】加载本样式之前，必须首先加载的
	* @Param string $ver						【可选】样式表的版本
	* @Param boolen $media				【可选】样式表指定的媒体
	* 例如：wp_enqueue_style( 'lingfeng-style', get_stylesheet_uri() );
	* 加载主题中的style.css文件
	*/
	wp_enqueue_style( 'lingfeng-css', get_template_directory_uri().'/style.css');
	

	/**
	* wp_register_script( $handle, $src, $deps, $ver, $in_footer ) 
	* 函数功能：加载js脚本
	* @Param string $handle				【必填】脚本的标识符（名称）
	* @Param string $src						【可选】脚本所在地址（url）
	* @Param array $deps					【可选】加载本脚本之前，必须首先加载的
	* @Param string $ver						【可选】脚本的版本
	* @Param boolen $in_footer			【可选】脚本的位置，是否放在页脚
	* 函数说明，仅仅是注册和备案，并没有真正添加。
	* 真正要添加脚本，用wp_enqueue_script( ) 函数
	* 例如：wp_register_script ('lingfeng-lazyload', get_template_directory_uri().'/js/jquery.lazyload.js');
	* 解释：注册一个名字为'lingfeng-lazyload'的脚本，脚本的地址是主题文件夹下的js/juqery.lazyload.js
	*/
	

	/**
	* wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer )
	* 函数功能：加载js脚本
	* @Param string $handle				【必填】脚本的标识符（名称）
	* @Param string $src						【可选】脚本所在地址（url）
	* @Param array $deps					【可选】加载本脚本之前，必须首先加载的
	* @Param string $ver						【可选】脚本的版本
	* @Param boolen $in_footer			【可选】脚本的位置，是否放在页脚
	* 例如: wp_enqueue_script ('lingfeng-tool', get_template_directory_uri().'/js/tool.js', array( 'jquery', 'lingfeng-lazyload'));
	* 解释：添加名字为‘lingfeng-tool’的脚本，脚本的地址为主题目录下的js/tool.js，而且在加载此脚本之前先要加载名字叫做'jquery'和'lingfeng-lazyload'的脚本
	*/
	wp_enqueue_script( 'shujilianjie', get_template_directory_uri().'/js/getlink.js', array('jquery'));

}

/**
* 想要wp_title()函数实现，访问首页显示“站点标题-站点副标题”
* 如果存在翻页且正方的不是第1页，标题格式“标题-第2页”
* 当使用短横线-作为分隔符时，会将短横线转成字符实体&#8211;
* 而我们不需要字符实体，因此需要替换字符实体
* wp_title()函数显示的内容，在分隔符前后会有空格，也要去掉
*/
add_filter('wp_title', 'lingfeng_wp_title', 10, 2);
function lingfeng_wp_title($title, $sep) {
	global $paged, $page;

	//如果是feed页，返回默认标题内容
	if ( is_feed() ) { 
		return $title;
	}

	// 标题中追加站点标题
	$title .= get_bloginfo( 'name' );

	// 网站首页追加站点副标题
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// 标题中显示第几页
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( '第%s页', max( $paged, $page ) );

	//去除空格，-的字符实体
	$search = array('&#8211;', ' ');
	$replace = array('-', '');
	$title = str_replace($search, $replace, $title);

	return $title;	
}


/*
add_theme_support($features, $arguments)
函数功能：开启缩略图功能
@参数 string $features, 此参数是告诉wordpress你要开启什么功能
@参数 array $arguments, 此参数是告诉wordpress哪些信息类型想要开启缩略图
第二个参数如果不填写，那么文章信息和页面信息都开启缩略图功能。
*/
add_theme_support('post-thumbnails');
add_image_size( 'dthumbnai1', 120, 150, true );
add_image_size( 'athumbnai1', 100, 150, true );
/**
*	创建一种新的分类方式的代码
*/
add_action( 'init', 'lingfeng_create_taxonomies', 0);
function lingfeng_create_taxonomies() {
	/*
		给页面创建“书籍分类”这种分类方式
	*/
		$taxonomy = 'lingfeng_shujileibie';
		$object_type = 'page';
		$args = array(
			'labels'	=> array(
						'name'							=>	'书籍分类',
						'singular_name'			=>	'书籍分类',
						'menu_name'				=>	'书籍分类',
						'all_items'					=>	'所有书籍类别',
						'edit_item'					=>	'编辑该书籍类别',
						'view_item'					=>	'view_item',
						'update_item'				=>	'update_item',
						'add_new_item'			=>	'添加新的书籍类别',
						'new_item_name'		=>	'new_item_name',
						'parent_item'				=>	'添加父级目录',
						'parent_item_colon'	=>	'parent_item_colon',
						'search_items'			=>	'搜索所有书籍类别',
						'popular_items'			=>	'常用的书籍类别',
						'separate_items_with_commas'	=>	'separate_items_with_commas',
						'add_or_remove_items'					=>	'add_or_remove_items',
						'choose_from_most_used'			=>	'choose_from_most_used',
						'not_found'										=>	'not_found',
			),
			'public'									=>	true,
			'show_ui'								=>	true,
			'show_in_nav_menus'		=>	true,
			'show_tagcloud'					=>	null,
			'meta_box_cb'					=>	null,
			'show_admin_column'		=>	true,
			'hierarchical'						=>	true,
			'update_count_callback'	=>	'',
			'query_var'							=>	$taxonomy,
			'rewrite'								=>	array(
														'slug'					=>	'book',
														'with_front'			=>	 true,
														'hierarchical'		=>	false,
														'ep_mask'			=>	EP_NONE,
			),
			'capabilities'						=>	array(
														'manage_terms'		=> 'manage_categories',
														'edit_terms'				=> 'manage_categories',
														'delete_terms'			=> 'manage_categories',
														'assign_terms'		=> 'manage_categories',
			),
			'sort'									=>	false,
			'_builtin'								=>	false,
		);

	register_taxonomy( $taxonomy, $object_type, $args );

	/*
		给页面信息创建“书籍作者”这种新的分类方式
	*/
		$taxonomy = 'lingfeng_shujizuozhe';
		$object_type = 'page';
		$args = array(
			'labels'	=> array(
						'name'							=>	'书籍作者',
						'singular_name'			=>	'singular_name',
						'menu_name'				=>	'书籍作者',
						'all_items'					=>	'all_items',
						'edit_item'					=>	'编辑该书籍作者',
						'view_item'					=>	'view_item',
						'update_item'				=>	'update_item',
						'add_new_item'			=>	'添加新的作者',
						'new_item_name'		=>	'new_item_name',
						'parent_item'				=>	'parent_item',
						'parent_item_colon'	=>	'parent_item_colon',
						'search_items'			=>	'搜索所有作者',
						'popular_items'			=>	'常用书籍作者',
						'separate_items_with_commas'	=>	'多个作者之间用逗号隔开',
						'add_or_remove_items'					=>	'add_or_remove_items',
						'choose_from_most_used'			=>	'从经常使用的作者中选择',
						'not_found'										=>	'not_found',
			),
			'public'									=>	true,
			'show_ui'								=>	true,
			'show_in_nav_menus'		=>	true,
			'show_tagcloud'					=>	null,
			'meta_box_cb'					=>	null,
			'show_admin_column'		=>	true,
			'hierarchical'						=>	false,
			'update_count_callback'	=>	'',
			'query_var'							=>	$taxonomy,
			'rewrite'								=>	array(
														'slug'					=>	'zuozhe',
														'with_front'			=>	 true,
														'hierarchical'		=>	false,
														'ep_mask'			=>	EP_NONE,
			),
			'capabilities'						=>	array(
														'manage_terms'		=> 'manage_categories',
														'edit_terms'				=> 'manage_categories',
														'delete_terms'			=> 'manage_categories',
														'assign_terms'		=> 'manage_categories',
			),
			'sort'									=>	false,
			'_builtin'								=>	false,
		);

	register_taxonomy( $taxonomy, $object_type, $args );

} //lingfeng_create_taxonomies()结尾
   

/*
     增加用户联系方式
*/
add_filter('user_contactmethods','custom_contactmethods');
function custom_contactmethods($user_contactmethods ){
    $user_contactmethods  = array(
        'qq' => 'QQ',
    );
    return $user_contactmethods ;
}

   
   
   /*
     评论框函数
    */
    function aurelius_comment($comment, $args, $depth)
{
   $GLOBALS['comment'] = $comment; ?>
   <li class="comment" id="li-comment-<?php comment_ID(); ?>">
		 <div class="comments">
			<div class="gravatar"><a class="do_not_like_red" href=" <?php echo get_author_posts_url($comment); ?>" target="_blank"><?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 48); } ?></a></div> 
			<div class="comment_content" id="comment-<?php comment_ID(); ?>">
			 <div class="media-body">
				<div class="clearfix">
						<div class="comment-meta commentmetadata"><span><a class="do_not_like_red" href=" <?php echo get_author_posts_url($comment); ?>" target="_blank"><?php printf(__('<cite class="author_name">%s</cite>'),get_comment_author_link()); ?></a>
						</span>|
						<span class="time_to_say_goodbye"><?php echo get_comment_time('Y-m-d H:i'); ?></span>
				</div>
				</div>
				<div class="comment_text">
					<?php if ($comment->comment_approved == '0') : ?>
						<em>你的评论正在审核，稍后会显示出来！</em><br />
			<?php endif; ?>
			<?php comment_text(); ?>
				</div>
			  </div>	
			</div>
			<div class="reply_my_love">
			<?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		 </div>	
    </li>
<?php } ?>
<?php 
/*
   为文章页添加新的模板
*/
add_action('template_include', 'load_single_template');
  function load_single_template($template) {
    $new_template = '';
    // single post template
    if( is_single() ) {
      global $post;
      // 'wordpress' is category slugs
      if( has_term('shuping', 'category', $post)||has_term('south-roseshuping', 'category', $post) ) {
        // use template file single-wordpress.php
        $new_template = locate_template(array('single-shuping.php' ));
      }
    }
    return ('' != $new_template) ? $new_template : $template;
  }
  //用户自定义头像功能
include (TEMPLATEPATH . '/author-avatars.php');
/*
   自定义登陆页面
*/
function custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/style.css" />';
}
add_action('login_head', 'custom_login');


add_action('comment_post_redirect', 'redirect_to_thank_page');
function redirect_to_thank_page() {
return 'http://localhost/wordpress2/?page_id=35784';
}
?>

    
	