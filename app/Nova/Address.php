<?php

namespace App\Nova;

use ElevateDigital\CharcountedFields\TextCounted;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Place;

class Address extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Address';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];

    /**
     * Should display in navigation.
     *
     * @var bool
     */
    public static $displayInNavigation = false;


    /**
     * Should should up in global search.
     *
     * @var bool
     */
    public static $globallySearchable = false;

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            MorphTo::make('Addressable')->types([
                Store::class,
                User::class,
            ])->rules('required'),

            Place::make('Line 1')
                 ->rules('required', 'min:5', 'max:100'),

            TextCounted::make('Line 2')
                       ->nullable()
                       ->maxChars(100)
                       ->rules('max:100'),

            Country::make('Country')
                   ->rules('required'),

            TextCounted::make('City')
                       ->maxChars(50)
                       ->rules('required', 'min:5', 'max:100'),

            TextCounted::make('Postal Code')
                       ->maxChars(10)
                       ->rules('required', 'min:5', 'max:100'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }
}
