<?php

declare(strict_types=1);

namespace HyperFlareMC\servermute;

use pocketmine\plugin\PluginBase;

class ServerMute extends PluginBase{

    /**
     * @var bool
     */
    private $universalMute = false;

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getServer()->getCommandMap()->register("servermute", new MuteCommand($this));
    }

    public function isMuted() : bool{
        return $this->universalMute;
    }

    public function setMuted(bool $bool = true) : void{
        $this->universalMute = $bool;
    }

}