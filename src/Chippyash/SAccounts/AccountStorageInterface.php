<?php
/**
 * Simple Double Entry Accounting
 *
 * @author Ashley Kitson
 * @copyright Ashley Kitson, 2015, UK
 * @license GPL V3+ See LICENSE.md
 */

namespace SAccounts;


use Chippyash\Type\Number\IntType;
use Chippyash\Type\String\StringType;

/**
 * Interface to save and fetch a Chart to/from storage
 */
interface AccountStorageInterface {

    /**
     * Fetch a chart from storage
     *
     * @param StringType $name
     * @param IntType $orgId that the chart belongs to.
     *
     * @return Chart
     */
    public function fetch(StringType $name, IntType $orgId);

    /**
     * Send a chart to storage
     *
     * @param Chart $chart
     * @return bool
     */
    public function send(Chart $chart);


}