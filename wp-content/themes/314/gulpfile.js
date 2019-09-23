var gulp = require('gulp');
var browserSync = require('browser-sync');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');
var changed = require('gulp-changed');

gulp.task('reload', function() {
	browserSync.reload();
});

// BROWSER SYNC
gulp.task('serve', ['sass'], function() {

	var files = [
			'css/*.css',
			'**/*.php',
			'js/*.js'
		];

		browserSync.init(files, {
			proxy: "http://starttheme.test"
		});

	gulp.watch('*.php', ['reload']);
	gulp.watch('sass/**/*.scss', ['sass']);

});

gulp.task('sass', ['reload'], function() {
	return gulp.src('sass/**/*.scss')
	.pipe(sourcemaps.init())
	.pipe(sass().on('error', sass.logError))
	.pipe(autoprefixer({
		browsers: ['last 5 versions']
	}))
	.pipe(sourcemaps.write())
	.pipe(gulp.dest('css'))
	//.pipe(browserSync.stream());
})


gulp.task('min-css', function() {
	return gulp.src('css/*.css ')
	.pipe(cleanCSS())
	.pipe(rename({
		suffix: '.min'
	}))
	.pipe(gulp.dest('css/'));
});

gulp.task('min-js', function() {
	return gulp.src('js/*.js')
	.pipe(uglify())
	.pipe(rename({
		suffix: '.min'
	}))
	.pipe(gulp.dest('js/'));
});

gulp.task('min-img', function() {
	return gulp.src('img/*.{jpg,jpeg,png,gif,svg,JPG,JPEG,PNG,GIF,SVG}')
	.pipe(changed('img-min'))
	.pipe(imagemin())
	.pipe(gulp.dest('img-min'));
});

gulp.task('default', ['serve']);
