import gulp from 'gulp';
import babel from 'gulp-babel';
import uglify from 'gulp-uglify';
import rename from 'gulp-rename';

export const jsUnits = () => {
	return gulp
		.src(app.path.src.jsUnits)
		.pipe(gulp.dest(app.path.build.jsUnits))
		.pipe(babel({
			presets: ['@babel/env']
		}))
		.pipe(uglify())
		.pipe(rename({
			extname: '.min.js'
		}))
		.pipe(gulp.dest(app.path.build.jsUnits));
};