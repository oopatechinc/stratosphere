<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ServiceContract
{
    public function index();
    public function store(array $payload);
    public function update(Model $model, array $payload);
    public function destroy(Model $model);
}
