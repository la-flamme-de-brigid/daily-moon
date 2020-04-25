# Daily moon

## Installation

1. Télécharger [l'archive zip de la dernière release](https://github.com/witch-please/daily-moon/releases).
2. Transférer les fichiers sur le serveur (wp-content/plugins/)(Le dossier doit porter le nom `daily-moon`).
3. Se connnectera en SSH et se rendre dans le dossier racine du plugin.
4. Lancer `composer install`. Une erreur à la création des dossiers de cache se produira si ils sont créés.
5. Créer un fichier `.env` à la racine du plugin et remplir à partir du fichier [.env.sample](https://github.com/witch-please/daily-moon/blob/master/.env.sample).
6. Si une erreur se produit après l'activation du plugin, lancer la commande `chown -R www-data:www-data cache` à la racine du plugin.

## Vider le cache
1. Supprimer le contenu de `cache/api` et de `cache/templates` à la racine du plugin.
