<?php
    
namespace BowPunch;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\math\Vector3;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\data\bedrock\EnchantmentIdMap;

use BowPunch\Main;

class EventListener implements Listener{
    
    public static $coold = [];
    
    public function onInteract(PlayerItemUseEvent $event){
        $item = $event->getItem();
        $player = $event->getPlayer();
        $pname = $event->getPlayer()->getName();
        
        if($item->getId() === 261){
            if($item->hasEnchantment(EnchantmentIdMap::getInstance()->fromId(20))){
                $event->cancel();
                if(!isset(self::$coold[$pname]) || self::$coold[$pname] - time() <= 0){
                    self::$coold[$pname] = time() + Main::getConfigs()->get("BowCooldown");
                    $motions = clone $player->getMotion();
                
                    $motions->x += $player->getDirectionVector()->getX() *  Main::getConfigs()->getNested("BowBoost.x");
                    $motions->y += $player->getEyeHeight() * Main::getConfigs()->getNested("BowBoost.y");
                    $motions->z += $player->getDirectionVector()->getZ() * Main::getConfigs()->getNested("BowBoost.x");
                            
                    $player->setMotion($motions);
                
                }else{
                     $player->sendPopup(str_replace("{time}", self::$coold[$pname] - time(), Main::getConfigs()->get("BowCooldownMessage")));
                }
            }
        }
    }
}
