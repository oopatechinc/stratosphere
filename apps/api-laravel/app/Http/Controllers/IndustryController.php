<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\IndustryService;
use App\Http\Requests\StoreIndustryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\UpdateIndustryRequest;
use App\Models\Category;
use App\Models\Industry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class IndustryController extends Controller
{
    public function __construct(protected IndustryService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function store(StoreIndustryRequest $request): Model
    {
        return $this->service->store($request->validated());
    }

    public function update(UpdateIndustryRequest $request, Industry $industry): Model
    {
        return $this->service->update($industry->id, $request->validated());
    }

    public function destroy(Industry $industry): void
    {
        $this->service->destroy($industry->id);
    }
}
