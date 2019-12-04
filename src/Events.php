<?php

namespace App;

final class Events
{
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    const USER_REGISTERED = 'user.registered';
    Const USER_ALERT = 'user.create.alert';
    Const PROPERTY_ALERT = 'property.alert.available';

}