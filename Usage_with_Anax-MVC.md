Usage with Anax-MVC
===================

To use the module with Anax-MVC first require it in your composer.json file like this:

```json
"minimum-stability": "dev",
"require": {
	"kajja/requestrecorder": "dev-master"
}

```
You need to set "minimum-stability" to "dev" since the package "kajja/requestrecorder" depends on "mos/cdatabase" which only has a dev-version.

The package uses the session to be able to keep track of which requests that belong to the same session, so you need to start the session, preferably early in your frontkontroller.
```php
$app->session;
```

Then, it is recommended that you register the module as a service, for example:
```php
$di->set('recorder', function() {
    $dbh = new \Kajja\Recorder\RequestDatabase();
    $dbh->setOptions([
        'dsn'           => 'sqlite:' . ANAX_APP_PATH . '.htphpmvc.sqlite',
        'fetch_mode'    => \PDO::FETCH_ASSOC
        ]);
    $dbh->connect();
    $formatter = new \Kajja\Recorder\HTMLFormatter();
    $recorder = new \Kajja\Recorder\RequestRecord($dbh, $formatter);
    return $recorder;
});
```
Explaination of the above:
* 'recorder', will be the service name, choose whatever name you want.
* A new RequestDatabase object is created, it inherits from mos/cdatabase/CDatabaseBasic.
* With setupOptions() you set up which database to use and how to retrive the HTTP-request info. In the example above I have a SQLite database and the fetch_mode variable specifies that the information must be returned as an array.
* Connect to the database
* A new HTMLFormatter object is created, it is used to format the retrieved records into HTML.
* A new RequestRecorder object is created. This is the central object. It takes as arguments the RequestDatabase and HTMLFormer objects that we just created.

To use the new service in your application you can, in your frontcontroller for example, save information from the current HTTP-request by doing:
```php
$app->recorder->save(['/Anax-MVC/webroot/records']);
```
When used, the recorder service will create a table named 'request' if is doesn't already exist in the database.

The array argument to the save() method is optional. It specifies which uri:s not to save, i.e. ignore.
When you want to retrieve and display the records in the database, this is how you do it:
```php
$res = $app->recorder->getRecords();
```
$res will be a string with a HTML-table with the records in the database.
You can clear all records in the database by doing:
```php
$app->recorder->clearRecords();
```