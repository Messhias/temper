<?php

/**
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    30/12/2019
 * @version  1.0
 */

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

/**
 * Default eloquent repository class which extends the contracts of the RepositoryInterface to handle
 * all the commons operations between models and repositories.
 *
 * Class RepositoryEloquent
 * @package App\Repositories
 */
abstract class RepositoryEloquent implements RepositoryInterface
{
    /**
     * Redis key identifier property.
     *
     * @var mixed
     */
    protected $redis_key;

    /**
     * Module representation.
     *
     * @var mixed
     */
    protected $module;

    /**
     * Model.
     *
     * @var mixed
     */
    protected $model;

    /**
     * Application container.
     *
     * @var App
     */
    protected $app;

    /**
     * Model object representation.
     *
     * @var mixed
     */
    protected $obj;

    /**
     * Abstract set up model function.
     *
     * @return mixed
     */
    abstract protected function model();

    /**
     * Abstract set up module representation.
     *
     * @return mixed
     */
    abstract protected function module();

    /**
     * @return mixed
     */
    protected abstract function redis_key();

    /**
     * Returning the set up model.
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set up the model into object context.
     *
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * Returning the application container.
     *
     * @return App
     */
    public function getApp(): App
    {
        return $this->app;
    }

    /**
     * Set up application container.
     *
     * @param App $app
     */
    public function setApp(App $app): void
    {
        $this->app = $app;
    }

    /**
     * Returning the object model.
     *
     * @return mixed
     */
    public function getObj()
    {
        return $this->obj;
    }

    /**
     * Set up the object model.
     *
     * @param mixed $obj
     */
    public function setObj($obj): void
    {
        $this->obj = $obj;
    }

    /**
     * Returning the module.
     *
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set up the module.
     *
     * @param mixed $module
     */
    public function setModule($module): void
    {
        $this->module = $module;
    }

    /**
     * @param $key
     */
    public function setRedisKey($key)
    {
        $this->redis_key = $key;
    }

    /**
     * @return mixed
     */
    public function getRedisKey()
    {
        return $this->redis_key;
    }

    /**
     * RepositoryEloquent constructor.
     *
     * @param App $app
     *
     * @throws Exception
     */
    public function __construct(App $app)
    {
        $this->setApp($app);
        $this->makeModel();
    }

    /**
     * Creating the model object instance.
     *
     * @return Model|mixed
     * @throws Exception
     */
    protected function makeModel()
    {
        $model = $this->getApp()->make($this->model());
        $this->setModule($this->module());
        $this->setRedisKey($this->redis_key());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Model");
        }

        $this->setModel($model);
        return $this->getModel();
    }

    /**
     * Returning the object model default data.
     *
     * @return mixed
     */
    protected function getDefaultData()
    {
        $data = $this->obj->getAttributes();
        $fields = $this->model->getFillable();
        array_push($fields, 'id');

        while (list($key, $value) = @each($data)) {
            if (!in_array($key, $fields)) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    /**
     * Sync object model data.
     *
     * @param mixed $data
     */
    protected function syncData(array $data = [])
    {
        if (!$this->obj) {
            return;
        }

        $this->obj->setRawAttributes($this->getDefaultData());
        $fields = $this->model->getFillable();

        array_map(function ($field) use ($data) {
            if (array_key_exists($field, $data)) {
                $this->obj->{$field} = $data[$field];
            }
        }, $fields);
    }

    /**
     * Returning all collection.
     *
     * @return mixed
     */
    public function get()
    {
        return $this->getModel()->get();
    }

    /**
     * Returning all the collection.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * Find a specific model instance.
     *
     * @param      $id
     * @param bool $is_update
     *
     * @return mixed
     */
    public function find($id, bool $is_update = false)
    {
        $this->obj = $this->model->find($id);

        if (!$this->obj) {
            if (!$this->obj) return [];
        }

        return $this->obj;
    }

    /**
     * Returning an where based on specific filter.
     *
     * It's seems work in the same way as model but there's a difference
     * since this function create a log entry in database.
     *
     * @param array $filter
     * @return mixed
     */
    public function where(array $filter = [])
    {
        return $this->model->where($filter)->get();
    }

    /**
     * Create a new collection.
     *
     * @param array $data
     * @return bool|Model
     */
    public function create(array $data = [])
    {
        $this->obj = new $this->model;

        return $this->saveObj($data, true);
    }

    /**
     * Updating an collection.
     *
     * @param $id
     * @param array $data
     *
     * @return array|bool|Model
     */
    public function update($id, array $data = [])
    {
        $this->obj = $this->find($id, true);

        $save_data = [];

        if (!empty($this->obj)) {

            $save_data = $this->saveObj($data);
        }

        return $save_data;
    }

    /**
     * Saving the object instance.
     *
     * @param array $data
     * @param bool $creating
     * @return bool|Model
     */
    protected function saveObj(array $data = [], $creating = false)
    {
        $this->syncData($data);
        $this->beforeSave($this->obj, $data, $creating);

        if ($this->obj->save()) {
            $data =  $this->afterSave($this->obj, $data, $creating);

            return $data;
        }

        return false;
    }

    /**
     * Before save returning the object sync data of collections instances.
     *
     * @param Model $model
     * @param mixed $data
     * @param $creating
     * @return Model
     */
    protected function beforeSave(Model &$model, &$data, $creating)
    {
        return $model;
    }

    /**
     * After save returning the object sync data of collections instances.
     *
     * @param Model $model
     * @param array $data
     * @param $creating
     * @return Model
     */
    protected function afterSave(Model $model, array $data, $creating)
    {
        return $model;
    }

    /**
     * Delete an instance.
     *
     * @param $id
     *
     * @return mixed
     * @throws Exception
     */
    public function delete($id)
    {
        $obj = $this->find($id);

        if ($obj instanceof Model) $this->beforeDelete($obj);

        if (!is_array($obj)) return $obj->delete();

        return true;
    }

    /**
     * Before delete returning the object sync data of collections instances.
     *
     * @param Model $model
     * @return Model
     */
    protected function beforeDelete(Model $model)
    {
        return $model;
    }

    /**
     * Running the validate functions.
     *
     * @return bool
     */
    public function validate()
    {
        if (!$this->obj) {
            return false;
        }

        return method_exists($this->obj, 'isValid') ? $this->obj->isValid() : false;
    }

    /**
     * Returning the active collections.
     *
     * @return mixed
     */
    public function active()
    {
        return $this->model->where('active', true)->get();
    }

    /**
     * Returning the object instance by code.
     *
     * @param $code
     * @return mixed
     */
    public function getByCode($code)
    {
        return $this->model->where('code', $code)->first();
    }

    /**
     * Generic filter.
     * This filter returns all the object collections which satisfy the filter
     * criteria.
     *
     * @param array $filter
     * @return mixed
     */
    public function filter(array $filter)
    {
        return $this->model->where($filter)->get();
    }

    /**
     * Returning only one object collection instance.
     *
     * @param array $filter
     * @return mixed
     */
    public function filterOne(array $filter)
    {
        return $this->model->where($filter)->first();
    }

    /**
     * Retrieve the data.
     *
     * @return array
     */
    public function first()
    {
        $data = $this->getModel()
            ->first();

        if (!empty($data)) return [];

        return $data;
    }

    /**
     * Return all the eloquent models data.
     *
     * @param string $user_id
     *
     * @return mixed
     */
    public function get_with_paginate($user_id = "")
    {
        return $this->getModel()
            ->paginate();
    }

    /**
     * Return the models entry with default pagination
     *
     * @return mixed
     */
    public function default_pagination()
    {
        return $this->getModel()
            ->paginate();
    }

    /**
     * This method in case of no overriding on it
     * it'll call the local method create as per
     * the register it's same concept of create.
     *
     * @param array $data
     *
     * @return bool|Model
     */
    public function register(array $data = [])
    {
        return $this->create($data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function login(array $data = [])
    {
        if (isset($data['email']))
        {
            if (isset($data['password']))
            {
                $user = $this->getModel()
                    ->where(["email" => $data['email']])
                    ->first();

                if (!$user) $user = $this->getModel()
                    ->where(['mail' => $data['email']])
                    ->first();

                if ($user)
                {
                    $password = password_hash($data['password']);
                    return password_verify($password, $user->password);
                }
                else return false;
            }
        }

        return false;
    }
}
