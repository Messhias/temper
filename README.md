# Read before start (don't skip it!!).

Before you start the project, download and start contributing it's nice to you read this first guidelines and whole README.md file to assure that you have all the necessary set up to work with it and don't waste your time openning issues tickets (since for now I'm only the maintainer so you could have a significally delay in the answer).

Bellow you'll found 

- [Linux environment](https://www.linux.org/) (recommend), if you choose windows maybe you'll have a bad time to install the PHP Extensions.
- [Docker](https://www.docker.com/) (recommend), same reason as peer Linux Env..
- [PHP latest version, 7.4+](https://www.php.net/) (MANDATORY), this project uses the latest features of PHP and the 7.4 is already stable and released, so please 
if you're considering using previously versions of PHP is under you responsability to downgrade and set up the project.
- [MySQL latest version](https://www.mysql.com/) (optional), as peer now the project isn't using the database, but if you choose go trough docker containers the MySQL with the latest version it'll added on the project, it's optional but I recommend it.
- [Yarn](https://yarnpkg.com/lang/en/) (recommend) or [NPM](https://www.npmjs.com/), there's a topic explaining the reason of Yarn..
- [Node](https://nodejs.org/en/), if you want to develop and compile the assests you need the Yarn or NPM, and both of them requires have node, so installing one of them (or both) automtically you'll have to install the Node.

## Running by the easiest way (Docker)

Just type ```docker-compose up -d --build``` to build all the containers 
in *detach* mode, but if you want to see the logs on your terminal you can type 
``docker-compose up --build``, you don't need to pass ```--build``` tag on the command
but I strong recommend to you to do that 
to always work with the latest version and most stable version of the technologies 
related on the repository.

If you want to change any configuration about how you containers it'll gonna work you can 
check the file [docker-compose.yml](./docker-compose.yml).

If you want to change the PHP container to add, change the version (what I doesn't recommend)
you can go to the [Dockerfile](./docker/php/Dockerfile).

If you web service is returning 503 or 502 for some reason 
as status code in http://localhost maybe you have a image 
conflicting with the attached port or network, so I suggest to you 
run ```docker ps``` to check which running containers 
you're running at moment and 
check which container is attached to a web port in 80 and 443 and stop 
it and remove the network attached on it.

1 - Tip

Sometimes the docker machine could have issues with your current containers and networks. 
This is normal when you have a lot containers running at the same time using the same
network interface sharing between them.

 
If you have any database volumes I suggest to you backup them (if you not set up 
your volumes locally) and remove all the conflicting containers based on their container
ID which you can get by ``docker ps``.

But if you want remove all without picking anything specific you can run the command:

```docker system prune -a``` amd choose the option `Y`.

2 - Tip – composer issue.

If you having issues when run ``docker-compose run --rm composer composer install | update 
| require`` commands because of the latest versions of composer just run the command 
``docker-compose run --rm composer composer <command> -vvv``.

## For those don't want docker approach

Even for those choose go trough the [Docker](https://docker.com) approach this packages it'll be installed, but it'll be automatically by the Dockerfile especifications and configured automatically for you.

So again I would like to recommend to go trough Docker approach, it's tested and it'll work in any kind of computer since it's supported to run the Docker.

You need install this packages:
- [PHP 7.4](php.net) and the 
[MySQL (optional, latest preferaly)](https://www.mysql.com/).
- [Yarn](https://yarnpkg.com/lang/en/) and the 
[Node](https://nodejs.org/en/).

You OS need those libraries available to run the PHP:
- libfreetype6-dev
- libjpeg62-turbo-dev
- libmcrypt-dev
- libpng-dev
- zlib1g-dev
- libxml2-dev
- libzip-dev
- libonig-dev
- graphviz
- zip
- unixodbc
- unixodbc-dev
- libgss3
- odbcinst
- locales

All the installation of this libraries you need to research and figure by your own 
depending by your operational system.

The PHP extensions need to be available and enabled:
- pdo_mysql
- gd
- mysqli
- zip 
- opcache

After install all the libraries, software necessary and enable the PHP extensions you 
 need to set up each dependencies of applications.

## Laravel


Navigate by terminal to the folder [root](./).

Once you inside the folder you need copy the [.env.example](.env.example) file 
to a **.env** and change the configurations that suits your manual configurations. 
If you're in a unix like environment you can just type ``cp .env.example .env``.

Also you need generate a key for the app as it is mandatory for Laravel framework. 
You could done that running the command ``docker-compose run --rm php php artisan key:generate`` (for those which choose the
docker approach) or ``php artisan key:generate``.

If you want to know how to configure .env files to work with the framework properly
please visit the [Laravel](https://laravel.com/).

Ok, after configure all the necessary needs to framework you need to following 
commands:

- ```composer install``` to install all the composer dependencies, if you still have 
issues to install you can try to force install running by ``composer instal --ignore-platform-reqs``
this command it'll install all libraries without checking your system requirements.

After running the above commands folder you need to 
install the  application, don't forgot you need to 
install all the requirements you need to run the command:

- Run ``yarn install``.
- After previously command run ``yarn start``.
- Open a new tab and type [http//localhost](http://localhost).
- If you want to check the browser sync options you could found the address of it on your terminal. 
Usually it's [http://localhost:3000](http://localhost:3000), but if you port 3000 is being used by some 
application the browser-sync it'll address in another port, so check always your terminal to get the accurate address. 

## Why yarn instead NPM?

Fast, reliable and secure dependency management - this is the promise of Yarn, 
the new dependency manager created by the engineers of Facebook.

### Installing Yarn
There are several ways of installing Yarn. If you have npm 
installed, you can just install Yarn with npm:

```npm install yarn --global```

However, the recommended way by the Yarn team is to install it 
via your native OS package manager 
if you are on a Mac, probably it will be brew:

```brew update```

```brew install yarn```

Yarn has a lot of performance and security improvements. 

Offline cache
When you install a package using Yarn (using ``yarn add <packagename>``), 
it places the package on your disk. 
During the next install, this package will be used instead of 
sending an HTTP request to get the tarball from the registry.

Your cached module will be put into ~/.yarn-cache, 
and will be prefixed with the registry name, and post fixed with the modules version.

This means that if you install the X.X.X version of express with Yarn, 
it will be put into ~/.yarn-cache/npm-express-X.X.X.

Deterministic Installs
Yarn uses lockfiles (yarn.lock) and a deterministic install algorithm. 
We can say goodbye to the "but it works on my machine" bugs. 
And this is the best feature that we 
have on yarn so far.
Yarn comes with a handy license checker, which can become really powerful 
in case you have to check the licenses of all the modules you depend on.

Anyway you can use ``npm install `` command, but as per current date
the npm packages I still facing issues of compatibility about "in my machine works".

Use yarn and work in everywhere without headache (like [Docker](https://docker.com)). 

## I still want to use npm?


Well, you need change all the **yarn**  references in [package.json](./package.json) and 
it's done.

## Running unit tests

If you going trough the docker containers to run this application 
it's very easy to run all the application unit tests.

Go to the root of the application and type the command: 

``docker-compose run --rm php ./vendor/bin/phpunit``

If **you aren't doing by docker approach** you need first
certify that you're using PHP 7.4 version at least since the 
project use latest version and arrow functions and another features of
PHP 7.4.

If you're using previously versions of PHP all the test and project
it'll fail. 

# Result screenshot

The project it'll result the result bellow:

![Result image](./result.png)

# Having troubles / bad time?

[Open a issue](https://github.com/Messhias/temper/issues/new)

# Author

[Fabio William Conceição](https://github.com/messhias)
