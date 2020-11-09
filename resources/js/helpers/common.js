/*
|--------------------------------------------------------------------------
| Common Helpers
|--------------------------------------------------------------------------
|
| This is a helper file which contains all common/generic helpers that will
| be called multiple times in different files.
|
| Kind put your methods in here and then just use them on Vuex or Components
| for cleaner implementation.
|
*/

/**
 * Validate
 * @param v
 * @returns {boolean}
 */
export function isEmpty(v) {
    if (window._.isArray(v) || window._.isObject(v)) {
        return window._.size(v) === 0;
    } else {
        return (
          window._.isNil(v)
          || window._.trim(v) === ''
          || v === 0
        );
    }
}
