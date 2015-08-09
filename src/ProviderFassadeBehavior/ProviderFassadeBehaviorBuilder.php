<?php

/**
 * Class ProviderFassadeBehaviorBuilder
 *
 * @author Emilio Markgraf <emilio.markgraf@gmail.com>
 */
class ProviderFassadeBehaviorBuilder extends OMBuilder
{

    public function build()
    {
        $phpDir = $this->getBuildProperty('phpDir');
        $fassadePath = $phpDir.DIRECTORY_SEPARATOR.$this->getClassFilePath();

        if (in_array($this->getBuildProperty('behaviorProviderCachefile'), array('true', 'on', 'yes', '1'))) {
            $outputDir = $this->getBuildProperty('outputDir');
            $cacheFile = $outputDir.DIRECTORY_SEPARATOR.'providerCache.json';
            $className = $this->getClassname();
            $package = $this->getPackage();
            $nameSpace = $this->getNamespace();

//            Check if a special constant has been defined - if not, this is the first run of
//            and Provider build, so we need to clear the cache.
            if(!defined('BEHAVIOR_PROVIDER_FASSADE_CACHE_CLEARED') || true != BEHAVIOR_PROVIDER_FASSADE_CACHE_CLEARED) {
                if (file_exists($cacheFile)) {
                    unlink($cacheFile);
                }
                touch($cacheFile);
                define('BEHAVIOR_PROVIDER_FASSADE_CACHE_CLEARED', true);
            }

            $cache = (array) json_decode(file_get_contents($cacheFile), true);
            if (JSON_ERROR_NONE == json_last_error()) {
                $cache[] = array(
                    'package' => $package,
                    'namespace' => $nameSpace,
                    'modelName' => str_replace('Provider', '', $className),
                    'providerName' => $className
                );
                file_put_contents($cacheFile, json_encode($cache));
            }
        }

        if (file_exists($fassadePath)) {
            // Fassade already exists.
            // It is not possible to just stop the process here and continue with the next file,
            // so we return the source string just as it is in the current file, so it does not get overwritten
            $sourceString = file_get_contents($fassadePath);
        } else {
            // Fassade does not exist yet, so we build it
            $sourceString = parent::build();
        }

        return $sourceString;
    }

    public function getUnprefixedClassname()
    {
        return $this->getStubObjectBuilder()->getUnprefixedClassname() . 'Provider';
    }

    protected function addClassOpen(&$script)
    {
        $table = $this->getTable();
        $tableName = $table->getName();
        $className = $this->getClassname();
        $baseClassName = 'Base'.$className;
        $nameSpace = $this->getNamespace();

        $this->declareClass($nameSpace.'\\om\\'.$baseClassName);

        $templatePath = $this->getTemplatePath();

        ob_start();
        require($templatePath.'open.php');
        $text = ob_get_clean();

        $script .= $text;
    }

    protected function addClassBody(&$script)
    {
        $templatePath = $this->getTemplatePath();

        ob_start();
        require($templatePath.'body.php');
        $text = ob_get_clean();

        $script .= $text;
    }

    protected function addClassClose(&$script)
    {
        $templatePath = $this->getTemplatePath();

        ob_start();
        require($templatePath.'close.php');
        $text = ob_get_clean();

        $script .= $text;
    }

    /**
     * Returns the current dirname of this behavior (also works for descendants)
     *
     * @return string The absolute directory name
     */
    protected function getTemplatePath()
    {
        if (!defined('BEHAVIOR_PROVIDER_FASSADE_TEMPLATE_PATH')) {
            $r = new ReflectionObject($this);
            $dirname = dirname($r->getFileName());
            $templatePath = $dirname.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR;
            define('BEHAVIOR_PROVIDER_FASSADE_TEMPLATE_PATH', $templatePath);
        }

        return BEHAVIOR_PROVIDER_FASSADE_TEMPLATE_PATH;
    }
}
