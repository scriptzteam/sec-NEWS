# sec-NEWS
sec:NEWS is a popular general-purpose script that is especially suited to make web development faster.

To add some news use the url: 
```yoursite.bla/app/adm/?x=b6504068aef694385c8ae9616878d7a1```

Change app/includes/config.php:  
```CRYPT is used in post_*.txt, so only if CRYPT defined is located in post_*.txt then the post will be loaded, its added to prevent some sort of hacking and loading other files```
```PWD is used in admin panel, so only those who know PWD can access it```
```MOD_REWRITE is used to rewrite url with apache2 mod_rewrite, default is false, so no mod_rewrite```

