# sec-NEWS
sec:NEWS is a popular general-purpose script that is especially suited to make web development faster.

sec:NEWS do NOT use MySQL, it pure use plain text as post/news storage, it is fast and secure.

![alt tag](http://i.imgur.com/lwwbFSZ.png)

To add some news use the url: 
http://yoursite.bla/app/adm/?x=b6504068aef694385c8ae9616878d7a1

Change app/includes/config.php:  
CRYPT is used in post_bla.txt, so only if CRYPT defined is located in post_bla.txt then the post will be loaded, its added to prevent some sort of hacking and loading other files.

PWD is used in admin panel, so only those who know PWD can access it.  

MOD_REWRITE is used to rewrite url with apache2 mod_rewrite, default is false, so no mod_rewrite.

