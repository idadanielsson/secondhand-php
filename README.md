# secondhand-php

För att bygga secondhand-butiken har php och PHPMyAdmin använts. Projektet är byggt med REST API för att visa samt addera säljare produkter och det outputas i JSON.

Installation:
Klona git-repo:

Använd exempelvis Postman för GET/POST/PUT

GET:
Hämta alla säljare:
/sellers

Hämta en säljare med produkter:
/sellers-id&id={id}

POST:
Lägga till säljare:
/add-seller

{
"firstname":string,
"lastname":string,
"email_address":string
}

Lägga till en produkt:
/add-product

{
"name": string,
"price": int,
"description": string,
"seller_id": int,
"category_id": int,
"size_id": int
}

PUT:
Markera produkt som såld:
/update-product

{
"id":int
}
