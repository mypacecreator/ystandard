<?php
/* ***************************************************************************
 *
 *	テンプレート出力する類の関数
 *
 * ************************************************************************ */


//-----------------------------------------------
//	この記事を読む
//-----------------------------------------------
if (!function_exists( 'ys_template_the_entry_more_text')) {
	function ys_template_the_entry_more_text() {

		$read_more = 'この記事を読む';

		echo apply_filters('ys_entry_more_text',$read_more);
	}
}


/**
 * 記事header SNSシェアボタン
 */
if( ! function_exists( 'ys_template_the_entry_header_share' ) ) {
	function ys_template_the_entry_header_share() {

		global $post;

		$html = '';
		$html .= '<aside id="sns-share__entry-header" class="sns-share__header">';

		$html .= ys_template_get_the_sns_share_buttons();
		$html .= '</aside>';

		// シェアボタンが非表示なら表示消す
		if( 0 == ys_get_setting( 'ys_sns_share_on_entry_header' ) ){
			$html = '';
		}

		echo apply_filters( 'ys_template_the_entry_header_share', $html );

	}
}



//-----------------------------------------------
//	関連記事
//-----------------------------------------------
if( ! function_exists( 'ys_template_the_related_post' ) ) {
	function ys_template_the_related_post() {

		if(ys_get_setting('ys_show_post_related') == 1 && !ys_is_amp()) {
			$cats = ys_utilities_get_cat_id_list();
			$cats = apply_filters('ys_the_related_post_category_in',$cats);
			$option = array(
											'post__not_in' => array(get_the_ID()),  //現在の投稿IDは除く
											'category__in' => $cats, //カテゴリー絞り込み
										);

			$query = new WP_Query(ys_utilities_get_rand(4,$option));

			if ($query->have_posts()) {
				echo '<aside class="entry-post-related entry-footer-container">';
				echo '<h2>関連記事</h2>';
				while ($query->have_posts()) : $query->the_post();
					get_template_part( 'template-parts/content','related' );
				endwhile;
				echo '</aside>';
			}
			wp_reset_postdata();
		}

	}//ys_template_the_related_post
}




//-----------------------------------------------
//	前の記事・次の記事
//-----------------------------------------------
if( ! function_exists( 'ys_template_the_post_paging' ) ) {
	function ys_template_the_post_paging() {

		if(ys_get_setting('ys_hide_post_paging') == 1){
			return;
		}

		$html = '<div class="post-navigation entry-footer-container">';

		$home = '<a href="'.esc_url( home_url( '/' ) ).'">';
		$home .= '<i class="fa fa-home" aria-hidden="true"></i>';
		$home .= '</a>';

		$post_navigation_warp = '<div class="nav-prev">';
		$prevpost = get_previous_post();
		if ($prevpost) {
			$prev_info = apply_filters('ys_the_post_paging_prev_info','<span class="prev-label">«前の投稿</span>');
			$prev_img = '';
			if( has_post_thumbnail( $prevpost->ID ) ) {
				$prev_img = ys_template_get_the_post_thumbnail( 'yslistthumb', false, false, '', 'post-navigation-image', $prevpost->ID);
				$prev_img = apply_filters( 'ys_the_post_paging_prev_image', $prev_img, $prevpost->ID );
				$prev_img = '<span class="post-navigation-image-wrap post-list-thumbnail-center">'.$prev_img.'</span>';
			}
			$prev_link = '<a href="'.esc_url(get_permalink($prevpost->ID)).'">'.$prev_img.get_the_title($prevpost->ID).'</a>';
			$prev_link = apply_filters('ys_the_post_paging_prev_link',$prev_link);
			$html .= $post_navigation_warp.$prev_info.$prev_link;
		} else {
			$post_navigation_warp = '<div class="nav-prev home">';
			$html .= $post_navigation_warp.$home;
		}
		$html .= '</div>';

		$post_navigation_warp = '<div class="nav-next">';
		$nextpost = get_next_post();
		if ($nextpost){

			$next_info = apply_filters('ys_the_post_paging_next_info','<span class="next-label">次の投稿»</span>');
			$next_img = '';
			if( has_post_thumbnail( $nextpost->ID ) ) {
				$next_img = ys_template_get_the_post_thumbnail( 'yslistthumb', false, false, '', 'post-navigation-image', $nextpost->ID);
				$next_img = apply_filters( 'ys_the_post_paging_next_image', $next_img, $nextpost->ID );
				$next_img = '<span class="post-navigation-image-wrap post-list-thumbnail-center">'.$next_img.'</span>';
			}
			$next_link = '<a href="'.esc_url(get_permalink($nextpost->ID)).'">'.$next_img.get_the_title($nextpost->ID).'</a>';
			$next_link = apply_filters('ys_the_post_paging_next_link',$next_link);
			$html .= $post_navigation_warp.$next_info.$next_link;
		} else {
			$post_navigation_warp = '<div class="nav-next home">';
			$html .= $post_navigation_warp.$home;
		}
		$html .= '</div>';



		$html .= '</div>';

		$html = apply_filters('ys_post_paging',$html);

		echo $html;
	}
}




//-----------------------------------------------
//	AMPページ用メニュー出力
//-----------------------------------------------
if( ! function_exists( 'ys_template_the_amp_menu' ) ) {
	function ys_template_the_amp_menu() {

		if(ys_is_amp()):
		?>
			<amp-sidebar id='sidebar' layout="nodisplay" side="right" class="amp-slider">
				<button class="menu-toggle-label" on='tap:sidebar.close'>
					<span class="top"></span>
					<span class="middle"></span>
					<span class="bottom"></span>
				</button>
				<nav id="site-navigation" class="main-navigation">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'gloval',
				'menu_class'		 => 'gloval-menu',
				'container_class' => 'menu-global-container',
				'depth'          => 2
			 ) );
		?>
			</nav><!-- .main-navigation -->
		</amp-sidebar>
		<?php
		endif;
	}
}




//-----------------------------------------------
//	copyright
//-----------------------------------------------
if( ! function_exists( 'ys_template_the_copyright' ) ) {
	function ys_template_the_copyright() {

		$copyright = '<p class="copy">Copyright &copy; '.ys_get_setting('ys_copyright_year').' <a href="'. esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo('name') . '</a> All Rights Reserved.</p>';
		$powered = '<p id="powered">Powered by <a href="https://ja.wordpress.org/" target="_blank" rel="nofollow">WordPress</a> &amp; ';
		$poweredtheme = '<a href="https://wp-ystandard.com" target="_blank" rel="nofollow">yStandard Theme</a> by <a href="https://yosiakatsuki.net/blog/" target="_blank" rel="nofollow">yosiakatsuki</a></p>';

		$copyright = apply_filters('ys_copyright',$copyright);
		$powered = apply_filters('ys_poweredby',$powered);
		$poweredtheme = apply_filters('ys_poweredby_theme',$poweredtheme);

		echo $copyright.$powered.$poweredtheme;
	}
}







//------------------------------------------------------------------------------
//
//	タクソノミー関連の関数
//
//------------------------------------------------------------------------------
//-----------------------------------------------
//	投稿のカテゴリー出力
//-----------------------------------------------
if( ! function_exists( 'ys_template_the_post_categorys' ) ) {
	function ys_template_the_post_categorys($number = 0,$link=true,$separator=', ',$postid=0) {
		echo '<svg class="entry-meta-ico" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 20 20"><path d="M0 4c0-1.1.9-2 2-2h7l2 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2 2v10h16V6H2z"/></svg>'.ys_utilities_get_the_post_categorys($number,$link,$separator,$postid,array('itemprop'=>true));
	}
}




//-----------------------------------------------
//	投稿のカテゴリー一覧出力
//-----------------------------------------------
if( ! function_exists( 'ys_template_the_category_list' ) ) {
	function ys_template_the_category_list($before,$after,$separator=', ',$link=true,$postid=0,$args=array()) {

		$categorys = ys_utilities_get_the_post_categorys(0,$link,$separator,$postid,$args);

		echo $before;
		echo $categorys;
		echo $after;
	}
}




//-----------------------------------------------
//	投稿のタグ一覧出力
//-----------------------------------------------
if( ! function_exists( 'ys_template_the_tag_list' ) ) {
	function ys_template_the_tag_list($before,$after,$separator=', ',$link=true,$postid=0) {

		$tags = ys_utilities_get_the_tag_list($separator,$link,$postid);

		if($tags != ''){
			echo $before;
			echo $tags;
			echo $after;
		}
	}
}




//-----------------------------------------------
//	投稿のタグ一覧出力
//-----------------------------------------------
if( ! function_exists( 'ys_template_the_taxonomy_list' ) ) {
	function ys_template_the_taxonomy_list() {

		echo '<div class="entry-footer-container">';

		// カテゴリー
		ys_template_the_category_list('<aside class="entry-category-list"><h2>カテゴリー</h2>','</aside>','',true,0);
		// タグ
		ys_template_the_tag_list('<aside class="entry-tag-list"><h2>タグ</h2>','</aside>','');

		echo '</div>';

	}
}




//------------------------------------------------------------------------------
//
//	画像関連の関数
//
//------------------------------------------------------------------------------

if (function_exists( 'ys_template_get_the_post_thumbnail')) {
	function ys_template_get_the_post_thumbnail(
																	$thumbname='full',
																	$viewsize=false,
																	$outputmeta=true,
																	$imgid='',
																	$imgclass='',
																	$postid=0
																) {

		if($postid == 0){
			$postid = get_the_ID();
		}

		$html = '';
		$image = null;
		$thumbname = apply_filters( 'ys_the_post_thumbnail_thumbname', $thumbname, $postid );
		$imgid = apply_filters( 'ys_the_post_thumbnail_id', $imgid, $thumbname, $postid );
		$imgclass = apply_filters( 'ys_the_post_thumbnail_class', $imgclass, $thumbname, $postid );

		if( has_post_thumbnail( $postid ) ) {

			$post_thumbnail_id = get_post_thumbnail_id( $postid );

			if( $post_thumbnail_id ) {
				$image = wp_get_attachment_image_src( $post_thumbnail_id, $thumbname );
			}

			$attr = array();
			if( $imgid ) $attr = wp_parse_args( array( 'id'=>$imgid ), $attr );
			if( $imgclass ) $attr = wp_parse_args( array( 'class'=>$imgclass ), $attr );

			$html = get_the_post_thumbnail( $postid, $thumbname, $attr );

		}

		if( '' == $html ) {

			// 画像を取得
			$image = ys_utilities_get_post_thumbnail($thumbname,'',$postid);

			// id確認
			if($imgid !== ''){
				$imgid = ' id="'.$imgid.'"';
			}
			// class確認
			if($imgclass !== ''){
				$imgclass = ' class="'.$imgclass.'"';
			}

			if( !is_array( $viewsize ) ){
				$viewsize = array($image[1],$image[2]);
			} else {
				if( 0 == $viewsize[0] ){
					$viewsize[0] = $image[1];
				}
				if( 0 == $viewsize[1] ){
					$viewsize[1] = $image[2];
				}
			}

			$html = '<img '.$imgid.$imgclass.'src="'.$image[0].'" '.image_hwstring($viewsize[0],$viewsize[1]).' alt="" />';

		}

		$html = apply_filters( 'ys_the_post_thumbnail', $html, $image, $thumbname, $postid );
		$html =  ys_amp_convert_image($html);

		//metaタグを出力
		if($outputmeta){
			$html .= ys_utilities_get_the_image_object_meta($image);
		}

		return $html;
	}
}

/**
 *	画像取得（出力）
 */
// if (!function_exists( 'ys_template_the_post_thumbnail')) {
// 	function ys_template_the_post_thumbnail(
// 																	$thumbname='full',
// 																	$viewsize=false,
// 																	$outputmeta=true,
// 																	$imgid='',
// 																	$imgclass='',
// 																	$postid=0
// 																) {
//
// 		echo ys_template_get_the_post_thumbnail( $thumbname, $viewsize, $outputmeta, $imgid, $imgclass, $postid );
// 	}
// }