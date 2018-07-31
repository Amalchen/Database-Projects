# Database Restaurant Project

I did this project back in 2017.
It has bugs and is not completely finished.
Sadly, I wasn't attending the lectures of my university in DBs.
Used the instructional videos of Alex Garrett in the newboston channel:
https://www.youtube.com/playlist?list=PL442FA2C127377F07
to make this project.
The videos were great (even though old for todays php), but should be watched as complementary meterial to the university course.

Bugs:
1) If you order the same thing > 1, it won't actually be ordered.

   i. I didn't know how to use "JOIN" back then, and used another way to implement it, building the string in a smart way. The string built was something likeI had "[...] WHERE `menu`.`id` == 1 && `menu`.`id` == 1 [...]. This didn't work.
2) Calendar is wrongly programmed & will produce 13th, 14th, ... month.

Missing:
1) Overall view of customers orders ("view cart" or similar)
2) List instead of box when ordering (cumbersome ordering of the same item, multiple times)
3) sql-injection protection.

   i. After a point, I stopped adding relevant php functions since safety was taught in the next semester. I was lazy.

Notes:
1) Code needs some serious clean-up

   i. Many lines extend further from the terminal safe 70 length.
  
   ii. Repeated code.
  
   iii. Bad "breaking" into files.
   
   iv. Didn't create functions.
  
2) After ordering, when clicking "Checkout", the Order DB-table will clear your orders and your reservation (if it exists).
3) Smoker, non-smoker option was never implemented.

4) I have two types of tables that fit 4 or 6 people.
5) The difficult part was the coupling of tables. I did the silliest/simplest sollution.

   i. My tables didn't had any positional restrictions, so I could couple whichever table with another one.
   
   ii. I decided to couple with the next available table in the DB-table matrix (searching by id)
   
   iii. If a 4 people group came and all the 4-people tables were filled, I wouldn't give them a 6-people table.
   
   iv. Each time I coupled a table, I removed 2 seats from capacity. Thinking that if I couple a 4-table with another 4-table, 2 seats will be lost etc. Of course that's stupid.
