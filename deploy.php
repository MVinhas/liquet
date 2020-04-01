<?php
namespace Deployer;

require 'recipe/common.php';

// Send statistics to Deployer
set('allow_anonymous_stats', true);

// Project name
set('application', 'Seamus');

// Project repository
set('repository', 'git@github.com:MVinhas/Seamus.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', []);


// Hosts

host('personal')
    ->set('deploy_path', '~/projetos/{{application}}');    
    

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Branch to deploy
set('branch', 'master');
