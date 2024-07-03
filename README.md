[<img alt="Deployed with FTP Deploy Action" src="https://img.shields.io/badge/Deployed With-FTP DEPLOY ACTION-%3CCOLOR%3E?style=for-the-badge&color=d00000">](https://github.com/SamKirkland/FTP-Deploy-Action)

Deciders theme
===

Hi. This theme, called `Deciders theme`, is based on the starting theme `underscores`. This theme is developed for https://zigmund.online/blog/deciders/

Installation
---------------

### Requirements

`Deciders theme` requires the following dependencies:

- [Node.js](https://nodejs.org/)
- [Composer](https://getcomposer.org/)


### Setup

To start using all the tools that come with `Deciders theme`  you need to install the necessary Node.js and Composer dependencies :

#### Backend

```sh
$ composer install
```

#### Frontend

```sh
$ npm i
$ gulp dev
```
- All settings and tasks you can find within gulpfile.js
- All assets you need to use in the ./app folder but compiled files for production will be in ./dist folder
- For complete production bundle use `gulp build`
- For complete production bundle use `npm run build`

### Available CLI commands

`Deciders theme` comes packed with CLI commands tailored for WordPress theme development :

- `composer lint:wpcs` : checks all PHP files against [PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
- `composer lint:php` : checks all PHP files for syntax errors.
- `composer make-pot` : generates a .pot file in the `languages/` directory.
- `npm run compile:css` : compiles SASS files to css.
- `npm run compile:rtl` : generates an RTL stylesheet.
- `npm run watch` : watches all SASS files and recompiles them to css when they change.
- `npm run lint:scss` : checks all SASS files against [CSS Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/css/).
- `npm run lint:js` : checks all JavaScript files against [JavaScript Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/).
- `npm run bundle` : generates a .zip archive for distribution, excluding development and system files.

### Fixing troubleshooting
In node_modules in the extension "webp-converter" you need the file "cwebp.js" from "webp-converter/src/cwebp.js" move to root "webp-converter/cwebp.js ".
