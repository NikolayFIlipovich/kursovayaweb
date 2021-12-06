<?php

class SiteController     
{

    public static function actionIndex()   
    {
        
       require_once(ROOT.'/views/site/index.php');
       return true;
    }
}
