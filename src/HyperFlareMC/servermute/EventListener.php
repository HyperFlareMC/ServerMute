<?php

declare(strict_types=1);

namespace HyperFlareMC\servermute;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class EventListener implements Listener{

    /**
     * @var array|mixed[]
     */
    private static $config;

    /**
     * @var ServerMute
     */
    private $plugin;

    public function __construct(ServerMute $plugin){
        $this->plugin = $plugin;
    }

    public function onChat(PlayerChatEvent $event){
        self::$config = $this->plugin->getConfig()->getAll();
        $player = $event->getPlayer();
        if($this->plugin->isMuted()){
            $event->setCancelled();
            $player->sendMessage(self::$config["no-talk-message"]);
            return;
        }
    }

}