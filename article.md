The first thing you'll want to do is head over to Linode's Cloud Dashboard and create a MongoDB Managed Database Cluster. It should be noted that as of the last commit to this repository, the MongoDB clusters are considered "beta" software.

Click the large, blue "Create" button at the top of the Cloud Dashboard and select "Database". From here, give your cluster a label and choose which version of MongoDB you want to use in the "Database Engine" field, then choose a region for your database to live in.

You'll then want to select a plan. I chose the Dedicated 4GB plan and choose the number of nodes you want to have in your cluster.

Finally, you'll need to authorize any IP addresses that you wish to be able to access this cluster. In my case as this is a simple tutorial, I am running all my PHP code on my development server, so I need to add my home IP address to the allowed list.

Now you can click "Create Database Cluster" and give it about a half hour to fully provision.

While you're waiting, head over this GitHub repo to follow along. Keep in mind that this isn't how I like to code PHP. This is a quick-and-dirty implementation that's not following coding best practices to illustrate Linode's Managed MongoDB cluster.

If you're not familiar with remote MongoDB instances, one stumbling block you might encounter is authentication. In our case, our cluster is using username and password authentication as well as self-signed SSL encryption.

We need to set up our development environment. We'll want the PHP driver for MongoDB. It should be in your package manager. On Ubuntu, the package is called `php-mongodb` or `phpX.X-mongodb` (where X.X is your mongo version number).

Once you have the appropriate package installed and configured, you should restart your web or php server and check that it's enabled.

```sh
$ php --info | grep mongodb
```

If you don't have composer installed, you'll want to get that as well. Head over to [GetComposer.org](https://getcomposer.org) to download the latest version for your system. (Or on Ubuntu, you can use `sudo apt install composer`).

Next we should clone [this Git repo](https://github.com/heavyelement/php-mongo) and configure your web server to serve it. 

> Configuring your web server is going to vary depending on your setup and is outside the scope of this tutorial.

Now, let's `cd` into the Git repo you downloaded and run the command:

```sh
composer require mongodb/mongodb
```

We should now have the dependencies we need to run this tutorial.

By now, your cluster should be just about done provisioning.

So let's inspect this code and we can start with `env.php`. 

Here, we're going to write our boilerplate code. The stuff we would otherwise copy and paste between files. Note on line 7, see how we're `require`-ing `vendor/autoload.php`? That's important as we're importing the MongoDB files we just downloaded with Composer.

On lines 10 through 14 we're establishing our host values. You can find in the appropriate values in the Cloud Dashboard. 

Of note here is the `$ssl_file` variable. It's the path to the certificate that you need to download from the Dashboard.

Note that where this file is located in the Git repo is **EXTREMELY DANGEROUS**. Seeing as anyone who visits https://yourdemosite.com/cert.crt would then have your private certificate. Again, this repo is for demonstration purposes and is not production code.

Then we have the `$client` instantiation on line 17. This should be self-explanatory at this point. We're providing all our credentials in order to access the database cluster. If you don't include the `sslAllowInvalidCertificates` key, then you're going to encounter issues.

Finally, we have the `$collection` variable on line 25. Here, we're selecting the database (tickets) and the collection (current) that we want to use.

The $collection object has several methods that can be used to create, read, update, and destroy information in the database. As you look through `insert.php`, `read.php`, `update.php`, and `delete.php`, you'll find instances of these methods being called from the `$collection` object as well as some error handling.

There's excellent and comprehensive documentation for these methods as well as their optional parameters [here](https://www.mongodb.com/docs/php-library/current/tutorial/crud/).

So now, I offer you a challenge. Create a new file: `ticket.php`. It should expect a single [query paramter](https://www.php.net/manual/en/reserved.variables.get.php) (`id`), use that parameter to *find* the *one* document in the database which matches that Mongo _id, then and display it.

Bonus points if you modify read.php so that each entry's `id` becomes a link to `ticket.php` and loads the appropriate document.
