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
