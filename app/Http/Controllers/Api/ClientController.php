<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientStoreRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\ClientResource;

class ClientController extends Controller
{
    public function index()
    {
        return ClientResource::collection(Client::with('files')->get());
    }

    public function store(ClientStoreRequest $request)
    {
        $created_client = Client::create($request->validated());
        return response()->json($created_client, 201);
    }

    public function show(string $id)
    {
        return new ClientResource(Client::findOrFail($id));
    }

    public function update(Request $request, Client $client)
    {
        $client->update($request->all());
        return response()->json($client);
    }

    public function destroy(string $id)
    {
        $client = Client::where('id', $id)->first();
    
        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }
    
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully'], 200);
    }
}
