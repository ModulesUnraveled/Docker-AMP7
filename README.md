### Requirements
**Docker:**
* [Mac](https://docs.docker.com/docker-for-mac/install/)
* [Windows](https://docs.docker.com/docker-for-windows/install/)
* [Linux](https://docs.docker.com/engine/installation/linux/)

**Docker Compose:**
* Mac - Comes with the installation above
* Windows - Comes with the installation above
* [Linux](https://docs.docker.com/engine/installation/linux/)

**Composer**
* [Download](https://getcomposer.org/download/)

### To Install Drupal 8 and Run it in this Docker Template
1. Create a new Drupal 8 site
  * `composer create-project drupal-composer/drupal-project:8.x-dev --stability dev --no-interaction --no-install some-dir`
  * `cd some-dir`
2. Clone this repo into your project, and move the pieces into place
  * `git clone git@github.com:ModulesUnraveled/Docker-AMP7.git && mv Docker-AMP7/.docker/ . && mv Docker-AMP7/docker-compose.yaml . && rm -Rf Docker-AMP7`
3. Install project dependencies (you can proceed to the next step in a new terminal window while this is working)
  * `composer install`
4. Build the Docker containers (you can also proceed to the next step in a new terminal window while this is working)
  * `docker-compose up -d --build --remove-orphans`
5. Add the local domain to your `/etc/hosts` file
  * `sudo vi /etc/hosts`
  * Add `127.0.0.1 yoursite.local`
6. One steps 3 and 4 complete, navigate to [the homepage](http://yoursite.local)

### Commands you should know
#### How to run Drush commands in your Docker container
`docker-compose exec web <command>`
e.g. `docker-compose exec web drush status`

##### Shell script
You can make this into a simple command
* Install the included drush script
  * `cd .docker/scripts`
  * `sudo install ddrush /usr/local/bin`

##### How to use the shell script
Once this is done, you can simply type `ddrush status` (or any other drush command) from inside the project, and it'll pass the command into the container.
