<?php

declare(strict_types=1);

namespace KygekDev\Utils;

use KygekDev\Utils\utils\MemoryUsage;
use KygekDev\Utils\utils\DiskUsage;
use pocketmine\plugin\PluginBase;

class Utils extends PluginBase {

    protected function onEnable() : void {
        $this->getServer()->getCommandMap()->registerAll("Utils", [
            new DiskUsage("diskusage", $this),
            new MemoryUsage("memoryusage", $this)
        ]);
    }

}