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

    public function __construct()
    {
        if (is_callable('parent::__construct')) {
            call_user_func_array(parent::__construct, func_get_args());
        }

        // get cache dir and clear cache
        if (!defined('BEHAVIOR_PROVIDER_FASSADE_CACHE_FILE')) {
            $r = new ReflectionObject($this);
            $dirname = dirname($r->getFileName());
            $cacheFile = $dirname.'/../../cache/providerCache.json';
            define('BEHAVIOR_PROVIDER_FASSADE_CACHE_FILE', $cacheFile);
        }

        unlink(BEHAVIOR_PROVIDER_FASSADE_CACHE_FILE);
        touch(BEHAVIOR_PROVIDER_FASSADE_CACHE_FILE);
    }
}
