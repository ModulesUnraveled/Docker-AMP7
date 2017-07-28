<?php

// This is an example file that demonstrates how you can use Drush aliases inside your docker container.
// Initially these aliases were copied from the alias file that Pantheon provides.

// Local
$aliases["ithaca-www.loc"] = array (
  'uri' => 'ithaca-www.local', // You'll be able to type this into your browser
  'root' => '/var/www/drupal/web', // This is the web root inside the container
  '#dev' => '@ithaca-www.dev', // These three lines are useful if using  drush shell-aliases like the ones here: https://github.com/ModulesUnraveled/Drush-Shell-Aliases
  '#test' => '@ithaca-www.test',
  '#live' => '@ithaca-www.live',
);

// The following were coppied from pantheon.aliases.drushrc.php, but the alias names have been re-defined

// Dev
$aliases['ithaca-www.dev'] = array(
  'uri' => 'dev-ithaca-www.pantheonsite.io',
  'db-url' => 'mysql://pantheon:<hash>@dbserver.dev.<hash>.drush.in:18065/pantheon',
  'db-allows-remote' => TRUE,
  'remote-host' => 'appserver.dev.<hash>.drush.in',
  'remote-user' => 'dev.<hash>',
  'ssh-options' => '-p 2222 -o "AddressFamily inet"',
  'path-aliases' => array(
    '%files' => 'code/sites/default/files',
    '%drush-script' => 'drush',
   ),
);

// Test
$aliases['ithaca-www.test'] = array(
  'uri' => 'test-ithaca-www.pantheonsite.io',
  'db-url' => 'mysql://pantheon:<hash>@dbserver.test.<hash>.drush.in:16094/pantheon',
  'db-allows-remote' => TRUE,
  'remote-host' => 'appserver.test.<hash>.drush.in',
  'remote-user' => 'test.<hash>',
  'ssh-options' => '-p 2222 -o "AddressFamily inet"',
  'path-aliases' => array(
    '%files' => 'code/sites/default/files',
    '%drush-script' => 'drush',
   ),
);

// Live
$aliases['ithaca-www.live'] = array(
  'uri' => 'live-ithaca-www.pantheonsite.io',
  'db-url' => 'mysql://pantheon:<hash>@dbserver.live.<hash>.drush.in:15306/pantheon',
  'db-allows-remote' => TRUE,
  'remote-host' => 'appserver.live.<hash>.drush.in',
  'remote-user' => 'live.<hash>',
  'ssh-options' => '-p 2222 -o "AddressFamily inet"',
  'path-aliases' => array(
    '%files' => 'code/sites/default/files',
    '%drush-script' => 'drush',
   ),
);
