Obtenir toutes les communautés
Route: /api/community/all
Méthode HTTP: GET
Description:
Récupère toutes les communautés en renvoyant les données au format JSON.
Input:
Aucun (No input required)
Output:
Retourne une réponse JSON contenant toutes les communautés.
Code de statut : 200 (OK)
Format de la réponse : JSON
Groups appliqués : 'community:read-all'

Obtenir les communautés de l'utilisateur actuel
Route: /api/community/
Méthode HTTP: GET
Description:
Récupère les communautés associées au profil de l'utilisateur actuel (connecté) en renvoyant les données au format JSON.
Input:
Aucun (No input required)
Output:
Retourne une réponse JSON contenant les communautés associées au profil de l'utilisateur actuel.
Code de statut : 200 (OK)
Format de la réponse : JSON
Groups appliqués : 'community:read-all'

Créer une nouvelle communauté
Route: /api/community/create
Méthode HTTP: POST
Description:
Crée une nouvelle communauté en utilisant les données JSON fournies dans la requête.
Input:
{
   "name":"name of community"
}

Output:
Retourne une réponse JSON contenant les détails de la nouvelle communauté créée.
Code de statut : 200 (OK)
Format de la réponse : JSON
Groups appliqués : 'community:read-all'

Obtenir les détails d'une communauté spécifique
Route: /api/community/{id}
Méthode HTTP: GET
Description:
Récupère les détails de la communauté spécifiée par son ID en renvoyant les données au format JSON.
Input:
{id}: L'objet de la communauté identifiée par son ID.
Output:
Retourne une réponse JSON contenant les détails de la communauté spécifiée.
Code de statut : 200 (OK)
Format de la réponse : JSON
Groups appliqués : 'community:read-all'

Rejoindre une communauté
Route: /api/community/{id}/join
Méthode HTTP: GET
Description:
Rejoint la communauté spécifiée par son ID en ajoutant l'utilisateur actuel comme membre.
Input:
{id}: L'objet de la communauté identifiée par son ID.
Output:
Retourne une réponse JSON contenant les détails de la communauté après l'ajout de l'utilisateur actuel.
Code de statut : 200 (OK)
Format de la réponse : JSON
Groups appliqués : 'community:read-all'

Quitter une communauté
Route: /api/community/{id}/leave
Méthode HTTP: DELETE
Description:
Quitte la communauté spécifiée par son ID en retirant l'utilisateur actuel des membres.
Input:
{id}: L'objet de la communauté identifiée par son ID.
Output:
Retourne une réponse JSON indiquant si l'utilisateur a quitté avec succès la communauté.
Code de statut : 200 (OK)
Format de la réponse : JSON

Éditer les détails d'une communauté
Route: /api/community/{id}/edit
Méthode HTTP: PATCH
Description:
Édite les détails de la communauté spécifiée par son ID en utilisant les données JSON fournies dans la requête.
Input:
{id}: L'objet de la communauté identifiée par son ID.
{
   "name":"name of community update"
}

Output:
Retourne une réponse JSON contenant les détails mis à jour de la communauté.
Code de statut : 200 (OK)
Format de la réponse : JSON
Groups appliqués : 'community:read-all'

Supprimer une communauté
Route: /api/community/{id}/delete
Méthode HTTP: DELETE
Description:
Supprime la communauté spécifiée par son ID, uniquement si l'utilisateur actuel est l'auteur de la communauté.
Input:
{id}: L'objet de la communauté identifiée par son ID.
Output:
Retourne une réponse JSON indiquant si la communauté a été supprimée avec succès.
Code de statut : 200 (OK)
Format de la réponse : JSON

