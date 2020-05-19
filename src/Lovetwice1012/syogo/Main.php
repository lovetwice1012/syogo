<?php

namespace Lovetwice1012\syogo;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

	
	public $myConfig;
		       
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
       
		$this->myConfig = new Config($this->getDataFolder() . "MyConfig.yml", Config::YAML);

	}

	public function onJoin(PlayerJoinEvent $event){
		$config = $this->myConfig;
  $player = $event->getPlayer();
  /** @var Config $config */
  if($config->exists($player->getName())){
	  $player->setNameTag($config->get($player->getName()));
	  $player->setDisplayName($config->get($player->getName()));
  }		
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
	{
		$config = $this->myConfig;
        if ($label === "syogo") {
            
		if(isset($args[0])){
		if(isset($args[1])){    
			$player = $this->getServer()->getPlayer($sender->getName());
 

                    $tag = $args[1]; 
		    $config->set($player->getName(), "[§d".$tag."§r]".$player->getName());
		    $config->save();
		    $player->setNameTag("[§d".$tag."§r]".$player->getName());
		    $player->setDisplayName("[§d".$tag."§r]".$player->getName());
		}else{
			$player = $this->getServer()->getPlayer($sender->getName());
			$config->set($player->getName(),$player->getName());
			$config->save();
               
                $player->setNameTag($player->getName());
                $player->setDisplayName($player->getName());
		}
	    	    $sender->sendMessage("称号が".$config->get($player->getName())."になりました");
		}else{
	
		    $sender->sendMessage("§c使用方法:/syo 称号");
			}
		
            
	
        }
        return true;
    }

}
