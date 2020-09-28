/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: C:\\xampp\\htdocs\\instantclass\\resources\\js\\app.js: Unexpected token (14:0)\n\n\u001b[0m \u001b[90m 12 | \u001b[39m\u001b[33mVue\u001b[39m\u001b[33m.\u001b[39mcomponent(\u001b[32m'appfooter'\u001b[39m\u001b[33m,\u001b[39m require(\u001b[32m'./components/FooterComponent.vue'\u001b[39m)\u001b[33m.\u001b[39m\u001b[36mdefault\u001b[39m)\u001b[33m;\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 13 | \u001b[39m\u001b[33mVue\u001b[39m\u001b[33m.\u001b[39mcomponent(\u001b[32m'Home'\u001b[39m\u001b[33m,\u001b[39m require(\u001b[32m'./components/HomeCompnent.vue'\u001b[39m)\u001b[33m.\u001b[39m\u001b[36mdefault\u001b[39m)\u001b[33m;\u001b[39m\u001b[0m\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 14 | \u001b[39m\u001b[33m<<\u001b[39m\u001b[33m<<\u001b[39m\u001b[33m<<\u001b[39m\u001b[33m<\u001b[39m \u001b[33mHEAD\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m    | \u001b[39m\u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 15 | \u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 16 | \u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 17 | \u001b[39m\u001b[90m// axios.defaults.baseURL = process.env.MIX_API_URL;\u001b[39m\u001b[0m\n    at Parser._raise (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:757:17)\n    at Parser.raiseWithData (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:750:17)\n    at Parser.raise (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:744:17)\n    at Parser.unexpected (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:8834:16)\n    at Parser.parseExprAtom (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:10176:20)\n    at Parser.parseExprSubscripts (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:9688:23)\n    at Parser.parseMaybeUnary (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:9668:21)\n    at Parser.parseExprOps (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:9538:23)\n    at Parser.parseMaybeConditional (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:9511:23)\n    at Parser.parseMaybeAssign (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:9466:21)\n    at Parser.parseExpression (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:9418:23)\n    at Parser.parseStatementContent (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:11339:23)\n    at Parser.parseStatement (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:11210:17)\n    at Parser.parseBlockOrModuleBlockBody (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:11785:25)\n    at Parser.parseBlockBody (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:11771:10)\n    at Parser.parseTopLevel (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:11141:10)\n    at Parser.parse (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:12843:10)\n    at parse (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\parser\\lib\\index.js:12896:38)\n    at parser (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\core\\lib\\parser\\index.js:54:34)\n    at parser.next (<anonymous>)\n    at normalizeFile (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\core\\lib\\transformation\\normalize-file.js:93:38)\n    at normalizeFile.next (<anonymous>)\n    at run (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\core\\lib\\transformation\\index.js:31:50)\n    at run.next (<anonymous>)\n    at Function.transform (C:\\xampp\\htdocs\\instantclass\\node_modules\\@babel\\core\\lib\\transform.js:27:41)\n    at transform.next (<anonymous>)\n    at step (C:\\xampp\\htdocs\\instantclass\\node_modules\\gensync\\index.js:254:32)\n    at C:\\xampp\\htdocs\\instantclass\\node_modules\\gensync\\index.js:266:13\n    at async.call.result.err.err (C:\\xampp\\htdocs\\instantclass\\node_modules\\gensync\\index.js:216:11)");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\instantclass\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\instantclass\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });