
# Zombie Survival Social Network

### API de Criação de sobreviventes
> API desenvolvida para cadastrar os sobreviventes do apocalipse.

####  Criação de sobreviventes
```sh
POST /api/v1/survivors 
Content-Type: application/json
```
Response:
```json
{  "name" : "string", 
   "age" : "number",
   "gender": "char",
   "latitude": "number",
   "longitude": "number",
   "contaminated_count": "number",
   "items": [   
	{ "item_id": "number", "quantity": "number" },
	{ "item_id": "number", "quantity": "number" }
	] }
```

- Expemplo: 

```json

{ "name" : "Otavio Costa Lima", "age" : 23
 , "gender": "M"
 , "latitude":   -22222666
 , "longitude":   43434343
 , "contaminated_count": 0
, "items":   [   
	{ "item_id": 1, "quantity": 3 },
	{ "item_id": 3, "quantity": 1 }
] }
```

### Atualizar localização do sobrevivente
```sh
PUT /api/v1/survivors/{survivor_id} HTTP/1.1
Content-Type: application/json
```
Response:
```json
{  
    "latitude": "number", 
	"longitude": "number" 
}

```
- Expemplo: 

```json

{ 
 , "latitude":   -22222666
 , "longitude":   43434343
}
```


### Notificar infectado

```sh
POST /api/v1/survivors/1/infected HTTP/1.1
Content-Type: application/json
```
Response:
```json
{ "notifier_id": "number" }
```
- Expemplo: 

```json

{ 
  "notifier_id": 1
}
```
#### Uso da API de Relatórios 

### Percentual de sobreviventes infectados e não infectados
```sh
GET /api/v1/reports/survivors?infected={0 ou 1} HTTP/1.1
Content-Type: application/json
```
- Parametros: 
	-  infected: Caso queirar listar o percentual de infectados deve informar 1, mas se preferir listar os não infectados informe 0 ou deixe em sem nada.

Request:
```json
{
  "percentage": "number"
}
```
- Expemplo: 

```json

{
  "percentage": "83.33"
}
```

### Média total por item dos sobreviventes não infectados
```sh
GET /api/v1/reports/resources?agregate=avg HTTP/1.1
Content-Type: application/json
```
- Parametros: 
	-  agregate: Informe avg no paramentro para trazer a média total por items.

Expemplo do Request:
```json
{
  "avg": [
    {
      "description": "água",
      "media": "3.00"
    },
    {
      "description": "medicação",
      "media": "1.33"
    }
  ]
}
```
### Pontos perdidos por causa dos infectados infectados
```sh
GET /api/v1/reports/pointsLost HTTP/1.1
Content-Type: application/json
```
Expemplo do Request:
```json
{
  "lost_points": "16"
}
```



```

#### Mensagens de Retorno da API 

```json
- 200  Ok: "messagem": "Sobrevivente Cadastrado Com Sucesso!"
- 400 Bad Request: 'error': 'Algo deu errado. Confira se as informações estão corretas!'
- 500   Internal server error
```

## Tecnologias Utilizadas
- [Laravel] - Plataforma de desenvolvimento
- [PostgreSQL] - Banco de dados
