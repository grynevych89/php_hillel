<?php

require __DIR__ . '/utils/constants.php';
require __DIR__ . '/utils/functions.php';
require __DIR__ . '/database/Connector.php';
require __DIR__ . '/database/SQLQueryBuilder.php';
require __DIR__ . '/database/MySQLQueryBuilder.php';
require __DIR__ . '/database/Repository.php';
require __DIR__ . '/database/UserRepository.php';
require __DIR__ . '/database/ProjectRepository.php';
require __DIR__ . '/database/RoleRepository.php';

$connector = Connector::getInstance();
$builder = new MySQLQueryBuilder();
//
$userRepository = new UserRepository($connector, $builder);
$projectRepository = new ProjectRepository($connector, $builder);
$roleRepository = new RoleRepository($connector, $builder);

try {
    $userRepository->insert(
        ['email', 'name', 'age', 'password', 'gender'],
        ['grynevych89@gmail.com', 'nick', 35, 'password1234', 'male']
    );
    $userRepository->update(2, ['project_id' => 1, 'role_id' => 3]);
    print_r($userRepository->findById(2));
    print_r(
        $userRepository->findOneWithPopulate(
            1,
            ['users.id', 'users.name', 'projects.project_name', 'roles.role_name']
        )
    );
    print_r(
        $userRepository->findOneWithPopulate(
        1,
        ['projects.id', 'projects.project_name', 'users.name']
    )
    );
    print_r($roleRepository->find());
} catch (Exception $error) {
    echo $error->getMessage();

}


