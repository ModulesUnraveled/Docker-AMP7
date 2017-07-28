## Requirements
**Docker:**
* [Mac](https://docs.docker.com/docker-for-mac/install/)
* [Windows](https://docs.docker.com/docker-for-windows/install/)
* [Linux](https://docs.docker.com/engine/installation/linux/)

**Docker Compose:**
* Mac and Windows - Comes with the installation above
* [Linux](https://docs.docker.com/engine/installation/linux/)

**Composer**
* [Download](https://getcomposer.org/download/)

## To Install Drupal 8 and Run it in this Docker Template
1. Create a new Drupal 8 site
  * `composer create-project drupal-composer/drupal-project:8.x-dev --stability dev --no-interaction --no-install project_name`
  * `cd project_name`
2. Clone this repo into your project, and move the pieces into place
  * `git clone git@github.com:ModulesUnraveled/Docker-AMP7.git && mv Docker-AMP7/.docker/ . && mv Docker-AMP7/docker-compose.yaml . && rm -Rf Docker-AMP7`
3. Add the local domain to your `/etc/hosts` file
  * `sudo vi /etc/hosts`
  * Add `127.0.0.1 yoursite.local`
4. Allow docker to use your ssh key to connect to the remote host by copying your ssh key into the `.docker/sshkeys` directory. (Everything in the sshkeys folder is gitignored.)
  * `cp ~/.ssh/<project>/id_rsa ./.docker/sshkeys/id_rsa && cp ~/.ssh/<project>/id_rsa.pub ./.docker/sshkeys/id_rsa` (if you created a new ssh key for this project - Recommended. Details below.)
  * `cp ~/.ssh/id_rsa ./.docker/sshkeys/id_rsa && cp ~/.ssh/id_rsa.pub ./.docker/sshkeys/id_rsa` (if you're reusing your host machine's key - Not recommended)
5. Build the Docker containers (you can also proceed to the next step in a new terminal window while this is working)
  * `docker-compose up -d --build --remove-orphans`
6. Install project dependencies (you can proceed to the next step in a new terminal window while this is working)
  * `composer install`
7. One steps 5 and 6 complete, navigate to [the homepage](http://yoursite.local)

## Create an SSH key for this project
You can re-use your existing SSH Key in your container, but for security, it is best-practice to create a new one, specifically for this project. Pantheon has [documentation on generating and adding ssh keys to their platform](https://pantheon.io/docs/ssh-keys/), but here are the basics:
* Create a new key with ssh-keygen
  * `mkdir ~/.ssh/<project> && ssh-keygen -f ~/.ssh/<project>/id_rsa -t rsa -b 4096 -C "your_email@domain.com"`
  * Enter a passphrase for this ssh key (Each time you rebuild your docker containers you will have to enter this passphrase the first time you login to the docker container, or use an ssh command such as `sql-sync`.)
  * Enter the same passphrase again
* Upload it to Pantheon
  * Copy the key to your clipboard `pbcopy < ~/.ssh/<project>/id_rsa.pub`
  * Log in to Pantheon, go to the "Account" page, click SSH Keys, paste your key in the field, and click "Add Key".

## Commands you should know
### How to run Drush commands in your Docker container
`docker-compose exec web <command>`
e.g. `docker-compose exec web drush status`

#### ddrush script
You can make this into a simple command by installing the "ddrush" script provided to "/usr/local/bin"
  * `sudo install .docker/scripts/ddrush /usr/local/bin`

Once this is done, you can simply type `ddrush status` (or any other drush command) from inside the project, and it'll pass the command into the container.
