<?php

namespace App\Nova;

use App\Enums\FundSource;
use App\Enums\TransactionStatus;
use App\Enums\TransferPurpose;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;


class Transaction extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Transaction';

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
     * Currencies supported for the transaction.
     *
     * @var
     */
    protected $currencies;

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
     * Get currency select options.
     *
     * @return array
     */
    public function currencyOptions()
    {
        $currencies = $this->getCurrencies();
        $options    = [];

        foreach ($currencies as $currency) {
            $options[$currency['code']] = $currency['name'];
        }

        return $options;
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

            NovaBelongsToDepend::make('Sender', 'user', 'App\Nova\User')
                ->onlyOnForms()
                ->searchable()
                ->options(\App\Models\User::all())
                ->rules('required'),

            NovaBelongsToDepend::make('Recipient', 'beneficiary', 'App\Nova\Beneficiary')
                ->onlyOnForms()
                ->optionsResolve(function ($user) {
                    return $user->beneficiaries()->get(['id', 'name']);
                })
                ->dependsOn('user')
                ->rules('required'),

            BelongsTo::make('Sender', 'user', 'App\Nova\User')
                ->exceptOnForms(),

            BelongsTo::make('Recipient', 'beneficiary', 'App\Nova\Beneficiary')
                ->exceptOnForms(),

            Select::make('Status')
                ->options(TransactionStatus::toSelectOptions()),

            new Panel('Funds Information', [
                Heading::make('Funds Information')->hideFromDetail(),

                Select::make('Source of Funds')
                    ->options(FundSource::toSelectOptions())
                    ->hideFromIndex()
                    ->rules('required', Rule::in(FundSource::toSelectOptions())),

                Select::make('Purpose')
                    ->options(TransferPurpose::toSelectOptions())
                    ->hideFromIndex()
                    ->rules('required', Rule::in(TransferPurpose::toSelectOptions())),

                Heading::make('Currency Conversion')->hideFromDetail(),

                Select::make('From Currency')
                    ->onlyOnForms()
                    ->options($this->currencyOptions())
                    ->rules('required'),

                Currency::make('From Amount')
                    ->onlyOnForms()
                    ->rules('required', 'numeric'),

                Select::make('To Currency')
                    ->onlyOnForms()
                    ->options($this->currencyOptions())
                    ->rules('required'),

                Currency::make('To Amount')
                    ->onlyOnForms()
                    ->rules('required', 'numeric'),

                Currency::make('Fees')
                    ->onlyOnForms()
                    ->rules('required', 'numeric'),

                Text::make('From', 'From Amount')
                    ->exceptOnForms()
                    ->displayUsing(function () {
                        return "{$this->from_currency} {$this->from_amount}";
                    }),

                Text::make('To', 'To Amount')
                    ->exceptOnForms()
                    ->displayUsing(function () {
                        return "{$this->to_currency} {$this->to_amount}";
                    }),

                Text::make('Fees')
                    ->exceptOnForms()
                    ->displayUsing(function () {
                        return "{$this->from_currency} {$this->fees}";
                    }),
            ]),

            Images::make('Proof'),
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

    public function getCurrencies()
    {
        if (!$this->currencies) {
            $this->currencies = \App\Models\Currency::all();
        }

        return $this->currencies;
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

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function subtitle()
    {
        return "ID: {$this->id} (From: {$this->user->name})";
    }

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return "To: {$this->beneficiary->name}";
    }
}
