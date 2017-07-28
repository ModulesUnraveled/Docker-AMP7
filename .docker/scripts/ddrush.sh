#!/bin/sh
docker-compose exec web drush $@

# You can install this "ddrush" script to "/usr/local/bin" by typing the following into your terminal:
# sudo install .docker/scripts/ddrush /usr/local/bin
#
# Once this is done, you can simply type `ddrush status` (or any other drush command) from inside the project, and it'll pass the command into the container.
