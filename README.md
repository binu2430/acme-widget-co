# Acme Widget Co

## Setup

1. Clone the repository.
2. Run `docker-compose up` to start the application.
3. Run tests using `docker-compose exec app vendor/bin/phpunit`.

## Assumptions

- The product catalogue, delivery rules, and offers are hardcoded for simplicity.
- The basket service is designed to be stateless for each request.
