Lamia API Application
===========================

A PHP Symfony Web Application framework project.


- Setup
 
 	    composer install
 		php bin/console cache:clear
 		php bin/console doctrine:database:create --if-not-exists
 		php bin/console doctrine:schema:drop --force --full-database
 		php bin/console doctrine:schema:update --force
 		php bin/console doctrine:fixtures:load --no-interaction


- Run (Start the app using symfony webserver)

        symfony server:start
        
    Send a json POST request to the api url: http://127.0.0.1:8000/v1/order/create     
        
        {
          "products": [
            {
              "id": 3,
              "quantity": 4
            },
            {
              "id": 15,
              "quantity": 8
            }
          ],
          "country": "FIN",
          "invoiceFormat": "JSON",
          "emailInvoice": true,
          "email": "test@email.com"
        }