import webpack from 'webpack-stream';
import TerserPlugin from 'terser-webpack-plugin';
import ESLintPlugin from 'eslint-webpack-plugin';

export const js = () => {
	return app.gulp
		.src(app.path.src.js, { sourcemaps: app.isDev })
		.pipe(
			app.plugins.plumber(
				app.plugins.notify.onError({
					title: 'JS',
					message: 'Error: <%= error.message %>',
				}),
			),
		)
		.pipe(
			webpack({
				mode: app.isBuild ? 'production' : 'development',
				output: {
					filename: '[name].min.js',
				},
				entry: {
					app: `${app.path.src.js}/app.js`,
					archive: `${app.path.src.js}/archive.js`,
				},
				optimization: {
					minimize: true,
					minimizer: [
						new TerserPlugin({
							terserOptions: {
								compress: app.isBuild,
								sourceMap: !app.isBuild,
								// keep_fnames: false,
							},
						}),
					],
				},
				module: {
					rules: [
						{
							test: /\.js$/,
							exclude: '/node_modules/',
							loader: 'babel-loader',
							options: {
								presets: [
									[
										'@babel/preset-env',
										{ targets: 'defaults' },
									],
								],
							},
						},
						{
							test: /\.(sass|scss|css)$/,
							use: ['style-loader', 'css-loader', 'sass-loader'],
						},
					],
				},
				plugins: [
					new ESLintPlugin({
						context: './node_modules/@wordpress/eslint-plugin',
					}),
				],
			}),
		)
		.pipe(app.gulp.dest(app.path.build.js));
	// .pipe(app.plugins.browsersync.stream());
};
