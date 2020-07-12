<?php

declare(strict_types=1);

namespace HyperFlareMC\servermute;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\TextFormat;

class EventListener implements Listener{

    /**
     * @var ServerMute
     */
    private $plugin;

    public function __construct(ServerMute $plugin){
        $this->plugin = $plugin;
    }

    public function onChat(PlayerChatEvent $event){
        $player = $event->getPlayer();
        if($this->plugin->getUniversalMute()){
            $event->setCancelled();
            $player->sendMessage(TextFormat::RED . "The entire server is muted! No one can talk!");
            return;
        }
    }

}