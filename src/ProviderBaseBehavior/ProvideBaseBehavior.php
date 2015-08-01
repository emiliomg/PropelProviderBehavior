<?php

require_once 'ProviderBaseBehaviorBuilder.php';

/**
 * Class ProviderBaseBehavior
 *
 * @author Emilio Markgraf <emilio.markgraf@gmail.com>
 */
class ProviderBaseBehavior extends Behavior
{
    protected $additionalBuilders = array('ProviderBaseBehaviorBuilder');
}
