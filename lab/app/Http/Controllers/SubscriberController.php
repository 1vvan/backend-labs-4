<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SubscriberController extends Controller
{
    public function __construct()
{
    $this->middleware('keycloak.roles:ProductsApiViewer')->only(['index', 'show']);
    $this->middleware('keycloak.roles:ProductsApiWriter')->only(['store', 'update', 'destroy']);
}


    public function index(): JsonResponse
    {
        return response()->json(Subscriber::all());
    }

    public function store(Request $request): JsonResponse
    {
        $subscriber = Subscriber::create($request->all());
        return response()->json($subscriber, 201);
    }

    public function show(Subscriber $subscriber): JsonResponse
    {
        return response()->json($subscriber);
    }

    public function update(Request $request, Subscriber $subscriber): JsonResponse
    {
        $subscriber->update($request->all());
        return response()->json($subscriber);
    }

    public function destroy(Subscriber $subscriber): JsonResponse
    {
        $subscriber->delete();
        return response()->json(null, 204);
    }
}
