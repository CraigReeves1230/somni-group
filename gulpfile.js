
var gulp = require('gulp');
var bundle = require('gulp-bundle-assets');

gulp.task('default', function(){

    return gulp.src('./cssbundle.config.js')
        .pipe(bundle())
        .pipe(gulp.dest('./public/css/frontend'));
});