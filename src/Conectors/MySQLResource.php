<?php
declare(strict_types = 1);

namespace Diaclone\Conector;


class MySQLConector extends Conector
{

    private $data;
    private $instance;

    public function __construct(array $data)
    {
        $this->data = $data;
        if (empty($this->instance)) {
            $this->instance = new \mysqli(
                getenv('MYSQL_HOST'),
                getenv('MYSQL_USER'),
                getenv('MYSQL_PASSWORD'),
                getenv('MYSQL_DBNAME')
            );
        }
    }

    /**
     * each resource implements their own serialize according the cursor or driver
     * or reuse the parent one
     */
    protected function serialize($data)
    {
        $data = parent::serialize($data);
        return $data;
    }

    /**
     * each resource implements their own deserialize according the cursor or driver
     * or reuse the parent one
     */
    protected function deserialize($data)
    {
        $data = parent::deserialize($data);
        return $data;
    }

    public function getData()
    {

    }

    public function setData($data)
    {

    }
}