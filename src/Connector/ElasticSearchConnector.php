<?php
declare(strict_types = 1);
namespace Diaclone\Connector;

class ElasticSearchConnector extends Connector
{
    private $connection;
    private $params;

    public function __construct( $connection, array $params = [])
    {
        $this->params = $params;
        if (empty($this->connection)) {
            $this->connection = $connection;
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getDataFromSource()
    {
        unset($this->params['body']);
        return $this->connection->get($this->params)['_source'];
    }

    public function sendDataToSource($data)
    {
        $this->params['body'] = $data;
        return $this->connection->index($this->params);
    }

}