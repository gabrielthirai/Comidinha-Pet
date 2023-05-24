-- Active: 1684802009577@@127.0.0.1@3306@comidinhapet
CREATE DATABASE IF NOT EXISTS `comidinhapet`;
use comidinhapet;

CREATE TABLE IF NOT EXISTS `usuarios` (
`idusuarios` int(10) unsigned NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;


ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`idusuarios`), ADD KEY `documento` (`cpf`);


 ALTER TABLE `usuarios`
MODIFY `idusuarios` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;


ALTER TABLE `usuarios` ADD `email` varchar(32) DEFAULT NULL;

ALTER TABLE `usuarios` ADD KEY `endemail` (`email`);


SELECT * FROM usuarios;