<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('broadcastme', function ($user) {
    return true; // Adjust this according to your authentication logic
});
