# INFORMATIONS GENERALES

# Principe du projet

Le projet consite a regrouper des medecin et des patient afin de faciliter l'accès au soins et la relation entre patient et medecin.

# Preparation de la base de donnee

Dans ce projet nous utilisons une base de donnee sous posgresql, si vous ne le possèder pas il vous suffit de rentrer les commandes suivantes dans votre terminal WSL :

sudo apt install postgresql
sudo service postgresql start
sudo -u postgres psql

Pour cree la base de donnee il faut utilier la comande suivante dans posgresql :

CREATE DATABASE doctolibre;

Puis se connecter a la base et la remplire la base grace au fichier model.sql et data.sql dans le dossier sql.

Ensuite il faut que vous creer depuis vscode (grace a l'extention SQLtool) une connection avec la base de donnee doctolibre.

# Lancer le site

En utilisant apache2 que nous lançons grace a la commande :

sudo service apache2 start

Puis, grace au navigateur internet de votre choix chercher localhost/"le chemin au vous avez ranger le projet". Puis cliquer sur le ficher connexion_patient present dans le dossier php.