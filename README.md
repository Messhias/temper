# Requirements

- [Linux environment](https://www.linux.org/).
- [Docker](https://www.docker.com/).
- [PHP latest version](https://www.php.net/).
- [MySQL latest version](https://www.mysql.com/).
- [Yarn](https://yarnpkg.com/lang/en/) (recommend) or [NPM](https://www.npmjs.com/).
- [Node](https://nodejs.org/en/).


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

## For those don't want docker approach

You need install this packages:
- [PHP 7.4](php.net) and the 
[MySQL (latest preferaly)](https://www.mysql.com/).
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

First let's start by backend.


Navigate by terminal to the folder [root](./).

Once you inside the folder you need copy the [.env.example](.env.example) file 
to a **.env** and change the configurations that suits your manual configurations. 
If you're in a unix like environment you can just type ``cp .env.example .env``

If you want to know how to configure .env files to work with the framework properly
please visit the [Laravel](https://laravel.com/).

Ok, after configure all the necessary needs to framework you need to following 
commands:

- ```composer install``` to install all the composer dependencies, if you still have 
issues to install you can try to force install running by ``composer instal --ignore-platform-reqs``
this command it'll install all libraries without checking your system requirements.

- ```php artisan migrate --seed``` you need.   

After running the above commands folder you need to 
install the  application, don't forgot you need to 
install all the requirements you need to run the command:

- Run ``yarn install``.
- After previously command run ``yarn start``.
- Open a new tab and type [http//localhost:3000](http://localhost:3000).

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


# Having troubles / bad time?

[Open a issue](https://github.com/Messhias/temper/issues/new)

# Author

[Fabio William Conceição](https://github.com/messhias)
