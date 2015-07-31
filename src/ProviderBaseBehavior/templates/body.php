    /**
     * Returns a new query instance.
     *
     * @return <?php echo $queryClassName; ?>

     */
    public function getQuery()
    {
        $query = <?php echo $queryClassName; ?>::create();

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
