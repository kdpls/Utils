<?php

declare(strict_types=1);

namespace KygekDev\Utils\utils;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat as TF;

class MemoryUsage extends Command {

    public function __construct(string $name, Plugin $owner) {
        parent::__construct($name);

        $this->setDescription("Get server memory usage (in MiB)");
        $this->setPermission("utils.memoryusage");
        $this->setAliases(["memusage"]);
        $this->setUsage("/memoryusage [realUsage: false]");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool {
        if (!$this->testPermission($sender)) return false;

        $usage = round(memory_get_usage(isset($args[0]) && $args[0] === "true") / 1024 / 1024, 2);

        $sender->sendMessage(TF::YELLOW . "Server memory usage: " . TF::AQUA . $usage . " MiB");
        return true;
    }

}