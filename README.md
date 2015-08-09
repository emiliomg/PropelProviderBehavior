propel.behavior.provider.cachefile

# Propel Provider Behavior

A Propel ORM Behavior that provides you with Providers for Query/Model/Peer Objects.

## Requirements

- Propel > 1.6.0

## Install

Add this behavior to your project via your `composer.json` file

    "require": {
        "emiliomg/propel-provider-behavior": "~1.0"
    }

Or simply run `composer require emiliomg/propel-provider-behavior`.

Then, add the following configuration to your `build.properties`:

    propel.behavior.providerBase.behavior = vendor.emiliomg.propel-provider-behavior.src.ProviderBaseBehavior.ProviderBaseBehavior
    propel.behavior.providerFassade.behavior = vendor.emiliomg.propel-provider-behavior.src.ProviderFassadeBehavior.ProviderFassadeBehavior
    propel.behavior.default = providerBase, providerFassade

The `propel.behavior.default` makes sure every one of your models uses this behavior.

Finally, rebuild your models. The provider classes will be generated alongside you Models and Query-Classes.

## Configuration

You can use the `propel.behavior.provider.cachefile = true` switch. 
This will generate a `providerCache.json` file inside the outputDir which contains a list of all generated Providers. 
This can be useful, e.g. for automatically generating factories (which the Symfony2 Bundle does for you automatically).

## Generated code

The generated provider code is quite simple. We use a simple `schema.xml` like this

    <?xml version="1.0" encoding="utf-8"?>
    <database name="bookstore" defaultIdMethod="native" namespace="Foo\Bar\Model">
        <table name="Author" idMethod="native">
            <column name="id" type="INTEGER" primaryKey="true" autoIncrement="true" required="true"/>
            <column name="name" type="VARCHAR" size="255" required="false"/>
            <vendor type="mysql">
                <parameter name="Engine" value="InnoDB"/>
            </vendor>
        </table>
    </database>

A sample output for a ficional `Author`-Model then looks like this:

### BaseAuthorProvider

    <?php
    
    namespace Foo\Bar\Model\om;
    
    use \Propel;
    use Foo\Bar\Model\Author;
    use Foo\Bar\Model\AuthorPeer;
    use Foo\Bar\Model\AuthorQuery;
    
    /**
     * This is a provider base class for the 'Author' table.
     * It provides query, model, peer and connection instances.
     * You can use Dependency Injection to inject this provider into services who need
     * 'Author'-queries or -models and fetch them via this provider.
     * There is no need to access the models or queries directly, since this provider can be mocked.
     */
    abstract class BaseAuthorProvider
    {
        /**
         * Returns a new query instance.
         *
         * @return AuthorQuery
         */
        public function getQuery()
        {
            $query = AuthorQuery::create();
    
            return $query;
        }
    
        /**
         * Returns a new Model instance.
         *
         * @return Author
         */
        public function getModel()
        {
            $model = new Author();
    
            return $model;
        }
    
        /**
         * Returns a new Peer Instance;
         *
         * @return AuthorPeer
         */
        public function getPeer()
        {
            $peer = new AuthorPeer();
    
            return $peer;
        }
    
        /**
         * Returns the connection for this table.
         *
         * @return \PropelPDO
         */
        public function getConnection()
        {
            $peer = $this->getPeer();
            $connection = Propel::getConnection($peer::DATABASE_NAME);
    
            return $connection;
        }
    
    }

### AuthorProvider
The behaviors also generate `fassade` classes, which will be generated if and only if there is no fassade class already present. A fassade class looks like this:

    <?php
    
    namespace Foo\Bar\Model;
    
    use Foo\Bar\Model\om\BaseAuthorProvider;
    
    /**
     * This is a provider fassade class for the 'Author' table.
     * It provides query, model, peer and connection instances.
     * You can use Dependency Injection to inject this provider into services who need
     * 'Author'-queries or -models and fetch them via this provider.
     * There is no need to access the models or queries directly, since this provider can be mocked.
     *
     * You should add additional methods to this class to meet the
     * application requirements.  This class will only be generated as
     * long as it does not already exist in the output directory.
     */
    class AuthorProvider extends BaseAuthorProvider
    {
    
    }
