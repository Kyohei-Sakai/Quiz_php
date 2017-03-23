
-- データベースの設定
-- ローカル開発環境

-- rootユーザでログイン
-- $ mysql -u root -p

-- mysql> create database quiz_myapp;
-- mysql> show databases;

-- dbuserでパスワード（htmr821）を設定
-- mysql> grant all on quiz_myapp.* to dbuser@localhost identified by 'htmr821';
-- mysql> use quiz_myapp;

drop table quizzes;

create table quizzes (
    id int not null auto_increment primary key,
    question text,
    correct_answer varchar(255),
    wrong_answer1 varchar(255),
    wrong_answer2 varchar(255),
    wrong_answer3 varchar(255)
);

insert into quizzes (
  question, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3)
values
('A', 'A0', 'A1', 'A2', 'A3'),
('B', 'B0', 'B1', 'B2', 'B3'),
('C', 'C0', 'C1', 'C2', 'C3');


select * from quizzes;


-- update
update quizzes set question = 'What is A?' where id = 1;
update quizzes set question = 'What is B?' where id = 2;
update quizzes set question = 'What is C?' where id = 3;
