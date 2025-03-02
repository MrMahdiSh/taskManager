<?php

namespace App\Services;

use Exception;
use finfo;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    // Holds the Eloquent model instance that this service will interact with.
    protected $model;

    /**
     * Constructor to inject the Eloquent model.
     *
     * @param Model $model The Eloquent model instance.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieves all records from the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection Returns a collection of all model records.
     */
    public function index()
    {
        return $this->model::all();
    }

    /**
     * Stores a new record in the database.
     *
     * @param array $data The data to be stored.
     * @return Model Returns the newly created model instance.
     */
    public function store($data)
    {
        return $this->model::create($data);
    }

    /**
     * Updates an existing record in the database.
     *
     * @param object $data The data containing the ID and fields to update.
     * @return Model Returns the updated model instance.
     * @throws Exception If the target record is not found.
     */
    public function update($data)
    {
        // Find the record by ID or throw an exception if not found.
        $find = $this->model::findOrFail($data["id"]);

        if ($find) {
            // Update the record with the provided data.
            $find->update($data);
            return $find;
        } else {
            // Throw an exception if the record is not found.
            throw new Exception("The target not found!", 1);
        }
    }

    /**
     * Deletes a record from the database.
     *
     * @param int $id The ID of the record to delete.
     * @return Model Returns the deleted model instance.
     * @throws Exception If the target record is not found.
     */
    public function destroy($id)
    {
        // Find the record by ID or throw an exception if not found.
        $find = $this->model::findOrFail($id);

        if ($find) {
            // Delete the record.
            $find::destroy($id);
            return $find;
        } else {
            // Throw an exception if the record is not found.
            throw new Exception("The target not found!", 1);
        }
    }

    /**
     * Finds records based on a specific column and value.
     *
     * @param string $col The column to search in.
     * @param mixed $val The value to search for.
     * @return \Illuminate\Database\Eloquent\Builder Returns a query builder instance.
     */
    public function findColumn($col, $val)
    {
        return $this->model::where($col, $val);
    }
}
