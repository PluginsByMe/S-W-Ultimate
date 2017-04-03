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
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\command\{Command, CommandSender, ConsoleCommandSender};
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\math\Vector3;
use pocketmine\tile\Sign;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\level\Position;
use pocketmine\entity\Entity;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;
use pocketmine\tile\Tile;
use pocketmine\utils\TextFormat as C;

class coordtp extends Loader implements Listener{

	public function __construct(Loader $plugin){
			$this->plugin = $plugin;
		}
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function playerBlockTouch(PlayerInteractEvent $event){
        $prefix = C::BLACK . "[" . C::AQUA . "S&W Ultimate" . C::BLACK . "]";
        if($event->getBlock()->getID() == 323 || $event->getBlock()->getID() == 63 || $event->getBlock()->getID() == 68){
            $sign = $event->getPlayer()->getLevel()->getTile($event->getBlock());
            if(!($sign instanceof Sign)){
                return;
            }
            $sign = $sign->getText();
            if($sign[0]=='[COORD]'){
                            if(empty($sign[1]) !== true){
                                $x = $sign[1];
                                $y = $sign[2];
                                $z = $sign[3];
                                $name = $player->getName();
                                $event->getPlayer()->teleport(new Position($x,$y,$z));
                                $event->getPlayer()->sendMessage($prefix . "Teleporting to  $x $y $z");
                            }else{
                	           $event->getPlayer()->sendMessage($prefix . "Coordinates not set. Please try again");
                    }
                }
            }
        }
    }
    
    public function tileupdate(SignChangeEvent $event){
        if($event->getBlock()->getID() == 323 || $event->getBlock()->getID() == 63 || $event->getBlock()->getID() == 68){
            //Server::getInstance()->broadcastMessage("lv1");
            $sign = $event->getPlayer()->getLevel()->getTile($event->getBlock());
            if(!($sign instanceof Sign)){
                return true;
            }
            $sign = $event->getLines();
            if($sign[0]=='[COORD]'){
                if($event->getPlayer()->isOp()){
                    if(empty($sign[1]) !==true){
                            $event->getPlayer()->sendMessage($prefix . " Sign to X: '".$sign[1]."' Y: '".$sign[2]."' Z: '".$sign[3]."' created. Time to Teleport!");
                            return true;
                        }
				            $event->getPlayer()->sendMessage($prefix . "Coordinates not set. Please try again");
				            $event->setLine(0,"[Broken Sign]");
                    return false;
                }
            $event->getPlayer()->sendMessage($prefix . " You must be an OP to make a sign that teleports");
            //Server::getInstance()->broadcastMessage("f2");
            $event->setLine(0,"[Broken Sign]");
            return false;
            }
        }
        return true;
    }
}
