/* script d'implémentation des différentes tables */

DROP DATABASE IF EXISTS exercice1;

CREATE DATABASE exercice1; 

USE exercice1;

CREATE TABLE client(
        cli_num      Int NOT NULL ,
        cli_nom     Varchar (50) NOT NULL ,
        cli_adresse Varchar (50) NOT NULL ,
        cli_tel     Varchar (30) NOT NULL
    ,CONSTRAINT client_PK PRIMARY KEY (cli_num)
);

CREATE TABLE produit(
        pro_num         Int NOT NULL ,
        pro_libelle      Varchar (50) NOT NULL ,
        pro_description  Varchar (50) NOT NULL
    ,CONSTRAINT produit_PK PRIMARY KEY (pro_num)
);

CREATE TABLE commande(
        com_num         Int NOT NULL ,
        cli_num         Int NOT NULL ,
		  com_date      Datetime NOT NULL ,
        com_obs  Varchar (50) NOT NULL
    ,CONSTRAINT commande_PK PRIMARY KEY (com_num)
    ,CONSTRAINT commande_cli_num_FK FOREIGN KEY (cli_num) REFERENCES client(cli_num)
);

CREATE TABLE est_compose(
        com_num Int NOT NULL ,
        pro_num    Int NOT NULL,
        est_qte	Int NOT NULL
    ,CONSTRAINT est_compose_PK PRIMARY KEY (com_num,pro_num)
    ,CONSTRAINT est_compose_com_num_FK FOREIGN KEY (com_num) REFERENCES commande(com_num)
    ,CONSTRAINT est_compose_pro_num_FK FOREIGN KEY (pro_num) REFERENCES produit(pro_num)
);

/* index sur le champ nom de la table client */

CREATE INDEX index1 ON client(cli_nom);
SHOW INDEX from client; 
