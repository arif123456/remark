const app = require('./package.json');
const gulp = require('gulp');
const { src, dest, assets, watch } = require('gulp');

const postcss = require('gulp-postcss');
const tailwindcss = require('tailwindcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sass = require('gulp-sass')(require('sass'));

// Run
// gulp sass
gulp.task('scss', function() {
    var processors = [
        tailwindcss,
        autoprefixer,
        cssnano
    ];
    return gulp.src('./assets/scss/master.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss(processors))
    .pipe(dest('./assets/css/'));
})

// Run
// gulp watch
gulp.task('watch', function() {
    gulp.watch('./assets/scss/*.scss', gulp.series('scss'));
})