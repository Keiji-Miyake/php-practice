# PHPナレッジベース*w

## PHP MD Install

```txt ./composer.json
{
    "require-dev": {
        "phpmd/phpmd" : "@stable"
    }
}
```

## phpmdの実行

```shell
# ./vendor/bin/phpmd sample.php text cleancode,codesize,controversial,design,naming,unusedcode
# ./vendor/bin/phpmd . text cleancode,codesize,controversial,design,naming,unusedcode --suffixes php --exclude vendor
# ./vendor/bin/phpmd . text phpmd.xml --suffixes php --exclude vendor
# composer phpmd
```

## PHPstan

```shell
# vendor/bin/phpstan analyse
# vendor/bin/phpstan analyse -c phpstan.neon
# composer phpstan
```


## PHPUnit

```shell
# composer phpunit
```
