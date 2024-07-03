import plumber from 'gulp-plumber';
import notify from 'gulp-notify';
import newer from 'gulp-newer';
import ifPlagin from 'gulp-if';

export const plugins = {
	plumber,
	notify,
	newer,
	if: ifPlagin,
};
