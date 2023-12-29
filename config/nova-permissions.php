<?php

return [
    /*
    |--------------------------------------------------------------------------
    | User model class
    |--------------------------------------------------------------------------
    */

    'user_model' => 'App\Models\User',

    /*
    |--------------------------------------------------------------------------
    | Nova User resource tool class
    |--------------------------------------------------------------------------
    */

    'user_resource' => 'App\Nova\User',

    /*
    |--------------------------------------------------------------------------
    | The group associated with the resource
    |--------------------------------------------------------------------------
    */

    'role_resource_group' => 'Accounts',

    /*
    |--------------------------------------------------------------------------
    | Database table names
    |--------------------------------------------------------------------------
    | When using the "HasRoles" trait from this package, we need to know which
    | table should be used to retrieve your roles. We have chosen a basic
    | default value but you may easily change it to any table you like.
    */

    'table_names' => [
        'roles' => 'roles',

        'role_permission' => 'role_permission',

        'role_user' => 'role_user',

        'users' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Permissions
    |--------------------------------------------------------------------------
    */

    'permissions' => [
        // User

        'navigate user' => [
            'display_name' => 'Show navigation menu item',
            'description'  => 'Show navigation menu item',
            'group'        => 'User',
        ],

        'view user' => [
            'display_name' => 'View any user account',
            'description'  => 'Can view any user account',
            'group'        => 'User',
        ],

        'create user' => [
            'display_name' => 'Create a new user account',
            'description'  => 'Can create a new user account',
            'group'        => 'User',
        ],

        'edit user' => [
            'display_name' => 'Edit any user account',
            'description'  => 'Can edit any user account',
            'group'        => 'User',
        ],

        'delete user' => [
            'display_name' => 'Delete any user account',
            'description'  => 'Can delete any user account',
            'group'        => 'User',
        ],

        // Role

        'view role' => [
            'display_name' => 'View any role',
            'description'  => 'Can view any role',
            'group'        => 'Role',
        ],

        'create role' => [
            'display_name' => 'Create a new role',
            'description'  => 'Can create a new role',
            'group'        => 'Role',
        ],

        'edit role' => [
            'display_name' => 'Edit any role',
            'description'  => 'Can edit any role',
            'group'        => 'Role',
        ],

        'delete role' => [
            'display_name' => 'Delete any role',
            'description'  => 'Can delete any role',
            'group'        => 'Role',
        ],
    ],
];
