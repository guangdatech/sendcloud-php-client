## SendCloud client for PHP

### Installation
```
composer require guangda/sendcloud
```

### Example
```
$mailData = [
    'to'=>'yushine999@qq.com',
    'subject'=>'test',
    'plain'=>'mail test'
];
\Guangda\SendCloud\SendCloud::getInstance('apiuser', 'apikey')->setFrom('from@qq.com')->sendMail($mailData);
```
