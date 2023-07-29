<?php

namespace skyss0fly\EasyBrag;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\inventory\PlayerInventory;

class Main extends PluginBase implements Listener {
    private $cooldowns = [];

    public function onLoad(): void {
        $this->saveDefaultConfig();
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        switch ($command->getName()) {
            case "brag":
                $cooldown = $this->getConfig()->get("Cooldown");
                $message = $this->getConfig()->get("Message");
                $prefix = "§l§e[§5Easy§gBrag§e]§d ";
                $player = $this->getServer()->getPlayerExact($sender->getName());
                $item = $player->getInventory()->getItemInHand();

                if (!$sender instanceof Player) {
                    $sender->sendMessage("§cError, must be in game");
                    return false;
                }

                $currentTime = time();
                if (isset($this->cooldowns[$player->getName()]) && $this->cooldowns[$player->getName()] > $currentTime) {
                    $remainingTime = $this->cooldowns[$player->getName()] - $currentTime;
                    $sender->sendMessage("§cError: still in timeout. Remaining time: " . $remainingTime . " seconds.");
                    return false;
                }

                if ($item !== null) { 
                    $bc = $prefix . $player->getName() . " has got: §r" . $item->getName();
                    $this->getServer()->broadcastMessage($bc);
                    $this->cooldowns[$player->getName()] = $currentTime + $cooldown;
                }
                
                return true;
            case "itembrag":
            $cooldown = $this->getConfig()->get("Cooldown");
                $message = $this->getConfig()->get("Message");
                $prefix = "§l§e[§5Easy§gBrag§e]§d ";
                $player = $this->getServer()->getPlayerExact($sender->getName());
                $item = $player->getInventory()->getItemInHand();

                if (!$sender instanceof Player) {
                    $sender->sendMessage("§cError, must be in game");
                    return false;
                }

                $currentTime = time();
                if (isset($this->cooldowns[$player->getName()]) && $this->cooldowns[$player->getName()] > $currentTime) {
                    $remainingTime = $this->cooldowns[$player->getName()] - $currentTime;
                    $sender->sendMessage("§cError: still in timeout. Remaining time: " . $remainingTime . " seconds.");
                    return false;
                }

                if ($item !== null) { 
                    $bc = $prefix . $player->getName() . " has got: §r" . $item->getName();
                    $this->getServer()->broadcastMessage($bc);
                    $this->cooldowns[$player->getName()] = $currentTime + $cooldown;
                }
                
                return true;
            case "bragsee":
            $disabled = $this->getConfig()->get("DisableBragView");
            $disabledmessage = "Unfortunately your admins Have Disabled this Command or you have no perms:("
            if ($disabled){
            $sender->sendMessage($disabledmessage);
        }
            else {
$sender->sendMessage("Coming Soon:)");
            }
        }
        
        return false;
    }
}
