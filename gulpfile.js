const gulp = require('gulp');
const { src, dest, watch } = require('gulp');

const sass = require('gulp-sass')(require('sass'));

// Theme Styles
function ThemeStyles() {
    return src('./assets/scss/master.scss')
        .pipe(sass())
        .pipe(dest('./dest/css/'));
}

// Theme Script
function ThemeScript() {
    return src('./assets/js/script.js')
        .pipe(dest('./dest/js/'));
}

// Watching file
function watcher(cb) {
    watch( './assets/scss/*.scss',ThemeStyles );
    watch( './assets/js/script.js',ThemeScript );

    cb();
}

exports.ThemeStyles  = ThemeStyles;
exports.ThemeScript  = ThemeScript;

exports.watcher = watcher;