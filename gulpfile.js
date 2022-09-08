const gulp = require('gulp');
const { src, dest, assets, watch } = require('gulp');

const sass = require('gulp-sass')(require('sass'));

// Theme Styles
function ThemeStyles() {
    return src('./assets/scss/master.scss')
        .pipe(sass())
        .pipe(dest('./assets/css/'));
}

// Watching file
function watcher(cb) {
    watch( './assets/scss/*.scss',ThemeStyles );

    cb();
}

exports.ThemeStyles  = ThemeStyles;

exports.watcher = watcher;