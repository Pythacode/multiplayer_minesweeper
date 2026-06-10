# WebSocket API

Request data type is always JSON string
Response data type is always JSON string

Error retun paramtres :

- `type` : `"error"`
- `action` : Action of request.
- `message` : Error message

| Command | description | Parametres | Exemple | Responce parametres | 
|---------|-------------|------------|---------|---------------------|
| Reveal | Reveal a case | `action` : `"reveal"`,<br>`x`:int,<br>`y`:int| `{"action":"reveal","x":3,"y":4}` | Error return or <br>`return` : Result of reveal function of game |