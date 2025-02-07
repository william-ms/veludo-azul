<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Client;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Traits\ServiceTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ServiceTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Services = Service::select()
        ->with('client')
        ->paginate(50);

        return inertia('Web/Service/IndexService', [
            'Services' => $Services,
            'ServiceStatus' => $this->ServiceStatus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Web/Service/CreateService', [
            'ServiceTypes' => $this->ServiceTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        $data['value'] = preg_replace('/[^0-9]/', '', $data['value']);

        // Define o identificador único do serviço
        $QtdServices = Service::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->get()->count();
        $data['service'] = Carbon::now()->format('Ym') . str_pad($QtdServices + 1, 4, '0', STR_PAD_LEFT);

        // Cadastra novo cliente caso ele não exista
        if(empty($data['client_id'])) {
            $Client = Client::create([
                'name' => $data['name'],
                'phone' => preg_replace('/[^0-9]/', '', $data['phone'])
            ]);
            $data['client_id'] = $Client->id;
        }

        // Cadastra o serviço
        $Service = Service::create($data);

        // Cadastra os items do serviço
        foreach($data['service_items'] as $service_item) {
            ServiceItem::create([
                'service_id' => $Service->id,
                'piece' => $service_item['piece'],
                'color' => $service_item['color'],
                'type' => $service_item['type'],
                'value' => preg_replace('/[^0-9]/', '', $service_item['value']),
            ]);
        }

        return to_route('service.edit', $Service->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $Service)
    {
        $Service->load('client');

        return inertia('Web/Service/ShowService', [
            'Service' => $Service,
            'ServiceStatus' => $this->ServiceStatus,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $Service)
    {
        $Service->load('client', 'items');

        return inertia('Web/Service/EditService', [
            'Service' => $Service,
            'ServiceStatus' => $this->ServiceStatus,
            'ServiceTypes' => $this->ServiceTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $Service)
    {
        $data = $request->validated();
        $data['value'] = preg_replace('/[^0-9]/', '', $data['value']);

        // Cadastra novo cliente caso ele não exista
        if(empty($data['client_id'])) {
            $Client = Client::create([
                'name' => $data['name'],
                'phone' => preg_replace('/[^0-9]/', '', $data['phone'])
            ]);
            $data['client_id'] = $Client->id;
        }

        // Atualiza o serviço
        $Service->update($data);
        $Service->load('items');

        // Atualiza/Cadastra os items do serviço
        foreach($data['service_items'] as $service_item) {
            $data_item = [
                'service_id' => $Service->id,
                'piece' => $service_item['piece'],
                'color' => $service_item['color'],
                'type' => $service_item['type'],
                'value' => preg_replace('/[^0-9]/', '', $service_item['value']),
            ];

            if(empty($service_item['id'])) {
                ServiceItem::create($data_item);
            } else {
                $Service->items->where('id', $service_item['id'])->first()->update($data_item);
            }
        }

        return to_route('service.edit', $Service->id)->with('success', 'Serviço atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
