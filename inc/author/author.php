<?php
/**
 * Author
 *
 * @package ystandard
 * @author yosiakatsuki
 * @license GPL-2.0+
 */

/**
 * 投稿者の記事一覧リンク取得
 */
if ( ! function_exists( 'ys_get_author_link' ) ) {
	function ys_get_author_link( $user_id = false ) {
		$user_id = ys_check_user_id( $user_id );
		return esc_url_raw( get_author_posts_url( get_the_author_meta( 'ID', $user_id ) ) );
	}
}
function ys_the_author_link( $user_id = false ) {
	echo ys_get_author_link( $user_id );
}
/**
 * 投稿者名取得
 */
if ( ! function_exists( 'ys_get_author_display_name' ) ) {
	function ys_get_author_display_name( $user_id = false ) {
		$user_id = ys_check_user_id( $user_id );
		return get_the_author_meta( 'display_name', $user_id );
	}
}
/**
 * ユーザー表示名の出力
 *
 * @param boolean $user_id ユーザーID.
 * @return void
 */
function ys_the_author_display_name( $user_id = false ) {
	echo ys_get_author_display_name( $user_id );
}
/**
 * 投稿者名（html）取得
 */
if ( ! function_exists( 'ys_get_author_name' ) ) {
	function ys_get_author_name( $user_id = false, $vcard = true ) {
		$user_id = ys_check_user_id( $user_id );
		$author_name = esc_html( ys_get_author_display_name( $user_id ) );
		$author_url = ys_get_author_link( $user_id );
		/**
		 * 投稿者非表示オプションによって構造化データつける付けない判断する
		 */
		if( $vcard && ! ys_is_active_entry_footer_author() ) {
			$vcard = false;
		}
		global $ys_author;
		if( $vcard && false !== $ys_author ) {
			$vcard = false;
		}
		if ( $vcard ) {
			$author_name = sprintf(
				'<span class="vcard author"><a class="url fn author__link" href="%s">%s</a></span>',
				$author_url,
				$author_name
			);
		}
		return $author_name;
	}
}
function ys_the_author_name( $user_id = false, $vcard = true ) {
	echo ys_get_author_name( $user_id = false, $vcard = true );
}
/**
 * 投稿者 SNS一覧取得
 */
if ( ! function_exists( 'ys_get_author_sns_list' ) ) {
	function ys_get_author_sns_list( $user_id = false ) {
		$user_id = ys_check_user_id( $user_id );
		/**
		 * 取得対象の meta key
		 * キーがmeta key,valueがfontawesomeのクラス
		 */
		$sns_key = array(
			'url'           => 'globe',
			'ys_twitter'    => 'twitter',
			'ys_facebook'   => 'facebook',
			'ys_googleplus' => 'google-plus',
			'ys_instagram'  => 'instagram',
			'ys_tumblr'     => 'tumblr',
			'ys_youtube'    => 'youtube-play',
			'ys_github'     => 'github',
			'ys_pinterest'  => 'pinterest',
			'ys_linkedin'   => 'linkedin',
		);
		$list    = array();
		foreach ( $sns_key as $key => $val ) {
			$arg = ys_get_author_sns_item( $key, $val, $user_id );
			if ( false !== $arg ) {
				$list[] = $arg;
			}
		}
		return apply_filters( 'ys_get_author_sns_list', $list );
	}
}
/**
 * 投稿者 SNS一覧用配列取得
 *
 * @param string $key key.
 * @param string $val value.
 * @param int    $user_id user id.
 * @return array
 */
function ys_get_author_sns_item( $key, $val, $user_id ) {
	$url = get_the_author_meta( $key, $user_id );
	if ( '' == $url ) {
		return false;
	}
	return array(
		'type' => $key,
		'icon' => esc_attr( $val ),
		'url'  => esc_url_raw( $url ),
	);
}

/**
 * 投稿者 SNSリンク出力
 *
 * @return void
 */
function ys_the_author_sns() {
	$sns = ys_get_author_sns_list();
	if ( ! empty( $sns ) ) :
	?>
	<ul class="author__sns list-style--none">
		<?php foreach ( $sns as $item ) : ?>
			<li class="author__sns-item">
				<a class="sns__color--<?php echo $item['icon']; ?> author__sns-link" href="<?php echo $item['url']; ?>" target="_blank" rel="nofollow"><i class="fa fa-<?php echo $item['icon']; ?>" aria-hidden="true"></i></a>
			</li>
		<?php endforeach; ?>
	</ul><!-- .author__sns -->
	<?php
	endif;
}

/**
 * 投稿者 プロフィール説明文取得
 */
if ( ! function_exists( 'ys_get_author_description' ) ) {
	function ys_get_author_description( $wpautop = true, $user_id = false ){
		$user_id = ys_check_user_id( $user_id );
		$author_dscr = get_the_author_meta( 'description' , $user_id );
		if( $wpautop ){
			$author_dscr = wpautop( str_replace( array( "\r\n", "\r", "\n" ), "\n\n", $author_dscr ) );
		}
		return $author_dscr;
	}
}
/**
 * 投稿者 プロフィール出力
 *
 * @param boolean $wpautop pタグ追加有無.
 * @param boolean $user_id ユーザーID.
 * @return void
 */
function ys_the_author_description( $wpautop = true, $user_id = false ) {
	echo ys_get_author_description( $wpautop, $user_id );
}
/**
 * 投稿者画像取得
 */
if ( ! function_exists( 'ys_get_author_avatar' ) ) {
	function ys_get_author_avatar( $user_id = false, $size = 96, $class = array() ) {
		$user_id = ys_check_user_id( $user_id );
		$author_id = false == $user_id ? get_the_author_meta( 'ID' ) : $user_id;
		$alt = esc_attr( ys_get_author_display_name() );
		$user_avatar = get_avatar( $author_id, $size, '', $alt, array( 'class' => 'author__img' ) );
		$custom_avatar = get_user_meta( $author_id, 'ys_custom_avatar', true );
		/**
		 * imgタグ作成
		 */
		$img = '';
		if ( empty( $class ) ) {
			$class = array( 'author__img' );
		}
		if ( '' !== $custom_avatar ) {
			$img = sprintf(
				'<img class="%s" src="%s" alt="%s" %s />',
				implode( ' ', $class ),
				$custom_avatar,
				$alt,
				image_hwstring( $size, $size )
			);
		}
		/**
		 * カスタムアバターが無ければ通常アバター
		 */
		if ( '' == $img ) {
			$img = $user_avatar;
		}
		$img = ys_amp_convert_image( $img );
		return apply_filters( 'ys_get_author_avatar', $img, $author_id, $size );
	}
}
function ys_the_author_avatar( $user_id = false, $size = 96, $class = array() ) {
	echo ys_get_author_avatar( $user_id, $size, $class );
}
/**
 * 投稿者ID 上書きチェック
 * 主にショートコードでの上書きに使用
 */
function ys_check_user_id( $user_id ) {
	global $ys_author;
	if ( false === $user_id && false !== $ys_author ) {
		$user_id = $ys_author;
	}
	return $user_id;
}