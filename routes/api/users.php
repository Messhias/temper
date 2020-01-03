<?php

/**
 * @file     users.php
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    01/01/2020
 * @version  1.0
 */

Route::group([
    'prefix' => 'users',
    "namespace" => "API"
], function()  {
    /**
     * Return all the users reports.
     *
     * @return \Illuminate\Routing\Route
     */
    Route::get("/", "UsersReportsController@get");

    /**
     * Create a new user report
     *
     * @return \Illuminate\Routing\Route
     */
    Route::post("/", "UsersReportsController@post");

    /**
     * Update a new user route.
     *
     * @return \Illuminate\Routing\Route
     */
    Route::put("/", "UsersReportsController@update");

    /**
     * Find a specific route stored by it id
     *
     * @return \Illuminate\Routing\Route
     */
    Route::get("/{id}", "UsersReportsController@update");

    /**
     * Delete a user report
     *
     * @return \Illuminate\Routing\Route
     */
    Route::delete("/{id}", "UsersReportsController@delete");
});
