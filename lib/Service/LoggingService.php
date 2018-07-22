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
use \OCP\ILogger;

/**
 * Class LoggingService
 *
 * @package OCA\Airavata\Service
 *
 * @author Felix Rupp <kontakt@felixrupp.com>
 * @copyright Felix Rupp <kontakt@felixrupp.com>
 *
 * @since 1.5.0
 */
class LoggingService
{
    private $appName;

    private $logger;

    public function __construct($appName, ILogger $logger)
    {

        $this->appName = $appName;
        $this->logger = $logger;
    }

    /**
     * @param mixed $level
     * @param string $message
     */
    public function write($level, $message) {
        $this->logger->log($level, $message, ['app' => $this->appName]);
    }
}