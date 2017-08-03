<?php

class ChangeController extends BaseController
{
    /**
     * "Change currencies" page
     */
    public function indexAction()
    {
        $asset = $this->request->get("asset");
        $t = $this->getTranslation();
        
        if ($asset != null) {
            $this->session->set("asset", $asset);
        }
        
        if ($this->session->has('investor')) {
            $user = $this->session->get("investor");
            $user_assets = UsersAssets::home($this->session->get("asset"), $t, ['user_id = ' . $user->id]);
            
            $this->view->user_assets = $user_assets;
            $this->view->total = array_sum(array_column($user_assets, 'value')); 
            $this->view->assets = Assets::listing($t); 
            $this->view->t = $t;
        }
    }
    
    /**
     * Checks if funds are sufficient to make the change. If so, the change is done.
     * 
     * @return string 'ok' / 'ko' (Insufficient funds) / 'error' 
     */
    public function checkAction()
    {
        try {
            $asset_id = $this->request->getPost("asset_id");
            $quantity =floatval($this->request->getPost("quantity"));
            $currency = $this->request->getPost("currency");
            $user = $this->session->get("investor");

            $user_asset = UsersAssets::findFirst(['user_id = ' . $user->id . ' AND asset_id = ' . $asset_id]);
            $value = Helper::convert($user_asset->quantity, $user_asset->Assets->name, $currency);

            if ($value >= $quantity) {
                $asset = Assets::findFirst(['name = "' . $currency . '"']);
                Changes::insert($user->id, $user_asset->asset_id, $asset->id, $quantity);
                UsersAssets::newOrCreate($user->id, $asset->id, $quantity);

                $user_asset->quantity -= Helper::convert($quantity, $currency, $user_asset->Assets->name);
                $user_asset->update();

                $this->logger->info($user->name . ' Successful change. Buy ' . $quantity . $currency . " (Remaining funds: " . $user_asset->quantity . $user_asset->Assets->name . ")");
                return 'ok';
            } else {
                $this->logger->warning($user->name . ' Warning: Insufficient funds to buy ' . $quantity . $currency . " (Funds: " . $user_asset->quantity . $user_asset->Assets->name . ")");
                return 'insufficient';
            }
        } catch (Exception $e) {
            $this->logger->error("Error: " . $e.message);
            return 'error';
        }
    }
}

