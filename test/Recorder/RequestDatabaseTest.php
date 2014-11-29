<?php

namespace Kajja\Recorder;

/**
 * Test of the RequestDatabase class
 * (and indirectly the Mos\CDatabaseBasic class)
 *
 */
class RequestDatabaseTest extends \PHPUnit_Framework_TestCase
{
    static protected $dbh = null; // Want to keep the db between tests

    protected function setUp()
    {
        if (self::$dbh === null) {

            // Setting up database
            self::$dbh = new RequestDatabase();
            self::$dbh->setOptions([
                'dsn'           => 'sqlite::memory:', // In-memory database
                'fetch_mode'    => \PDO::FETCH_ASSOC
            ]);
            self::$dbh->connect();
        }
    }


    /**
     * Test
     *
     *
     */
    public function testinsertRecord()
    {
        // Record to be stored
        $columns = ['session', 'uri', 'method', 'date'];
        $values = ['123456', 'http://test.se/test.php', 'GET', 'Sat, 29 Nov 2014 12:12:39 +0100'];
                
        $this->assertTrue(self::$dbh->insertRecord($columns, $values));
    }


    /**
     * Test
     *
     * @depends testinsertRecord
     */
    public function testgetAllRecords()
    {
        $expected[] =  [
                'session'   => '123456',
                'id'        => 1,
                'uri'       => 'http://test.se/test.php',
                'method'    => 'GET',
                'date'      => 'Sat, 29 Nov 2014 12:12:39 +0100'
        ];

        $records = self::$dbh->getAllRecords();

        $this->assertEquals($expected, $records, "Error fetching from db");
    }


    /**
     * Test
     *
     *
     */
    public function testdeleteAll()
    {
        // Cleans the database table
        $this->assertTrue(self::$dbh->deleteAll());

        // No records shall be left
        $this->assertEquals([], self::$dbh->getAllRecords());
    }
}