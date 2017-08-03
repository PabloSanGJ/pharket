<?php

class Assets extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $name;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("boazsqda_pharket");
        $this->hasMany('id', 'UsersAssets', 'asset_id', ['alias' => 'UsersAssets']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'assets';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Assets[]|Assets|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Assets|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $t
     * @return Assets[]|Assets|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function listing($t)
    {
        $assets = self::find();
        $result = array();
        
        foreach($assets as $asset) {
            $asset->translated = $t->_($asset->name);
            $result[] = $asset;
        }
        
        return $result;
    }
}
