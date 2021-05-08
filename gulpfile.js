const gulp = require('gulp');
const path = require("path");
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('autoprefixer');

// config
var assets_path = './public/_cms/wp-content/themes/hippoblog_v2/_assets';
var src_path = 'assets_src/scss/index.scss';
const watch_path = 'assets_src/scss';
var dest_path = assets_path + '/css';

const SASS_INCLUDE_PATHS = [
  path.join(__dirname, '/node_modules/bootstrap/scss')
];

gulp.task('sass', () => {
  return gulp.src(src_path)
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'compressed',
      includePaths: SASS_INCLUDE_PATHS
    }).on('error', sass.logError))
    .pipe(postcss([
      autoprefixer(),
      // cssnano({autoprefixer: false})
    ]))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(dest_path));
});

gulp.task('watch:sass', () => {
  return gulp.watch(
    watch_path + '/**/*.scss',
    gulp.parallel('sass')
  );
});
