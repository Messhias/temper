<?php

/**
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    30/12/2019
 * @version  1.0
 */

namespace App\Http\Controllers;

use App\Exceptions\GenericException;
use App\Interfaces\ResourceAPIInterface;
use App\Traits\GenericLogErrors;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Abstract class to init the basic operations for CRUD in models and avoid re-coding in the
 * application controllers.
 *
 * Class ResourceController
 * @package App\Http\Controllers
 */
abstract class ResourceAPIController implements ResourceAPIInterface
{
    use GenericLogErrors;

    /**
     * Representation of the repository in the abstract context.
     *
     * @var mixed
     */
    protected $repository;

    /**
     * Set up the key identifier for the controller.
     *
     * @return mixed
     */
    abstract protected function getKeyIdentifier();

    /**
     * Set up an singular identifier for the class context process.
     *
     * @return mixed
     */
    abstract protected function getSingularIdentifier();

    /**
     * Set up an plural identifier for the class context process.
     *
     * @return mixed
     */
    abstract protected function getPluralIdentifier();

    /**
     * Default found message.
     *
     * @return string
     */
    abstract protected function foundMessage(): string;

    /**
     * Default create message.
     *
     * @return string
     */
    abstract protected function createMessage(): string;

    /**
     * Default update message.
     *
     * @return string
     */
    abstract protected function updateMessage(): string;

    /**
     * Default deleted message.
     *
     * @return string
     */
    abstract protected function deletedMessage(): string;

    /**
     * Default generic message.
     *
     * @return string
     */
    abstract protected function genericMessage(): string;

    /**
     * Set up the repository into the abstract context.
     *
     * @param $repository
     */
    public function setRepository($repository): void
    {
        $this->repository = $repository;
    }

    /**
     * Returns the repository representation.
     *
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Create new entity based on repository abstraction.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try
        {
            return response()->json([
                "data" => $this->getRepository()->create(
                    $request->input($this->getKeyIdentifier())),
                "success" => true,
                "code" => 201,
                "message" => "{$this->getPluralIdentifier()} - {$this->createMessage()}"
                ],
                201
            );
        }
        catch (GenericException $exception)
        {
            return $this->logError($exception);
        }
        catch (\Exception $exception)
        {
            return $this->logError($exception);
        }
    }

    /**
     * Return the entity base on repository abstraction.
     *
     * @param  $id
     *
     * @return JsonResponse
     */
    public function find($id): JsonResponse
    {
        if (empty($id)) return response()->json(['message' => "Provide the identifier."], 404);

        try
        {
            return response()->json([
                "message" => "{$this->getPluralIdentifier()} - {$this->foundMessage()}",
                "data" => $this->getRepository()->find($id),
                "success" => true,
                "code" => 200
            ], 200);
        }
        catch (GenericException $exception)
        {
            return $this->logError($exception);
        }
        catch (\Exception $exception)
        {
            return $this->logError($exception);
        }
    }

    /**
     * Return all the entities base on repository abstraction.
     *
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        try
        {
            return response()->json([
                    "data" => unserialize(
                        str_replace(array('NAN;','INF;'),'0;',serialize($this->getRepository()->get()))
                    ),
                    "success" => true,
                    "code" => 200,
                    "message" => "{$this->getPluralIdentifier()} - {$this->foundMessage()}"
                ], 200
            );
        }
        catch (GenericException $exception)
        {
            return $this->logError($exception);
        }
        catch (\Exception $exception)
        {
            return $this->logError($exception);
        }
    }

    /**
     * Update entity base on id provided and database sent of the repository
     * representation.
     *
     * @param Request $request
     * @param mixed     $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        try
        {
            return response()
                ->json([
                    "data" => $this->getRepository()->update(
                        $id,
                        $request->input($this->getKeyIdentifier())),
                    "success" => true,
                    "code" => 200,
                    "message" => "{$this->getPluralIdentifier()} - {$this->updateMessage()}",
                ], 200
            );
        }
        catch (GenericException $exception)
        {
            return $this->logError($exception);
        }
        catch (\Exception $exception)
        {
            return $this->logError($exception);
        }
    }

    /**
     * Delete entity based on repository implementation
     *
     * @param mixed $id
     *
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        try
        {
            return response()->json([
                "data" => $this->getRepository()->delete($id),
                "success" => true,
                "code" => 200,
                "message" => "{$this->getPluralIdentifier()} - {$this->deletedMessage()}",
            ], 200);
        }
        catch (GenericException $exception)
        {
            return $this->logError($exception);
        }
        catch (\Exception $exception)
        {
            return $this->logError($exception);
        }
    }

    /**
     * Default login resource.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        try
        {
            return response()->json([
                "data" => $this->getRepository()->login(
                $request->input($this->getKeyIdentifier())),
                "message" => "{$this->getPluralIdentifier()} - {$this->genericMessage()}",
                "code" => 200,
                "success" => true,
            ], 200);
        }
        catch (GenericException $exception)
        {
            return $this->logError($exception);
        }
        catch (\Exception $exception)
        {
            return $this->logError($exception);
        }
    }

    /**
     * Abstract register / sign up function.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        try
        {
            return response()
                ->json([
                    "data" => $this->getRepository()
                        ->register(
                            $request->input($this->getKeyIdentifier())
                        ),
                    "success" => true,
                    "code" => 201,
                    "message" => "{$this->getSingularIdentifier()} - Complete",
                ], 201);
        }
        catch (ValidationException $exception)
        {
            return $this->logError($exception);
        }
        catch (\Exception $exception)
        {
            return $this->logError($exception);
        }
    }

    /**
     * Get all the users bookings with pagination and proper
     * eloquent transform data.
     *
     * @param string $user_id
     *
     * @return JsonResponse
     */
    public function get_with_paginate($user_id = ""): JsonResponse
    {
        try
        {
            return response()->json(
                [
                    "data" => unserialize(
                    str_replace(
                        array('NAN;','INF;'),'0;',
                        serialize(
                            $this->getRepository()
                                ->get_with_paginate($user_id))

                        )
                    ),
                    "success" => true,
                    "code" => 200,
                    "message" => "{$this->getPluralIdentifier()} - {$this->foundMessage()}",
                ], 200);
        }
        catch (\Exception $exception)
        {
            return $this->logError($exception);
        }
    }

    /**
     * Default request entries with pagination.
     *
     * @return JsonResponse
     */
    public function default_pagination(): JsonResponse
    {
        try
        {
            return response()
                ->json([
                    "data" => $this->getRepository()
                        ->default_pagination(),
                    "success" => true,
                    "code" => 200,
                    "message" => "{$this->getPluralIdentifier()} - {$this->foundMessage()}",
                ]);
        }
        catch (\Exception $exception)
        {
            return $this->logError($exception);
        }
    }
}
