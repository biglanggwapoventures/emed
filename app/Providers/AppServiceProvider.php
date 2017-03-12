<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.form.text', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('bsRadio', 'components.form.radio', ['name', 'label' => null, 'options', 'selected' => null]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
