/**
 * @file     Get.js
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    03/01/2020
 * @version  1.0
 */

import Request from '../../utils/Request';

/**
 * Request the information from api.
 *
 * @request
 * @return <Promise>
 */
export default () => Request.get(`/api/users/reports`);
