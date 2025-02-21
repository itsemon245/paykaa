<?php

namespace App\Http\Controllers;

use App\Data\AddData;
use App\Data\AddMethodData;
use App\Enum\AddType;
use App\Models\Add;
use App\Models\AddMethod;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adds = Add::with('addMethod')->paginate();
        $addMethods = AddMethod::select(['id', 'name'])->get();
        return Inertia::render('Add/Index', [
            'adds' => AddData::collect($adds),
            'addMethods' => AddMethodData::collect($addMethods)
        ]);
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
    public function store(Request $request)
    {
        $data = AddData::from($request)->only(
            'type',
            'add_method_id',
            'amount',
            'rate',
            'limit_max',
            'limit_min',
            'contact'
        )->toArray();
        $add = Add::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Add $add)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Add $add)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Add $add)
    {
        $data = AddData::from($request)->only(
            'type',
            'add_method_id',
            'amount',
            'rate',
            'limit_max',
            'limit_min',
            'contact'
        );
        if ($data->type->value == AddType::BUY->value) {
            $data->limit_min = null;
            $data->limit_max = null;
            $data->rate = 0;
        }
        $add->update($data->toArray());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Add $add)
    {
        $add->delete();
        return back()->with('success', 'Add deleted!');
    }
}
