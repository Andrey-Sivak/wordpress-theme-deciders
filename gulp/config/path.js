import * as nodePath from 'path';

const rootFolder = nodePath.basename(nodePath.resolve());

const buildFolder = `./dist`;
const srcFolder = `./assets`;

export const path = {
	build: {
		js: `${buildFolder}/js/`,
		css: `${buildFolder}/css/`,
		cssVendor: `${buildFolder}/css/vendor/`,
		// html: `${buildFolder}/`,
		files: `${buildFolder}/files/`,
		images: `${buildFolder}/img/`,
		fonts: `${buildFolder}/fonts/`,
		jsLibs: `${buildFolder}/js/libs/`,
		jsUnits: `${buildFolder}/js/units/`,
	},
	src: {
		js: `${srcFolder}/js`,
		scss: `${srcFolder}/scss/*.scss`,
		cssVendor: `${srcFolder}/css/*.css`,
		php: ['**/*.php', '!vendor/**/*.php'],
		files: `${srcFolder}/files/**/*.*`,
		images: `${srcFolder}/img/**/*.{jpg,jpeg,png,gif,webp}`,
		svg: `${srcFolder}/img/**/*.svg`,
		svgicons: `${srcFolder}/svgicons/*.svg`,
		jsLibs: `${srcFolder}/js/libs/*.js`,
		jsUnits: `${srcFolder}/js/units/*.js`,
		fonts: `${srcFolder}/fonts/*.*`,
	},
	watch: {
		js: `${srcFolder}/js/**/*.js`,
		scss: `${srcFolder}/scss/**/*.scss`,
		cssVendor: `${srcFolder}/css/*.css`,
		php: ['**/*.php', '!vendor/**/*.php'],
		files: `${srcFolder}/files/**/*.*`,
		images: `${srcFolder}/img/**/*.{jpg,jpeg,png,gif,webp,svg,ico}`,
		jsLibs: `${srcFolder}/js/libs/*.js`,
		jsUnits: `${srcFolder}/js/units/*.js`,
	},
	clean: buildFolder,
	buildFolder: buildFolder,
	srcFolder: srcFolder,
	rootFolder: rootFolder,
};
