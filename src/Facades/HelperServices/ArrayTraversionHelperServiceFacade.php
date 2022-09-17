<?php

declare(strict_types=1);

namespace PoPSchema\ExtendedSchemaCommons\Facades\HelperServices;

use PoP\Root\App;
use PoPSchema\ExtendedSchemaCommons\HelperServices\ArrayTraversionHelperServiceInterface;

class ArrayTraversionHelperServiceFacade
{
    public static function getInstance(): ArrayTraversionHelperServiceInterface
    {
        /**
         * @var ArrayTraversionHelperServiceInterface
         */
        $service = App::getContainer()->get(ArrayTraversionHelperServiceInterface::class);
        return $service;
    }
}
