<?php
    
namespace BowPunch;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

use BowPunch\EventListener;

class Main extends PluginBase{
    
    public static $instance;
    
    protected function onEnable(): void{
        
        $this->getLogger()->info("
        
  ____                   ____                       _     
 | __ )   ___ __      __|  _ \  _   _  _ __    ___ | |__  
 |  _ \  / _ \\ \ /\ / /| |_) || | | || '_ \  / __|| '_ \ 
 | |_) || (_) |\ V  V / |  __/ | |_| || | | || (__ | | | |
 |____/  \___/  \_/\_/  |_|     \__,_||_| |_| \___||_| |_|
 #This plugin was made by Fan. All right reserved         
        
        ");
        self::$instance = $this;
        @mkdir($this->getDataFolder());
        $this->saveResource("settings.yml");
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }
    
    public static function getInstance(): Main{
        return self::$instance;
    }
    
    public static function getConfigs(){
        return new Config(self::$instance->getDataFolder()."settings.yml", Config::YAML);
    }
}