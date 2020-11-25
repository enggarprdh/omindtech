<?php

namespace App\Repositories;

use App\Plugin;

class PluginRepository  {

    protected $plugin;

    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

}