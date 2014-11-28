<?php

namespace Kajja\Recorder;

use Mos\Database\CDatabaseBasic;

/**
 * Class that adds a few database methods to Mos\Database\CDatabaseBasic
 * to be able to better suit the RequestRecord class.
 *
 */
class RequestDatabase extends CDatabaseBasic implements IDatabaseHandler
{

    private $table; // Database table name for the records.

    /**
     *
     * @param array with setup options
     */
    public function __construct($options = [])
    {
        parent::__construct($options);

        $this->table = 'request';
    }


    /**
     * Insert a record in the database.
     *
     * @param array with the column names where the values is to be inserted
     * @param array with the values
     *
     * @return void
     */
    public function insertRecord($columns, $values)
    {
        $this->createTableIfNotExists();

        parent::insert($this->table, $columns, $values);
        $this->execute();
    }


    /**
     * Create a table for the records in the database if it
     * does not exist.
     *
     * @return void
     */
    public function createTableIfNotExists()
    {
        $this->createTable("IF NOT EXISTS $this->table", [
            'session'   => ['varchar(20)'],
            'id'        => ['integer', 'primary key', 'not null', 'auto_increment'],
            'uri'       => ['varchar(2048)'],
            'method'    => ['varchar(20)'],
            'date'      => ['datetime']
            ]);

        $this->execute();
    }


    /**
     * Get all the records from the records database table.
     *
     * @return array with all the records in the database
     */
    public function getAllRecords()
    {
        $this->select()->from($this->table)
            ->orderBy('session DESC, id DESC');
        $this->execute();

        return $this->fetchAll();
    }


    /**
     * Delete all records in the records database table.
     *
     * @return void
     */
    public function deleteAll()
    {
        $this->delete($this->table);
        $this->execute();
    }

}