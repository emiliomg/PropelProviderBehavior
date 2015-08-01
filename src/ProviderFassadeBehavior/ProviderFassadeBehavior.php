<?php

require_once 'ProviderFassadeBehaviorBuilder.php';

/**
 * Class ProviderFassadeBehavior
 *
 * @author Emilio Markgraf <emilio.markgraf@gmail.com>
 */
class ProviderFassadeBehavior extends Behavior
{
    protected $additionalBuilders = array('ProviderFassadeBehaviorBuilder');
}
