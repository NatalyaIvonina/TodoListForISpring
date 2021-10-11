# Todo List

Тестовое задание в компанию iSpring

Постановка: https://github.com/ispringtech/coding-interview/blob/master/backend/README.md

- PHP 7.3
- Symfony 4.4
- MySQL

## Развертывание
```shell
composer install

symfony serve
```
## Swagger
https://app.swaggerhub.com/apis/NatalyaIvonina/TodoList/1.0.0#/TaskItem

![Image alt](https://github.com/NatalyaIvonina/TodoListForISpring/blob/master/swagger.jpg)

## Тестирование
Тесты лежат в App\Tests\Task
```shell
# migrations
php bin/console doctrine:migrations:migrate

# fixtures
php bin/console doctrine:fixtures:load

# start tests
php ./vendor/bin/phpunit
```

P.S.
- Примерно попыталась показать компонентрый подход, о котором говорила, где контракты, контроллеры, исключения и (в идеале) тесты лежат в одном месте.
- Начала настраивать докер, но не успела. Настраивать приложение из пустого skeleton не так уж и быстро).
- Еще надо как минимум настроить нормальную сериализацию/десериализацию для контрактов и настроить тесты, чтобы были более подбробными (не только по статусу) и обнуление id ключа таблицы при накатывании фикстур.

P.P.S.
- Удаление задач - а, может, они нам еще понадобятся =)
