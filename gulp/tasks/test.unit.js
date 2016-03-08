"use strict";

var gulp = require("gulp"),
    phpunit = require("gulp-phpunit"),
	config = require("../config");

/**
 * The `test:unit` task runs the unit test suite
 */
gulp.task("test:unit", function() {
    return gulp.src(config.test.unit.suite)
        .pipe(phpunit(config.test.unit.phpunit, {
            debug: false,
            stderr: true,
            strictCoverage: true,
            coverageClover: config.test.unit.coverage.clover,
            coverageHtml: config.test.unit.coverage.html,
            logJunit: config.test.unit.coverage.junit
        }))
});

gulp.task('default', ['test:unit']);
