var gulp = require('gulp'),
    gutil = require('gulp-util'),
    minifycss = require('gulp-minify-css'),
    scss = require('gulp-sass'),
    notify = require('gulp-notify'),
    zip = require('gulp-zip'),
    autoprefixer = require('gulp-autoprefixer');

var plugins = require("gulp-load-plugins")({
    pattern: ['gulp-*', 'gulp.*'],
    replaceString: /\bgulp[\-.]/
});

var browserSync = require('browser-sync');
var reload = browserSync.reload;

var paths = {

    scripts: {
        src: 'src/js/',
        dest: 'assets/public/js/',
    },

    styles: {
        src: 'src/css/',
        dest: 'assets/public/css/',
    },

    scss: {
        src: 'src/scss/',
        dest: 'assets/public/css/',
    },

};

var appFiles = {
    scripts: [paths.scripts.src + 'vendor/*.js'],
    mainScript: paths.scripts.src + 'main.js',
    styles: [paths.styles.src + '*.css'],
    scss: paths.scss.src + "/*.scss",
    scssStyle: paths.scss.src + "main.scss",
    mainStyle: paths.styles.dest + "main.css"
};


gulp.task('vendorScripts', function() {

    gulp.src(appFiles.scripts)
        .pipe(gulp.dest(paths.scripts.dest));

});

gulp.task('mainScript', function() {

    gulp.src(appFiles.mainScript)
        .pipe(gulp.dest(paths.scripts.dest));

});

gulp.task('minScripts', function() {

    var arr = appFiles.scripts;
    arr.push(appFiles.mainScript);

    gulp.src(arr)
        .pipe(plugins.concat('min.js'))
        .pipe(plugins.uglify())
        .pipe(gulp.dest(paths.scripts.dest));

});

gulp.task('vendorStyles', function() {

    gulp.src(appFiles.styles)
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(notify({
            message: 'Vendor Styles',
            onLast: true
        }));

});

gulp.task('mainStyle', function() {

    gulp.src(appFiles.scssStyle)
        .pipe(scss())
        .pipe(plugins.concat('main.css'))
        .pipe(autoprefixer({
            remove: false,
            browsers: ['last 4 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4']
        }))
        .pipe(gulp.dest(paths.styles.dest));

});

gulp.task('minStyles', function() {

    setTimeout(function() {
        var arr = '';
        arr = appFiles.styles;
        arr.push(appFiles.mainStyle);

        gulp.src(arr)
            .pipe(plugins.concat('min.css'))
            .pipe(minifycss())
            .pipe(gulp.dest(paths.styles.dest))
            .pipe(reload({
                stream: true
            }));

    }, 1000);

});

gulp.task('watch', function() {
    gulp.watch(appFiles.mainScript, ['mainScript', 'minScripts']);
    gulp.watch(appFiles.scss, ['minStyles']);
});

gulp.task('default', function() {
    gulp.start('vendorScripts');
    gulp.start('mainScript');
    gulp.start('minScripts');
    gulp.start('vendorStyles');
    gulp.start('mainStyle');
    gulp.start('minStyles');
    gulp.start('watch');
});