<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexClientRequest $request)
    {

        $Clients = Client::select('id', 'name', 'phone')
        ->when($request->f_name, function($query) use ($request) {
            $query->where('name', 'LIKE', "%$request->f_name%");
        })
        ->when($request->f_phone, function($query) use ($request) {
            $query->where('phone', 'LIKE', "%$request->f_phone%");
        })
        ->paginate(10);

        return inertia('Web/Client/Index', [
            'Clients' => $Clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Web/Client/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $data = $request->validated();
        $data['phone'] = preg_replace('/[^0-9]/', '', $data['phone']);

        Client::create($data);

        return to_route('client.create')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $Client)
    {
        return inertia('Web/Client/Show', [
            'Client' => $Client,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $Client)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $Client)
    {
        $data = $request->validated();
        $data['phone'] = preg_replace('/[^0-9]/', '', $data['phone']);

        $Client->update($data);

        return to_route('client.show', $Client->id)->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
