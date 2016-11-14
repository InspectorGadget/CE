<?php

namespace CustomEnchants;

/*
 * All rights reserved TeamBlocket & InspectorGadget
 * Do not copy!
 * Its hard to make one, so please understand
*/

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\NBT;

use pocketmine\math\Vector3;

use pocketmine\event\entity\EntityArmorChangeEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemHeldEvent;

use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\network\protocol\MovePlayerPacket;
use pocketmine\network\protocol\MoveEntityPacket;

use pocketmine\utils\Config;

use pocketmine\utils\TextFormat as c;

use pocketmine\Player;

use pocketmine\Server;

use pocketmine\entity\Effect;

use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;


class Main extends PluginBase implements Listener {

/*
 * RTGN37w0rk
*/


	public function onEnable(){
	
		if($this->getConfig()->get("enable") == false) {
			$this->setEnabled(false);
			return;
		}
		
		
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->warning(base64_decode("
CQktIEN1c3RvbSBFbmNoYW50cyBpcyBTdGFydGluZyEKCQktIE15U1FMOiBDb25uZWN0ZWQgNG1zCgkJLSBBdXRob3JzOiBUZWFtQmxvY2tldCAmJiBJbnNwZWN0b3JHYWRnZXQKCQktIENvbnRyaWJ1dGlvbjoge0FueSBTZXJ2ZXJ9CgkJLSBEbyBub3QgcmVkaXN0cmlidXRlIHRoaXMgcGx1Z2luIHcvbyBwcm9wZXIgcGVybWlzc2lvbnMh
		"));
		$this->getLogger()->warning(base64_decode("
		LSAtIC0gLSAtIC0gLSAtIC0gDQotIC0gUiAtIFQgLSBHIC0gLQ0KLSAtIC0gVCAtIEIgLSAtIC0
		"));
    }
	
	public function onDisable() {
		$this->getLogger()->warning("
		* Turning off Custom Enchants!
		");
   }
   
   public function onHeld(PlayerItemHeldEvent $e) {

      $tem = $e->getPlayer()->getInventory()->getItemInHand()->getID();
      $temm = $e->getPlayer()->getInventory()->getItemInHand();
      $cname = $this->getConfig()->get("CustomName");
      $id = Item::IRON_SWORD;

     If ($tem === $id) {

         $id = Item::IRON_SWORD;
         $ss = Enchantment::getEnchantment(15);
         $temm->addEnchantment($ss);
      }
   }
   
   public function onTap(PlayerInteractEvent $e) {
   	$p = $e->getPlayer();
   	if($e->getBlock()->getId() == Item::STONE_BRICK) {
   		$enchantment = Enchantment::getEnchantment(9);
   		$enchantment->setLevel(1);
   		$item = $p->getInventory()->getItemInHand();
   		$item->addEnchantment($enchantment);
   		$p->getInventory()->addItem($item);
   		$p->sendTip("Enchanted!");
   	}
   }
   
   public function onEntityDamageByEntity(EntityDamageEvent $event){
	if ($event instanceof EntityDamageByEntityEvent) {

		$entity = $event->getEntity();
		$player = $event->getDamager();

		if ($entity instanceof Player and $player instanceof Player) {
			
			$item = $player->getInventory()->getItemInHand()->getID();
			$nama = $player->getInventory()->getItemInHand()->getName();
			
			$id = Item::IRON_SWORD;
			
			$cname = $this->getConfig()->get("CustomName");
			
			if ($item == $id) {

                        $item = $player->getInventory()->getItemInHand()->getID();
                        $hand = $player->getInventory()->getItemInHand();
			    
			    $bs = Enchantment::getEnchantment(9);
			    $hand->addEnchantment($bs);
                        $bs->setLevel(1000);
				
			    $light = new AddEntityPacket();
			    $light->type = 93;
			    $light->eid = Entity::$entityCount++;
			    $light->metadata = array();
			    $light->speedX = 0;
			    $light->speedY = 0;
			    $light->speedZ = 0;
 			    $light->yaw = $entity->getYaw();
			    $light->pitch = $entity->getPitch();
			    $light->x = $entity->x;
			    $light->y = $entity->y;
			    $light->z = $entity->z;
			    $event->setDamage(9);
			    $entity->setOnFire(9);
		}
		}
     }
  }
}