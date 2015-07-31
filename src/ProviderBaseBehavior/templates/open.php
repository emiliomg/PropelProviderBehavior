
/**
 * This is a provider base class for the '<?php echo $tableName; ?>' table.
 * It provides query, model, peer and connection instances.
 * You can use Dependency Injection to inject this provider into services who need
 * '<?php echo $tableName; ?>'-queries or -models and fetch them via this provider.
 * There is no need to access the models or queries directly, since this provider can be mocked.
 */
abstract class <?php echo $className; ?>

{
