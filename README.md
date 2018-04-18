# Projet TeamRocket -- Web -- IMAC 

## Récuperer le projet : 

	
* Installer lumen : https://lumen.laravel.com/docs/5.6
* Créer un nouveau projet avec 
```
lumen new [NOM]
```
* Récuperer les fichiers du GIT avec un clone et les placer dans le dossier à la place des fichiers par défaut


### TIPS : 
Pensez à bosser avec un dossier GIT qui vous permet d'upload votre travail / récuperer le travail des aurtes et un dossier de travail où vous pouvez faire ce que vous voulez ca vous facilitera la vie pour ceux qui n'y pensent pas naturellement. 


### IMPORTANT : 
	Pour le .env penser à remplir le APP_KEY avec un élement de 32 caractères sinon le mondule d'encrytage des mots de passe ne marchera pas et vous ne pourrez pas avoir d'utilisateurs dans votre BDD 
	(vous pouvez utiliser https://www.random.org/strings/ )



	
	
## Base de données : 

### Installer la BD : 
	- Creer un fichier .env à la racine du projet en suivant le patern du fichier .env.example
	- Creer la base de données via console ou via interface (phpmyadmin par ex)
	- Executer la commande -- php artisan migrate -- dans le dossier racine du projet 

	Note : Ne pas toucher à la table migrations c'est une table qui permet à Lumen de vérifier les migrations qui ont déjà été faites.


### Update la BD : 
	php artisan migrate:refresh --seed 
	(dans le dossier du projet, pensez à creer votre .env si c'est pas déjà fait)
	ATTENTION : LE REFRESH DELETE TOUTE LES DONNEES PRESENTE EN BD ET RECREE CELLES PAR DEFAUT