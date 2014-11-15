Usage with Anax-MVC
===================

To use the module with Anax-MVC first require it in your composer.json file like this:

```json
"require": {
	"kajja/requestrecorder": "dev-master"
}

```

Then, it is recommended that you register the module as a service:
```php
$this->set('recorder', function() {
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
* With setupOptions() you set up which database to use and how to retrive HTTP-request info. The fetch_mode variable specifies that we want information retrieved as an array.
* Connect to the database
* A new HTMLFormatter object is created, it is used to format the retrieved records into HTML.
* A new RequestRecorder object is created, which is the central object. It takes as parameters the RequestDatabase and HTMLFormer objects that we just created.

To use the new service in your application you can, in your frontcontroller save information from the current HTTP-request by doing:
```php
$app->recorder->save(['/Anax-MVC/webroot/records']);
```
The array argument to the save() method is optional. It specifies which uri:s not to save.
When you want to retrieve and display the records in the database, this is how you do it:
```php
$res = $app->recorder->getRecords();
```
$res will be a string with a HTML-table with the records in the database table.