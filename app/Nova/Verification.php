<?php

namespace App\Nova;

use App\Enums\VerificationStatus;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;

class Verification extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Verification';

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
    public static $search = [
        'id',
    ];

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

            Images::make('Portrait'),
            Images::make('Document Front', 'documentFront'),
            Images::make('Document Rear', 'documentRear'),

            new Panel('User Details', [
                Text::make("Name", 'UserName')
                    ->onlyOnDetail(),

                Text::make("Email", 'UserEmail')
                    ->onlyOnDetail(),

                Text::make("Nationality", 'UserNationality')
                    ->onlyOnDetail(),

                Text::make("Contact Number", 'UserContactNumber')
                    ->onlyOnDetail(),

                Date::make("Date of Birth", 'UserDateOfBirth')
                    ->onlyOnDetail(),
            ]),

            BelongsTo::make('User')
                     ->onlyOnIndex()
                     ->readonly(),

            Select::make('Status')
                  ->options(VerificationStatus::toSelectOptions())
                  ->updateRules('required', Rule::in(VerificationStatus::toSelectOptions())),

            Textarea::make('Remarks'),
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
