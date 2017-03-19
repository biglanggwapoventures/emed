<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;
use Validator;

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

        // Validator::extend('current_password_match', function($attribute, $value, $parameters, $validator) {
        //     return Hash::check($value, Auth::user()->password);
        // });
        Validator::extend('current_password_match', 'App\Validators\PasswordMatch@check');
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
