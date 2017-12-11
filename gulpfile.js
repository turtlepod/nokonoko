// Load packages.
var gulp            = require( 'gulp' );
var template        = require( 'gulp-template' );
var fs              = require( 'fs' );
var concat          = require( 'gulp-concat' );
var pump            = require( 'pump' );
var pkg             = JSON.parse( fs.readFileSync( './package.json' ) );
var sass            = require( 'gulp-sass' );
var sassglob        = require( 'gulp-css-globbing' );
var scsslint        = require( 'gulp-scss-lint' );
var cleancss        = require( 'gulp-clean-css' );
var wpPot           = require( 'gulp-wp-pot' );
var checktextdomain = require( 'gulp-checktextdomain' );
var zip             = require( 'gulp-zip' );
var clean           = require( 'gulp-clean' );
var uglify          = require( 'gulp-uglify' );
var jshint          = require( 'gulp-jshint' );
var sourcemaps      = require( 'gulp-sourcemaps' );
var watch           = require( 'gulp-watch' );
var phpcs           = require( 'gulp-phpcs' );

/**
 * JS Hint
 * 
 * @since 1.0.0
 */
gulp.task( 'js:hint', function( cb ) {
	pump( [
		gulp.src( [
			'assets/**/*.js',
		] ),
		jshint( '.jshintrc' ),
		jshint.reporter( 'default' ),
		jshint.reporter( 'fail' )
	], cb );
} );

/**
 * JS Minify
 * 
 * @since 1.0.0
 */
gulp.task( 'js:minify', function() {
	gulp.src( [
		'assets/theme/theme.js',
	] )
		.pipe( sourcemaps.init() )
		.pipe( concat( 'theme/theme.min.js' ) )
		.pipe( uglify() )
		.pipe( sourcemaps.mapSources( function( sourcePath, file ) {
			return 'assets/' + sourcePath;
		}))
		.pipe( sourcemaps.write( '/' ) )
		.pipe( gulp.dest( 'assets' ) );
} );

/**
 * CSS Lint
 *
 * @since 1.0.0
 */
gulp.task( 'css:lint', function( cb ) {
	pump( [
		gulp.src( [
			'assets/*.scss',
			'assets/**/*.scss'
		] ),
		scsslint( {
			'maxBuffer': 10007200,
			'reporterOutputFormat': 'Stats'
		} )
	], cb );
} );

/**
 * SCSS Process
 *
 * @since 1.0.0
 */
gulp.task( 'css:compile', function( cb ) {
	pump( [
		gulp.src( [
			'assets/scss/style.scss'
		] ),
		sourcemaps.init(),
		sassglob( {
			extensions: [ '.scss' ]
		} ),
		sass(),
		concat( 'theme/theme.min.css' ),
		cleancss(),
		sourcemaps.write( '/' ),
		gulp.dest( 'assets' )
	], cb );
} );

/* Minify */
gulp.task( 'minify', [ 'css:compile', 'js:minify'] );

/** Assets */
gulp.task( 'assets', [ 'minify' ] );

/**
 * Watch
 * 
 * @since 1.0.0
 */
gulp.task( 'watch', function () {
	// CSS.
	gulp.watch( [
		'assets/*.scss',
		'assets/**/*.scss',
	], [ 'css:compile' ] );

	// JS.
	gulp.watch( [
		'assets/*.js',
		'assets/**/*.js',
	], [ 'js:minify' ] );
});

/**
 * Check Textdomain
 * 
 * @since 1.0.0
 */
gulp.task( 'checktextdomain', function() {
	gulp.src( [ 
		'*.php', 
		'app/**/**.php', 
		'resources/**/**.php'
	] )
		.pipe( checktextdomain( {
			text_domain: 'nokonoko',
			correct_domain: true,
			force: true,
			keywords: [
				'__:1,2d',
				'_e:1,2d',
				'_x:1,2c,3d',
				'esc_html__:1,2d',
				'esc_html_e:1,2d',
				'esc_html_x:1,2c,3d',
				'esc_attr__:1,2d',
				'esc_attr_e:1,2d',
				'esc_attr_x:1,2c,3d',
				'_ex:1,2c,3d',
				'_n:1,2,4d',
				'_nx:1,2,4c,5d',
				'_n_noop:1,2,3d',
				'_nx_noop:1,2,3c,4d'
			],
		} ) );
} );

/**
 * Make POT
 * 
 * @since 1.0.0
 */
gulp.task( 'makepot', function() {
	gulp.src( [ 
		'*.php', 
		'**.php', 
		'includes/**/**.php', 
	] )
		.pipe( wpPot( {
			domain: 'nokonoko',
		} ))
		.pipe( gulp.dest( 'assets/languages/nokonoko.pot' ) );
} );

/* i18n */
gulp.task( 'i18n', [ 'checktextdomain', 'makepot' ] );

/**
 * PHP Code Sniffer
 *
 * @since 1.0.0
 */
gulp.task( 'php', function() {
	gulp.src( [
		'includes/*.php',
		'includes/**/*.php',
		'library/*.php',
		'library/**/*.php',
	] )
		.pipe( phpcs({
			'standard': './phpcs.ruleset.xml'
		}) )
		.pipe( phpcs.reporter( 'log' ) )
} );
