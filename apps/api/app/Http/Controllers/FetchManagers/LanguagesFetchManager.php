<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Industry;
use App\Models\Language;

class LanguagesFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Language(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        return $this;
    }
}
