<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'Signup Carrot');

// Project repository
set('repository', 'git@github.com:alexroan/TheCarrot.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', [
    'public/popups/carrots/generated'
]);

// Writable dirs by web server 
add('writable_dirs', [
    'public/popups/carrots',
    'public/popups/carrots/generated'
]);


// Hosts

host('178.128.168.224')
    ->user('deployer')
    ->identityFile('~/.ssh/deployerkey')
    ->set('deploy_path', '/var/www/signupcarrot.com');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

