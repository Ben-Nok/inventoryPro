<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /** @var Model */
    protected Model $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection<int, Model>
     */
    public function all(): Collection
    {
        return $this->model->newQuery()->get();
    }


    /**
     * @param string $id
     * @return Model|null
     * @throws ModelNotFoundException
     */
    public function find(string $id): ?Model
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model
    {
        return $this->model->newQuery()->create($data);
    }

    /**
     * @param string $id
     * @param array $data
     * @return Model|null
     */
    public function update(string $id, array $data): ?Model
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    /**
     * @param string $id
     * @return bool|null
     */
    public function delete(string $id): ?bool
    {
        return $this->find($id)->delete();
    }

    /**
     * @param string $column
     * @param mixed $value
     * @return Collection<int, Model>
     */
    public function where(string $column, mixed $value): Collection
    {
        return $this->model->newQuery()->where($column, $value)->get();
    }
}
