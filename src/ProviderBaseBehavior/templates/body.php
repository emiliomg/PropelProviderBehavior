    /**
     * Returns a new query instance.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   <?php echo $queryClassName; ?>|Criteria $criteria Optional Criteria to build the query from
     *
     * @return <?php echo $queryClassName; ?>

     */
    public function getQuery($modelAlias = null, $criteria = null)
    {
        $query = <?php echo $queryClassName; ?>::create($modelAlias, $criteria);

        return $query;
    }

    /**
     * Returns a new Model instance.
     *
     * @return <?php echo $objectClassName; ?>

     */
    public function getModel()
    {
        $model = new <?php echo $objectClassName; ?>();

        return $model;
    }

    /**
     * Returns a new Peer Instance;
     *
     * @return <?php echo $peerClassName; ?>

     */
    public function getPeer()
    {
        $peer = new <?php echo $peerClassName; ?>();

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
