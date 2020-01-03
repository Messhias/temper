/**
 * @file     Functions.js
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    03/01/2020
 * @version  1.0
 */

/**
 * Filtering array removing null, undefined, ' ', NaN values.
 *
 * @param test_array
 */
export function filterArray(test_array) {
    let index = -1,
        arr_length = test_array ? test_array.length : 0,
        resIndex = -1,
        result = [];

    while (++index < arr_length) {
        const value = test_array[index];

        if (value) {
            result[++resIndex] = value;
        }
    }

    return result;
}
