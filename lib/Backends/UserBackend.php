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

namespace OCA\Airavata\Backends;

//require '../../vendor/autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use OC\User\Database;
use OCA\Airavata\Service\LoggingService;
use OCA\Airavata\Service\SettingsService;
use OCP\IUserBackend;


class UserBackend extends Database
{

    private $loggingService;

    private $settingsService;

    public function __construct(LoggingService $loggingService, SettingsService $settingsService)
    {

        parent::__construct();
        $this->loggingService = $loggingService;
        $this->settingsService = $settingsService;
    }

    public function getBackendName()
    {
        return "Airavata";
    }

    public function createUser($uid, $password): bool
    {
        return true;
    }

    public function deleteUser($uid) {
        return true;
    }

    public function setPassword( $uid, $password): bool
    {
        return true;
    }

    public function setDisplayName($uid, $displayName): bool
    {
        return true;
    }

    public function getDisplayName($uid): string {
        $this->loggingService->write(\OCP\Util::DEBUG, 'Get display name for ' . $uid);
        return $uid;
    }

    public function getDisplayNames($search = '', $limit = null, $offset = null)
    {
        $this->loggingService->write(\OCP\Util::DEBUG, 'Get display names for query ' . $search);
        return $this->getUsers($search, $limit, $offset);
    }

    public function userExists($uid) {
        $this->loggingService->write(\OCP\Util::DEBUG, 'Checking uses exists ' . $uid);

        $users = $this->getUsers($uid, null, null);
        if (count($users) == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get a list of all users
     *
     * @param string $search
     * @param null|int $limit
     * @param null|int $offset
     * @return string[] an array of all uids
     */
    public function getUsers($search = '', $limit = null, $offset = null)
    {
        $this->loggingService->write(\OCP\Util::DEBUG, 'Get users for query ' . $search);

        $realm = $this->settingsService->getAiravataRealm();
        $client = new Client([
            'base_uri' => $this->settingsService->getAiravataKeycloakUrl(),
            'timeout'  => 2.0,
            'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ),
        ]);

        try {
            $token_response = $client->request('POST', '/auth/realms/master/protocol/openid-connect/token', [
                'form_params' => [
                    'username' => $this->settingsService->getAiravataKeycloakSuperUsername(),
                    'password' => $this->settingsService->getAiravataKeycloakSuperUserPassword(),
                    'grant_type' => $this->settingsService->getAiravataKeycloakAuthGranttype(),
                    'client_id' => $this->settingsService->getAiravataKeycloakClientId()
                ]
            ]);
        } catch (GuzzleException $e) {
            $this->loggingService->write(\OCP\Util::ERROR, 'Failed to fetch token' . $e);
        }

        $parsedToken = (array)json_decode($token_response->getBody());

        $access_token = $parsedToken['access_token'];

        try {
            $users_response = $client->request('GET', '/auth/admin/realms/' . $realm . '/users', [
                'query' => ['search' => $search],
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token,
                ]
            ]);
        } catch (GuzzleException $e) {
            $this->loggingService->write(\OCP\Util::ERROR, 'Failed to fetch users' . $e);

        }

        $userIds = [];
        $user_list = json_decode($users_response->getBody(), true);
        foreach ($user_list as $user_obj) {
            array_push($userIds, $user_obj['username']);
        }

        return $userIds;
    }

    /**
     * @param string $uid
     * @param string $password
     * @return string|bool The users UID or false
     */
    public function checkPassword($uid, $password)
    {

        $this->loggingService->write(\OCP\Util::INFO, 'Checking password for Airavata user ' . $uid);

        $realm = $this->settingsService->getAiravataRealm();
        $client = new Client([
            'base_uri' => $this->settingsService->getAiravataKeycloakUrl(),
            'timeout'  => 2.0,
            'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ),
        ]);

        $token_response = $client->request('POST', '/auth/realms/' . $realm . '/protocol/openid-connect/token',[
            'form_params' => [
                'username' => $uid,
                'password' => $password,
                'grant_type' => $this->settingsService->getAiravataKeycloakAuthGranttype(),
                'client_id' => $this->settingsService->getAiravataKeycloakClientId()
            ]
        ]);

        if ($token_response->getStatusCode() === 200) {
            return $uid;
        } else {
            return FALSE;
        }
    }
}