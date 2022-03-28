<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Auth;

class Timesheet extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Timesheet::class;

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
        'id'
    ];
 
    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (Auth::user()->isManager())
            return $query->select("timesheets.*")->join('users', 'users.id', '=', 'timesheets.user_id')->where('users.manager_guid', Auth::user()->guid);

        if (Auth::user()->isAdmin())
            return $query->select("timesheets.*");
    }
 
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $fields = [
            ID::make(__('ID'), 'id')->sortable(),
        ];

        if (Auth::user()->isManager()) {
            $fields = array_merge(
                $fields,
                [
                    Number::make('user', 'user_id')->displayUsing(function ($user_id) {
                        return \App\Models\User::find($user_id)->email;
                    }),
                    Number::make('activity', 'activity_id')->displayUsing(function ($activity_id) {
                        return \App\Models\Activity::find($activity_id)->name;
                    }),
                ]
            );
        }

        if (Auth::user()->isAdmin()) {
            $fields = array_merge(
                $fields,
                [
                    BelongsTo::make('user'),
                    BelongsTo::make('activity')
                ]
            );
        }

        return array_merge($fields, [
            DateTime::make('started_at')->sortable(),
            DateTime::make('finished_at')->sortable()
        ]);
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fieldsForUpdate(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Select::make('user', 'user_id')->options(\App\Models\User::pluck('email', 'id')),
            Select::make('activity', 'activity_id')->options(\App\Models\Activity::pluck('name', 'id')),
            DateTime::make('started_at')->sortable(),
            DateTime::make('finished_at')->sortable()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [new \Apps\TimesheetReport\TimesheetReport];        
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
