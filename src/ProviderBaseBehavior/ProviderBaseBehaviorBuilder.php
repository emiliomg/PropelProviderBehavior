<?php

/**
 * Class ProviderBaseBehaviorBuilder
 *
 * @author Emilio Markgraf <emilio.markgraf@gmail.com>
 */
class ProviderBaseBehaviorBuilder extends OMBuilder
{

    public function getUnprefixedClassname()
    {
        return $this->getStubObjectBuilder()->getUnprefixedClassname() . 'Provider';
    }

    protected function addClassOpen(&$script)
    {
        $table = $this->getTable();
        $tableName = $table->getName();
        $className = $this->getClassname();

        $templatePath = $this->getTemplatePath();

        ob_start();
        require($templatePath.'open.php');
        $text = ob_get_clean();

        $script .= $text;
    }

    protected function addClassBody(&$script)
    {
        $objectClassName = $this->getStubObjectBuilder()->getClassname();
        $queryClassName = $this->getStubQueryBuilder()->getClassname();
        $peerClassName = $this->getStubPeerBuilder()->getClassname();
        $nameSpace = $this->getRealNamespace();

        $this->declareClass($nameSpace.'\\'.$objectClassName);
        $this->declareClass($nameSpace.'\\'.$queryClassName);
        $this->declareClass($nameSpace.'\\'.$peerClassName);
        $this->declareClass('\\Propel');

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

    public function getPackage()
    {
        return parent::getPackage().'.om';
    }

    public function getNamespace()
    {
        $nameSpace = parent::getNamespace();
        $nameSpace = $nameSpace.'\om';

        return $nameSpace;
    }

    public function getRealNamespace()
    {
        $nameSpace = parent::getNamespace();
        return $nameSpace;
    }

    public function getClassname()
    {
        $className = parent::getClassname();
        $className = 'Base'.$className;

        return $className;
    }

    public function getRealClassname()
    {
        return parent::getClassname();
    }

    /**
     * Returns the current dirname of this behavior (also works for descendants)
     *
     * @return string The absolute directory name
     */
    protected function getTemplatePath()
    {
        if (!defined('BEHAVIOR_PROVIDER_BASE_TEMPLATE_PATH')) {
            $r = new ReflectionObject($this);
            $dirname = dirname($r->getFileName());
            $templatePath = $dirname.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR;
            define('BEHAVIOR_PROVIDER_BASE_TEMPLATE_PATH', $templatePath);
        }

        return BEHAVIOR_PROVIDER_BASE_TEMPLATE_PATH;
    }
}
