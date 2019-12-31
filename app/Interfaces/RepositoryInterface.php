<?php
/**
 * Created by fabioconceicao.
 * FILE: RepositoryInterface.php
 * User: fabioconceicao
 * Date: 2019-07-08
 * Time: 16:08
 */

namespace App\Interfaces;


/**
 * Default repository interface which it'll gonna create a contract
 * between repository and model.
 *
 * In that once the repository implements that interface it'll automatically create a contract
 * to be implemented the default models operations (create, find, delete, get and etc...).
 *
 * Interface RepositoryInterface
 * @package App\Interfaces
 */
interface RepositoryInterface
{
    /**
     * Find an entry in the model.
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Retrieve all the information from the model.
     *
     * @return mixed
     */
    public function all();

    /**
     * Retrieve all the information from the model.
     *
     * @return mixed
     */
    public function get();

    /**
     * Create a new entry in the model.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update the entry in the model base on id of the same.
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Delete an information from the model.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
