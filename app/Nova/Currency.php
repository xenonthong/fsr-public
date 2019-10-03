<?php

namespace App\Nova;

use App\Enums\FeeType;
use App\Enums\PaymentMode;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text as CurrencyField;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Silvanite\NovaFieldCheckboxes\Checkboxes;
use Whitecube\NovaFlexibleContent\Flexible;

class Currency extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Currency';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'code';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'code',
        'name',
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
     * @throws \Exception
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->withMeta(['extraAttributes' => [
                    'placeholder' => 'Singapore Dollars'],
                ])
                ->rules('required', 'min:5', 'max:30')
                ->creationRules('unique:currencies,name')
                ->updateRules('unique:currencies,name,{{resourceId}}'),

            Text::make('Code')
                ->sortable()
                ->withMeta(['extraAttributes' => [
                    'placeholder' => 'SGD'],
                ])
                ->rules('required', 'size:3')
                ->creationRules('unique:currencies,code')
                ->updateRules('unique:currencies,code,{{resourceId}}'),

            Checkboxes::make('Payment Modes')->options([
                (string)PaymentMode::bankTransfer() => 'Bank Transfer',
                (string)PaymentMode::jpCard()       => 'Japan Post Bank Card',
                (string)PaymentMode::jpBank()       => 'Japan Post Bank Account',
                (string)PaymentMode::walkIn()       => 'Walk-In payment',
            ]),

            Flexible::make('Rates')->addLayout('Rate', 'rate', [
                Text::make('Name')
                    ->withMeta(['extraAttributes' => [
                        'placeholder' => 'Japanese Yen'],
                    ])
                    ->rules('required', 'min:5', 'max:30'),

                Text::make('Code')
                    ->withMeta(['extraAttributes' => [
                        'placeholder' => 'JPY'],
                    ])
                    ->rules('required', 'size:3'),

                CurrencyField::make('Conversion')
                             ->rules('required'),
            ])
                    ->button('Add New Rate'),

            Flexible::make('Fees')->addLayout('Fee', 'fees', [
                CurrencyField::make('Minimum Amount', 'min')
                             ->withMeta(['extraAttributes' => [
                                 'placeholder' => '1'],
                             ])
                             ->rules('required', 'integer'),

                CurrencyField::make('Maximum Amount', 'max')
                             ->withMeta(['extraAttributes' => [
                                 'placeholder' => '1000'],
                             ])
                             ->rules('required', 'integer'),

                CurrencyField::make('Amount')
                             ->withMeta(['extraAttributes' => [
                                 'placeholder' => '5'],
                             ])
                             ->rules('required', 'integer'),

                Select::make('Type')
                      ->options([
                          (string)FeeType::percent() => 'Percentage',
                          (string)FeeType::fixed()   => 'Flat',
                      ]),
            ])
                    ->button('Add New Fee'),
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
