# Screenshot
it can make a screenshot  on linux by phantomjs

========
Usage:
        $model = new WebScreenshot();
        $model->webUrl = 'www.baidu.com';
        $model->tempFolder = dirname(__FILE__) ;
        $model->run();

if you want to post some data  can  set postData attributes like this
        $model->postData = 'name=zhangsan&age=16';
======
Notice:
bin/phantomjs need to have permissions

