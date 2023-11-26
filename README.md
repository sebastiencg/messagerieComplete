# Community API

## Obtenir toutes les communautés

### Endpoint
```
/api/community/all
```

### Méthode HTTP
```
GET
```

### Description
Récupère toutes les communautés en renvoyant les données au format JSON.

### Input
Aucun (No input required)

### Output
Retourne une réponse JSON contenant toutes les communautés.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Obtenir les communautés de l'utilisateur actuel

### Endpoint
```
/api/community/
```

### Méthode HTTP
```
GET
```

### Description
Récupère les communautés associées au profil de l'utilisateur actuel (connecté) en renvoyant les données au format JSON.

### Input
Aucun (No input required)

### Output
Retourne une réponse JSON contenant les communautés associées au profil de l'utilisateur actuel.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Créer une nouvelle communauté

### Endpoint
```
/api/community/create
```

### Méthode HTTP
```
POST
```

### Description
Crée une nouvelle communauté en utilisant les données JSON fournies dans la requête.

### Input
```json
{
   "name":"name of community"
}
```

### Output
Retourne une réponse JSON contenant les détails de la nouvelle communauté créée.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'community:read-all'

## Obtenir les détails d'une communauté spécifique

### Endpoint
```
/api/community/{id}
```

### Méthode HTTP
```
GET
```

### Description
Récupère les détails de la communauté spécifiée par son ID en renvoyant les données au format JSON.

### Input
`{id}`: L'objet de la communauté identifiée par son ID.

### Output
Retourne une réponse JSON contenant les détails de la communauté spécifiée.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Rejoindre une communauté

### Endpoint
```
/api/community/{id}/join
```

### Méthode HTTP
```
GET
```

### Description
Rejoint la communauté spécifiée par son ID en ajoutant l'utilisateur actuel comme membre.

### Input
`{id}`: L'objet de la communauté identifiée par son ID.

### Output
Retourne une réponse JSON contenant les détails de la communauté après l'ajout de l'utilisateur actuel.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Quitter une communauté

### Endpoint
```
/api/community/{id}/leave
```

### Méthode HTTP
```
DELETE
```

### Description
Quitte la communauté spécifiée par son ID en retirant l'utilisateur actuel des membres.

### Input
`{id}`: L'objet de la communauté identifiée par son ID.

### Output
Retourne une réponse JSON indiquant si l'utilisateur a quitté avec succès la communauté.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
  # Éditer les détails d'une communauté

### Endpoint
```
/api/community/{id}/edit
```

### Méthode HTTP
```
PATCH
```

### Description
Édite les détails de la communauté spécifiée par son ID en utilisant les données JSON fournies dans la requête.

### Input
`{id}`: L'objet de la communauté identifiée par son ID.
```json
{
   "name":"name of community update"
}
```

### Output
Retourne une réponse JSON contenant les détails mis à jour de la communauté.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

# Supprimer une communauté

### Endpoint
```
/api/community/{id}/delete
```

### Méthode HTTP
```
DELETE
```

### Description
Supprime la communauté spécifiée par son ID, uniquement si l'utilisateur actuel est l'auteur de la communauté.

### Input
`{id}`: L'objet de la communauté identifiée par son ID.

### Output
Retourne une réponse JSON indiquant si la communauté a été supprimée avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

---

# Obtenir les messages d'une communauté

### Endpoint
```
/api/community/{id}/messages
```

### Méthode HTTP
```
GET
```

### Description
Récupère les messages de la communauté spécifiée par son ID en renvoyant les données au format JSON.

### Input
`{id}`: L'objet de la communauté identifiée par son ID.

### Output
Retourne une réponse JSON contenant les messages de la communauté.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

# Supprimer un message d'une communauté

### Endpoint
```
/api/community/{communityId}/message/{messageId}/delete
```

### Méthode HTTP
```
DELETE
```

### Description
Supprime le message spécifié par son ID dans la communauté spécifiée par son ID, uniquement si l'utilisateur actuel est l'auteur du message.

### Input
- `{communityId}`: L'objet de la communauté identifiée par son ID.
- `{messageId}`: L'objet message identifié par son ID.

### Output
Retourne une réponse JSON indiquant si le message a été supprimé avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

# Créer un message dans une communauté

### Endpoint
```
/api/community/{id}/message/create
```

### Méthode HTTP
```
POST
```

### Description
Crée un nouveau message dans la communauté spécifiée par son ID en utilisant les données JSON fournies dans la requête.

### Input
- `{id}`: L'objet de la communauté identifiée par son ID.
```json
{
   "content":"content here"
}
```

### Output
Retourne une réponse JSON contenant les détails du nouveau message créé.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

# Mettre à jour un message dans une communauté

### Endpoint
```
/api/community/{id}/message/update
```

### Méthode HTTP
```
PATCH
```

### Description
Met à jour le contenu d'un message dans la communauté spécifiée par son ID, uniquement si l'utilisateur actuel est l'auteur du message.

### Input
- `{id}`: L'objet de la communauté identifiée par son ID.
```json
{
   "id":"id message update"
   "content":"content update here"
}
```

### Output
Retourne une réponse JSON contenant les détails du message mis à jour.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
# Gestion des Groupes

## Obtenir tous les groupes

### Endpoint
```
/api/group/
```

### Méthode HTTP
```
GET
```

### Description
Récupère tous les groupes associés au profil de l'utilisateur actuel (connecté) en renvoyant les données au format JSON.

### Input
Aucun (No input required)

### Output
Retourne une réponse JSON contenant tous les groupes associés au profil de l'utilisateur actuel.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Créer un nouveau groupe

### Endpoint
```
/api/group/new
```

### Méthode HTTP
```
POST
```

### Description
Crée un nouveau groupe en utilisant les données JSON fournies dans la requête.

### Input
```json
{
 "name": "Nom du groupe"
}
```

### Output
Retourne une réponse JSON contenant les détails du nouveau groupe créé.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Exclure un membre d'un groupe

### Endpoint
```
/api/group/{id}/member/exclude
```

### Méthode HTTP
```
DELETE
```

### Description
Exclut un membre spécifié du groupe. Seuls les administrateurs du groupe peuvent effectuer cette action.

### Input
`{id}`: L'objet du groupe identifié par son ID.
```json
{
    "id": "ID du profil à exclure"
}
```

### Output
Retourne une réponse JSON indiquant si le membre a été exclu avec succès du groupe.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Promouvoir un membre au statut d'administrateur

### Endpoint
```
/api/group/{id}/member/promote
```

### Méthode HTTP
```
POST
```

### Description
Promeut un membre spécifié au statut d'administrateur dans le groupe. Seuls les administrateurs du groupe peuvent effectuer cette action.

### Input
`{id}`: L'objet du groupe identifié par son ID.
```json
{
    "id": "ID du profil à promouvoir"
}
```

### Output
Retourne une réponse JSON indiquant si le membre a été promu avec succès au statut d'administrateur.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Rétrograder un administrateur au statut de membre

### Endpoint
```
/api/group/{id}/member/demote
```

### Méthode HTTP
```
POST
```

### Description
Rétrograde un administrateur spécifié au statut de membre dans le groupe. Seuls les administrateurs du groupe peuvent effectuer cette action.

### Input
`{id}`: L'objet du groupe identifié par son ID.
```json
{
    "id": "ID du profil à rétrograder"
}
```

### Output
Retourne une réponse JSON indiquant si l'administrateur a été rétrogradé avec succès au statut de membre.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Obtenir les détails d'un groupe spécifique

### Endpoint
```
/api/group/{id}
```

### Méthode HTTP
```
GET
```

### Description
Récupère les détails du groupe spécifié par son ID en renvoyant les données au format JSON.

### Input
`{id}`: L'objet du groupe identifié par son ID.

### Output
Retourne une réponse JSON contenant les détails du groupe spécifié.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'group:read-all'

## Éditer les détails d'un groupe

### Endpoint
```
/api/group/{id}/edit
```

### Méthode HTTP
```
PATCH
```

### Description
Édite les détails du groupe spécifié par son ID en utilisant les données JSON fournies dans la requête. Seul l'auteur du groupe peut effectuer cette action.

### Input
`{id}`: L'objet du groupe identifié par son ID.
```json
{
 "name": "Nom du groupe"
}
```

### Output
Retourne une réponse JSON contenant les détails mis à jour du groupe.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'group:read-all'

## Supprimer un groupe

### Endpoint
```
/api/group/{id}/delete
```

### Méthode HTTP
```
DELETE
```

### Description
Supprime le groupe spécifié par son ID, uniquement si l'utilisateur actuel est l'auteur du groupe.

### Input
`{id}`: L'objet du groupe identifié par son ID.

### Output
Retourne une réponse JSON indiquant si le groupe a été supprimé avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
# Gestion des Messages dans un Groupe

## Obtenir tous les messages d'un groupe

### Endpoint
```
/api/group/{id}/messages
```

### Méthode HTTP
```
GET
```

### Description
Récupère tous les messages associés au groupe spécifié par son ID en renvoyant les données au format JSON.

### Input
`{id}`: L'objet du groupe identifié par son ID.

### Output
Retourne une réponse JSON contenant tous les messages du groupe.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'GroupMessage:read-message'

## Supprimer un ou plusieurs messages d'un groupe

### Endpoint
```
/api/group/{id}/message/delete
```

### Méthode HTTP
```
DELETE
```

### Description
Supprime un ou plusieurs messages spécifiés par leur ID dans le groupe. Seul l'auteur du message peut effectuer cette action.

### Input
`{id}`: L'objet du groupe identifié par son ID.

```json
[
	{"message": "id du message a supprimer"},
	{"message": "id du message a supprimer"},
]
```

### Output
Retourne une réponse JSON indiquant si les messages ont été supprimés avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Créer un nouveau message dans un groupe

### Endpoint
```
/api/group/{id}/message/create
```

### Méthode HTTP
```
POST
```

### Description
Crée un nouveau message dans le groupe spécifié par son ID en utilisant les données JSON fournies dans la requête.

### Input
`{id}`: L'objet du groupe identifié par son ID.

```json
{
 "content": "Contenu du message"
}
```

### Output
Retourne une réponse JSON contenant les détails du nouveau message créé.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'GroupMessage:read-message'

## Mettre à jour le contenu d'un message dans un groupe

### Endpoint
```
/api/group/{id}/message/update
```

### Méthode HTTP
```
PATCH
```

### Description
Met à jour le contenu d'un message spécifié par son ID dans le groupe. Seul l'auteur du message peut effectuer cette action.

### Input
`{id}`: L'objet du groupe identifié par son ID.

```json
{
 "id": "id du message a update",
 "content": "Nouveau contenu du message"
}
```

### Output
Retourne une réponse JSON contenant les détails mis à jour du message.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'GroupMessage:read-message'
# Gestion des Réponses à un Message de Groupe

## Obtenir toutes les réponses à un message de groupe

### Endpoint
```
/api/group/{groupId}/message/{messageId}/
```

### Méthode HTTP
```
GET
```

### Description
Récupère toutes les réponses associées à un message de groupe spécifié par son ID en renvoyant les données au format JSON.

### Input
- `{groupId}`: L'objet du groupe identifié par son ID.
- `{messageId}`: L'objet du message identifié par son ID.

### Output
Retourne une réponse JSON contenant toutes les réponses au message de groupe.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'responseMessage:all-response'

## Créer une nouvelle réponse à un message de groupe

### Endpoint
```
/api/group/{groupId}/message/{messageId}/response/create
```

### Méthode HTTP
```
POST
```

### Description
Crée une nouvelle réponse au message de groupe spécifié par son ID en utilisant les données JSON fournies dans la requête.

### Input
- `{groupId}`: L'objet du groupe identifié par son ID.
- `{messageId}`: L'objet du message identifié par son ID.

```json
{
 "content": "Contenu de la réponse"
}
```

### Output
Retourne une réponse JSON contenant les détails de la nouvelle réponse créée.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'responseMessage:read-response'

## Mettre à jour le contenu d'une réponse à un message de groupe

### Endpoint
```
/api/group/{groupId}/message/{messageId}/response/{responseId}/update
```

### Méthode HTTP
```
POST
```

### Description
Met à jour le contenu d'une réponse spécifiée par son ID au message de groupe. Seul l'auteur de la réponse peut effectuer cette action.

### Input
- `{groupId}`: L'objet du groupe identifié par son ID.
- `{messageId}`: L'objet du message identifié par son ID.

```json
{
 "content": "Nouveau contenu de la réponse"
}
```

### Output
Retourne une réponse JSON contenant les détails mis à jour de la réponse.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'responseMessage:read-response'

## Supprimer une réponse à un message de groupe

### Endpoint
```
/api/group/{groupId}/message/{messageId}/response/{responseId}/delete
```

### Méthode HTTP
```
DELETE
```

### Description
Supprime une réponse spécifiée par son ID au message de groupe. Seul l'auteur de la réponse peut effectuer cette action.

### Input
- `{groupId}`: L'objet du groupe identifié par son ID.
- `{messageId}`: L'objet du message identifié par son ID.
- `{responseId}`: L'objet de la réponse identifié par son ID.

### Output
Retourne une réponse JSON indiquant si la réponse a été supprimée avec succès.
- Code de statut : 403 (Forbidden) si l'utilisateur n'est pas l'auteur de la réponse.
- Format de la réponse : JSON
# Gestion des Invitations de Groupes

## Obtenir toutes les invitations de groupes pour l'utilisateur actuel

### Endpoint
```
/api/invitation/
```

### Méthode HTTP
```
GET
```

### Description
Récupère toutes les invitations de groupes associées au profil de l'utilisateur actuel (connecté) en renvoyant les données au format JSON.

### Input
Aucun (No input required)

### Output
Retourne une réponse JSON contenant toutes les invitations de groupes.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'invitation:read-all'

## Créer de nouvelles invitations pour un groupe spécifique

### Endpoint
```
/api/invitation/create/group/{id}/
```

### Méthode HTTP
```
POST
```

### Description
Crée de nouvelles invitations pour un groupe spécifié par son ID en utilisant les données JSON fournies dans la requête.

### Input
- `{id}`: L'objet du groupe identifié par son ID.

```json
[
 { "profile": 1 },
 { "profile": 2 },
 ...
]
```

### Output
Retourne une réponse JSON indiquant si les invitations ont été envoyées avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Refuser une invitation

### Endpoint
```
/api/invitation/{id}/denied
```

### Méthode HTTP
```
DELETE
```

### Description
Refuse une invitation spécifiée par son ID. L'invitation ne peut être refusée que par le destinataire ou si elle n'est pas encore validée.

### Input
- `{id}`: L'objet de l’invitation identifiée par son ID.

### Output
Retourne une réponse JSON indiquant si l'invitation a été refusée avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Accepter une invitation

### Endpoint
```
/api/invitation/{id}/accepted
```

### Méthode HTTP
```
GET
```

### Description
Accepte une invitation spécifiée par son ID. L'invitation ne peut être acceptée que par le destinataire ou si elle n'est pas encore validée.

### Input
- `{id}`: L'objet de l’invitation identifiée par son ID.

### Output
Retourne une réponse JSON indiquant si l'invitation a été acceptée avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
# Gestion des Relations

## Obtenir toutes les relations de l'utilisateur actuel

### Endpoint
```
/api/relation/
```

### Méthode HTTP
```
GET
```

### Description
Récupère toutes les relations associées au profil de l'utilisateur actuel (connecté) en renvoyant les données au format JSON.

### Input
Aucun (No input required)

### Output
Retourne une réponse JSON contenant toutes les relations.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'relation:read-onlyRelation'

## Nouvelle demande d'amitié

### Endpoint
```
/api/relation/new/{id}
```

### Méthode HTTP
```
GET et POST
```

### Description
Crée une nouvelle demande d'amitié entre l'utilisateur actuel et un autre profil spécifié par son ID.

### Input
- `{id}`: L'objet du profile identifié par son ID.

### Output
Retourne une réponse JSON indiquant si la demande d'amitié a été envoyée avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Demande d'amitié reçue

### Endpoint
```
/api/relation/requestReceived/
```

### Méthode HTTP
```
GET
```

### Description
Récupère toutes les demandes d'amitié reçues par l'utilisateur actuel en renvoyant les données au format JSON.

### Input
Aucun (No input required)

### Output
Retourne une réponse JSON contenant toutes les demandes d'amitié reçues.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'relation:read-one'

## Demandes d'amitié envoyées

### Endpoint
```
/api/relation/requestSend/
```

### Méthode HTTP
```
GET
```

### Description
Récupère toutes les demandes d'amitié envoyées par l'utilisateur actuel en renvoyant les données au format JSON.

### Input
Aucun (No input required)

### Output
Retourne une réponse JSON contenant toutes les demandes d'amitié envoyées.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'relation:read-one'

## Accepter une demande d'amitié

### Endpoint
```
/api/relation/request/valid/{id}
```

### Méthode HTTP
```
GET
```

### Description
Accepte une demande d'amitié spécifiée par l'ID du profil. La demande d'amitié doit être en attente.

### Input
- `{id}`: L'objet du profile identifié par son ID.

### Output
Retourne une réponse JSON indiquant si la demande d'amitié a été acceptée avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## Refuser une demande d'amitié

### Endpoint
```
/api/relation/request/refuse/{id}
```

### Méthode HTTP
```
GET
```

### Description
Refuse une demande d'amitié spécifiée par l'ID du profil. La demande d'amitié doit être en attente.

### Input
- `{id}`: L'objet du profile identifié par son ID.

### Output
Retourne une réponse JSON indiquant si la demande d'amitié a été refusée avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON

## supprimer une relation (unfriend)

### Endpoint
```
/api/relation/denied/{id}
```

### Méthode HTTP
```
DELETE
```

### Description
supprime une relation spécifiée par l'ID du profil.

### Input
- `{id}`: L'objet du profile identifié par son ID.

### Output
Retourne une réponse JSON indiquant si la relation a été refusée avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
# Gestion des Messages Privés

## Obtenir tous les messages privés entre l'utilisateur actuel et un autre profil

### Endpoint
```
/api/message/profile/{id}
```

### Méthode HTTP
```
GET
```

### Description
Récupère tous les messages privés entre l'utilisateur actuel (l'auteur) et un autre profil spécifié par son ID (le destinataire).

### Input
- `{id}`: L'objet du profile identifié par son ID.

### Output
Retourne une réponse JSON contenant tous les messages privés entre l'utilisateur actuel et le profil spécifié.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'privateMessage:read-message'

## Obtenir un message privé spécifique

### Endpoint
```
/api/message/{id}
```

### Méthode HTTP
```
GET
```

### Description
Récupère un message privé spécifique par son ID.

### Input
- `{id}`: L'objet du message identifié par son ID.

### Output
Retourne une réponse JSON contenant le message privé spécifié.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'privateMessage:read-message'

## Créer un nouveau message privé

### Endpoint
```
/api/message/create/{id}
```

### Méthode HTTP
```
POST
```

### Description
Crée un nouveau message privé entre l'utilisateur actuel et un autre profil spécifié par son ID.

### Input
- `{id}`: L'objet du profile identifié par son ID.
- `{
  "content": "text",
  "associatedImages": "id de l'image associée (optionnel)"
}`

### Output
Retourne une réponse JSON indiquant si le message privé a été créé avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'privateMessage:read-message'

## Supprimer un message privé

### Endpoint
```
/api/message/delete/{id}
```

### Méthode HTTP
```
DELETE
```

### Description
Supprime un message privé spécifié par son ID.

### Input
- `{id}`: L'objet du message identifié par son ID.

### Output
Retourne une réponse JSON indiquant si le message privé a été supprimé avec succès.
- Code de statut : 200 (OK)

## Mettre à jour un message privé

### Endpoint
```
/api/message/update/{id}
```

### Méthode HTTP
```
PATCH
```

### Description
Met à jour un message privé spécifié par son ID.

### Input
- `{id}`: L'objet du message identifié par son ID.
- `{
  "content": "text"
}`

### Output
Retourne une réponse JSON indiquant si le message privé a été mis à jour avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'privateMessage:read-message'
# Gestion des Conversations

## Créer une nouvelle conversation

### Endpoint
```
/api/conversation/create
```

### Méthode HTTP
```
GET
```

### Description
Crée une nouvelle conversation avec l'auteur actuel (l'utilisateur connecté) comme l'auteur de la conversation et le seul membre de la conversation.

### Input
Aucun (No input required)

### Output
Retourne une réponse JSON contenant la nouvelle conversation créée.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'privateMessage:read-message'

## Supprimer une conversation

### Endpoint
```
/api/conversation/{id}/delete
```

### Méthode HTTP
```
DELETE
```

### Description
Supprime une conversation spécifiée par son ID, mais seulement si l'auteur de la conversation est l'utilisateur connecté.

### Input
- `{id}`: L'objet de la conversation identifié par son ID.

### Output
Retourne une réponse JSON indiquant si la conversation a été supprimée avec succès.
- Code de statut : 200 (OK)

## Créer un nouveau message dans une conversation

### Endpoint
```
/api/conversation/{id}/message/create
```

### Méthode HTTP
```
POST
```

### Description
Crée un nouveau message dans une conversation spécifiée par son ID.

### Input
- `{id}`: L'objet de la conversation identifié par son ID.
- `{
  "content": "text"
}`

### Output
Retourne une réponse JSON indiquant si le message a été créé avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'privateMessage:read-message'

## Supprimer un ou plusieurs messages dans une conversation

### Endpoint
```
/api/conversation/{id}/message/delete
```

### Méthode HTTP
```
DELETE
```

### Description
Supprime un ou plusieurs messages dans une conversation spécifiée par son ID.

### Input
- `{id}`: L'objet de la conversation identifié par son ID.
- `[
  {"id": "id message"}
]`

### Output
Retourne une réponse JSON indiquant si les messages ont été supprimés avec succès.
- Code de statut : 200 (OK)

## Mettre à jour un message dans une conversation

### Endpoint
```
/api/conversation/{id}/message/update
```

### Méthode HTTP
```
PATCH
```

### Description
Met à jour un message dans une conversation spécifiée par son ID.

### Input
- `{id}`: L'objet de la conversation identifié par son ID.
- `{
  "id": "id message",
  "content": "text update"
}`

### Output
Retourne une réponse JSON indiquant si le message a été mis à jour avec succès.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'privateMessage:read-message'

## Obtenir tous les messages d'une conversation

### Endpoint
```
/api/conversation/{id}/messages
```

### Méthode HTTP
```
GET
```

### Description
Récupère tous les messages d'une conversation spécifiée par son ID.

### Input
- `{id}`: L'objet de la conversation identifié par son ID.

### Output
Retourne une réponse JSON contenant tous les messages de la conversation.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'privateMessage:read-message'

## Ajouter des profils à une conversation

### Endpoint
```
/api/conversation/{id}/add
```

### Méthode HTTP
```
POST
```

### Description
Ajoute un ou plusieurs profils à une conversation spécifiée par son ID, mais seulement si l'auteur de la conversation est l'utilisateur connecté.

### Input
- `{id}`: L'objet de la conversation identifié par son ID.
- `[
  {"profile": "id profile"}
]`

### Output
Retourne une réponse JSON indiquant si les profils ont été ajoutés avec succès à la conversation.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'conversation:read-conversation'

## Supprimer des profils d'une conversation

### Endpoint
```
/api/conversation/{id}/remove
```

### Méthode HTTP
```
DELETE
```

### Description
Supprime un ou plusieurs profils d'une conversation spécifiée par son ID, mais seulement si l'auteur de la conversation est l'utilisateur connecté.

### Input
- `{id}`: L'objet de la conversation identifié par son ID.
- `[
  {"profile": "id profile"}
]`

### Output
Retourne une réponse JSON indiquant si les profils ont été supprimés avec succès de la conversation.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'conversation:read-conversation'

## Obtenir tous les messages d'une conversation avec des URLs d'images

### Endpoint
```
/api/conversation/{id}/
```

### Méthode HTTP
```
GET
```

### Description
Récupère tous les messages d'une conversation spécifiée par son ID avec des URLs d'images générées.

### Input
- `{id}`: L'objet de la conversation identifié par son ID.

### Output
Retourne une réponse JSON contenant tous les messages de la conversation avec des URLs d'images.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'privateMessage:read-message'
# Gestion des Profils et des Images

## Obtenir le profil de l'utilisateur connecté

### Endpoint
```
/api/profile
```

### Méthode HTTP
```
GET
```

### Description
Récupère le profil de l'utilisateur connecté.

### Input
Aucun.

### Output
Retourne une réponse JSON contenant le profil de l'utilisateur connecté.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'profile:read-all'

## Mettre à jour le profil de l'utilisateur connecté

### Endpoint
```
/api/profile/update
```

### Méthode HTTP
```
PATCH
```

### Description
Met à jour le profil de l'utilisateur connecté avec les informations fournies.

### Input
```
{
  "username": "new username"
}
```

### Output
Retourne une réponse JSON contenant le profil mis à jour de l'utilisateur connecté.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'profile:read-all'

## Obtenir tous les profils visibles

### Endpoint
```
/api/profile/allProfile
```

### Méthode HTTP
```
GET
```

### Description
Récupère tous les profils dont la visibilité est définie sur true.

### Input
Aucun.

### Output
Retourne une réponse JSON contenant tous les profils dont la visibilité est true.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'relation:read-one'

## Rechercher des profils par nom d'utilisateur

### Endpoint
```
/api/profile/searchProfile
```

### Méthode HTTP
```
POST
```

### Description
Recherche des profils par nom d'utilisateur.

### Input
```
{
  "username": "new username"
}
```

### Output
Retourne une réponse JSON contenant les profils correspondant à la recherche par nom d'utilisateur.
- Code de statut : 200 (OK)
- Format de la réponse : JSON
- Groups appliqués : 'profile:read-one'

## Télécharger une image

### Endpoint
```
/api/image/upload
```

### Méthode HTTP
```
POST
```

### Description
Permet à l'utilisateur de télécharger une image. L'image est associée à l'auteur (profil) de l'utilisateur connecté.

### Input
image

### Output
Retourne une réponse JSON indiquant le succès du téléchargement.
- Contient le message "Bravo pour ton upload, tu peux maintenant ajouter ton message" et l'identifiant de l'image téléchargée (idImage).
- Code de statut : 200 (OK)
- Format de la réponse : JSON
### Gestion des utilisateurs

25. **Obtenir un token (login)**
    - Route : `/api/login_check`
    - Méthode HTTP : POST
    - Description : Cette route est utilisée pour authentifier un utilisateur en vérifiant les informations de connexion fournies. Lorsqu'un utilisateur tente de se connecter à l'application, les identifiants (email et mot de passe) sont envoyés au serveur via cette route. Le serveur vérifie ensuite ces informations par rapport à sa base de données d'utilisateurs.
    - Exemple de corps de requête au format JSON :
    - `{
  "email": "email","password": "password"
}`

26. **Obtenir un token rafraichi**
    - Route : `/api/token/refresh`
    - Méthode HTTP : POST
    - Description : Description : Cette route permet à un utilisateur de demander le rafraîchissement de son jeton d'authentification. Les jetons d'authentification sont utilisés pour maintenir la session de l'utilisateur actif et sécurisée. Lorsqu'un utilisateur se connecte à l'application, il reçoit un jeton d'accès (access token) qui a une durée de validité limitée. Le jeton d'actualisation (refresh token) est utilisé pour obtenir un nouveau jeton d'accès une fois que le jeton actuel a expiré.
    - Exemple de corps de requête au format JSON :
    - `{
  "token": "token refresh"
}`
   
27. **creer un utilisateur**
    - Route : `/register`
    - Méthode HTTP : POST
    - Description : Cette route est utilisée pour creer un utilisateur.
    - Exemple de corps de requête au format JSON :
    - `{
  "email": "email","password": "password"
}`
