CREATE TABLE users(
    user_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    user_title varchar(256) not null,
    user_blog text not null,
    user_image text not null,
    

);

INSERT INTO users ( user_title, user_blog, user_image) 
VALUES ( 'harry porter','Harry Potter is a series of fantasy novels written by British author J. K. Rowling. The novels chronicle the lives of a young wizard, Harry Potter, and his friends Hermione Granger and Ron Weasley, all of whom are students at Hogwarts School of Witchcraft and Wizardry','C:\Users\USER\Documents\UI\images\slider1.jpg');