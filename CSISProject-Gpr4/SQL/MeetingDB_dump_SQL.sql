/*
    SQL Dump Script
    SQL create db, tables and fields, also insert data into newly created database
    Company: Canada Plastics Inc 
    Created on: 2017-11-15
    Modified on: 2017-11-28
    User: Daniel Muniz Frade - 
    E-mail: munizfraded@student.douglascollege.ca
*/

#Creating Database if non existent
DROP DATABASE IF EXISTS meetingdb;
CREATE DATABASE IF NOT EXISTS meetingdb;
USE meetingdb;


#Setting foreign check off
SET FOREIGN_KEY_CHECKS = 0;


#------------------------------------------------------------
DROP TABLE IF EXISTS Branch;
CREATE TABLE IF NOT EXISTS Branch(
   BranchID        INTEGER  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,Name            VARCHAR(150) NOT NULL
  ,Description     VARCHAR(1000)
  ,Country         VARCHAR(4) NOT NULL
  ,Estate_Province VARCHAR(100) NOT NULL
  ,City            VARCHAR(150) NOT NULL
  ,Street_Name     VARCHAR(150)
  ,Postal_Code     VARCHAR(10)
  ,ModifiedON      DATETIME DEFAULT NOW()
);
INSERT INTO Branch(BranchID,Name,Description,Country,Estate_Province,City,Street_Name,Postal_Code,ModifiedON) VALUES (1,'H.V. Building','First Branch','CA','BC','Vancouver','Robson St.','JL5B3S', DEFAULT);
INSERT INTO Branch(BranchID,Name,Description,Country,Estate_Province,City,Street_Name,Postal_Code,ModifiedON) VALUES (2,'HQ','Headquarters','CA','BC','Vancouver','Granville St.','TM9C5D',DEFAULT);
INSERT INTO Branch(BranchID,Name,Description,Country,Estate_Province,City,Street_Name,Postal_Code,ModifiedON) VALUES (3,'New West Branch','New Westminster location','CA','BC','New Westminster','7th St.','CB1 D9A',DEFAULT);
INSERT INTO Branch(BranchID,Name,Description,Country,Estate_Province,City,Street_Name,Postal_Code,ModifiedON) VALUES (4,'Jameson Branch',NULL,'CA','AB','Calgary','Downtown','D9ACT1',DEFAULT);
INSERT INTO Branch(BranchID,Name,Description,Country,Estate_Province,City,Street_Name,Postal_Code,ModifiedON) VALUES (5,'Lauren M.S Building','Latest and modern building','US','WA','Seattle','Lauren St.','98001',DEFAULT);
INSERT INTO Branch(BranchID,Name,Description,Country,Estate_Province,City,Street_Name,Postal_Code,ModifiedON) VALUES (6, 'Roosevelt Building', 'This is the new building', 'US', 'Washington', 'Seattle', 'Roosevelt St.', '886677', DEFAULT);
INSERT INTO Branch(BranchID,Name,Description,Country,Estate_Province,City,Street_Name,Postal_Code,ModifiedON) VALUES (7, 'James Karr Building', 'New recent created building', 'CA', 'BC', 'Vancouver', 'New Ave', 'V3H 1U8', DEFAULT);

#----------------------------------------------------------------
DROP TABLE IF EXISTS Participant;
CREATE TABLE IF NOT EXISTS Participant(
   ParticipantID INTEGER  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,Name          VARCHAR(150) NOT NULL
  ,Phone_Number  VARCHAR(25)
  ,Email         VARCHAR(150)
  ,Employee      BIT  NOT NULL DEFAULT 1
  ,ModifiedON    DATETIME DEFAULT NOW()
);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (1,'Steve Klein','688 512 4710','klein.s@plastics.ca',1,DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (2,'Nilton Grace','744 234 5555','grace.n@plastics.ca',1,DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (3,'John Smith','741 321 6060','smith.j@plastics.ca',1,DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (4,'James Carr','778 523 3000','carr.j@plastics.ca',1,DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (5,'London Blame','234 587 7410','blame.l@plastics.ca',1,DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (6,'James Lynn Carver','887 234 5100','carver.j@plastics.ca',1,DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (7, 'Hormein Huss', '777 666 5555', 'klein.test@logistics.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (8, 'Huge Barnes', '5555 4444', 'test@tes.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (9, 'Lost Name', '666 444', 'new_mail@new.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (10, 'NoMore Trest', '888 888', 'test@tes.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (11, 'Jason Vorhees', '666 666 6666', 'jason@plastics.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (12, 'Daniel M', '777 666 5555', 'daniel.m@plastics.ca', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (13, 'Leonard Styles', '123456', 'leonard@plastics.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (14, 'Ronald Jamie', '999 444 5555', 'test@tes.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (15, 'Blade Runner', '333 555 44444', 'test@tes.ca', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (16, 'Bling', '5556666', 'test@tes.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (17, 'Hormein Huss hgh', '777 666 5555', 'klein.test@logistics.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (18, 'Dona Summer', '888 555 6644', 'dona@plastics.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (19, 'Julio Brass', '555 777 8888', 'test_julio@tes.ca', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (20, 'Giraldo', '88888', 'test@tes.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (21, 'Huminr Fess', '88888 999', 'test@tes.ca', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (22, 'Luther King', '88888 444', 'test@tes.ca', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (23, 'John Maverick', '877 555 5874', 'john.mav@plastics.ca', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (24, 'Raymond Smith', '574 587 3210', 'raymond.s@plastics.ca', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (25, 'Carrie Simmons', '654 532 1234', 'carrie.s@plastics.ca', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (26, 'Carol Stevens', '699 888 7744', 'carol.d@plastics.ca', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (27, 'Gabriel Weinstein', '123 444 7899', 'gabriel@plastics.ca', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (28, 'Not Trest Anymore', '888 888', 'test@tes.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (29, 'Bia Couto', '888 888 9999', 'bia.c@plastics.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (30, 'Freddy G', '888 888 9999', 'freddy.g@plastics.ca', b'0', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (31, 'Rudolph Moor', '321654', 'kajii@plastics.ca', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (32, 'Barren Gordon', '987 654 123', 'jashgd@kajhdsf', b'1', DEFAULT);
INSERT INTO Participant(ParticipantID,Name,Phone_Number,Email,Employee,ModifiedON) VALUES (33, 'Gina Hugg', '654 123 4566', 'gina.h@plastics.ca', b'1', DEFAULT);

#--------------------------------------------------------------------
DROP TABLE IF EXISTS Resource;
CREATE TABLE IF NOT EXISTS Resource(
   ResourceID  INTEGER  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,Name        VARCHAR(150) NOT NULL
  ,Description VARCHAR(500) NOT NULL
  ,ModifiedON  DATETIME DEFAULT NOW()
);
INSERT INTO Resource(ResourceID,Name,Description,ModifiedON) VALUES (1,'Projector','Epson PowerLite Ultra HD',DEFAULT);
INSERT INTO Resource(ResourceID,Name,Description,ModifiedON) VALUES (2,'Webcam','Logitech HD Pro Webcam',DEFAULT);
INSERT INTO Resource(ResourceID,Name,Description,ModifiedON) VALUES (3,'Audio Conference Phone','Polycom Sound Station',DEFAULT);
INSERT INTO Resource(ResourceID,Name,Description,ModifiedON) VALUES (4,'Laptop','Dell Inspiron i7 1Tb',DEFAULT);
INSERT INTO Resource(ResourceID,Name,Description,ModifiedON) VALUES (5,'Blue-ray Player','Blue-ray player connected to internet',DEFAULT);
INSERT INTO Resource(ResourceID,Name,Description,ModifiedON) VALUES (6,'TV Wide-screen 52"','TV Samsung 52 inches - 4 HDMI',DEFAULT);
INSERT INTO Resource(ResourceID,Name,Description,ModifiedON) VALUES (7, 'Keypad', 'New Keypad', DEFAULT);
INSERT INTO Resource(ResourceID,Name,Description,ModifiedON) VALUES (8, 'Holographic Projector', 'Holographic projector ', DEFAULT);
INSERT INTO Resource(ResourceID,Name,Description,ModifiedON) VALUES (9, 'Widescreen', 'All Widescreen', DEFAULT);

#-------------------------------------------------------------------
DROP TABLE IF EXISTS Room;
CREATE TABLE IF NOT EXISTS Room(
   RoomID      INTEGER  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,Name        VARCHAR(150)  NOT NULL
  ,Description VARCHAR(500) 
  ,Capacity    INTEGER  NOT NULL DEFAULT 0
  ,BranchID    INTEGER  NOT NULL
  ,ModifiedON  DATETIME  DEFAULT NOW()
  ,FOREIGN KEY (BranchID) REFERENCES Branch(BranchID)
	ON UPDATE CASCADE ON DELETE RESTRICT
);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (200,'Carr Meeting Room','Open to the public',10,2,DEFAULT);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (201,'J H Meeting','Theater Room',20,2,DEFAULT);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (202,'Hall','Available to all employees',8,5,DEFAULT);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (203,'Adjacent Theatre Room','Room 4',5,1,DEFAULT);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (204,'Library Meeting Room','Room 5',12,4,DEFAULT);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (205, 'Main Theatre Room', 'Special for huge audiences and all', 50, 3, DEFAULT);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (206, 'Theatre Hall', 'Newly create meeting room', 18, 3, DEFAULT);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (207, 'Garmin Meeting Room', 'The new room', 22, 5, DEFAULT);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (208, 'Meeting Room', 'New Meeting room', 0, 6, DEFAULT);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (209, 'Subsidiary Room', 'New Test room', 16, 6, DEFAULT);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (210, 'New West Meeting Room', 'New West Meeting Room', 15, 3, DEFAULT);
INSERT INTO Room(RoomID,Name,Description,Capacity,BranchID,ModifiedON) VALUES (211, 'James Carr Room', 'New James karr room', 6, 7, DEFAULT);


#---------------------------------------------------------------------
DROP TABLE IF EXISTS Room_Resource;
CREATE TABLE IF NOT EXISTS Room_Resource(
   Room_Resource_ID INTEGER  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,RoomID           INTEGER  NOT NULL
  ,ResourceID       INTEGER  NOT NULL
  ,ModifiedON       DATETIME DEFAULT NOW()
  ,FOREIGN KEY (RoomID) REFERENCES Room(RoomID)
	ON UPDATE CASCADE ON DELETE RESTRICT
  ,FOREIGN KEY (ResourceID)	REFERENCES Resource(ResourceID)
	ON UPDATE CASCADE ON DELETE RESTRICT
);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (1,203,1,DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (2,203,3,DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (3,200,4,DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (4,201,1,DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (5,201,5,DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (6,202,2,DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (7,202,4,DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (13, 211, 8, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (12, 211, 1, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (11, 211, 4, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (14, 211, 6, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (15, 205, 5, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (16, 204, 4, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (17, 204, 1, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (18, 204, 8, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (19, 204, 6, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (39, 209, 2, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (38, 209, 8, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (37, 209, 7, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (26, 200, 7, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (29, 202, 5, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (32, 201, 8, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (33, 201, 2, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (34, 201, 9, DEFAULT);
INSERT INTO Room_Resource(Room_Resource_ID,RoomID,ResourceID,ModifiedON) VALUES (40, 209, 6, DEFAULT);


#----------------------------------------------------------------
DROP TABLE IF EXISTS Meeting;
CREATE TABLE IF NOT EXISTS Meeting(
   MeetingID   INTEGER  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,Subject     VARCHAR(150) NOT NULL
  ,Description VARCHAR(500)
  ,Start_Date  DATETIME  NOT NULL
  ,End_Date    DATETIME  NOT NULL
  ,RoomID      INTEGER  NOT NULL
  ,Private     BIT  NOT NULL DEFAULT 0
  ,ModifiedON  DATETIME  DEFAULT NOW()
  ,FOREIGN KEY (RoomID) REFERENCES Room(RoomID)
	ON UPDATE CASCADE ON DELETE RESTRICT
);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (1,'Finance','Monthly Financial Meeting','2017-10-25 10:00:00','2017-10-25 11:00:00',203,0,DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (2,'Budget Meeting','Budget approval for next fiscal year 2018','2017-10-29 08:00:00','2017-10-29 10:00:00',201,0,DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (3,'IT Proposals','New equipments and IT services','2017-10-30 10:00:00','2017-10-30 12:30:00',201,0,DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (4,'Accountability',NULL,'2017-10-30 15:00:00','2017-10-30 17:00:00',200,0,DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (5,'Finance','Monthly Financial Meeting','2017-11-22 15:00:00','2017-11-22 16:00:00',202,0,DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (6,'Management Meeting',NULL,'2017-11-28 09:00:00','2017-11-28 11:30:00',203,1,DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (7, 'Director board', 'Meeting with directors', '2017-12-14 09:00:00', '2017-12-14 12:00:00', 204, b'0', DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (8, 'Managers', 'new description new meeting', '2017-12-18 11:00:00', '2017-12-18 12:00:00', 200, b'0', DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (9, 'Director Meeting', 'New Meeting', '2017-12-19 09:30:00', '2017-12-19 11:30:00', 208, b'1', DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (10, 'Sales Meeting', 'New sales meeting', '2017-12-12 09:00:00', '2017-12-12 11:15:00', 207, b'0', DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (11, 'Marketing Meeting', 'Marketing strategies', '2017-12-20 13:15:00', '2017-12-20 17:15:00', 206, b'0', DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (12, 'Future Meeting', 'New Future meeting', '2018-01-17 08:15:00', '2018-01-17 12:00:00', 204, b'0', DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (13, 'New Product Dev', 'Development of a new product', '2018-01-23 15:10:00', '2018-01-23 17:10:00', 203, b'0', DEFAULT);
INSERT INTO Meeting(MeetingID,Subject,Description,Start_Date,End_Date,RoomID,Private,ModifiedON) VALUES (14, 'Marketing Directives', 'New Marketing estrategies', '2017-12-22 10:15:00', '2017-12-22 14:30:00', 208, b'0', DEFAULT);

#-------------------------------------------------------------------
DROP TABLE IF EXISTS Participant_Meeting;
CREATE TABLE IF NOT EXISTS Participant_Meeting(
   Participant_Meeting_ID INTEGER  NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,ParticipantID          INTEGER  NOT NULL
  ,MeetingID              INTEGER  NOT NULL
  ,ModifiedON             DATETIME DEFAULT NOW()
  ,FOREIGN KEY (ParticipantID) REFERENCES Participant(ParticipantID)
	ON UPDATE CASCADE ON DELETE RESTRICT
  ,FOREIGN KEY (MeetingID) REFERENCES Meeting(MeetingID)
	ON UPDATE CASCADE ON DELETE RESTRICT
);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (1,3,1,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (2,4,1,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (3,6,2,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (4,3,3,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (5,2,3,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (6,1,4,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (7,3,5,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (8,4,6,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (9,5,6,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (10, 7, 32, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (11, 7, 16, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (12, 7, 17, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (16, 8, 32, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (14, 7, 21, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (15, 7, 3,  DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (17, 8, 29, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (72, 3, 8,  DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (19, 8, 21, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (20, 9, 9,  DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (24, 10, 21,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (22, 9, 28, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (68, 1, 14, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (25, 10, 3, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (26, 10, 19,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (46, 3, 13, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (28, 10, 5, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (29, 3, 11, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (30, 19, 11,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (31, 5, 11, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (32, 9, 11, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (33, 22, 11,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (34, 2, 11, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (35, 27, 12,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (36, 15, 12,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (37, 33, 12,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (38, 16, 12,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (39, 12, 12,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (40, 29, 12,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (41, 20, 12,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (71, 21, 8, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (70, 8, 8,  DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (69, 17, 8, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (47, 19, 13,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (48, 13, 13,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (49, 5, 13, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (50, 9, 13, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (51, 22, 13,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (52, 2, 13, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (67, 2, 14, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (66, 4, 14, DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (65, 21, 14,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (64, 33, 14,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (63, 27, 14,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (62, 30, 14,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (61, 25, 14,DEFAULT);
INSERT INTO Participant_Meeting(Participant_Meeting_ID,ParticipantID,MeetingID,ModifiedON) VALUES (DEFAULT, 25, 10,DEFAULT);


#Setting foreign check on
SET FOREIGN_KEY_CHECKS = 1;
