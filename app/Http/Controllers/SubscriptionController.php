<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Services\SystemServices;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    private $systemServices;
    function __construct(SystemServices $systemServices)
    {
        $this->systemServices = $systemServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::query()->orderBy('created_at', 'DESC')->get();
        return view('backend.pages.subscription.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSubscriptionRequest $request)
    {
        $data = $this->data($request);
        $data['slug'] = str()->slug($request->input('title'));
        return $this->systemServices->createSystem(Subscription::query(), $data, 'Subscription', null, $request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, $slug)
    {
        $data = $this->data($request);
        return $this->systemServices->editSystem(Subscription::query(), $slug, $data, 'Subscription', null, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        return $this->systemServices->deleteSystem(Subscription::query(), $slug, 'Subscription');
    }

    public function data($request): array
    {
        $data = $request->except('_token', 'photo', 'title', 'title_en', 'description', 'description_en');
        $data['title'] = ['ar' => $request->input('title'), 'en' => $request->input('title_en')];
        $data['description'] = ['ar' => $request->input('description'), 'en' => $request->input('description_en')];
        $data['admin_id'] = auth()->user()->id;
        return $data;
    }
}
