<?php

namespace App\Repositories\Contracts;


interface BaseRepositoryInterface
{
    public function all();
    public function find(string $id);
    public function create(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);
    public function where(string $column, mixed $value);
}
