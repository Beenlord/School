const gulp = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const rigger = require('gulp-rigger')

const path = (type) => ('../public/' + type + '/raw')

const styles = async () => {
	const fileType = 'styles'
	return gulp.src(path(fileType) + '/style.scss')
			   .pipe(sass())
			   .pipe(gulp.dest(path(fileType).replace('/raw', '/')))
}

const scripts = async () => {
	const fileType = 'scripts'
	return gulp.src(path(fileType) + '/script.js')
			   .pipe(rigger())
			   .pipe(gulp.dest(path(fileType).replace('/raw', '/')))
}

const watch = async () => {
	gulp.watch(`${path('styles')}/**.scss`, gulp.series(styles))
	gulp.watch(`${path('scripts')}/**.js`, gulp.series(scripts))
}

module.exports.dev = gulp.series(styles, scripts, watch)
module.exports.build = gulp.series(styles, scripts)
