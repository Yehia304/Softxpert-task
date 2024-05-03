<?php


namespace App\Repositories;

interface AbstractRepositoryInterface
{
    public function create($data);

    public function firstOrCreate($data);

    public function update($item, $data);

    public function updateOrCreate($itemIfExist, $data);

    public function findAllAscending($filters = [], $with = [], $orderBy = 'created_at');

    public function findAllDescending($filters = [], $with = [], $orderBy = 'created_at');

    public function findOneBy($filters = [], $with = []);

    public function findOneByOrFail($filters = [], $with = []);

    public function delete($id);

}
