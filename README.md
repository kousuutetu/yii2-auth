Yii2 Auth
=========
Yii2 Auth

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist jeff/yii2-auth "*"
```

or add

```
"jeff/yii2-auth": "*"
```

to the require section of your `composer.json` file.


Usage
-----

You need to add this to your application configuration:

```php
'components' => [
    'authManager' => [
        'class' => 'yii\rbac\DbManager',
    ],
],

'modules' => [
    'auth' => [
        'class' => 'Jeff\auth\Module',
    ],
],

php yii migrate --migrationPath=@yii/rbac/migrations/
php yii migrate --migrationPath=@Jeff/auth/migrations/
```
Once the extension is installed, simply use it in your code by  :

```php
if (!\Yii::$app->user->can('/site/dashboard')) {
    throw new \yii\web\UnauthorizedHttpException(Yii::t('app', 'Has not obtained the authorization, please contact with the administrator.'));
}
