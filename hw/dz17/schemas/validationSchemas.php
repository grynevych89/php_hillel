<?php

const AUTH_VALIDATION_SCHEMA = [
    'email' => 'string|email|required',
    'password' => 'string|password|required'
];

const ID_VALIDATION_SCHEMA = [
    'id' => 'int|required'
];

const USER_VALIDATION_SCHEMA = [
    'name' => 'string|min:2|max:10',
    'email' => 'string|email',
    'password' => 'string|password',
];