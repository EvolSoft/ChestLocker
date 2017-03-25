<?php

/*
 * ChestLocker (v1.2) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 27/12/2014 03:32 PM (UTC)
 * Copyright & License: (C) 2014-2017 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/ChestLocker/blob/master/LICENSE)
 */

namespace ChestLocker\Commands;

use pocketmine\plugin\PluginBase;
use pocketmine\permission\Permission;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

use ChestLocker\Main;

class Commands extends PluginBase{
	public function __construct(Main $plugin){
		$this->plugin = $plugin;
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    	switch(strtolower($cmd->getName())){
    		case "chestlocker":
    			if(isset($args[0])){
    				$args[0] = strtolower($args[0]);
    				if($args[0]=="help"){
    					if($sender->hasPermission("chestlocker.commands.help")){
    						$sender->sendMessage($this->plugin->translateColors("&", "&c|| &8Available Commands &c||"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&c/chlock info &8> Show info about this plugin"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&c/chlock reload &8> Reload the config"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&c/lockchest &8> Lock a " . Main::ITEM_NAME_2));
    						$sender->sendMessage($this->plugin->translateColors("&", "&c/unlockchest &8> Unlock a " . Main::ITEM_NAME_2));
    						break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}elseif($args[0]=="reload"){
    					if($sender->hasPermission("chestlocker.commands.reload")){
    						$this->plugin->reloadConfig();
    			   	        $sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&aConfiguration Reloaded."));
    				        break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}elseif($args[0]=="info"){
    					if($sender->hasPermission("chestlocker.commands.info")){
    						$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&8ChestLocker &cv" . Main::VERSION . " &8developed by&c " . Main::PRODUCER));
    			   	        $sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&8Website &c" . Main::MAIN_WEBSITE));
    				        break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}
    				}else{
    					if($sender->hasPermission("chestlocker.commands.help")){
    						$sender->sendMessage($this->plugin->translateColors("&", "&c|| &8Available Commands &c||"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&c/chlock info &8> Show info about this plugin"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&c/chlock reload &8> Reload the config"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&c/lockchest &8> Lock a " . Main::ITEM_NAME_2));
    						$sender->sendMessage($this->plugin->translateColors("&", "&c/unlockchest &8> Unlock a " . Main::ITEM_NAME_2));
    						break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}
    			}
	  }
}
