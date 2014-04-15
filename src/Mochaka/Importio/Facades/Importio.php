<?php 
namespace Mochaka\Importio\Facades;

use Illuminate\Support\Facades\Facade;

class Importio extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'importio'; }

}