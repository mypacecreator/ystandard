<?php
/**
 * Class ConditionalTagTest
 *
 * @package ystandard
 */

/**
 * AMP用テスト
 */
class ConditionalTagTest extends WP_UnitTestCase {

	/**
	 * ys_is_top_page
	 */
	function test_ys_is_top_page_home_1() {
		$post_id = $this->factory->post->create();
		$this->go_to( home_url( '/' ) );
		$this->assertTrue( ys_is_top_page() );
	}

	/**
	 * ys_is_top_page 2
	 */
	function test_ys_is_top_page_home_2() {
		$post_id = $this->factory->post->create();
		$post_id = $this->factory->post->create();
		$post_id = $this->factory->post->create();
		$post_id = $this->factory->post->create();
		/**
		 * ページ設定
		 */
		update_option( 'posts_per_page', 1 );
		/**
		 * 2ページ目へ移動
		 */
		$this->go_to( home_url( '/' ) );
		$this->go_to( get_pagenum_link( 2 ) );
		$this->assertFalse( ys_is_top_page() );
	}
	/**
	 * ys_is_top_page
	 */
	function test_ys_is_top_page_front() {
		$post_id = $this->factory->post->create(
			[
				'post_type' => 'page'
			]
		);
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $post_id );
		$this->go_to( home_url( '/' ) );
		$this->assertTrue( ys_is_top_page() );
	}
}