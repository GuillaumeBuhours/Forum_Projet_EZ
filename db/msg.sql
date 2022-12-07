CREATE TABLE `message` (
    `pseudo` varchar(25) NOT NULL, 
    `message` varchar(56) NOT NULL, 
    `date` DATETIME,
    PRIMARY KEY(`pseudo`)
);