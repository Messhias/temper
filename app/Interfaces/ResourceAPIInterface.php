<?php

/**
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    30/12/2019
 * @version  1.0
 */

namespace App\Interfaces;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Interface class contract to set up all the minimal requirements for create a Resource API.
 * Works as the same way as the repository interface, but the difference on this one it's the contract between controller,
 * repository to return the data trough the API.
 *
 * Interface ResourceAPIInterface
 * @package App\Interfaces
 */
interface ResourceAPIInterface
{
    /**
     * Set up the repository into the abstract context.
     *
     * @param $repository
     */
    public function setRepository($repository): void;

    /**
     * Returns the repository representation.
     *
     * @return mixed
     */
    public function getRepository();

    /**
     * Create new entity based on repository abstraction.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse;

    /**
     * Return the entity base on repository abstraction.
     *
     * @info
     * The id is a mixed because by default we're using MySQL database but you can
     * remove the id type identifier and left the auto casting of PHP work for you.
     *
     * @param mixed $id
     *
     * @return JsonResponse
     */
    public function find($id): JsonResponse;

    /**
     * Return all the entities base on repository abstraction.
     *
     * @return JsonResponse
     */
    public function get(): JsonResponse;

    /**
     * Update entity base on id provided and database sent of the repository
     * representation.
     *
     * @info
     * The id is a mixed because by default we're using MySQL database but you can
     * remove the id type identifier and left the auto casting of PHP work for you.
     *
     * @param Request $request
     * @param mixed     $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse;

    /**
     * Delete entity based on repository implementation
     *
     * @info
     * The id is a mixed because by default we're using MySQL database but you can
     * remove the id type identifier and left the auto casting of PHP work for you.
     *
     * @param mixed $id
     *
     * @return JsonResponse
     */
    public function delete($id): JsonResponse;
}
