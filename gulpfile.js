let gulp = require('gulp');
let zip  = require('gulp-zip');


/**
 * create zip file
 */
gulp.task('zip', function () {
    return gulp.src(
        [
            '**',
            '!node_modules',
            '!node_modules/**',
            '!gulpfile.js',
            '!package.json',
            '!webpack.config.js',
            '!ystandard-info.json',
            '!phpcs.ruleset.dist',
            '!phpunit.xml.dist',
            '!tests',
            '!tests/**',
            '!bin',
            '!bin/**',
            '!src',
            '!src/**',
            '!docs',
            '!docs/**',
            '!temp',
            '!temp/**',
        ],
        {base: './'}
    )
        .pipe(zip('ystandard.zip'))
        .pipe(gulp.dest('./'));
});
