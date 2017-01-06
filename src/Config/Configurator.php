<?php

/*
 * Copyright (c) 2017 Lp digital system
 *
 * This file is part of hauth-bundle.
 *
 * hauth-bundle is free bundle: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * hauth-bundle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with hauth-bundle. If not, see <http://www.gnu.org/licenses/>.
 */

namespace LpDigital\Bundle\HAuthBundle\Config;

use BackBee\ApplicationInterface;
use BackBee\Config\Config;
use BackBee\Utils\Collection\Collection;

use LpDigital\Bundle\HAuthBundle\HAuth;

/**
 * Description of Configurator
 *
 * @manufacturer Lp digital - http://www.lp-digital.fr
 * @copyright    ©2017 - Lp digital
 * @author       Charles Rouillon <charles.rouillon@lp-digital.fr>
 */
class Configurator
{

    /**
     * The hybridauth entrypoint route name.
     *
     * @var string
     */
    static public $routeName = 'hauth.entrypoint';

    /**
     * Adds the root to the entry point of hybridauth library.
     *
     * @param ApplicationInterface $application
     * @param Config               $config
     */
    public static function loadRoutes(ApplicationInterface $application, Config $config)
    {
        $baseURL = Collection::get(HAuth::getHybridAuthConfig($config), 'base_url');

        if (!empty($baseURL) && $application->getContainer()->has('routing')) {
            $route = [
                'pattern' => $baseURL,
                'defaults' => [
                    '_action' => 'hAuthAction',
                    '_controller' => 'hauth.controller',
                ]
            ];

            $application->getContainer()
                    ->get('routing')
                    ->pushRouteCollection([self::$routeName => $route]);
        }
    }
}
