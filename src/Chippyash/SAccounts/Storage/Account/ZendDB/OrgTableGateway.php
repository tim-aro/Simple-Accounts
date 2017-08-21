<?php
/**
 * Simple Double Entry Bookkeeping
 *
 * @author Ashley Kitson
 * @copyright Ashley Kitson, 2017, UK
 * @license GPL V3+ See LICENSE.md
 */
namespace SAccounts\Storage\Account\ZendDB;

use Chippyash\Type\Number\IntType;
use Chippyash\Type\String\StringType;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;

/**
 * Data model for Organisations
 *
 * Table name = sa_org
 * Columns:
 *   id: int Org id PK
 *   name: string Org Name IDX
 *   crcyCode: string Currency Code for organisation
 */
class OrgTableGateway extends TableGateway
{
    /**
     * Constructor.
     *
     * @param AdapterInterface $adapter
     * @param null             $features
     * @param null             $resultSetPrototype
     * @param null             $sql
     */
    public function __construct(
        AdapterInterface $adapter,
        $features = null,
        $resultSetPrototype = null,
        $sql = null
    ) {

        parent::__construct('sa_org', $adapter, $features, $resultSetPrototype, $sql);
    }

    /**
     * Does the table have required organisation?
     *
     * @param IntType $id
     *
     * @return bool
     */
    public function has(IntType $id)
    {
        return $this->select(['id' => $id()])->count() == 1;
    }

    /**
     * Create a new organisation record
     *
     * @param StringType   $name
     * @param StringType   $crcyCode
     * @param IntType|null $id
     *
     * @return int
     */
    public function create(StringType $name, StringType $crcyCode, IntType $id = null)
    {
        $id = is_null($id) ? null : $id();
        $this->insert(
            [
                'id' => $id,
                'name' => $name(),
                'crcyCode' => $crcyCode()
            ]
        );

        if ($this->getLastInsertValue() !== $id) {
            return $this->getLastInsertValue();
        }

        return $id;
    }
}