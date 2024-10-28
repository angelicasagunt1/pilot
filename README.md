# CarSale API

## Descripción

CarSale es una pequeña prueba API construida en Symfony que gestiona la venta de autos. 

## Requisitos

- PHP 8.2 o superior
- Composer
- Docker y Docker Compose

## Instalación

1. **Clonar el repositorio:**

   ```bash
   git clone <https://github.com/angelicasagunt1/pilot>
   cd carSale

2. **Construir y levantar los contenedores:**
   ```bash
     docker-compose up -d --build

3. **Instalar las dependencias de PHP::**
   ```bash
    docker-compose exec app php bin/console doctrine:schema:update --force
    docker-compose exec app php bin/console doctrine:fixtures:load
   
## Endpoint
 
**Vender Auto (POST) /api/car/sell**
   ```bash
    {
    "car_id": "1",
    "customer_name": "angelica",
    "price": "3000",
    "installments": "2"
    }
   ```
Errores comunes:

    400 Bad Request: Datos incompletos o auto no disponible.
    500 Internal Server Error: Error inesperado en el servidor.
