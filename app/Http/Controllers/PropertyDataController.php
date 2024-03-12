<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyData;
use App\Http\Resources\PropertyDataResource;

class PropertyDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $propertyData;

    public function __construct(PropertyData $propertyData)
    {
        $this->propertyData = $propertyData;
    }

    public function index(Request $request)
    {
        $filters = $request->only($this->propertyData->getFilters());

        $properties = $this->propertyData->search($filters);

        return PropertyDataResource::collection($properties);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new PropertyDataResource(PropertyData::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
