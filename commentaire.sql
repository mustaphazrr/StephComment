CREATE TABLE IF NOT EXISTS `commentaire` (
  `code_cmt` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_cmt` text NOT NULL,
  `date_cmt` date NOT NULL,
  `nom_user` varchar(255) NOT NULL,
  `prenom_user` varchar(255) NOT NULL,
  `url_page` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`code_cmt`)
) ;