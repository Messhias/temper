import Axios from 'axios';

/**
 * Options for request.
 *
 * @INFO -> if you need change the default requests handlers be auth just switch the param
 * withCredentials to true.
 *
 * @INFO -> if you want to use your dev ser in baseURL just change the getDevServer() and it's done,
 * @INFO -> if you want to change the endpoint of your dev ser go to Env.js file and change the const dev_server to your
 * respective URL endpoint.
 *
 * @type {{baseURL: (never|*), withCredentials: boolean, timeout: number}}
 */
const options = {
    baseURL: "http://localhost/",
    withCredentials: false,
    headers: {
        'Content-Type': 'application/json',
    },
};

const instance = Axios.create(options);

instance.parseParams = (params) => {
    return Object.keys(params).map(function(key) {
        return [key, params[key]].map(encodeURIComponent).join("=");
    }).join("&");
};

export default instance;
