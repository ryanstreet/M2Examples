<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 9/18/2017
 * Time: 4:29 PM
 */

namespace Training\Example\Model;


use Magento\Framework\App\State;
use Magento\Framework\Logger\Monolog;

class Logger extends Monolog
{
    /**
     * @var State
     */
    private $state;

    public function __construct(
        $name,
        $handlers = array(),
        State $state
    )
    {
        parent::__construct($name, $handlers, $processors = array());
        $this->state = $state;
    }

}