<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Nova;
use Carbon\Carbon;
use App\Nova\Abstracts\Resource;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * The number of resources to show per page via relationships.
     *
     * @var int
     */
    public static $perPageViaRelationship = 10;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Accounts';

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return $this->name;
    }

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string
     */
    public function subtitle()
    {
        return implode(', ', array_column($this->roles->toArray(), 'name'));
    }

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @return bool
     */
    public static function availableForNavigation(Request $request)
    {
        return $request->user()->isAdmin() || $request->user()->hasPermissionTo('navigate user');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Gravatar::make()->maxWidth(50)
                ->showWhenPeeking()
                ->showOnPreview(),

            Text::make('Name')
                ->sortable()
                ->showWhenPeeking()
                ->showOnPreview()
                ->rules('required', 'max:255'),


            Text::make('Roles', function($model) {
                    return implode(', ', array_column($model->roles->toArray(), 'name'));
                })
                ->showWhenPeeking()
                ->showOnPreview(),

            Text::make('Email')
                ->sortable()
                ->showWhenPeeking()
                ->showOnPreview()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),

            BelongsToMany::make('Roles', 'roles', \Pktharindu\NovaPermissions\Nova\Role::class)
                ->canSee(function () use ($request) {
                    return $request->user()->isAdmin() || $request->user()->hasPermissionTo('view user');
                }),

            Boolean::make('Status')
                ->default(function() {
                    return true;
                })
                ->showWhenPeeking()
                ->showOnPreview(),
            
            Stack::make('Created By', [
                Line::make('Created By', function ($model) {
                    if ($model->createdBy?->name == null) {
                        return '-';
                    } else {
                        return '<a class="link-default" href="' . Nova::url('/resources/' . User::uriKey() . '/' . $model->created_by) . '">' . $model->createdBy->name . '</a>';
                    }
                })
                ->asHeading()
                ->asHtml(),
                Line::make('Created Time', function ($model) {
                    return Carbon::parse($model->created_at)?->diffForHumans() ?? '-';
                })->asSmall()
            ])
            ->canSee(function () use ($request) {
                return $request->user()->isAdmin() || $request->user()->hasPermissionTo('view user');
            }),

            Stack::make('Updated By', [
                Line::make('Updated By', function ($model) {
                    if ($model->updatedBy?->name == null) {
                        return '-';
                    } else {
                        return '<a class="link-default" href="' . Nova::url('/resources/' . User::uriKey() . '/' . $model->updated_by) . '">' . $model->updatedBy->name . '</a>';
                    }
                })
                ->asHeading()
                ->asHtml(),
                Line::make('Updated Time', function ($model) {
                    return Carbon::parse($model->updated_at)?->diffForHumans() ?? '-';
                })->asSmall(),
            ])
            ->hideFromIndex()
            ->canSee(function () use ($request) {
                return $request->user()->isAdmin() || $request->user()->hasPermissionTo('view user');
            }),
        ];
    }

    /**
     * Get the menu that should represent the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Nova\Menu\MenuItem
     */
    public function menu(Request $request)
    {
        return parent::menu($request)->withBadge(function () {
            return static::$model::count();
        });
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new Filters\UserRoleType,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            ExportAsCsv::make(),
        ];
    }
}
