<?php

namespace App\Providers;

use App\Models\Model;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 5);
        Model::unguard();
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Confirm your email address')
                ->line('Thank you for registering an account with **PayKaa.**')
                ->line('Before getting started, we need to confirm that it is you who created this account.')
                ->line('Please click the button below to confirm your email address.')
                ->action('Confirm the Email', $url)
                ->line('**Please do not reply to this email.**');
        });
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailMessage)
                ->subject('Password Recovery')
                ->line('We have received a password reset request for your account.')
                ->line('In order to reset the password, please follow the link below.')
                ->action('Reset Password', route('password.reset', ['token' => $token, 'email' => $notifiable->email]))
                ->line('**Please do not reply to this email.**');
        });
    }
}
