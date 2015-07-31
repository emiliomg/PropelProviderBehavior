<?php

class ProviderFassadeBehaviorBuilder extends OMBuilder
{

    public function build()
    {
        $className = $this->getClassname();
        $nameSpace = $this->getNamespace();
        $fassadePath = $this->getBuildProperty('phpDir');
        $fassadeClassPath = $fassadePath.'/'.$this->getClassFilePath();

        if (file_exists($fassadeClassPath)) {
            // File already exists.
            // It is not possible to just stop the process here and continue with the next file,
            // so we return the source string just as it is in the current file, so it does not get overwritten
            $sourceString = file_get_contents($fassadeClassPath);
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
            $templatePath = $dirname.'/templates/';
            define('BEHAVIOR_PROVIDER_FASSADE_TEMPLATE_PATH', $templatePath);
        }

        return BEHAVIOR_PROVIDER_FASSADE_TEMPLATE_PATH;
    }
}
