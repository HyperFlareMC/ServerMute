<?php

declare(strict_types=1);

namespace HyperFlareMC\servermute;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class MuteCommand extends Command{

    /**
     * @var array|mixed[]
     */
    private static $config;

    /**
     * @var ServerMute
     */
    private $plugin;

    public function __construct(ServerMute $plugin){
        parent::__construct(
            "servermute",
            "Mute the entire server!",
            TextFormat::RED . "Usage: " . TextFormat::GRAY . "/servermute",
            ["sm"]
        );
        $this->setPermission("servermute.mute");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        self::$config = $this->plugin->getConfig()->getAll();
        $server = Server::getInstance();
        if(!$sender->hasPermission("servermute.mute")){
            $sender->sendMessage(self::$config["no-permission-message"]);
            return;
        }
        $players = $this->plugin->getServer()->getOnlinePlayers();
        foreach($players as $player){
            if($this->plugin->isMuted()){
                $this->plugin->setMuted(false);
                $server->broadcastMessage(self::$config["disabled-message"]);
                return;
            }
            $this->plugin->setMuted();
            $server->broadcastMessage(self::$config["enabled-message"]);
        }
    }

}