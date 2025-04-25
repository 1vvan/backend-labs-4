<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('keycloak.roles:ProductsApiViewer')->only(['index', 'show']);
        $this->middleware('keycloak.roles:ProductsApiWriter')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        return Subscription::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subscriber_id' => 'required|exists:subscribers,id',
            'plan' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        return Subscription::create($data);
    }

    public function show(Subscription $subscription)
    {
        return $subscription;
    }

    public function update(Request $request, Subscription $subscription)
    {
        $data = $request->validate([
            'plan' => 'sometimes|string',
            'start_date' => 'sometimes|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
        ]);

        $subscription->update($data);
        return $subscription;
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response()->noContent();
    }
}
