<?php

declare(strict_types=1);

namespace HyperFlareMC\servermute;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class MuteCommand extends Command{

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
        $server = Server::getInstance();
        if(!$sender->hasPermission("servermute.mute")){
            $sender->sendMessage(TextFormat::RED . "You do not have permission to use this command!");
            return;
        }
        $players = $this->plugin->getServer()->getOnlinePlayers();
        foreach($players as $player){
            if($this->plugin->getUniversalMute()){
                $this->plugin->setUniversalMute(false);
                $server->broadcastMessage(TextFormat::YELLOW . "Server-wide Mute mode has been disabled!");
                return;
            }
            $this->plugin->setUniversalMute();
            $server->broadcastMessage(TextFormat::YELLOW . "Server-wide Mute mode has been enabled!");
        }
    }

}