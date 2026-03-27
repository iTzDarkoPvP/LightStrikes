<?php

namespace LightStrikes;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\entity\Entity;

class Main extends PluginBase implements Listener {

    private $config;

    public function onEnable() {
        $this->saveDefaultConfig();
        $this->config = $this->getConfig()->getAll();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("LightStrikes activado!");
    }

    public function onDisable() {
        $this->getLogger()->info("LightStrikes desactivado!");
    }

    public function onPlayerDeath(PlayerDeathEvent $event) {
        if ($this->config["Death"]["activado"] === true) {
            $player = $event->getEntity();
            if ($player instanceof Player) {
                $this->spawnLightningBolt($player);
            }
        }
    }

    public function onPlayerJoin(PlayerJoinEvent $event) {
        if ($this->config["Join"]["activado"] === true) {
            $player = $event->getPlayer();
            $this->getServer()->getScheduler()->scheduleDelayedTask(
                new class($this, $player) extends \pocketmine\scheduler\Task {
                    private $plugin;
                    private $player;
                    
                    public function __construct(Main $plugin, Player $player) {
                        $this->plugin = $plugin;
                        $this->player = $player;
                    }
                    
                    public function onRun($currentTick) {
                        $this->plugin->spawnLightningBolt($this->player);
                    }
                }, 
                20
            );
        }
    }

    public function onPlayerQuit(PlayerQuitEvent $event) {
        if ($this->config["Left"]["activado"] === true) {
            $player = $event->getPlayer();
            $this->spawnLightningBolt($player);
        }
    }

    public function spawnLightningBolt(Player $player) {
        $level = $player->getLevel();
        
        $light = new AddEntityPacket();
        $light->type = 93;
        $light->eid = Entity::$entityCount++;
        $light->metadata = array();
        $light->speedX = 0;
        $light->speedY = 0;
        $light->speedZ = 0;
        $light->yaw = $player->getYaw();
        $light->pitch = $player->getPitch();
        $light->x = $player->x;
        $light->y = $player->y;
        $light->z = $player->z;
        
        Server::broadcastPacket($level->getPlayers(), $light);
    }
}