<?php

class Changes extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    public $user_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    public $asset_from;
    
    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    public $asset_to;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $quantity;
    
    /**
     *
     * @var string
     * @Column(type="char", length=2, nullable=true)
     */
    public $country;
    
    /**
     *
     * @var timestamp
     * @Column(type="timestamp", nullable=false)
     */
    public $when;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("boazsqda_pharket");
        $this->belongsTo('user_id', '\Users', 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'changes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UsersAssets[]|UsersAssets|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UsersAssets|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
    
    /**
     * New asset change
     * 
     * @param integer $user_id
     * @param integer $asset_from
     * @param integer $asset_to
     * @param float $quantity
     */
    public static function insert($user_id, $asset_from, $asset_to, $quantity)
    {
        $change = new Changes();
        $change->user_id = $user_id;
        $change->asset_from = $asset_from;
        $change->asset_to = $asset_to;
        $change->quantity = $quantity;
        $change->country = Helper::getCountry();
        $change->create();
    }
}
