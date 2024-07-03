export const cssVendor = () => {
    return app.gulp
        .src(app.path.src.cssVendor)
        .pipe(app.gulp.dest(app.path.build.cssVendor));
};
