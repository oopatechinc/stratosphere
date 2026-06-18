<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Template;

class TemplatesFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Template(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        //filters
        $vertical = auth()->user()->tenant->vertical;
        $this->query
            ->whereHas('verticals', function ($q) use ($vertical) {
                $q->where('template_vertical.vertical_id', $vertical->id);
            })
            ->where('is_active', 1)
            ->with('blueprint.themes')
            ->with('verticals');

        return $this;
    }
}
