<?php

/**
 * @file     routes.php
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    01/01/2020
 * @version  1.0
 */


$resources = [
    'users'
];

/**
 * Mapping all the resources to be included on the routes.
 */
array_map(fn ($resource) => include_once __DIR__ . "/{$resource}.php", $resources);
