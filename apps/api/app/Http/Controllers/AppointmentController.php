<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\AppointmentService;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AppointmentController extends Controller
{
    public function __construct(protected AppointmentService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function show(Appointment $appointment): Model
    {
        return $this->service->show($appointment);
    }

    public function store(StoreAppointmentRequest $request): Model
    {
        return $this->service->store($request->validated());
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): Model
    {
        return $this->service->update($appointment, $request->validated());
    }

    public function destroy(Appointment $appointment): void
    {
        $this->service->destroy($appointment);
    }
}
