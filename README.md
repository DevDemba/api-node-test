## Windows ou Linux

Commencer d'abord par cloner le projet en utilisant la commande : 

```shell
git clone
```

Ensuite, il faut créer un fichier .env et le mettre à la racine du dossier BackEnd avec les informations suivantes ou vos informations personelles pour se connecter à une base de données:

```shell
HOST=localhost
MYSQL_USER=root
MYSQL_PASSWORD=
DATABASE=e_motion
PORT=3000
```

Puis, vous devez créer une base de données sous le nom e_motion et importer le fichier sql qui se trouve dans le dossier BackEnd/sql

Désormais vous pouvez lancer le projet de deux manières 

# Lancement en BackEnd

Se mettre sur le dossier BackEnd et lancer cette commande:
```shell
npm install 
```

Se mettre ensuite sur le dossier FrontEnd/vue-project et lancer cette commande:
```shell
npm install chalk
npm run build
```

Pour pouvor lancer le projet, retourner sur le dossier BackEnd et faites:
```shell
npm start
```
Vous pouvez désormais vous rendre sur:

```shell
http://localhost:3000/
```

# Lancement en Front

Se mettre sur le dossier Front/vue-project et lancer cette commande 
```shell
npm install 
```

Pour pouvor lancer le projet, faites:
```shell
npm run dev
```
Vous pouvez désormais vous rendre sur:

```shell
http://localhost:8080/
```
