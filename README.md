# Database Restaurant Project

I did this project back in 2017.
It has bugs and is not completely finished.
Sadly, I was't attending the lectures of my university in DBs.
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
  
   iii. Bad "breaking" into files. Didn't create a single function.
  
2) After ordering, when clicking "Checkout", the Order DB-table will clear your orders and your reservation (if it exists).
3) Smoker, non-smoker option was never implemented.

4) I have two types of tables that fit 4 or 6 people.
5) The difficult part was the coupling of tables. I did the silliest/simplest sollution.

   i. My tables didn't had any positional restrictions, so I could couple whichever table with another one.
   
   ii. I decided to couple with the next available table in the DB-table matrix (searching by id)
   
   iii. If a 4 people group came and all the 4-people tables were filled, I wouldn't give them a 6-people table.
   
   iv. Each time I coupled a table, I removed 2 seats from capacity. Thinking that if I couple a 4-table with another 4-table, 2 seats will be lost etc. Of course that's stupid.

(english)
Project in Databases - 5th semester

We want to create a system for seat reservation & ordering for a restaurant. The restaurant has a specific amount of tables (preset). Depending on the type of table fit specific amount of seats. It must have the ability of reservetion for a specific amount of seats, in a specific day and time. If there isn't a table that fits the number of clients that partake in a reservation, examine the possibility of coupling tables together. Moreover, there should be the ability to view menu of the day and orders done either in the process of reserving or after the clients reach the restaurant. Lastly, there should be the ability to calculate the overall cost that will be charged.

The system will have two kind of users with different privileges. The first will be the admin of the restaurant that will have the privilege to modify the menu of the day and will also manage tables, while the second will be the simple client with the privilege of making a reservation and making orders.

You should, apart from the DB, create appropriate forms for admission, interfaces for each different kind of user, interafces for reservation, view menu, orders etc.

(greek)
Εργασία στις Βάσεις Δεδομένων - 5ο εξάμηνο
ΠΕΡΙΓΡΑΦΗ

Θέλουμε να φτιάξουμε ένα σύστημα κράτησης θέσεων και παραγγελιών για ένα εστιατόριο. Το εστιατόριο έχει συγκεκριμένο πλήθος τραπεζιών (αριθμημένο). Αναλόγως του είδους του τραπεζιού χωρούν συγκεκριμένο πληθος καθισμάτων. Θα πρέπει να υπάρχει δυνατότητα κρατήσεων για συγκεκριμένο πλήθος θέσεων, σε συγκεκριμένη ημέρα και ώρα. Αν δεν υπάρχει ένα τραπέζι που να χωράει το πλήθος των πελατών που εμπλέκεται σε μία κράτηση εξετάζεται το ενδεχόμενο ένωσης τραπεζιών. Επιπλέον θα υπάρχει δυνατότητα προβολής του μενού της ημέρας και παραγγελιών είτε κατά τη φάση της κράτησης είτε αφού αφιχθούν οι πελάτες στο εστιατόριο. Τέλος θα πρέπει να υπάρχει η δυνατότητα υπολογισμού του συνολικού κόστους που πρέπει να χρεωθεί.

Στο σύστημα θα υπάρχουν δύο ειδών χρήστες με διαφορετικά δικαιώματα. Το πρώτο θα είναι ο admin του μαγαζιού που θα έχει δικάιωμα να τροποποιεί το μενού της ημέρας καθώς και να χειρίζεται τα τραπέζια, ενώ το δεύτερο θα είναι το επίπεδο του απλού πελάτη με δυνατότητα να κάνει κράτηση και παραγγελίες.

Θα πρέπει πέραν της ΒΔ να φτιαχτούν κατάλληλες φόρμες εισαγωγής, διαπαφές για κάθε ξεχωριστό είδος χρήστη, διεπαφές για κρατήσεις, εμφάνιση μενού, παραγγελίες κλπ.
