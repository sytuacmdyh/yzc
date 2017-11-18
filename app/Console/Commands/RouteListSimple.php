<?php

namespace App\Console\Commands;

use Closure;
use Illuminate\Console\Command;
use Illuminate\Foundation\Console\RouteListCommand;
use Illuminate\Routing\Route;

class RouteListSimple extends RouteListCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'route:ls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'simplified route:list';

    /**
     * The table headers for the command.
     *
     * @var array
     */
    protected $headers = ['Method', 'URI', 'Name', 'Action', 'Middleware'];

    /**
     * Get the route information for a given route.
     *
     * @param  \Illuminate\Routing\Route $route
     * @return array
     */
    protected function getRouteInformation(Route $route)
    {
        $actionArr = explode('\\', $route->getActionName());
        return $this->filterRoute([
//            'host'   => $route->domain(),
            'method' => implode('|', $route->methods()),
            'uri'    => $route->uri(),
            'name'   => $route->getName(),
            'action' => end($actionArr),
            'middleware' => $this->getMiddleware($route),
        ]);
    }

    protected function getMiddleware($route)
    {
        return collect($route->gatherMiddleware())->map(function ($middleware) {
            $middlewareArr = explode('\\', $middleware);
            return $middleware instanceof Closure ? 'Closure' : end($middlewareArr);
        })->implode(',');
    }
}
