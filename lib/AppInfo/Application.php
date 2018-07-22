<?php

/*
 *
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

namespace OCA\Airavata\AppInfo;

use OCA\Airavata\Backends\GroupBackend;
use \OCP\AppFramework\App;
use \OCP\IContainer;

use OCA\Airavata\Service\BackendService;
use OCA\Airavata\Service\SettingsService;
use OCA\Airavata\Controller\SettingsController;
use OCA\Airavata\Backends\UserBackend;
use OCA\Airavata\Service\LoggingService;

class Application extends App
{

    /**
     * Application constructor.
     *
     * @param array $urlParams
     */
    public function __construct(array $urlParams = array())
    {

        parent::__construct('airavata-nextcloud-app', $urlParams);

        $container = $this->getContainer();

        $container->registerService('User', function (IContainer $c) {
            return $c->query('UserSession')->getUser();
        });

        $container->registerService('Config', function (IContainer $c) {
            return $c->query('ServerContainer')->getConfig();
        });

        $container->registerService('Logger', function (IContainer $c) {
            return $c->query('ServerContainer')->getLogger();
        });

        $container->registerService('LoggingService', function (IContainer $c) {
            return new LoggingService(
                $c->query('AppName'),
                $c->query('Logger')
            );
        });

        $container->registerService('SettingsService', function (IContainer $c) {
            return new SettingsService(
                $c->query('Config')
            );
        });

        $container->registerService('UserBackend', function (IContainer $c) {
            return new UserBackend(
                $c->query('LoggingService'),
                $c->query('SettingsService')
            );
        });

        $container->registerService('GroupBackend', function (IContainer $c) {
            return new GroupBackend();
        });

        $container->registerService('BackendService', function (IContainer $c) {
            return new BackendService(
                $c->query('ServerContainer')->getUserManager(),
                $c->query('ServerContainer')->getGroupManager(),
                $c->query('UserBackend'),
                $c->query('GroupBackend'),
                $c->query('LoggingService')
            );
        });

        $container->registerService('SettingsController', function (IContainer $c) {
            return new SettingsController(
                $c->query('AppName'),
                $c->query('Request'),
                $c->query('Config')
            );
        });
    }
}