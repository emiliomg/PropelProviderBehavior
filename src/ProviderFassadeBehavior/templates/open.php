
/**
 * This is a provider base class for the '<?php echo $tableName; ?>' table.
 * It provides query, model, peer and connection instances.
 * You can use Dependency Injection to inject this provider into services who need
 * '<?php echo $tableName; ?>'-queries or -models and fetch them via this provider.
 * There is no need to access the models or queries directly, since this provider can be mocked.
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class <?php echo $className; ?> extends <?php echo $baseClassName; ?>

{
