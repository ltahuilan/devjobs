<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
        VerifyEmail::toMailUsing( function($notifiable, $url) {
            return (new MailMessage)
                ->subject('Confirma tu correo electrónico')
                ->line('Por favor, haga clic en el siguiente botón para verificar su dirección de correo electrónico.')
                ->action('Confirmar correo electrónico', $url)
                ->line('Si no ha creado una cuenta, puede ignorar este mensaje.');
        });
    }
}
