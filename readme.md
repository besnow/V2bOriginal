<img src="https://avatars.githubusercontent.com/u/56885001?s=200&v=4" alt="logo" width="130" height="130" align="right"/>

# **V2Board**

- PHP7.3+
- Composer
- MySQL5.5+
- Redis
- Laravel
- 原版DEV版本号:31c5cf1c2b404ddf8ae4fbf743182524f3869f64


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


## V2Board_Tutorial

<h1 id="使用aapanel手动部署" tabindex="-1">使用aaPanel手动部署 <a class="header-anchor" href="#使用aapanel手动部署" aria-hidden="true">#</a></h1><p>aaPanel是宝塔(<a href="http://bt.cn" target="_blank" rel="noreferrer">bt.cn</a>)的国际版本</p><h2 id="_1-配置aapanel" tabindex="-1">1.配置aaPanel <a class="header-anchor" href="#_1-配置aapanel" aria-hidden="true">#</a></h2><p>你需要在 <a href="https://forum.aapanel.com/d/9-aapanel-linux-panel-6-5-4-installation-tutorial" target="_blank" rel="noreferrer">aaPanel</a> 选择你的系统获得安装方式。这里以 CentOS 7+ 作为系统环境进行安装。</p><p>请务必使用 <strong>CentOS 7+</strong> 安装aaPanel，其他系统可能会有未知问题。</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki"><code><span class="line"><span style="color:#A6ACCD;">// 最新脚本可以在aaPanel官网获取</span></span>
<span class="line"><span style="color:#A6ACCD;">yum install -y wget </span><span style="color:#89DDFF;">&amp;&amp;</span><span style="color:#A6ACCD;"> wget -O install.sh http://www.aapanel.com/script/install_6.0_en.sh </span><span style="color:#89DDFF;">&amp;&amp;</span><span style="color:#A6ACCD;"> bash install.sh</span></span>
<span class="line"></span></code></pre></div><p>安装完成后我们登陆 aaPanel 进行环境的安装。</p><p>选择使用LNMP的环境安装方式勾选如下信息</p><p>☑️ Nginx 1.17<br> ☑️ MySQL 5.6<br> ☑️ PHP 7.4</p><p>选择 Fast 快速编译后进行安装。</p><h2 id="_2-安装redis、fileinfo" tabindex="-1">2.安装Redis、fileinfo <a class="header-anchor" href="#_2-安装redis、fileinfo" aria-hidden="true">#</a></h2><p>aaPanel 面板 &gt; App Store &gt; 找到PHP 7.4点击Setting &gt; Install extentions &gt; redis,fileinfo 进行安装。</p><h2 id="_3-解除被禁止的函数" tabindex="-1">3.解除被禁止的函数 <a class="header-anchor" href="#_3-解除被禁止的函数" aria-hidden="true">#</a></h2><p>aaPanel 面板 &gt; App Store &gt; 找到PHP 7.4点击Setting &gt; Disabled functions 将 <code>putenv</code> <code>proc_open</code> <code>pcntl_alarm</code> <code>pcntl_signal</code> 从列表中删除。</p><h2 id="_4-添加站点" tabindex="-1">4.添加站点 <a class="header-anchor" href="#_4-添加站点" aria-hidden="true">#</a></h2><p>aaPanel 面板 &gt; Website &gt; Add site。</p><blockquote><p>在 Domain 填入你指向服务器的域名<br> 在 Database 选择MySQL<br> 在 PHP Verison 选择PHP-74</p></blockquote><h2 id="_5-安装v2board" tabindex="-1">5.安装V2Board <a class="header-anchor" href="#_5-安装v2board" aria-hidden="true">#</a></h2><p>通过SSH登录到服务器后访问站点路径如：/www/wwwroot/你的站点域名。</p><p>以下命令都需要在站点目录进行执行。</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki"><code><span class="line"><span style="color:#676E95;"># 删除目录下文件</span></span>
<span class="line"><span style="color:#A6ACCD;">chattr -i .user.ini</span></span>
<span class="line"><span style="color:#A6ACCD;">rm -rf .htaccess 404.html index.html .user.ini</span></span>
<span class="line"></span></code></pre></div><p>执行命令从 Github 克隆到当前目录。</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki"><code><span class="line"><span style="color:#A6ACCD;">git clone https://github.com/v2board/v2board.git ./</span></span>
<span class="line"></span></code></pre></div><p>执行命令安装依赖包以及V2board</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki"><code><span class="line"><span style="color:#A6ACCD;">sh init.sh</span></span>
<span class="line"></span></code></pre></div><p>根据提示完成安装</p><h2 id="_6-配置站点目录及伪静态" tabindex="-1">6.配置站点目录及伪静态 <a class="header-anchor" href="#_6-配置站点目录及伪静态" aria-hidden="true">#</a></h2><p>添加完成后编辑添加的站点 &gt; Site directory &gt; Running directory 选择 /public 保存。</p><p>添加完成后编辑添加的站点 &gt; URL rewrite 填入伪静态信息。</p><div class="language-"><button title="Copy Code" class="copy"></button><span class="lang"></span><pre class="shiki"><code><span class="line"><span style="color:#A6ACCD;">location /downloads {</span></span>
<span class="line"><span style="color:#A6ACCD;">}</span></span>
<span class="line"><span style="color:#A6ACCD;"></span></span>
<span class="line"><span style="color:#A6ACCD;">location / {  </span></span>
<span class="line"><span style="color:#A6ACCD;">    try_files $uri $uri/ /index.php$is_args$query_string;  </span></span>
<span class="line"><span style="color:#A6ACCD;">}</span></span>
<span class="line"><span style="color:#A6ACCD;"></span></span>
<span class="line"><span style="color:#A6ACCD;">location ~ .*\.(js|css)?$</span></span>
<span class="line"><span style="color:#A6ACCD;">{</span></span>
<span class="line"><span style="color:#A6ACCD;">    expires      1h;</span></span>
<span class="line"><span style="color:#A6ACCD;">    error_log off;</span></span>
<span class="line"><span style="color:#A6ACCD;">    access_log /dev/null; </span></span>
<span class="line"><span style="color:#A6ACCD;">}</span></span>
<span class="line"><span style="color:#A6ACCD;"></span></span></code></pre></div><h2 id="_7-配置定时任务" tabindex="-1">7.配置定时任务 <a class="header-anchor" href="#_7-配置定时任务" aria-hidden="true">#</a></h2><p>aaPanel 面板 &gt; Cron。</p><blockquote><p>在 Type of Task 选择 Shell Script<br> 在 Name of Task 填写 v2board<br> 在 Period 选择 N Minutes 1 Minute<br> 在 Script content 填写 php /www/wwwroot/路径/artisan schedule:run</p></blockquote><p>根据上述信息添加每1分钟执行一次的定时任务。</p><h2 id="_8-启动队列服务" tabindex="-1">8.启动队列服务 <a class="header-anchor" href="#_8-启动队列服务" aria-hidden="true">#</a></h2><p>V2board的系统强依赖队列服务，正常使用V2Board必须启动队列服务。下面以aaPanel中supervisor服务来守护队列服务作为演示。</p><p>aaPanel 面板 &gt; App Store &gt; Tools</p><p>找到Supervisor进行安装，安装完成后点击<code>设置 &gt; Add Daemon</code>按照如下填写</p><blockquote><p>在 Name 填写 V2board<br> 在 Run User 选择 www<br> 在 Run Dir 选择 站点目录 在 Start Command 填写 php artisan horizon 在 Processes 填写 1</p></blockquote><p>填写后点击Confirm添加即可运行。</p><h3 id="常见问题" tabindex="-1">常见问题 <a class="header-anchor" href="#常见问题" aria-hidden="true">#</a></h3><p>Q：500错误<br> A：检查站点根目录权限，递归755，保证目录有可写文件的权限，也有可能是Redis扩展没有安装或者Redis没有按照造成的。你可以通过查看storage/logs下的日志来排查错误或者开启debug模式、站点设置中关闭防跨站。</p>

<h1 id="更新升级" tabindex="-1">更新升级 <a class="header-anchor" href="#更新升级" aria-hidden="true">#</a></h1><p>V2Board强依赖git，所以你如果要进行操作请务必是使用git的形式进行部署。</p><h3 id="升级至稳定版" tabindex="-1">升级至稳定版 <a class="header-anchor" href="#升级至稳定版" aria-hidden="true">#</a></h3><p>站点目录下执行</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki"><code><span class="line"><span style="color:#A6ACCD;">sh update.sh</span></span>
<span class="line"></span></code></pre></div><h3 id="升级至开发版" tabindex="-1">升级至开发版 <a class="header-anchor" href="#升级至开发版" aria-hidden="true">#</a></h3><p>请注意升级到开发版本后无法退回，升级前请务必做好备份做事以便回滚</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki"><code><span class="line"><span style="color:#A6ACCD;">sh update_dev.sh</span></span>
<span class="line"></span></code></pre></div><p>⚠️如果有额外要求需要重启队列服务，您可以对您队列服务的守护服务进行重启，例如PM2或Supervisor。</p><h3 id="备份重装" tabindex="-1">备份重装 <a class="header-anchor" href="#备份重装" aria-hidden="true">#</a></h3><p>备份数据库及 config/v2board.php 文件后全新安装v2board恢复文件即可完成重装。</p><h3 id="常见问题" tabindex="-1">常见问题 <a class="header-anchor" href="#常见问题" aria-hidden="true">#</a></h3><p>Q：更新完成后没有变化？<br> A：如果你使用的是CDN请检查清除CDN缓存。</p><p>Q：非git部署如何更新？<br> A：你可以到仓库下载最新版本的代码包全量覆盖更新。覆盖后请务必执行 <strong>php artisan v2board:update</strong></p><p>Q：如何降级？<br> A：降级前必须要有数据库备份，否则将会导致问题。重装指定版本，导入指定版本数据库。</p>

