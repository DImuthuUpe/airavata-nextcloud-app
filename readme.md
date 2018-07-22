# Airavata NextCloud App

## Description

Airavata NextCloud App provides ability to seamlessly integrate Apache Airavata userbase into NextCloud and authenticate
Airavata users into NextCloud through Airavata credentials. In addition to that it provides the ability to share files
among Airavata users and groups both through Web interface and APIs. 

## Supported Distributions

NextCloud 13.0.0 - 13.0.4

OwnCloud 10.0.0 - 10.0.8

## Installation guide

* Build the app through composer

    `php composer.phar install`

* Copy the whole app directory to NextCloud app directory

* Login to NextCloud as an Admin user and go to Apps window and in Disabled Apps tab, you can see "Airavata user and group backend" app

    ![Alt text](/screenshots/apps.png)
        
    ![Alt text](/screenshots/disabled-apps.png)
    

* Click Enable

* Now it should be listed in Enabled apps section

    ![Alt text](/screenshots/enabled-apps.png)

* To configure the App, go to, Setting -> Security section. At the bottom of the page there is a form to fill about Airavata
deployment. 

    * **Airavata API Server URL** : Api Server endpoint of Airavata deployment

    * **Airavata Keycloak URL** : Keycloak Identity manager URL. Airavata uses Keycloak as the Identity manager and user store

    * **Airavata realm (Gateway id)** : Gateway Id. One Nextcloud deployment can be used for one gateway

    * **Airavata Keycloak super user name** : Keycloak master user id

    * **Airavata Keycloak super user password** : Keycloak master user password

    * **Airavata Keycloak auth grant type** : Defaults to 'password'

    * **Airavata Keycloak client id** : Defaults to 'admin-cli'
    
    ![Alt text](/screenshots/settings.png)

* Click Save

## Verification

* To verify whether App is properly configured, go to Users window and it should show all the Users and Groups that are currently 
registered in Airavata.

    ![Alt text](/screenshots/users.png)
    
* Logout from Admin and try to Login as an Airavata user

* Share  files among users and groups to verify the sharing feature

## WebDAV API

Airavata users can use NextCloud WebDAV API to access their files using their Airavata credentials. Example WebDAV invocation
through curl to list all the files in user directory is as below

`curl -u '<Airavata User>:<Password>' 'http://<NextCloud Endpoint>/remote.php/dav/files/<Airavata User>' -X PROPFIND --data '<?xml version="1.0" encoding="UTF-8"?>
 <d:propfind xmlns:d="DAV:">
   <d:prop xmlns:oc="http://owncloud.org/ns">
     <d:getlastmodified/>
     <d:getcontentlength/>
     <d:getcontenttype/>
     <oc:permissions/>
     <d:resourcetype/>
     <d:getetag/>
   </d:prop>
 </d:propfind>'`