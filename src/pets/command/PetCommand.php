<?php

namespace pets\command;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pets\main;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class PetCommand extends PluginCommand {

	public function __construct(main $main, $name) {
		parent::__construct(
				$name, $main
		);
		$this->main = $main;
		$this->setPermission("pets.command");
		$this->setAliases(array("pets"));
	}

	public function execute(CommandSender $sender, $currentAlias, array $args) {
	if($sender->hasPermission('pets.command')){
		if (!isset($args[0])) {
			$sender->sendMessage("§e======§aPetHelp§e======");
			$sender->sendMessage("§aUsage: §d/pets get pet §b-§fGets Your Pets Now!.");
			$sender->sendMessage("§aUsage: §d/pets setname [name] §b-§fSet Your Pets Name.");
			$sender->sendMessage("§aNote: §dOnce U Summon Pets, The Pets Can't Be Removed!");
			
			return true;
		}
		switch (strtolower($args[0])){
			case "setname":
				if (isset($args[1])){
					unset($args[0]);
					$name = implode(" ", $args);
					$this->main->getPet($sender->getName())->setNameTag("§8".$name);
					$sender->sendMessage("Set Name to ".$name);
					$data = new Config($this->main->getDataFolder() . "players/" . strtolower($sender->getName()) . ".yml", Config::YAML);
					$data->set("name", $name); 
					$data->save();
				}
				return true;
			break;
			case "help":
				$sender->sendMessage("§e======§aPetHelp§e======");
			$sender->sendMessage("§aUsage: §d/pets get pet §b-§fGets Your Pets Now!.");
			$sender->sendMessage("§aUsage: §d/pets setname [name] §b-§fSet Your Pets Name.");
			$sender->sendMessage("§aNote: §dOnce U Summon Pets, The Pets Can't Be Removed!");
				return true;
			break;
/*			case "keep":
				$this->main->disablePet($sender);
*							$sender->sendMessage("§eBye LMOA!".$name);
*							return true;
* 		break;
*/
			case "get":
				if (isset($args[1])){
					switch ($args[1]){
						case "pet":
							$this->main->changePet($sender, "ChickenPet");
							$sender->sendMessage("§eCongratulation For Ur Purchase On Our Pets Stystem.\n§aPlease Report Some Bugs To Our Email Or Twitter.\n§dEmail: §bArchRPG@gmail.com\n§dTwitter:§b MyrulXzavier\n§ePet Gifted!");
					$name = implode(" ", $args);
					$this->main->getPet($sender->getName())->setNameTag("§8".$sender->getName()."§8's Pet");
					$data = new Config($this->main->getDataFolder() . "players/" . strtolower($sender->getName()) . ".yml", Config::YAML);
					$data->set("name", $name); 
					$data->save();
							return true;
					}
				}
			break;
		}
		return true;
	}
	}
}
