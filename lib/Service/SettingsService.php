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

namespace OCA\Airavata\Service;

use \OCP\IConfig;

class SettingsService
{

    private $config;

    public function __construct(IConfig $config)
    {
        $this->config = $config;
    }

    public function getAiravataKeycloakUrl()
    {
        return $this->config->getAppValue('user_cas', 'airavata_keycloak_url', '');
    }

    public function getAiravataApiserverUrl()
    {
        return $this->config->getAppValue('user_cas', 'airavata_apiserver_url', '');
    }

    public function getAiravataKeycloakSuperUsername()
    {
        return $this->config->getAppValue('user_cas', 'airavata_keycloak_superuser_name', '');
    }

    public function getAiravataKeycloakAuthGranttype()
    {
        return $this->config->getAppValue('user_cas', 'airavata_keycloak_auth_granttype', '');
    }

    public function getAiravataKeycloakClientId()
    {
        return $this->config->getAppValue('user_cas', 'airavata_keycloak_client_id', '');
    }

    public function getAiravataRealm()
    {
        return $this->config->getAppValue('user_cas', 'airavata_realm', '');
    }

    public function getAiravataKeycloakSuperUserPassword()
    {
        return $this->config->getAppValue('user_cas', 'airavata_keycloak_superuser_password', '');
    }

    public function getPgaClientId()
    {
        return $this->config->getAppValue('user_cas', 'pga_client_id', '');
    }
}