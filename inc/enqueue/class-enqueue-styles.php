<?php
/**
 * CSS読み込みクラス
 *
 * @package ystandard
 * @author  yosiakatsuki
 * @license GPL-2.0+
 */

namespace ystandard;
use ystandard\helper\Filesystem;
use ystandard\helper\Style_Sheet;

defined( 'ABSPATH' ) || die();

/**
 * Class Enqueue_Styles
 *
 * @package ystandard
 */
class Enqueue_Styles {

	/**
	 * Main CSS.
	 */
	const HANDLE_MAIN = 'ystandard';

	/**
	 * Blocks CSS.
	 */
	const HANDLE_BLOCKS = 'ys-blocks';


	/**
	 * Enqueue_Styles constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_css' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'dequeue_css' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_style_css' ], 100 );
		// CSSインライン読み込み.
		if ( Option::get_option_by_bool( 'ys_option_optimize_load_css', false ) ) {
			add_filter( 'style_loader_tag', [ $this, 'style_loader_inline' ], PHP_INT_MAX, 4 );
		}
		add_filter( 'wp_get_custom_css', [ $this, '_wp_get_custom_css' ] );
	}

	/**
	 * CSS enqueue
	 */
	public function enqueue_css() {
		/**
		 * メインCSS
		 */
		wp_enqueue_style(
			self::HANDLE_MAIN,
			get_template_directory_uri() . '/css/ystandard.css',
			[],
			filemtime( get_template_directory() . '/css/ystandard.css' )
		);

		wp_add_inline_style(
			self::HANDLE_MAIN,
			$this->get_inline_css()
		);

		// 位置調整.
		wp_dequeue_style( 'wp-block-library' );
		wp_enqueue_style( 'wp-block-library' );
		wp_enqueue_style(
			self::HANDLE_BLOCKS,
			get_template_directory_uri() . '/css/blocks.css',
			[],
			filemtime( get_template_directory() . '/css/blocks.css' )
		);
		wp_add_inline_style(
			self::HANDLE_BLOCKS,
			$this->get_blocks_inline_css()
		);

		do_action( 'ys_enqueue_css' );

		/**
		 * Style css
		 */
		wp_enqueue_style(
			'style-css',
			get_stylesheet_uri(),
			[],
			Utility::get_theme_version( true )
		);

		$this->style_add_data();
	}

	/**
	 * Add Data
	 */
	private function style_add_data() {
		wp_style_add_data( self::HANDLE_MAIN, 'inline', true );
		wp_style_add_data( 'wp-block-library', 'inline', 'none' );
		do_action( 'ys_style_add_data' );
	}

	/**
	 * インラインCSSを取得
	 *
	 * @return string
	 */
	private function get_inline_css() {
		$inline   = Style_Sheet::minify( apply_filters( Enqueue_Utility::FILTER_INLINE_CSS, '' ) );
		$css_vars = self::get_css_vars_selector();

		return $inline . $css_vars;
	}

	/**
	 * インラインCSSを取得
	 *
	 * @return string
	 */
	private function get_blocks_inline_css() {

		return Style_Sheet::minify( apply_filters( Enqueue_Utility::FILTER_BLOCKS_INLINE_CSS, '' ) );
	}

	/**
	 * CSSカスタムプロパティを作成する
	 *
	 * @return string
	 */
	public static function get_css_vars_selector() {
		/**
		 * CSSカスタムプロパティに指定する値
		 * name,value
		 */
		$vars = apply_filters( Enqueue_Utility::FILTER_CSS_VARS, [] );
		if ( empty( $vars ) ) {
			return '';
		}
		$result = '';
		foreach ( $vars as $key => $value ) {
			if ( ! empty( $key ) && '' !== $value ) {
				$result .= "--{$key}: {$value};";
			}
		}

		if ( ! $result ) {
			return '';
		}

		return ":root{ ${result} }";
	}

	/**
	 * Style.cssの位置調整
	 */
	public function enqueue_style_css() {
		wp_dequeue_style( 'style-css' );
		wp_enqueue_style(
			'style-css',
			get_stylesheet_uri(),
			[],
			Utility::get_theme_version( true )
		);
	}

	/**
	 * CSS dequeue
	 */
	public function dequeue_css() {
		wp_dequeue_style( 'wp-block-library-theme' );
	}

	/**
	 * 追加CSSのminify
	 *
	 * @param string $css CSS.
	 *
	 * @return string
	 */
	public function _wp_get_custom_css( $css ) {
		return Style_Sheet::minify( $css );
	}

	/**
	 * CSSのインライン出力化
	 *
	 * @param string $html   Html.
	 * @param string $handle Handle.
	 * @param string $href   Href.
	 * @param string $media  Media.
	 *
	 * @return string
	 */
	public function style_loader_inline( $html, $handle, $href, $media ) {
		if ( false === strpos( $html, 'ystandard' ) ) {
			if ( true !== wp_styles()->get_data( $handle, 'inline' ) ) {
				return $html;
			}
		}
		if ( 'none' === wp_styles()->get_data( $handle, 'inline' ) ) {
			return $html;
		}
		if ( is_admin() ) {
			return $html;
		}
		/**
		 * URLとメディア指定を取得
		 */
		$pattern = '/<link.+href=[\'"](.+?)[\'"\?\#].+media=[\'"](.+?)[\'"].*\/>/i';
		$matches = null;
		if ( 1 !== preg_match( $pattern, $html, $matches ) ) {
			return $html;
		}
		/**
		 * サイトURLのチェック
		 */
		$url = $matches[1];

		if ( false === strrpos( $url, home_url() ) ) {
			return $html;
		}
		$path = str_replace( site_url( '/' ), ABSPATH, $url );
		if ( file_exists( $path ) ) {
			$style = Filesystem::file_get_contents( $path );
		}
		if ( false === $style ) {
			return $html;
		}
		if ( false !== strpos( $style, '../' ) || false !== strpos( $style, './' ) ) {
			return $html;
		}
		/**
		 * インラインCSSのminify
		 */
		$style = Style_Sheet::minify( str_replace( '@charset "UTF-8";', '', $style ) );
		/**
		 * 中身がなければ何も出さない
		 */
		if ( empty( $style ) ) {
			return '';
		}
		/**
		 * インラインCSS出力
		 */
		$tag = '<style>%s</style>';
		if ( isset( $matches[2] ) && 'all' !== $matches[2] ) {
			$tag = '<style>@media ' . $matches[2] . ' {%s}</style>';
		}

		return sprintf( $tag, $style ) . PHP_EOL;
	}

}

new Enqueue_Styles();
