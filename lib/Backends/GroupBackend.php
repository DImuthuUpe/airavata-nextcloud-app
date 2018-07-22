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

use OC\Group\Database;

class GroupBackend extends Database
{

    /**
     * Try to create a new group
     * @param string $gid The name of the group to create
     * @return bool
     *
     * Tries to create a new group. If the group name already exists, false will
     * be returned.
     */
    public function createGroup($gid): bool {
        return true;
    }

    /**
     * delete a group
     * @param string $gid gid of the group to delete
     * @return bool
     *
     * Deletes a group and removes it from the group_user-table
     */
    public function deleteGroup($gid): bool {
        return true;
    }

    /**
     * is user in group?
     * @param string $uid uid of the user
     * @param string $gid gid of the group
     * @return bool
     *
     * Checks whether the user is member of a group or not.
     */
    public function inGroup($uid, $gid ) {
        return true;
    }

    /**
     * Add a user to a group
     * @param string $uid Name of the user to add to group
     * @param string $gid Name of the group in which add the user
     * @return bool
     *
     * Adds a user to a group.
     */
    public function addToGroup($uid, $gid): bool {
        return true;
    }

    /**
     * Removes a user from a group
     * @param string $uid Name of the user to remove from group
     * @param string $gid Name of the group from which remove the user
     * @return bool
     *
     * removes the user from a group.
     */
    public function removeFromGroup($uid, $gid): bool {
        return true;
    }


    /**
     * Get all groups a user belongs to
     * @param string $uid Name of the user
     * @return array an array of group names
     *
     * This function fetches all groups a user belongs to. It does not check
     * if the user exists at all.
     */
    public function getUserGroups( $uid ) {
        return array('group1', 'group2');
    }


    /**
     * get a list of all groups
     * @param string $search
     * @param int $limit
     * @param int $offset
     * @return array an array of group names
     *
     * Returns a list with all groups
     */
    public function getGroups($search = '', $limit = null, $offset = null) {
        return array('group1', 'group2');
    }

    /**
     * check if a group exists
     * @param string $gid
     * @return bool
     */
    public function groupExists($gid) {
        return true;
    }

    /**
     * get a list of all users in a group
     * @param string $gid
     * @param string $search
     * @param int $limit
     * @param int $offset
     * @return array an array of user ids
     */
    public function usersInGroup($gid, $search = '', $limit = null, $offset = null) {
        return array();
    }

    /**
     * get the number of all users matching the search string in a group
     * @param string $gid
     * @param string $search
     * @return int
     */
    public function countUsersInGroup($gid, $search = ''): int {
        return 0;
    }

    /**
     * get the number of disabled users in a group
     *
     * @param string $search
     * @return int|bool
     */
    public function countDisabledInGroup($gid): int {
        return 0;
    }
}