<?php
/*
 * This file is part of the PropelProviderBehavior package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

/**
 * Tests for ProviderBehaviorTest class
 *
 * @author Emilio Markgraf <emilio.markgraf@gmail.com>
 */
class ProviderBehaviorTest extends \PHPUnit_Framework_TestCase
{
    private $schema;

    public function setUp()
    {
        if (!class_exists('Author')) {
            $schema = <<<EOF
<database name="bookstore" defaultIdMethod="native">
    <table name="author">
        <column name="id" required="true" primaryKey="true" autoIncrement="true" type="INTEGER" />
        <column name="first_name" type="VARCHAR" size="255" />
        <column name="last_name" type="VARCHAR" size="255" />
        <behavior name="providerBase" />
    </table>
</database>
EOF;
            $builder = new PropelQuickBuilder();
            $config  = $builder->getConfig();
            $config->setBuildProperty('behavior.provider_base.class', __DIR__.'/../src/ProviderBaseBehavior/ProviderBaseBehavior');
            $builder->setConfig($config);
            $builder->setSchema($schema);
            $con = $builder->build();
        }
    }

    public function testFoo()
    {
        $this->assertTrue(true);
    }
}