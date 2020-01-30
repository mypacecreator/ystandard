<?php
/**
 * パンくずリスト
 *
 * @package ystandard
 * @author  yosiakatsuki
 * @license GPL-2.0+
 */

/**
 * Class YS_Breadcrumb
 */
class YS_Breadcrumb {

	/**
	 * Position.
	 *
	 * @var int
	 */
	private $position = 1;

	/**
	 * Items.
	 *
	 * @var array
	 */
	private $items = [];

	/**
	 * Show on front
	 *
	 * @var bool
	 */
	private $show_on_front = false;

	/**
	 * Page on front
	 *
	 * @var bool
	 */
	private $page_on_front = false;

	/**
	 * Page for posts
	 *
	 * @var bool
	 */
	private $page_for_posts = false;

	/**
	 * Homeの表示ラベル
	 *
	 * @var string
	 */
	private $home_label = 'Home';

	/**
	 * Breadcrumb constructor.
	 */
	function __construct() {
		$this->show_on_front  = get_option( 'show_on_front' );
		$this->page_on_front  = get_option( 'page_on_front' );
		$this->page_for_posts = get_option( 'page_for_posts' );
		$this->items          = [];
		$this->home_label     = apply_filters( 'ys_breadcrumbs_home_label', 'Home' );
	}

	/**
	 * アクションフックのセット
	 */
	public function set_action() {
		add_action( 'wp_footer', [ $this, 'breadcrumbs' ], 11 );
	}

	/**
	 * パンくずリスト出力
	 */
	public function breadcrumbs() {
		$items = $this->get_breadcrumbs();
		if ( ! is_array( $items ) || empty( $items ) ) {
			return;
		}
		$breadcrumbs = [
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $items,
		];

		ys_echo_json_ld( $breadcrumbs );
	}

	/**
	 * パンずく取得
	 *
	 * @return array
	 */
	public function get_breadcrumbs() {
		/**
		 * フロントページの場合
		 */
		if ( is_front_page() ) {
			if ( $this->page_on_front ) {
				$this->set_item(
					get_the_title( $this->page_on_front ),
					home_url( '/' )
				);
			} else {
				$this->set_item( $this->home_label, home_url( '/' ) );
			}

			return apply_filters( 'ys_get_breadcrumbs_data', $this->items );
		}
		/**
		 * TOPページ
		 */
		$this->set_item(
			$this->home_label,
			home_url( '/' )
		);
		/**
		 * 一覧先頭ページ
		 */
		$this->set_front_item();
		/**
		 * 属性ごと
		 */
		if ( is_404() ) {
			$this->set_404();
		} elseif ( is_search() ) {
			$this->set_search();
		} elseif ( is_tax() ) {
			$this->set_tax();
		} elseif ( is_attachment() ) {
			$this->set_attachment();
		} elseif ( is_page() ) {
			$this->set_page();
		} elseif ( is_post_type_archive() ) {
			$this->set_post_type_archive();
		} elseif ( is_single() ) {
			$this->set_single();
		} elseif ( is_category() ) {
			$this->set_category();
		} elseif ( is_tag() ) {
			$this->set_tag();
		} elseif ( is_author() ) {
			$this->set_author();
		} elseif ( is_day() ) {
			$this->set_day();
		} elseif ( is_month() ) {
			$this->set_month();
		} elseif ( is_year() ) {
			$this->set_year();
		} elseif ( is_home() ) {
			$this->set_home();
		}

		return apply_filters( 'ys_get_breadcrumbs_data', $this->items );
	}

	/**
	 * 404ページ
	 */
	private function set_404() {
		$this->set_item(
			__( 'Page not found' ),
			''
		);
	}

	/**
	 * 検索ページ
	 */
	private function set_search() {
		$title = sprintf( __( 'Search results of "%1$s"' ), get_search_query() );
		$this->set_item(
			$title,
			esc_url_raw( home_url( '?s=' . urlencode( get_query_var( 's' ) ) ) )
		);
	}

	/**
	 * タクソノミー
	 */
	private function set_tax() {
		$taxonomy         = get_query_var( 'taxonomy' );
		$term             = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
		$taxonomy_objects = get_taxonomy( $taxonomy );
		$post_types       = $taxonomy_objects->object_type;
		$post_type        = array_shift( $post_types );
		if ( $post_type ) {
			$post_type_object = get_post_type_object( $post_type );
			$label            = $post_type_object->label;
			if ( $post_type_object->has_archive ) {
				$this->set_item(
					$label,
					get_post_type_archive_link( $post_type )
				);
			}
			if ( is_taxonomy_hierarchical( $taxonomy ) && $term->parent ) {
				$this->set_item(
					$label,
					get_post_type_archive_link( $post_type )
				);
				$this->set_ancestors( $term->term_id, $taxonomy );
			}
		}

		$this->set_item(
			$term->name,
			get_term_link( $term )
		);
	}

	/**
	 * 添付ファイルページ
	 */
	private function set_attachment() {
		$this->set_item(
			get_the_title(),
			get_the_permalink()
		);
	}

	/**
	 * 固定ページ
	 */
	private function set_page() {
		$this->set_ancestors( get_the_ID(), 'page' );
		$this->set_item(
			get_the_title(),
			get_the_permalink()
		);
	}

	/**
	 * 投稿タイプアーカイブ
	 */
	private function set_post_type_archive() {
		$post_type = $this->get_post_type();
		if ( $post_type && 'post' !== $post_type ) {
			$post_type_object = get_post_type_object( $post_type );
			$label            = $post_type_object->label;
			$this->set_item(
				$label,
				get_post_type_archive_link( $post_type_object->name )
			);
		}
	}

	/**
	 * 投稿ページ
	 */
	private function set_single() {
		$post_type = $this->get_post_type();
		if ( $post_type && 'post' !== $post_type ) {
			$post_type_object = get_post_type_object( $post_type );
			$label            = $post_type_object->label;
			$taxonomies       = $post_type_object->taxonomies;
			$taxonomy         = array_shift( $taxonomies );
			$terms            = get_the_terms( get_the_ID(), $taxonomy );
			$this->set_item(
				$label,
				get_post_type_archive_link( $post_type )
			);
			if ( $terms ) {
				$term = array_shift( $terms );
				$this->set_ancestors( $term->term_id, $taxonomy );
				$this->set_item(
					$term->name,
					get_term_link( $term )
				);
			}
		} else {
			$categories = get_the_category( get_the_ID() );
			$category   = $categories[0];
			$this->set_ancestors( $category->term_id, 'category' );
			$link = get_term_link( $category );
			if ( is_wp_error( $link ) ) {
				$link = '';
			}
			$this->set_item(
				$category->name,
				$link
			);
		}
		$this->set_item(
			get_the_title(),
			get_the_permalink()
		);
	}

	/**
	 * カテゴリーアーカイブ
	 */
	private function set_category() {
		$category_name = single_cat_title( '', false );
		$category_id   = get_cat_ID( $category_name );
		$this->set_ancestors( $category_id, 'category' );
		$this->set_item(
			$category_name,
			get_category_link( $category_id )
		);
	}

	/**
	 * タグアーカイブ
	 */
	private function set_tag() {
		$this->set_item(
			single_tag_title( '', false ),
			get_tag_link( get_queried_object() )
		);
	}

	/**
	 * 投稿者
	 */
	private function set_author() {
		$author_id = get_query_var( 'author' );
		$this->set_item(
			get_the_author_meta( 'display_name', $author_id ),
			get_author_posts_url( $author_id )
		);
	}

	/**
	 * 日アーカイブ
	 */
	private function set_day() {

		$year = get_query_var( 'year' );
		if ( $year ) {
			$month = get_query_var( 'monthnum' );
			$day   = get_query_var( 'day' );
		} else {
			$ymd   = get_query_var( 'm' );
			$year  = substr( $ymd, 0, 4 );
			$month = substr( $ymd, 4, 2 );
			$day   = substr( $ymd, - 2 );
		}
		$this->set_year_item( $year );
		$this->set_month_item( $year, $month );
		$this->set_day_item( $day, $month, $year );
	}

	/**
	 * 月アーカイブ
	 */
	private function set_month() {
		/**
		 * Month
		 */
		$year = get_query_var( 'year' );
		if ( $year ) {
			$month = get_query_var( 'monthnum' );
		} else {
			$ymd   = get_query_var( 'm' );
			$year  = substr( $ymd, 0, 4 );
			$month = substr( $ymd, - 2 );
		}
		$this->set_year_item( $year );
		$this->set_month_item( $year, $month );
	}

	/**
	 * 年アーカイブ
	 */
	private function set_year() {
		/**
		 * Year
		 */
		$year = get_query_var( 'year' );
		if ( ! $year ) {
			$ymd  = get_query_var( 'm' );
			$year = $ymd;
		}
		$this->set_year_item( $year );
	}

	/**
	 * ホーム
	 */
	private function set_home() {
		/**
		 * Home
		 */
		if ( 'page' === $this->show_on_front && $this->page_for_posts ) {
			$this->set_item(
				get_the_title( $this->page_for_posts ),
				get_permalink( $this->page_for_posts )
			);
		}
	}

	/**
	 * パンくずアイテムの変数セット
	 *
	 * @param string $title タイトル.
	 * @param string $link  URL.
	 */
	private function set_item( $title, $link ) {

		$item = [
			'@type'    => 'ListItem',
			'position' => $this->position,
			'name'     => $title,
			'item'     => $link,
		];
		if ( empty( $link ) ) {
			unset( $item['item'] );
		}
		$this->items[] = $item;
		$this->position ++;
	}

	/**
	 * 一覧ページ先頭アイテムをセット
	 */
	private function set_front_item() {
		$post_type = $this->get_post_type();
		if ( ( is_single() && 'post' === $post_type ) || is_date() || is_author() || is_category() || is_tax() ) {
			if ( 'page' === $this->show_on_front && $this->page_for_posts && ys_get_option( 'ys_show_page_for_posts_on_breadcrumbs' ) ) {
				$this->set_item(
					get_the_title( $this->page_for_posts ),
					get_permalink( $this->page_for_posts )
				);
			}
		}
	}

	/**
	 * 階層アイテムをセット
	 *
	 * @param        $object_id
	 * @param        $object_type
	 * @param string $resource_type
	 */
	private function set_ancestors( $object_id, $object_type, $resource_type = '' ) {
		$ancestors = get_ancestors( $object_id, $object_type, $resource_type );
		krsort( $ancestors );
		foreach ( $ancestors as $ancestor_id ) {
			if ( 'page' === $object_type ) {
				$this->set_item(
					get_the_title( $ancestor_id ),
					get_permalink( $ancestor_id )
				);
			} else {
				$ancestors_term = get_term_by( 'id', $ancestor_id, $object_type );
				if ( $ancestors_term ) {
					$this->set_item(
						$ancestors_term->name,
						get_term_link( $ancestor_id, $object_type )
					);
				}
			}
		}
	}

	/**
	 * 年の情報セット.
	 *
	 * @param string|int $year 年.
	 * @param bool       $link URLをセットするか.
	 */
	private function set_year_item( $year, $link = true ) {
		$label = $year;
		$url   = '';
		if ( 'ja' === get_locale() ) {
			$label .= '年';
		}
		if ( $link ) {
			$url = get_year_link( $year );
		}
		$this->set_item(
			$label,
			$url
		);
	}

	/**
	 * 月情報セット
	 *
	 * @param string|int $year  年.
	 * @param string|int $month 月.
	 * @param bool       $link  URLをセットするか.
	 */
	private function set_month_item( $year, $month, $link = true ) {
		$label = $month;
		$url   = '';
		if ( 'ja' === get_locale() ) {
			$label .= '月';
		} else {
			$monthes = array(
				1  => 'January',
				2  => 'February',
				3  => 'March',
				4  => 'April',
				5  => 'May',
				6  => 'June',
				7  => 'July',
				8  => 'August',
				9  => 'September',
				10 => 'October',
				11 => 'November',
				12 => 'December',
			);
			$label   = $monthes[ $month ];
		}
		if ( $link ) {
			$url = get_month_link( $year, $month );
		}
		$this->set_item(
			$label,
			$url
		);
	}

	/**
	 * 日情報をセットするか
	 *
	 * @param string|int $day   日.
	 * @param string|int $month 月.
	 * @param string|int $year  年.
	 */
	private function set_day_item( $day, $month, $year ) {
		$label = $day;
		if ( 'ja' === get_locale() ) {
			$label .= '日';
		}
		$this->set_item(
			$label,
			get_day_link( $year, $month, $day )
		);
	}


	/**
	 * Get Post Type
	 */
	private function get_post_type() {
		return ys_get_post_type();
	}

}

/**
 * アクションのセット
 */
$ys_breadcrumb = new YS_Breadcrumb();
$ys_breadcrumb->set_action();