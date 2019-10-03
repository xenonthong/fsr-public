<?php

namespace App\Nova;

use App\Enums\VerificationStatus;
use ElevateDigital\CharcountedFields\TextCounted;
use Eminiarts\Tabs\ActionsInTabs;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;

class User extends Resource
{
    use ActionsInTabs;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\Models\\User';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'email';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'first_name',
        'last_name',
        'email',
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

            TextCounted::make('First Name')
                       ->maxChars('50')
                       ->sortable()
                       ->rules('required', 'max:50'),

            TextCounted::make('Last Name')
                       ->maxChars('50')
                       ->sortable()
                       ->rules('required', 'max:50'),

            TextCounted::make('Email')
                       ->maxChars(50)
                       ->sortable()
                       ->rules('required', 'email', 'max:254')
                       ->creationRules('unique:users,email')
                       ->updateRules('unique:users,email,{{resourceId}}'),

            Select::make('Verification Status')
                  ->options(VerificationStatus::toSelectOptions())
                  ->updateRules('required', Rule::in(VerificationStatus::toSelectOptions())),

            Password::make('Password')
                    ->onlyOnForms()
                    ->creationRules('required', 'string', 'min:8')
                    ->updateRules('nullable', 'string', 'min:8'),

            (new Tabs('Relations', [
                HasOne::make('Profile'),
                HasOne::make('Address'),
                HasMany::make('Beneficiaries'),
                HasMany::make('Points'),
                MorphToMany::make('Roles', 'roles', Role::class),
                MorphToMany::make('Permissions', 'permissions', \Eminiarts\NovaPermissions\Nova\Permission::class),
            ])),
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
     * Determines if the User is a Super admin
     *
     * @return null
     */
    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
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
        return "ID: {$this->id}";
    }

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return "{$this->name} ({$this->email})";
    }
}
