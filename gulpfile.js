import gulp from 'gulp';
import { path } from './gulp/config/path.js';
import { plugins } from './gulp/config/plugins.js';
import { copy } from './gulp/tasks/copy.js';
import { reset } from './gulp/tasks/reset.js';
import { scss } from './gulp/tasks/scss.js';
import { js } from './gulp/tasks/js.js';
import { images } from './gulp/tasks/images.js';
import { svgSprive } from './gulp/tasks/svgSprite.js';
import { jsLibs } from './gulp/tasks/jsLibs.js';
import { jsUnits } from './gulp/tasks/jsUnits.js';
import { fonts } from './gulp/tasks/fonts.js';
import { cssVendor } from './gulp/tasks/cssVendor.js';

global.app = {
	isBuild: process.argv.includes('--build'),
	isDev: !process.argv.includes('--build'),
	path: path,
	gulp: gulp,
	plugins: plugins,
};

function watcher() {
	gulp.watch(path.watch.files, copy);
	gulp.watch(path.watch.jsLibs, jsLibs);
	gulp.watch(path.watch.jsUnits, jsUnits);
	gulp.watch(path.watch.php, scss);
	gulp.watch(path.watch.scss, scss);
	gulp.watch(path.watch.js, js);
	gulp.watch(path.watch.js, scss);
	gulp.watch(path.watch.images, images);
	gulp.watch(path.watch.cssVendor, cssVendor);
}

export { svgSprive };

const mainTasks = gulp.parallel(copy, fonts, jsLibs, jsUnits, scss, js, images, cssVendor);

const dev = gulp.series(reset, mainTasks, gulp.parallel(watcher));
const build = gulp.series(reset, mainTasks);

export { dev };
export { build };

gulp.task('default', dev);
