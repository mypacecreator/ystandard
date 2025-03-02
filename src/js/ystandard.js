/**
 * 検索ボタンの開閉処理
 */
const setGlobalNavSearch = () => {
	const searchButton = document.getElementById('global-nav__search-button');
	if (searchButton) {
		searchButton.addEventListener('click', () => {
			const search = document.getElementById('global-nav__search');
			if (search) {
				search.classList.toggle('is-active');
				setTimeout(function () {
					document
						.querySelector('#global-nav__search .search-field')
						.focus();
				}, 50);
			}
		});
	}
	const closeButton = document.getElementById('global-nav__search-close');
	if (closeButton) {
		closeButton.addEventListener('click', () => {
			const search = document.getElementById('global-nav__search');
			if (search) {
				search.classList.remove('is-active');
			}
		});
	}
};

/**
 * グローバルナビゲーションの開閉処理
 */
const setGlobalNavToggle = () => {
	const globalNav = document.getElementById('global-nav__toggle');
	if (globalNav) {
		globalNav.addEventListener('click', (e) => {
			e.currentTarget.classList.toggle('is-open');
			const mobileFooter =
				document.getElementsByClassName('footer-mobile-nav');
			if (mobileFooter && mobileFooter.length) {
				mobileFooter[0].classList.toggle('is-hide');
			}
		});
	}
	// グロナビ閉じる.
	const globalNavLinks = document.querySelectorAll(
		'.global-nav a[href*="#"]'
	);
	for (let i = 0; i < globalNavLinks.length; i++) {
		globalNavLinks[i].addEventListener('click', () => {
			const toggle = document.getElementById('global-nav__toggle');
			if (toggle) {
				toggle.classList.remove('is-open');
			}
			const mobileFooter =
				document.getElementsByClassName('footer-mobile-nav');
			if (mobileFooter) {
				mobileFooter[0].classList.remove('is-hide');
			}
		});
	}
};

/**
 * ページ内リンクのスムーススクロール.
 */
const setSmoothScroll = () => {
	const links = document.querySelectorAll('a[href^="#"]');
	for (let i = 0; i < links.length; i++) {
		links[i].addEventListener('click', (e) => {
			e.preventDefault();
			let top = 0;
			const id = e.currentTarget.getAttribute('href').replace('#', '');
			const target = document.getElementById(id);
			if (!target && '' !== id) {
				return;
			}
			if (target) {
				const pos = target.getBoundingClientRect().top;
				let buffer = 50;
				const header = document.getElementById('masthead');
				if (
					'fixed' ===
					window
						.getComputedStyle(header, null)
						.getPropertyValue('position')
				) {
					buffer = header.getBoundingClientRect().bottom + 20;
				}
				top = pos + window.pageYOffset - buffer;
			}

			window.scroll({
				top,
				behavior: 'smooth',
			});
		});
	}
};

/**
 * TOPへ戻る.
 */
const setBackToTop = () => {
	const backToTop = document.getElementById('back-to-top');
	if (backToTop && backToTop.classList.contains('is-square')) {
		const width = backToTop.getBoundingClientRect().width;
		const height = backToTop.getBoundingClientRect().height;
		const size = width < height ? `${height}px` : `${width}px`;
		backToTop.style.width = size;
		backToTop.style.height = size;
		backToTop.addEventListener('click', (e) => {
			e.preventDefault();
			window.scroll({
				top: 0,
				behavior: 'smooth',
			});
		});
	}
};

/**
 * スクロールバー幅の変数セット.
 */
const setScrollBarWidth = () => {
	const scrollbar = window.innerWidth - document.body.clientWidth;
	if (
		window
			.getComputedStyle(document.documentElement)
			.getPropertyValue('--scrollbar-width')
	) {
		document
			.querySelector(':root')
			.style.setProperty('--scrollbar-width', scrollbar + 'px');
	}
};

const setFixedHeaderPadding = () => {
	const classes = document.body.classList;
	if (
		classes.contains('has-fixed-header') &&
		!classes.contains('disable-auto-padding') &&
		!classes.contains('is-overlay')
	) {
		const header = document.getElementById('masthead');
		if (header) {
			const size = Math.floor(header.getBoundingClientRect().height);
			document.body.style.paddingTop = `${size}px`;
		}
	}
};

document.addEventListener('DOMContentLoaded', () => {
	// スクロールバー分.
	setScrollBarWidth();
	// 固定ヘッダー高さセット.
	setFixedHeaderPadding();
	// メニュー.
	setGlobalNavToggle();
	// 検索ボタン.
	setGlobalNavSearch();
	// スムーススクロール.
	setSmoothScroll();
	// TOPへ戻る.
	setBackToTop();
});

window.addEventListener('resize', () => {
	if (window.ysResizeFixedHeader) {
		clearTimeout(window.ysResizeFixedHeader);
	}
	window.ysResizeFixedHeader = setTimeout(function () {
		// 固定ヘッダー高さセット.
		setFixedHeaderPadding();
	}, 100);
});
