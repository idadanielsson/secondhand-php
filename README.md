# secondhand-php

För att bygga secondhand-butiken har php och PHPMyAdmin använts. Projektet är byggt med REST API för att visa samt addera säljare och produkter och det outputas i JSON.

# Användning

Använd exempelvis Postman för GET/POST/PUT

## GET:

Hämta alla säljare:
http://localhost:8888/second-hand-shop/?action=sellers

Hämta en säljare med produkter:
http://localhost:8888/second-hand-shop/?action=sellers-id&id={id}

Hämta alla produkter:
http://localhost:8888/second-hand-shop/?action=products

Hämta en produkt:
http://localhost:8888/second-hand-shop/?action=products-id&id={id}

## POST:

I postman välj POST > Body > Raw > JSON

Lägga till säljare:
http://localhost:8888/second-hand-shop/?action=add-seller

{
"firstname":string,
"lastname":string,
"email_address":string
}

Lägga till en produkt:
http://localhost:8888/second-hand-shop/?action=add-product

{
"name": string,
"price": int,
"description": string,
"seller_id": int,
"category_id": int,
"size_id": int
}

## PUT:

I postman välj PUT > Body > Raw > JSON

Markera produkt som såld:
http://localhost:8888/second-hand-shop/?action=update-product

{
"id":int
}
