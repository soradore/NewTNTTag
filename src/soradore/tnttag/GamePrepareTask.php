<?php 

namespace soradore\tnttag;

use pocketmine\scheduler\Task;
use pocketmine\Server;

class GamePrepareTask extends Task {

    const FINISH = 20;

    public function __construct($plugin){
    	$this->second = self::FINISH;
    	$this->plugin = $plugin;
    }


	public function onRun(int $tick){
		$this->second = $this->second - 1;
		$players = $this->plugin->playerManager->getAllPlayers();
		$pad = str_repeat("   ",25);
		foreach($players as $player){
		    $player->sendPopup($pad . "§b次のラウンドまで... §6" . $this->second . "s\n \n \n \n");
		}
		if($this->second == 0){
			$this->plugin->nextRound();
			$this->getHandler()->cancel();
		}
	}
}