<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceTypeRequest;
use App\Http\Requests\UpdateServiceTypeRequest;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ServiceTypes = ServiceType::select()
        ->paginate(50);

        return inertia('Web/ServiceType/IndexServiceType', [
            'ServiceTypes' => $ServiceTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Web/ServiceType/CreateServiceType');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceTypeRequest $request)
    {
        $data = $request->validated();
        $data['value'] = preg_replace('/[^0-9]/', '', $data['value']);

        // Cadastra o tipo de serviço
        $ServiceType = ServiceType::create($data);

        return to_route('service.type.create')->with('success', 'Tipo de serviço cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceType $ServiceType)
    {
        return inertia('Web/ServiceType/EditServiceType', [
            'ServiceType' => $ServiceType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceTypeRequest $request, ServiceType $ServiceType)
    {
        $data = $request->validated();
        $data['value'] = preg_replace('/[^0-9]/', '', $data['value']);

        // Atualiza o serviço
        $ServiceType->update($data);

        return to_route('service.type.edit', $ServiceType->id)->with('success', 'Tipo de serviço atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceType $ServiceType)
    {
        $ServiceType->delete();

        return to_route('service.type.index')->with('success', 'Tipo de serviço deletado com sucesso');
    }
}
