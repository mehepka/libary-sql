

CREATE DATABASE library;

USE library;


CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR (100) NOT NULL,
    password VARCHAR (200) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    role VARCHAR(30) DEFAULT 'student'

);

INSERT INTO users (user_name, password, first_name, last_name, role)
VALUES
('Aiden_Foster', '100101', 'Aiden', 'Foster', 'student'),
('Emma_Carter', '100102', 'Emma', 'Carter', 'student'),
('Connor_Hill', '100103', 'Connor', 'Hill', 'student'),
('Isabelle_Green', '100104', 'Isabelle', 'Green', 'student'),
('Ethan_Barnes', '100105', 'Ethan', 'Barnes', 'student'),
('Avery_James', '100106', 'Avery', 'James', 'student'),
('Logan_Nelson', '100107', 'Logan', 'Nelson', 'student'),
('HamzaBN', '160538', 'Hamza', 'Ben alla', 'staff'),
('SHasan', '160598', 'Shadid', 'Hasan', 'admin'),
('TMahfuz', '160104', 'Talha', 'Mahfuz', 'student');


CREATE TABLE books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bookName VARCHAR(200) NOT NULL,
    ISBN CHAR(15) NOT NULL UNIQUE,
    category VARCHAR(200) NOT NULL,
    author VARCHAR(200) NOT NULL,
    cover varchar(255),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO books (bookName, ISBN, category, author, cover)
VALUES
('Calculus: A Complete Introduction', '9781473678446', 'Mathematics', 'Hugh Neill', 'calculus.jpg'),
('Physics: A complete Introduction', '9781529397925', 'Physics', 'Jim Breithaupt', 'Physics.jpg'),
('Computer Science: A Very Short Introduction', '9780198733461', 'Computer Science', 'Subrata Dasgupta', 'cs.jpg'),
('Artificial Intelligence: A Very Short Introduction', '978152464692', 'Computer Science', 'Margaret A. Boden', 'AI.jpg'),
('Mathematics: A Complete Introduction', '9781473678378', 'Mathematics', ' Hugh Neill', 'math.jpg'),
('General Biology I', '9781636350431', 'Biology', 'Lisa Bartee', 'Biology-101.jpg'),
('Bleach Vol 55', '978469782648', 'Fiction', 'Tite Kubo', 'bleach.jpg'),
('Chainsaw Man Vol 11', ' 978564792468 ', 'Fiction', 'Tatsuki Fujimoto', 'chainsaw-man-vol-11.jpg'),
('Introduction to Biosystems Engineering', '9781949373974', 'Engineering', 'Nicholas M. Holden', 'Engineering.jpg'),
('Microeconomics: Theory Through Applications', '9781453313282', 'Economics', 'Russell Cooper', 'econ.jpg'),
('Human Nutrition', ' 9781589367925 ', 'Nutrition', 'Marie Kainoa Fialkowski Revilla', 'human-nutrition.jpg'),
('Introduction to Calculus', '9798654032362', 'Mathematics', 'Nathan Frey', 'Introduction to Calculus Book 1.jpg');



CREATE TABLE exchange (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    phone VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    bookToGive VARCHAR(200) NOT NULL,
    ISBN1 CHAR(13) NOT NULL,
    bookToTake VARCHAR(200) NOT NULL,
    ISBN2 CHAR(13) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO exchange (name, phone, email, bookToGive, ISBN1, bookToTake, ISBN2)
VALUES
    ('John Doe', '123-456-7890', 'john.doe@acadiau.ca', 'Python Basics', '9876543210123', 'Web Development Fundamentals', '9876543210981'),
    ('Jane Smith', '987-654-3210', 'jane.smith@acadiau.ca', 'Data Structures in Java', '9876543210234', 'Advanced JavaScript', '9876543210872'),
    ('Alice Johnson', '456-789-0123', 'alice.johnson@acadiau.ca', 'Database Design Principles', '9876543210345', 'Object-Oriented Programming', '9876543210763'),
    ('Bob Brown', '789-012-3456', 'bob.brown@acadiau.ca', 'Machine Learning Techniques', '9876543210456', 'Software Architecture Patterns', '9876543210654'),
    ('Ella Wilson', '567-890-1234', 'ella.wilson@acadiau.ca', 'Web Development with HTML5', '9876543210567', 'Python for Data Analysis', '9876543210659'),
    ('David Lee', '890-123-4567', 'david.lee@acadiau.ca', 'Mobile App Development', '9876543210678', 'Database Administration', '9876543210432'),
    ('Grace Martin', '234-567-8901', 'grace.martin@acadiau.ca', 'Software Testing Strategies', '9876543210789', 'Cybersecurity Fundamentals', '9876543210321'),
    ('Henry Clark', '345-678-9012', 'henry.clark@acadiau.ca', 'Artificial Intelligence in Healthcare', '9876543210890', 'Blockchain Technology', '9876543210214'),
    ('Olivia Harris', '678-901-2345', 'olivia.harris@acadiau.ca', 'Web Design Principles', '9876543210901', 'Data Analytics Tools', '9876543202123'),
    ('Samuel Turner', '456-789-0123', 'samuel.turner@acadiau.ca', 'Java Programming', '9876543210012', 'Introduction to Computer Science', '9876543200987');



CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    phone VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    book VARCHAR(200) NOT NULL,
    ISBN CHAR(13) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO orders (name, phone, email, book, ISBN)
VALUES
    ('John Doe', '123-456-7890', 'john.doe@acadiau.ca', 'Introduction to Computer Science', '1234567890124'),
    ('Jane Smith', '987-654-3210', 'jane.smith@acadiau.ca', 'Data Structures and Algorithms', '2345678901235'),
    ('Alice Johnson', '456-789-0123', 'alice.johnson@acadiau.ca', 'Database Management Systems', '3456789012346'),
    ('Bob Brown', '789-012-3456', 'bob.brown@acadiau.ca', 'Machine Learning and Deep Learning', '4567890123457'),
    ('Ella Wilson', '567-890-1234', 'ella.wilson@acadiau.ca', 'Computer Networks and Security', '5678901234568'),
    ('David Lee', '890-123-4567', 'david.lee@acadiau.ca', 'Artificial Intelligence: Principles and Techniques', '6789012345679'),
    ('Grace Martin', '234-567-8901', 'grace.martin@acadiau.ca', 'Linear Algebra and Its Applications', '7890123456780'),
    ('Henry Clark', '345-678-9012', 'henry.clark@acadiau.ca', 'Introduction to Statistics', '8901234567891'),
    ('Olivia Harris', '678-901-2345', 'olivia.harris@acadiau.ca', 'Economics for Beginners', '9012345678902'),
    ('Samuel Turner', '456-789-0123', 'samuel.turner@acadiau.ca', 'Physics: Principles and Problems', '0123456789013');

CREATE TABLE feedbacks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    serviceType VARCHAR (100) NOT NULL,
    feedback VARCHAR (300) NOT NULL
);

INSERT INTO feedbacks (serviceType, feedback)
VALUES
    ('Book Recommendation', 'I recommend adding "Introduction to Computer Science" to the list for university students.'),
    ('Order', 'Great service, received my order.'),
    ('Exchange', 'The exchange process was smooth, and the service was excellent. Thank you!'),
    ('Order', 'The book quality exceeded my expectations.'),
    ('Book Recommendation', 'Please consider "Organic Chemistry for Beginners" for the book list.'),
    ('Exchange', 'I successfully exchanged my book with ease. Great service overall.'),
    ('Book Recommendation', 'Adding "Economics 101" would be great for students.'),
    ('Exchange', 'Very content with the exchange service, and I found the book I needed.'),
    ('Book Recommendation', 'The book "Physics Made Simple" should be added for physics students.'),
    ('Order', 'Impressed with the prompt delivery and the overall service.'),
    ('Exchange', 'I had a positive experience with the exchange service, and I recommend it.'),
    ('Book Recommendation', 'I recommend "Art History: A Comprehensive Guide" for art students.'),
    ('Order', 'My order arrived in excellent condition, and I am very happy with it.'),
    ('Book Recommendation', 'The book "English Literature Classics" is a must for literature students.'),
    ('Order', 'Great service, received my order on time. Very satisfied!'),
    ('Exchange', 'The exchange request service was convenient, and I am happy with the outcome.'),
    ('Book Recommendation', 'I recommend "The Psychology of Mindfulness" for psychology students.'),
    ('Order', 'I am very content with my order; it was a smooth process from start to finish.'),
    ('Book Recommendation', 'Please add "Introduction to Environmental Science" for environmental science students.'),
    ('Order', 'The delivery was quick, and the book quality exceeded my expectations.');