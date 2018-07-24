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

namespace OCA\Airavata\Controller;

use \OCP\IRequest;
use \OCP\AppFramework\Http\TemplateResponse;
use \OCP\AppFramework\Controller;
use \OCP\IConfig;

class SettingsController extends Controller
{

    private $config;

    protected $appName;

    public function __construct($appName, IRequest $request, IConfig $config)
    {
        $this->config = $config;
        $this->appName = $appName;
        parent::__construct($appName, $request);
    }


    public function saveSettings($airavata_keycloak_url, $airavata_apiserver_url, $airavata_realm, $airavata_keycloak_superuser_name,
                                 $airavata_keycloak_superuser_password, $airavata_keycloak_auth_granttype, $airavata_keycloak_client_id, $pga_client_id)
    {
        try {
            $this->config->setAppValue($this->appName, 'airavata_apiserver_url', $airavata_apiserver_url);
            $this->config->setAppValue($this->appName, 'airavata_keycloak_url', $airavata_keycloak_url);
            $this->config->setAppValue($this->appName, 'airavata_keycloak_superuser_name', $airavata_keycloak_superuser_name);
            $this->config->setAppValue($this->appName, 'airavata_keycloak_superuser_password', $airavata_keycloak_superuser_password);
            $this->config->setAppValue($this->appName, 'airavata_keycloak_auth_granttype', $airavata_keycloak_auth_granttype);
            $this->config->setAppValue($this->appName, 'airavata_keycloak_client_id', $airavata_keycloak_client_id);
            $this->config->setAppValue($this->appName, 'airavata_realm', $airavata_realm);
            $this->config->setAppValue($this->appName, 'pga_client_id', $pga_client_id);
            return array(
                'code' => 200,
                'message' => 'Your Airavata settings have been updated.'
            );
        } catch (\Exception $e) {

            return array(
                'code' => 500,
                'message' => 'Your Airavata settings could not be updated. Please try again.'
            );
        }
    }
}