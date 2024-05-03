<?php

namespace App\Repositories;

use App\Exceptions\CustomQueryException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class EloquentAbstractRepository implements AbstractRepositoryInterface
{
    protected $model;

    /**
     * @throws CustomQueryException
     */
    public function create($data)
    {
        try {
            return $this->model->query()->create($data->toArray());
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

    /**
     * @throws CustomQueryException
     */
    public function firstOrCreate($data)
    {
        try {
            return $this->model->query()->firstOrCreate($data);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

    /**
     * @throws CustomQueryException
     */
    public function update($item, $data)
    {
        try {
            return $item->update($data);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

    /**
     * @throws CustomQueryException
     */
    public function updateOrCreate($itemIfExist, $data)
    {
        try {
            return $this->model->query()->updateOrCreate($itemIfExist, $data);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

    /**
     * @throws CustomQueryException
     */
    public function findAllAscending($filters = [], $with = [], $orderBy = 'created_at')
    {
        try {
            return $this->model->query()
                ->where($filters)
                ->with($with)
                ->orderBy($orderBy);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

    /**
     * @throws CustomQueryException
     */
    public function findAllDescending($filters = [], $with = [], $orderBy = 'created_at')
    {
        try {
            return $this->model->query()
                ->where($filters)
                ->with($with)
                ->orderByDesc($orderBy);

        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }


    /**
     * @throws CustomQueryException
     */
    public function findOneBy($filters = [], $with = [])
    {
        try {
            return $this->model->query()->where($filters)->with($with)->first();
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

    /**
     * @throws CustomQueryException
     */
    public function findOneByOrFail($filters = [], $with = [])
    {
        try {
            return $this->model->query()->where($filters)->with($with)->firstOrFail();
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

    /**
     * @throws CustomQueryException
     */
    public function delete($id)
    {
        try {
            return $this->model->destroy($id);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

}
