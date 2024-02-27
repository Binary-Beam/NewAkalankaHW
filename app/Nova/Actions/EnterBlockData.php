<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class EnterBlockData extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            // Update model fields with new values from action fields
            $model->cement = $fields->cement;
            $model->metal_sand = $fields->metal_sand;
            $model->metal = $fields->metal;
            $model->blocks = $fields->blocks;
            $model->save(); // Save the updated model
        }

        return Action::message('Block data updated successfully!');
    }

    /**
     * Get the fields available on the action.
     */
    public function fields(NovaRequest $request)
    {
        return [
            Number::make('Cement')->rules('required', 'numeric'),
            Number::make('Metal Sand')->rules('required', 'numeric'),
            Number::make('Metal')->rules('required', 'numeric'),
            Number::make('Blocks')->rules('required', 'numeric'),
        ];
    }
}
