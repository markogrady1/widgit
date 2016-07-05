# widgit.js
##### Library that provides small GitHub widgets to display various GitHub information directly into your website.
- Enter the correct path to the widget.js file.



####The repo list widget.

```php
<?php
  use Widgit\Lib\Plugin;
  
  //simply provide your username and the amount of repositories your wish to display
  $widget = new Plugin("markogrady1", 10);
  echo $widget->getData(true);
?>
```
This will result in the following widget.

![checkmark]( https://github.com/markogrady1/widgit.js/raw/master/demo-assets/repo2.png)


***NOTE: More widgets are on their way.***
