<?php

namespace App\Listeners;

use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreSamlLoginInSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Saml2LoginEvent  $event
     * @return void
     */
    public function handle(Saml2LoginEvent $event)
    {
        session(['saml2User' => $event->getSaml2User(), 'saml2Auth' => $event->getSaml2Auth()]);
    }
}
