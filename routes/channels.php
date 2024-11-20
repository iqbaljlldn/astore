<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('products', function ($user) {
    return true;
});

Broadcast::channel('sales', function ($user) {
    return true;
});
