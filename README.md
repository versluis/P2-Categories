P2 Categories
=============

This is a fork of P2 version 1.5.1 with added category posting (as it was in P2 1.3.3). 

The full process is explained here: http://wpguru.co.uk/2012/04/how-to-bring-back-post-categories-in-p2/

Sometimes the code shown on my site is replaced with weird characters (without my doing mind) so I thought it's benefitial to have a full working project in a remote place. Here it is - enjoy!


What are we doing here?
=======================

By default, P2 allows you to specify if you'd like to post a Status Update, Blog Post, Quote or Link. In all recent versions every post goes into the same category, and instead is assigned a WordPress Post Format. 

In P2 version 1.3.3 and below Post Formats had not been implemented yet, and hence each post would go into a separate category (Status Updates into a Status category, Quotes into a Quotes category, and so forth). It was even possible to define your own categories and turn P2 into something very custom.

This reposiroty here is my attempt at bringing back posting into such categories, even with the latest verison of P2 (1.5.1 at the time of writing).


Installation
============

This entire project is a WordPress theme. Download it and copy all files into a new folder under wp-content/themes. Then head over to Appearance - Themes and activate P2 Categories. It looks and works just like the original P2.


How do P2 Categories work, and how do I use them?
=================================================

For posts to be added to a corresponding category you must first create them. P2 Categories will not create categories if they do not exist, and instead post into the default category just like before. So go and create a "Quotes" category, then your front page quote posts will go into said category. The same goes for Blog Post, Link and Status.


Full Usage Example
==================

Once installed on a fresh WordPress instance, create a post from the front page as usual. No matter which button at the top you click (status, blog post, quote, link), everything goes into one category (the default category you've defined under Settings - Writing). We don't want that.

So go and create a new category, for example "quote" (under Posts - Categories). Now head back to the front page and post a quote. Now your latest post is in the Quote category. Nice, huh?


What if I want my own categories?
=================================

I wrote a post about this a few years back in which I explained how to add your own buttons to the theme, each of which would have been a new category. I've not looked at it in a while, but the principles still apply here: http://wpguru.co.uk/2012/03/how-to-tweak-p2-adding-and-replacing-categories/

The article also explaines how you can rename the category labels. 


Further Reading
================

You can find thr original P2 theme by Automattic here:
http://p2theme.com

Check out my P2 User Guide at http://p2guide.wordpress.com

Related: How to add new category buttons to the front page: http://wpguru.co.uk/2012/03/how-to-tweak-p2-adding-and-replacing-categories/

My original post coverng this topic, with code explanations: http://wpguru.co.uk/2012/04/how-to-bring-back-post-categories-in-p2/
