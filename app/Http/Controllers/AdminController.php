<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Laws;
use App\Subscriptions;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function allSubscriptions()
    {
        return view('admin.subscription.index', ['subscriptions' => Subscriptions::all()]);
    }

    public function singleSubscription($id = null)
    {
        return view('admin.subscription.single',
            ['subscription' => Subscriptions::with('laws', 'laws.lawInfo')->find($id)]);
    }

    public function createSubscription()
    {
        return view('admin.subscription.create', ['lawsCount' => Laws::all(),
            'subscription' => new Subscriptions()]);
    }

    public function storeSubscription(SubscriptionRequest $request, Subscriptions $subscriptions)
    {

        $subscriptions->fill($request->all());
        $subscriptions->save();

        foreach ($request->laws as $law){
            $subscriptions->laws()->create(["laws_id" => $law]);
        }

        return redirect()->route('admin.subscription.all');
    }

    public function editSubscription($id = null)
    {
        return view('admin.subscription.edit',
            ['lawsCount' => Laws::all(),
                'subscription' => Subscriptions::with('laws', 'laws.lawInfo')->find($id)]);
    }

    public function updateSubscription( SubscriptionRequest $request, $id = null)
    {
        $subscriptions = Subscriptions::find($id);
        $subscriptions->fill($request->all());
        $subscriptions->save();

        $subscriptions->laws()->delete();

        foreach ($request->laws as $law){
            $subscriptions->laws()->create(["laws_id" => $law]);
        }

        return redirect()->route('admin.subscription.all');
    }


    public function deleteSubscription($id = null)
    {
        $subscriptions = Subscriptions::find($id);

        if($subscriptions) {

            $subscriptions->laws()->delete();
            $subscriptions->delete();
        }
        return redirect()->route('admin.subscription.all');
    }




    public function allLaws()
    {
        return view('admin.laws.index', ['laws' => $this->getAllLaws()]);
    }

    public function singleLaws($id = null)
    {
        return view('admin.laws.single', ['law' => Laws::find($id)]);
    }

    public function getAllLaws()
    {
        return Laws::all();
    }
}
