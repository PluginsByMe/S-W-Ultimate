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

namespace SWUltimate;

use SWUltimate\signs\worldtp;
use SWUltimate\signs\coordtp;
use SWUltimate\signs\status;
use SWUltimate\signs\seedgenerate;
use SWUltimate\signs\typegenerate;
use SWUltimate\signs\cmd-non-op; #Can by tapped by any player, even if non-op player. Only runs non-op commands.
use SWUltimate\signs\cmd-op; #Can only by tapped by ops. Runs any command, even op only commands
use SWUltimate\signs\cmd-all; #Can by tapped by any player, even if non-op player. Runs any command.

use SWUltimate\worldcmd\seedgenerate;
use SWUltimate\worldcmd\typegenerate;
use SWUltimate\worldcmd\worldtp;
use SWUltimate\worldcmd\coordtp;
use SWUltimate\worldcmd\worldload;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Loader extends PluginBase implements Listener{
    
    const AUTHOR = "remote_vase";
    const VERSION = "1.0.0";
    const PREFIX = C::BLACK . "[" . C::AQUA . "S&W Ultimate" . C::BLACK . "]";
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(self::PREFIX . C::GREEN . "Enabled!");
    }
    public function getPrefix(){
        return self::PREFIX;
    }
    public function getAuthor(){
        return self::AUTHOR;
    }
    public function getVersion(){
        return self::VERSION;
    }
    public function onDisable(){
        $this->getLogger()->info(self::PREFIX . C::RED . "Disabled!");
    }
    
}
?>
