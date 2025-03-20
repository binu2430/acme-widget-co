# Acme Widget Co

## Setup

1. Clone the repository.
2. Run `docker-compose up` to start the application.
3. You can access the application at [http://localhost:8000/](http://localhost:8000/).
4. Run tests using `docker-compose exec app vendor/bin/phpunit`.


## Example Test Cases

### 1. **Basic Basket**
   **Products**: 1 Blue Widget (B01) and 1 Green Widget (G01).

   **(http://localhost:8000/basket/total?products[]=B01&products[]=G01)**:
