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

script('airavata-nextcloud-app', 'settings');
style('airavata-next-cloud-app', 'settings');

?>

<form id="airavaraSettingsForm" class='section' method="post">
    <h2><?php echo 'Airavata Authentication backend'; ?></h2>

<div id="airavataSettings" class="personalblock">
    <ul>
        <li><a href="#airavataSetting-1"><?php echo 'Airavata Settings'; ?></a></li>
    </ul>
    <fieldset id="airavataSetting-1">
        <p><label for="airavata_apiserver_url"><?php p($l->t('Airavata API Server URL')); ?></label><input
                id="airavata_apiserver_url"
                name="airavata_apiserver_url"
                value="<?php p($_['airavata_apiserver_url']); ?>"/>
        </p>
        <p>
            <label for="airavata_keycloak_url"><?php p($l->t('Airavata Keycloak URL')); ?></label><input
                id="airavata_keycloak_url"
                name="airavata_keycloak_url"
                value="<?php p($_['airavata_keycloak_url']); ?>"/>
        </p>
        <p><label for="airavata_realm"><?php p($l->t('Airavata realm (Gateway id)')); ?></label><input
                id="airavata_realm"
                name="airavata_realm"
                value="<?php p($_['airavata_realm']); ?>"/>
        </p>
        <p><label for="airavata_keycloak_superuser_name"><?php p($l->t('Airavata Keycloak super user name')); ?></label><input
                id="airavata_keycloak_superuser_name"
                name="airavata_keycloak_superuser_name"
                value="<?php p($_['airavata_keycloak_superuser_name']); ?>"/>
        </p>
        <p><label for="airavata_keycloak_superuser_password"><?php p($l->t('Airavata Keycloak super user password')); ?></label><input
                id="airavata_keycloak_superuser_password"
                name="airavata_keycloak_superuser_password"
                type="password"
                value="<?php p($_['airavata_keycloak_superuser_password']); ?>"/>
        </p>
        <p><label for="airavata_keycloak_auth_granttype"><?php p($l->t('Airavata Keycloak auth grant type')); ?></label><input
                id="airavata_keycloak_auth_granttype"
                name="airavata_keycloak_auth_granttype"
                value="<?php p($_['airavata_keycloak_auth_granttype']); ?>"/>
        </p>
        <p><label for="airavata_keycloak_client_id"><?php p($l->t('Airavata Keycloak client id')); ?></label><input
                id="airavata_keycloak_client_id"
                name="airavata_keycloak_client_id"
                value="<?php p($_['airavata_keycloak_client_id']); ?>"/>
        </p>
    </fieldset>
    <input type="hidden" value="<?php p($_['requesttoken']); ?>" name="requesttoken"/>
    <input id="airavataSettingsSubmit" type="submit" value="<?php p($l->t('Save')); ?>"/>
</div>
</form>

