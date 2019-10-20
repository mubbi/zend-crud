<?php

namespace Post\Model;

use Zend\Db\TableGateway\TableGatewayInterface;

/**
 * Post Table
 */
class PostTable implements TableGatewayInterface
{
    protected $tableGateway;

    function __construct($tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getTable() {
        return $this->tableGateway->select();
    }

    public function select($where = null) {
        return $this->tableGateway->select($where);
    }

    public function insert($data) {
        $newData = [
            'title' => $data->title,
            'description' => $data->description,
            'category' => $data->category
        ];
        return $this->tableGateway->insert($newData);
    }

    public function update($data, $where = null) {
        $newData = [
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category']
        ];
        return $this->tableGateway->update($newData, $where);
    }

    public function delete($where) {
        return $this->tableGateway->delete($where);
    }

}
