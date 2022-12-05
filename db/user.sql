CREATE TABLE `utilisateurs` (
    `id` int(15) NOT NULL AUTO_INCREMENT, 
    `mail` varchar(56) NOT NULL, 
    `pseudo` varchar(25) NOT NULL, 
    `mdp` varchar(25) NOT NULL, 
    `admin` tinyint(1) NOT NULL, 
    `topic` varchar(56) NOT NULL, 
    `message` varchar(4096) NOT NULL,
    `date` DATETIME,
    PRIMARY KEY(`id`)
);