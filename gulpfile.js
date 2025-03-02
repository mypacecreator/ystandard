const { series, parallel, watch, src, dest } = require( 'gulp' );
const gulpZip = require( 'gulp-zip' );
const gulpSass = require( 'gulp-sass' )( require( 'sass' ) );
const postcss = require( 'gulp-postcss' );
const autoprefixer = require( 'autoprefixer' );
const cssnano = require( 'cssnano' );
const cssdeclsort = require( 'css-declaration-sorter' );
const babel = require( 'gulp-babel' );
const del = require( 'del' );
const webpackStream = require( 'webpack-stream' );
const webpack = require( 'webpack' );
const rename = require( 'gulp-rename' );

const webpackConfig = require( './webpack.polyfill.config' );


/**
 * PostCssで使うプラグイン
 */
const postcssPlugins = [
	autoprefixer( {
		grid: 'autoplace'
	} ),
	cssnano( {
			preset: [
				'default',
				{ minifyFontValues: { removeQuotes: false } }
			]
		}
	),
	cssdeclsort( { order: 'smacss' } )
];
const postcssPluginsParts = [
	autoprefixer( {
		overrideBrowserslist: [ 'last 2 version, not ie < 11' ],
		grid: 'autoplace'
	} ),
];
/**
 * babel option
 */
const babelOption = {
	presets: [ '@babel/env' ],
	targets: {
		ie: '11',
	},
	minified: true,
	comments: false
};

/**
 * sass
 */
function sass() {
	return src( './src/sass/*.scss' )
		.pipe( gulpSass() )
		.pipe( postcss( postcssPlugins ) )
		.pipe( dest( './css' ) )
}

/**
 * sass - parts
 */
function sassParts() {
	return src( './src/sass/inline-parts/*.scss' )
		.pipe( gulpSass() )
		.pipe( postcss( postcssPluginsParts ) )
		.pipe( dest( './src/css/inline-parts' ) )
}

/**
 * JS
 */
function js() {
	return src( 'src/js/*.js' )
		.pipe( babel( babelOption ) )
		.pipe( dest( 'js/' ) )
}

function jsAdmin() {
	return src( 'src/js/admin/*.js' )
		.pipe( babel( babelOption ) )
		.pipe( dest( 'js/admin/' ) )
}

function buildWebpack() {
	return webpackStream( webpackConfig, webpack )
		.pipe( dest( 'js/' ) )
}

/**
 * 必要ファイルのコピー
 */
function copyProductionFiles() {
	return src(
		[
			'**',
			'!.github',
			'!.github/**',
			'!.travis',
			'!.travis/**',
			'!bin',
			'!bin/**',
			'!node_modules',
			'!node_modules/**',
			'!src',
			'!src/**',
			'!tests',
			'!tests/**',
			'!.editorconfig',
			'!.eslintrc.json',
			'!.prettierrc.js',
			'!.gitignore',
			'!.travis.yml',
			'!gulpfile.js',
			'!package.json',
			'!package-lock.json',
			'!composer.json',
			'!composer.lock',
			'!phpcs.ruleset.xml',
			'!phpunit.xml.dist',
			'!webpack.config.js',
			'!ystandard-info.json',
			'!ystandard-info-beta.json',
			'!block/**/*.js',
			'!block/**/*.scss',
			'!build',
			'!build/**',
			'!*.zip',
			'!ystandard',
			'!ystandard/**',
		],
		{ base: '.' }
	)
		.pipe( dest( './ystandard' ) );
}

/**
 * create zip file
 */
function zip() {
	return src( 'ystandard/**', { base: '.' } )
		.pipe( gulpZip( 'ystandard.zip' ) )
		.pipe( dest( 'build' ) );
}

function copyJson() {
	return src( 'ystandard-info.json' )
		.pipe( dest( 'build' ) );
}


function deleteVendor( cb ) {
	return del(
		[
			'./ystandard/vendor',
		],
		cb );
}

function copyJsonBeta() {
	return src( 'ystandard-info-beta.json' )
		.pipe( rename( 'ystandard-info.json' ) )
		.pipe( dest( 'build' ) );
}

function cleanFiles( cb ) {
	return del(
		[
			'./ystandard',
			'./build'
		],
		cb );
}

function cleanTempFiles( cb ) {
	return del(
		[
			'./ystandard',
		],
		cb );
}

/**
 * サーバーにデプロイするファイルを作成
 */
exports.production = series(
	cleanFiles,
	copyProductionFiles,
	parallel( zip, copyJson ),
	cleanTempFiles
);
exports.productionBeta = series(
	cleanFiles,
	copyProductionFiles,
	parallel( zip, copyJsonBeta ),
	cleanTempFiles
);
exports.productionManual = series(
	cleanFiles,
	copyProductionFiles,
	deleteVendor,
	parallel( zip ),
	cleanTempFiles
);
/**
 * タスクの登録
 */
exports.zip = series( copyProductionFiles, zip );
exports.clean = series( cleanFiles );
exports.cleanTemp = series( cleanTempFiles );
exports.js = parallel( js, jsAdmin );
exports.sass = parallel( sass, sassParts );
exports.webpack = series( buildWebpack );
exports.build = series( cleanFiles, parallel( sass, sassParts, js, jsAdmin, buildWebpack ) );

/**
 * default
 */
exports.default = function () {
	cleanFiles();
	sass();
	watch( [ './src/sass/**/*.scss', '!./src/sass/inline-parts/**/*.scss' ], sass );
	watch( './src/sass/inline-parts/**/*.scss', sassParts );
	watch( './src/js/*.js', js );
	watch( './src/js/admin/*.js', jsAdmin );
	watch( './src/js/polyfill/polyfill.js', buildWebpack );
};
