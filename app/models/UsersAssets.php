<?php

class UsersAssets extends \Phalcon\Mvc\Model
{

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
    public $asset_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $quantity;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("boazsqda_pharket");
        $this->belongsTo('asset_id', '\Assets', 'id', ['alias' => 'Assets']);
        $this->belongsTo('user_id', '\Users', 'id', ['alias' => 'Users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users_assets';
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
     * List of assets and values
     *
     * @param string $asset
     * @param mixed $parameters
     * @return UsersAssets[]|UsersAssets|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function home($asset, $t, $parameters = null)
    {
        $user_assets = parent::find($parameters);
        $result = array();
        
        foreach($user_assets as $row) {
            $row->value = $row->Assets->name == $asset ? floatval($row->quantity) : Helper::convert($row->quantity, $row->Assets->name, $asset);
            $row->translated = $t->_($row->Assets->name);
            
            $result[] = $row;
        }
        
        return $result;
    }
    
    /**
     * Create or update a new user-asset entry
     * 
     * @param integer $user_id
     * @param integer $asset_id
     * @param float $quantity
     */
    public static function newOrCreate($user_id, $asset_id, $quantity) {
        $new_asset = parent::findFirst(['user_id = ' . $user_id . ' AND asset_id = ' . $asset_id]);
        
        if ($new_asset) {
            $new_asset->quantity += $quantity;
            $new_asset->update();
        } else {
            $new_asset = new UsersAssets();
            $new_asset->user_id = $user_id;
            $new_asset->asset_id = $asset_id;
            $new_asset->quantity = $quantity;
            $new_asset->create();
        }
    }
}
