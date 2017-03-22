/*jslint indent: 2 */
'use strict';

var gulp = require('gulp'),
  autoprefixer = require('gulp-autoprefixer'),
  filter = require('gulp-filter'),
  // twig = require('gulp-twig'),
  sass = require('gulp-sass'),
  sourcemaps = require('gulp-sourcemaps'),
  scsslint = require('gulp-scss-lint'),
  jshint = require('gulp-jshint'),
  // prettify = require('gulp-html-prettify'),
  // data = require('gulp-data'),
  // path = require('path'),
  run = require('gulp-run'),
  browserSync = require('browser-sync'),
  reload = browserSync.reload,
  src = {
    scss: '../scss/**/*.scss',
    css: '../css',
    twigFile: '../pattern-lab/source/_**/**/*.twig',
    jsonFile: '../pattern-lab/source/_**/**/*.json',
    mdFile: '../pattern-lab/source/_**/**/*.md',
    latestChangeFile: '../pattern-lab/public/latest-change.txt',
    javascript: '../js/*.js',
    cssFile: '../css/*.css',
  };

gulp.task('pl-generate', function () {
  run('php ../pattern-lab/core/console --generate').exec();
});

// Task for local, static development.
gulp.task('local-development', ['sass-dev', 'pl-generate'], function () {
  browserSync({
    server: {
      baseDir: "../",
    },
    startPath: "pattern-lab/public"
  });

  gulp.watch(src.scss, ['sass-dev']);
  gulp.watch(src.javascript, reload);
  gulp.watch(src.cssFile, reload);
  gulp.watch(src.twigFile, ['pl-generate']);
  gulp.watch(src.jsonFile, ['pl-generate']);
  gulp.watch(src.mdFile, ['pl-generate']);
  gulp.watch(src.latestChangeFile).on('change', reload);
});

// Sass watch, compile css when sass is changed.
gulp.task('sass-watch', ['sass-dev'], function () {
  gulp.watch(src.scss, ['sass-dev']);
});

// Task for compiling sass in development mode with all features enabled.
gulp.task('sass-dev', function () {
  gulp.src('../scss/{,*/}*.{scss,sass}')
    .pipe(sourcemaps.init())
    .pipe(sass({
      errLogToConsole: true
    }))
    .on('error', function (err) {
      console.error('Error!', err.message);
    })
    .pipe(autoprefixer({browsers: ['safari >= 8', 'last 3 versions', '> 2%']}))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(src.css))
    .pipe(filter("**/*.css"))
});

// SCSS Lint
gulp.task('scss-lint', function () {
  return gulp.src(src.scss)
    .pipe(
      scsslint({
        'config': 'scss-lint.yml',
      })
    );
});

// Javascript Lint
gulp.task('js-lint', function () {
  return gulp.src(src.javascript)
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

// Default task.
gulp.task('default', ['local-development']);