Usage with Anax-MVC
===================

To use the module with Anax-MVC first require it in your composer.json file like this:


Then, it is recommended that you register the module as a service:
`        $this->set('recorder', function() {
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
`