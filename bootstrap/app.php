<?php

use Illuminate\Foundation\Application;

return Application::configure(dirname(__DIR__))
    ->withExceptions()
    ->create();