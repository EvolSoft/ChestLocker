<?php

/*
 * ChestLocker (v1.2) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 27/12/2014 03:32 PM (UTC)
 * Copyright & License: (C) 2014 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/ChestLocker/blob/master/LICENSE)
 */

namespace ChestLocker;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\level\Level;
use pocketmine\permission\Permission;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\math\Vector3;
use pocketmine\tile\Chest;

class EventListener extends PluginBase implements Listener{
	
	public function __construct(Main $plugin){
		$this->plugin = $plugin;
	}
	
	public function onPlayerJoin(PlayerJoinEvent $event){
		$this->plugin->setCommandStatus(0, $event->getPlayer()->getName());
	}
	
	public function onPlayerQuit(PlayerQuitEvent $event){
		$this->plugin->endCommandSession($event->getPlayer()->getName());
	}
	
	public function onChestOpen(PlayerInteractEvent $event){
		if($event->getBlock()->getID() == Main::ITEM_ID){
			$chest = $event->getPlayer()->getLevel()->getTile($event->getBlock());
			if($chest instanceof Chest){
				//Check Command status
				//0
				if($this->plugin->getCommandStatus($event->getPlayer()->getName())==0){
					//Check bypass permission
					if($event->getPlayer()->hasPermission("chestlocker.bypass") == false){
						//Check if Chest is registered
						if($this->plugin->isChestRegistered($chest->getLevel()->getName(), $chest->getX(), $chest->getY(), $chest->getZ())){
							if($this->plugin->getChestOwner($chest->getLevel()->getName(), $chest->getX(), $chest->getY(), $chest->getZ()) != strtolower($event->getPlayer()->getName())){
								$event->setCancelled(true);
								$event->getPlayer()->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&4You aren't the owner of this " . Main::ITEM_NAME_2 . "."));
							}
						}
					}
				}
				//1
				if($this->plugin->getCommandStatus($event->getPlayer()->getName())==1){
					//Check if Chest is registered
					if($this->plugin->isChestRegistered($chest->getLevel()->getName(), $chest->getX(), $chest->getY(), $chest->getZ())){
						if($this->plugin->getChestOwner($chest->getLevel()->getName(), $chest->getX(), $chest->getY(), $chest->getZ()) != strtolower($event->getPlayer()->getName())){
							$event->getPlayer()->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&4You aren't the owner of this " . Main::ITEM_NAME_2 . "."));
						}else{
							$event->getPlayer()->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&2" . Main::ITEM_NAME . " already locked"));
						}
					}else{
						$event->getPlayer()->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&2" . Main::ITEM_NAME . " locked"));
						$this->plugin->lockChest($chest->getLevel()->getName(), $chest->getX(), $chest->getY(), $chest->getZ(), $event->getPlayer()->getName());
					}
					$event->setCancelled(true);
					$this->plugin->setCommandStatus(0, $event->getPlayer()->getName());
				}
				//2
				if($this->plugin->getCommandStatus($event->getPlayer()->getName())==2){
					//Check if Chest is registered
					if($this->plugin->isChestRegistered($chest->getLevel()->getName(), $chest->getX(), $chest->getY(), $chest->getZ())){
						if($this->plugin->getChestOwner($chest->getLevel()->getName(), $chest->getX(), $chest->getY(), $chest->getZ()) != strtolower($event->getPlayer()->getName())){
							$event->getPlayer()->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&4You aren't the owner of this " . Main::ITEM_NAME_2 . "."));
						}else{
							$event->getPlayer()->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&2" . Main::ITEM_NAME . " unlocked"));
							$this->plugin->unlockChest($chest->getLevel()->getName(), $chest->getX(), $chest->getY(), $chest->getZ(), $event->getPlayer()->getName());
						}
					}else{
						$event->getPlayer()->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&2" . Main::ITEM_NAME . " not registered"));
					}
					$event->setCancelled(true);
					$this->plugin->setCommandStatus(0, $event->getPlayer()->getName());
				}
			}
		}
	}

	public function onBlockDestroy(BlockBreakEvent $event){
		$this->cfg = $this->plugin->getConfig()->getAll();
		$player = $event->getPlayer();
		if($event->getBlock()->getID() == Main::ITEM_ID){
			$chest = $event->getPlayer()->getLevel()->getTile($event->getBlock());
			if($chest instanceof Chest){
				$level = $chest->getLevel()->getName();
				$x = $chest->getX();
				$y = $chest->getY();
				$z = $chest->getZ();
				//Check if chest is registered
				if($this->plugin->isChestRegistered($level, $x, $y, $z)){
					//Check bypass permission
					if($event->getPlayer()->hasPermission("chestlocker.bypass") == false){
						if($this->cfg["protect-chests"] == true){
							$player->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&4You aren't the owner of this " . Main::ITEM_NAME_2 . "."));
							$event->setCancelled(true);
						}else{
							$this->plugin->unlockChest($level, $x, $y, $z, $this->plugin->getChestOwner($level, $x, $y, $z));
						}
					}else{
						$this->plugin->unlockChest($level, $x, $y, $z, $this->plugin->getChestOwner($level, $x, $y, $z));
				    }
				}
			}
		}
	}
}
?>
