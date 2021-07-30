# Doctrine Error Demo

## Setup
```bash
docker-compose up -d
docker-compose exec php ./bin/console app:setup
```

## Run the example
```bash
docker-compose exec php ./bin/console app:run -vvv
```

And you'll get...

```
[debug] MongoDB command: {"find":"Order","filter":{"_id":{"$oid":"610419a277d50f7609139543"}},"limit":1,"$db":"symfony"}

[debug] MongoDB command: {"find":"Customer","filter":{},"$db":"symfony"}

[critical] Error thrown while running command "app:run -vvv". Message: "Cannot access uninitialized non-nullable property App\Docum
ent\Customer::$domainEvents by reference"

[debug] Command "app:run -vvv" exited with code "1"


In MongoDBODMProxies__PM__AppDocumentCustomerGeneratede8b9bddc036f0175c9176441a5a7a888.php line 155:
                                                                                                       
  [Error]                                                                                              
  Cannot access uninitialized non-nullable property App\Document\Customer::$domainEvents by reference  
                                                                                                       

Exception trace:
  at /app/var/cache/dev/doctrine/odm/mongodb/Proxies/MongoDBODMProxies__PM__AppDocumentCustomerGeneratede8b9bddc036f0175c9176441a5a
7a888.php:155
 App\Document\Customer::MongoDBODMProxies\__PM__\App\Document\Customer\{closure}() at /app/var/cache/dev/doctrine/odm/mongodb/Proxi
es/MongoDBODMProxies__PM__AppDocumentCustomerGeneratede8b9bddc036f0175c9176441a5a7a888.php:158
 MongoDBODMProxies\__PM__\App\Document\Customer\Generatede8b9bddc036f0175c9176441a5a7a888->__get() at /app/src/Document/Customer.ph
p:34
 App\Document\Customer->doSomeUpdate() at /app/src/Command/RunTestCommand.php:42
 App\Command\RunTestCommand->execute() at /app/vendor/symfony/console/Command/Command.php:299
 Symfony\Component\Console\Command\Command->run() at /app/vendor/symfony/console/Application.php:996
 Symfony\Component\Console\Application->doRunCommand() at /app/vendor/symfony/framework-bundle/Console/Application.php:96
 Symfony\Bundle\FrameworkBundle\Console\Application->doRunCommand() at /app/vendor/symfony/console/Application.php:295
 Symfony\Component\Console\Application->doRun() at /app/vendor/symfony/framework-bundle/Console/Application.php:82
 Symfony\Bundle\FrameworkBundle\Console\Application->doRun() at /app/vendor/symfony/console/Application.php:167
 Symfony\Component\Console\Application->run() at /app/vendor/symfony/runtime/Runner/Symfony/ConsoleApplicationRunner.php:56
 Symfony\Component\Runtime\Runner\Symfony\ConsoleApplicationRunner->run() at /app/vendor/autoload_runtime.php:35
 require_once() at /app/bin/console:11

app:run

2021-07-30T17:08:29+00:00 [critical] Uncaught Error: Cannot access uninitialized non-nullable property App\Document\Customer::$doma
inEvents by reference
```
