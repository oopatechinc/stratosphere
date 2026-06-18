<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Property;

class CollectionItemFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Property(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        $this->query->with('images');
        return $this;
    }
}
