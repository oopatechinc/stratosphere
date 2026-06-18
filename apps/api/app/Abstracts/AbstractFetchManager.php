<?php

namespace App\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

Abstract class AbstractFetchManager
{
    protected Builder $query;
    protected Request $request;
    private bool $isSingle = false;

    public function __construct(protected Model $model, $id = null)
    {
        $this->request = request();

        if ($id) {
            $this->isSingle = true;
            $this->query = $model::query()->where('id', $id);
        } else {
            $this->query = $model::query();
        }
    }

    public abstract function apply();

    public function get()
    {
        if ($this->isSingle) {
            return $this->query->first();
        }

        //handle multiple data
        if ($this->request->has('paginate') && isset($this->request['paginate'])) {
            return $this->query->paginate($this->request['paginate']);
        } else if ($this->request->has('total') && isset($this->request['total'])) {
            return $this->query->count();
        }  else {
            return $this->query->get();
        }
    }
}
