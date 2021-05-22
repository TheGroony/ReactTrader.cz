const gulp = require("gulp");
const sass = require("gulp-sass");
const uglify = require("gulp-uglify");
const concat = require("gulp-concat");
const rename = require("gulp-rename");

gulp.task("sass", function(done) {
    gulp.src("scss/app.scss")
    .pipe(sass({outputStyle: "compressed"}))
    .pipe(gulp.dest("css/"));
    done();
});

gulp.task("javascript", function(done) {
    gulp.src("js/*.js")
        .pipe(uglify())
        .pipe(gulp.dest("js/dist"))
    done();
});

gulp.task("watch", function() {
    gulp.watch("scss/**/*.scss", gulp.series(["sass"]));
    gulp.watch("js/*.js", gulp.series(["javascript"]));
});