# message
A PHP Framework


 ## Tiki 
===============

### Tiki 简单易用，其主要特性包括：

 #### + 自动加载 
 #### + 命名空间
 #### + 支持monolog
 #### + db用medoo封装

### 配置文件用软链生成，先进入config里   
 #### 测试环境 
```
   ln -s ./config.test.php config.php 
```

 #### 线上环境
```
 ln -s ./config.online.php config.php 
```
   
 #### 计划任务方式：  
 ```
    cd cmd   
    php c.php index myCrontTest  
 ```
    
