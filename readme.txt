PROJET PERSONNEL : Site web "Les mondes d'Oriendo" et application "PonyOnFire"
-- réalisé sous Laravel 8 --

## Mise en production et installation :

1 - Créer une base de données
2 - Renseigner le nom de la BDD (DB_DATABASE) et le mot de passe pour y accéder (DB_PASSWORD) dans le fichier .env
3 - Lancer les installations des modules via Composer (commande : composer install // composer dump-autoload)
4 - Lancer la migration et le peuplement de la BDD avec la commande : php artisan migrate:fresh --seed.

Remarque : Ce site internet est encore en cours de construction.
Il s'agit de mon site web personnel, qui sera hébergé prochainement sur un VPS.
D'autres fonctionnalités verront rapidement le jour par la suite, comme l'ajout de commentaires dans la section "Mes récits".
Certains mini-jeux et projets du Portfolio sont encore à l'état de "Work In Project" : je continue actuellement de travailler dessus et les intégrerai au fur
et à mesure de mon avancée lorsqu'ils seront testés et fonctionnels.
L'essentiel de la structure du site et le layout CSS sont toutefois opérationnels, ce qui constitue une v1 utilisable.


## Tester l'application PonyOnFire :

Lancer le site sur un navigateur avec un serveur Apache, puis accéder via la barre d'adresse à la route 'register' (orienworld.test/register).
Le formulaire d'inscription qui apparait permet de s'enregistrer pour accéder à l'application PonyOnFire du Portfolio. Le premier utilisateur enregistré
via ce chemin d'accès obtient automatiquement le grade d'Administrateur de l'application.

Remarque : PonyOnFire a été développée comme une application autonome pour la Sellerie des Nacres. Son intégration au sein de mon portfolio est toujours en cours.
Il peut donc subsister de rares erreurs de namespace et de routes par endroit, mais l'essentiel des fonctionnalités sont opérationnelles.


## Tester la page de contact (configurer l'envoi de mails) :

Pour tester l'envoi de mails via le formulaire de contact, j'ai fait le choix d'utiliser l'outil Mailtrap.
Afin de s'en servir, il faut se rendre sur https://mailtrap.io/ et se connecter.
Si vous n'avez pas de boite mail sur MailTrap, créez-en une. Ouvrez-la, puis rendez-vous dans ses paramètres pour récupérer les informations SMTP permettant de
rediriger les mails de l'application à l'intérieur.
Il suffit alors de copier/coller ces informations à l'endroit approprié du fichier .env du projet (MAIL_HOST, MAIL_PORT, MAIL_USERNAME et MAIL_PASSWORD)