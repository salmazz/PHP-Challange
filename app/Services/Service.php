<?php

namespace App\Services;

use Closure;
use Illuminate\Container\Container as Application;

abstract class Service
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var $repository
     */
    protected $repository;

    /**
     * Appication constructor
     */
    public function __construct()
    {
        $this->app = new Application();
        $this->makeRepository();
        $this->boot();
    }

    /**
     *
     */
    public function boot()
    {
        //
    }

    /**
     * Returns the current repository instance
     *
     * @return $repository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Reset repository
     *
     * @reurn void
     */
    public function resetRepository()
    {
        $this->makeRepository();
    }

    /**
     * Specify Repository class name
     *
     * @return string
     */
    abstract public function repository();

    /**
     * Make repository
     *
     * @return $repository
     */
    public function makeRepository()
    {
        $repository = app($this->repository());

        return $this->repository = $repository;
    }

    /**
     * Retrieve data array for populate field select
     *
     * @param $column
     * @param null $key
     * @return mixed
     * @throws \Exception
     */
    public function pluck($column, $key = null)
    {
        try {
            $result = $this->repository->pluck($column, $key);
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function all($columns = ['*'])
    {
        try {
            $result = $this->repository->all($columns);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Retrieve first data of repository
     *
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function first($columns = ['*'])
    {
        try {
            $result = $this->repository->first($columns);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null $limit
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        try {
            $result = $this->repository->paginate($limit, $columns);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Find data by id
     *
     * @param $id
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function find($id, $columns = ['*'])
    {
        try {
            $result = $this->repository->findOrFail($id, $columns);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * First or fail data by field and value
     *
     * @param $field
     * @param null $value
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function firstOrFailByField($field, $value = null, $columns = ['*'])
    {
        try {
            $result = $this->repository->firstOrFailByField($field, $value, $columns);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Find data by field and value
     *
     * @param $field
     * @param null $value
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function findByField($field, $value = null, $columns = ['*'])
    {
        try {
            $result = $this->repository->findByField($field, $value, $columns);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function findWhere(array $where, $columns = ['*'])
    {
        try {
            $result = $this->repository->findWhere($where, $columns);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Find data by multiple values in one field
     *
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function findWhereIn($field, array $values, $columns = ['*'])
    {
        try {
            $result = $this->repository->findWhereIn($field, $values, $columns);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Find data by excluding multiple values in one field
     *
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     * @throws \Exception
     */
    public function findWhereNotIn($field, array $values, $columns = ['*'])
    {
        try {
            $result = $this->repository->findWhereNotIn($field, $values, $columns);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     * @return mixed
     * @throws \Exception
     */
    public function create(array $attributes)
    {
        try {
            $result = $this->repository->create($attributes);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $attributes
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function update(array $attributes, $id)
    {
        try {
            $result = $this->repository->update($attributes, $id);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Update or Create an entity in repository
     *
     * @param array $attributes
     * @param array $values
     * @return mixed
     * @throws \Exception
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        try {
            $result = $this->repository->updateOrCreate($attributes, $values);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function delete($id)
    {
        try {
            $result = $this->repository->delete($id);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Delete multiple entities by given criteria.
     *
     * @param array $where
     * @return mixed
     * @throws \Exception
     */
    public function deleteWhere(array $where)
    {
        try {
            $result = $this->repository->deleteWhere($where);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Bulk delete
     *
     * @param array $ids
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     */
    public function bulkDelete($ids)
    {
        try {
            $result = $this->repository->bulkDelete($ids);

            $this->resetRepository();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $result;
    }

    /**
     * Check if entity has relation
     *
     * @param string $relation
     *
     * @return $this
     */
    public function has($relation)
    {
        $this->repository = $this->repository->has($relation);

        return $this;
    }

    /**
     * Load relations
     *
     * @param array|string $relations
     *
     * @return $this
     */
    public function with($relations)
    {
        $this->repository = $this->repository->with($relations);

        return $this;
    }

    /**
     * Add subselect queries to count the relations.
     *
     * @param  mixed $relations
     * @return $this
     */
    public function withCount($relations)
    {
        $this->repository = $this->repository->withCount($relations);
        return $this;
    }

    /**
     * Load relation with closure
     *
     * @param string $relation
     * @param closure $closure
     *
     * @return $this
     */
    public function whereHas($relation, $closure)
    {
        $this->repository = $this->repository->whereHas($relation, $closure);

        return $this;
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->repository = $this->repository->orderBy($column, $direction);

        return $this;
    }
}
