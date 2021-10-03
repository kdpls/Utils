<?php

declare(strict_types=1);

namespace KygekDev\Utils\utils;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;
use RecursiveDirectoryIterator as RDI;
use RecursiveIteratorIterator as RII;

class DiskUsage extends PluginCommand {

    public function __construct(string $name, Plugin $owner) {
        parent::__construct($name, $owner);

        $this->setDescription("Get server disk usage (in MiB)");
        $this->setPermission("utils.diskusage");
        $this->setUsage("/diskusage");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool {
        if (!$this->testPermission($sender)) return false;

        $size = 0;
        foreach (new RII(new RDI(Server::getInstance()->getDataPath())) as $file) {
            $size += $file->getSize();
        }
        $size = round($size / 1024 / 1024, 2);

        $sender->sendMessage(TF::YELLOW . "Server disk usage: " . TF::AQUA . $size . " MiB");
        return true;
    }

}