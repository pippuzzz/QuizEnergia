
CREATE TABLE question(
id INT PRIMARY KEY auto_increment,
admin_answer BOOLEAN NOT NULL,
feedback int NOT NULL, 
question VARCHAR(10000)
);

CREATE TABLE mark(
id INT PRIMARY KEY auto_increment,
mark DOUBLE NOT NULL
);

CREATE TABLE user(
id INT PRIMARY KEY auto_increment,
name VARCHAR(100) NOT NULL,
surname VARCHAR(1000) NOT NULL
);


CREATE TABLE mark_user_(
id_mark INT,
id_user INT,
FOREIGN KEY (id_mark) REFERENCES mark(id),
FOREIGN KEY (id_user) REFERENCES user(id)
);

CREATE TABLE user_answer(
id INT PRIMARY KEY auto_increment,
id_question INT,
id_user INT,
answer BOOLEAN NOT NULL,
FOREIGN KEY (id_user) REFERENCES user(id)
);

CREATE TABLE warning(
id INT PRIMARY KEY auto_increment, 
warning_message VARCHAR(20000)
);