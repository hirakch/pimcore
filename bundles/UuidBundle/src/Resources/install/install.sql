DROP TABLE IF EXISTS `uuids`;
CREATE TABLE `uuids` (
    `uuid` CHAR(36) NOT NULL,
    `itemId` int(11) unsigned NOT NULL,
    `type` VARCHAR(25) NOT NULL,
    `instanceIdentifier` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`uuid`, `itemId`, `type`)
) DEFAULT CHARSET=utf8mb4;