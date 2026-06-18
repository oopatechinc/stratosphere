<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Category;

class CategoriesFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Category(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        //filters
        if ($this->request->has('tenant_id') && isset($this->request['tenant_id'])) {
            $this->query->where('tenant_id', $this->request['tenant_id']);
        }

        //appends
        $this->query->with('services');

        return $this;
    }
}
