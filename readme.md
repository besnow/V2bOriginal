<img src="https://avatars.githubusercontent.com/u/56885001?s=200&v=4" alt="logo" width="130" height="130" align="right"/>

# **V2Board**

- PHP7.3+
- Composer
- MySQL5.5+
- Redis
- Laravel


## 原版迁移步骤

按以下步骤进行面板文件迁移：

    git remote set-url origin https://github.com/besnow/v2board  
    git checkout master  
    ./update.sh  


按以下步骤刷新设置缓存，重启队列:

    php artisan config:clear
    php artisan config:cache
    php artisan horizon:terminate

这个命令是用来克隆一个仓库里的默认分支的：

    git clone https://github.com/besnow/v2board.git ./


## Demo
[Demo](https://demo.v2board.com)

## Document
[Click](https://v2board.com)

## Sponsors
Thanks to the open source project license provided by [Jetbrains](https://www.jetbrains.com/)

## Community
🔔Telegram Channel: [@v2board](https://t.me/v2board)  

## How to Feedback
Follow the template in the issue to submit your question correctly, and we will have someone follow up with you.
