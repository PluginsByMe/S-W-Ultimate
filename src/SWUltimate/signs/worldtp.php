<?php
/*
*   _________             __      __ 
*  /   _____/    .__     /  \    /  \
*  \_____  \   __|  |___ \   \/\/   /
*  /        \ /__    __/  \        / 
* /_______  /    |__|      \__/\  /  
*         \/                    \/   
*  ____ ___.__   __  .__                __          
* |    |   \  |_/  |_|__| _____ _____ _/  |_  ____  
* |    |   /  |\   __\  |/     \\__  \\   __\/ __ \ 
* |    |  /|  |_|  | |  |  Y Y  \/ __ \|  | \  ___/ 
* |______/ |____/__| |__|__|_|  (____  /__|  \___  >
*                             \/     \/          \/ 
* 
*  @author remote_vase
*  
*/
namespace SWUltimate\signs;
use SWUltimate\Loader;
use pocketmine\command\{Command, CommandSender};
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\level\{Position, Level};
use pocketmine\utils\TextFormat as C;

class worldtp extends PluginBase{
    public $homeData;
    
    public function __construct(Loader $plugin){
		$this->plugin = $plugin;
	}
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        switch(strtolower($command->getName())){
            case "home":
            if($sender instanceof Player){
                $home = $this->homeData->get($args[0]);
                if($home["world"] instanceof Level){
                    $sender->setLevel($home["world"]);
                    $sender->teleport(new Position($home["x"], $home["y"], $home["z"]));
                    $sender->sendMessage(C::BLUE."You teleported home.");
                }else{
                    $sender->sendMessage(C::RED."That world is not loaded or Doesn't Exist!");
                }
            }
            break;
            case "sethome":
            if ($sender instanceof Player){
                $x = $sender->x;
                $y = $sender->y;
                $z = $sender->z;
                $level = $sender->getLevel();
                // $args[0] is the Name of the house -> /sethome <name>
                $this->homeData->set($args[0], array(
                    "x" => $x,
                    "y" => $y,
                    "z" => $z,
                    "world" => $level,
                ));
                $sender->sendMessage(C::GREEN."Your home is set at coordinates\n" . "X:" . C::YELLOW . $x . C::GREEN . "\nY:" . C::YELLOW . $y . C::GREEN . "\nZ:" . C::YELLOW . $z . C::GREEN . "\nUse /home < ". $args[0] ." > to teleport to this home!");
                $this->getLogger()->info($sender->getName() . " has set their home in world " . $sender->getLevel()->getName());
            }else{
                    $sender->sendMessage(C::RED. "Please run command in game.");
                    return true;
                }
                break;
            default:
                return false;
        }
    }
    }
}
