# WebSocket API

Request data type is always JSON string
Response data type is always JSON string

| Command | description | Parametres | Exemple | Responce parametres | 
|---------|-------------|------------|---------|---------------------|
| Reveal | Reveal a case | `action` : `"reveal"`,<br>`x`:int,<br>`y`:int| `{"action":"reveal","x":3,"y":4}` | `return` : Result of reveal function of game