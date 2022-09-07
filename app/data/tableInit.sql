
-- DDL Creating Tables --
CREATE TABLE Skater (
    SkaterID INTEGER PRIMARY KEY,
    SkaterName VARCHAR2(50),
    YearOfSkating INTEGER,
    Hometown VARCHAR2(50),
    SocialMedia VARCHAR2(500) UNIQUE
);

CREATE TABLE Organization (
    OrgName VARCHAR2(50) PRIMARY KEY, 
    Founder VARCHAR2(50), 
    WebLink VARCHAR2(500) UNIQUE
);

CREATE TABLE Affiliate (
    OrgName VARCHAR2(50), 
    SkaterID INTEGER, 
    PRIMARY KEY (OrgName, SkaterID), 
    FOREIGN KEY (OrgName) 
        REFERENCES Organization
        ON DELETE CASCADE,
    FOREIGN KEY (SkaterID) 
        REFERENCES Skater 
        ON DELETE CASCADE
);

CREATE TABLE Events (
    EventName VARCHAR2(50) PRIMARY KEY, 
    Capacity INTEGER
);

CREATE TABLE Host (
    OrgName VARCHAR2(50),
    EventName VARCHAR2(50),
    PRIMARY KEY (OrgName, EventName),
    FOREIGN KEY (OrgName) 
        REFERENCES Organization
        ON DELETE CASCADE,
    FOREIGN KEY (EventName)
        REFERENCES Events
        ON DELETE CASCADE
);

CREATE TABLE Participate (
    EventName VARCHAR2(50),
    SkaterID INTEGER, 
    ParticipantRole VARCHAR2(50),
    PRIMARY KEY (EventName, SkaterID), 
    FOREIGN KEY (EventName)
        REFERENCES Events
        ON DELETE CASCADE,
    FOREIGN KEY (SkaterID)
        REFERENCES Skater 
        ON DELETE CASCADE
);

CREATE TABLE SkateLocation (
    StreetAddress VARCHAR2(100),
    City VARCHAR2(50), 
    Province VARCHAR2(50),
    LocationDescription VARCHAR2(500), 
    Rating INTEGER, 
    PRIMARY KEY (StreetAddress, City, Province)
);

CREATE TABLE HappenedAt (
    EventName VARCHAR2(50),
    StreetAddress VARCHAR2(100),
    Province VARCHAR2(30), 
    City VARCHAR2(50),
    EventDate DATE,
    PRIMARY KEY(EventName, StreetAddress, City, Province),
    FOREIGN KEY(EventName) 
        REFERENCES Events
        ON DELETE CASCADE,
    FOREIGN KEY(StreetAddress, City, Province) 
        REFERENCES SkateLocation
        ON DELETE CASCADE
);

CREATE TABLE Brands (
    BrandName VARCHAR2(40) PRIMARY KEY,
    Website VARCHAR2(500) UNIQUE
);

CREATE TABLE BoardType (
    BoardLength NUMBER,
    Kicktail INTEGER,
    BoardType VARCHAR2(40),
    PRIMARY KEY(BoardLength, Kicktail)
);

CREATE TABLE Boards (
    ProductNum INTEGER,
    BrandName VARCHAR2(40),
    BoardName VARCHAR2(40),
    Kicktail INTEGER,
    BoardLength NUMBER,
    PRIMARY KEY(ProductNum, BrandName),
    FOREIGN KEY(BrandName) 
        REFERENCES Brands
        ON DELETE CASCADE
);

CREATE TABLE Owns (
    BrandName VARCHAR2(40),
    ProductNum INTEGER,
    SkaterID INTEGER,
    BoardRating INTEGER, 
    PRIMARY KEY(BrandName, ProductNum, SkaterID),
    FOREIGN KEY(BrandName, ProductNum)
        REFERENCES Boards(BrandName, ProductNum),
    FOREIGN KEY (SkaterID)
        REFERENCES Skater
        ON DELETE CASCADE
);

CREATE TABLE BoardShopAddress (
    PostalCode CHAR(6) PRIMARY KEY,
    City VARCHAR2(50),
    Province VARCHAR2(30)
);

CREATE TABLE BoardShop (
    PostalCode CHAR(6),
    Phone CHAR(11) PRIMARY KEY,
    BoardShopName VARCHAR2(100),
    Website VARCHAR2(500) UNIQUE,
    StreetAddress VARCHAR2(100),
    FOREIGN KEY (PostalCode) 
        REFERENCES BoardShopAddress(PostalCode) 
        ON DELETE CASCADE
);

CREATE TABLE Sell (
    BrandName VARCHAR2(40),
    ProductNum INTEGER,
    Phone CHAR(11),
    Price INTEGER,
    PRIMARY KEY(BrandName, ProductNum, Phone),
    FOREIGN KEY(BrandName, ProductNum) 
        REFERENCES Boards(BrandName, ProductNum),
    FOREIGN KEY(Phone) 
        REFERENCES BoardShop
        ON DELETE CASCADE
);

CREATE TABLE Tricks (
    TrickName VARCHAR2(100) PRIMARY KEY,
    Difficulty INTEGER
);

CREATE TABLE CanDo (
    TrickName VARCHAR2(100),
    SkaterID INTEGER,
    Familiarity INTEGER,
    PRIMARY KEY (TrickName, SkaterID),
    FOREIGN KEY (SkaterID) 
        REFERENCES Skater(SkaterID) 
        ON DELETE CASCADE,
    FOREIGN KEY (TrickName) 
        REFERENCES Tricks(TrickName) 
        ON DELETE CASCADE
);

CREATE TABLE SkateAt (
    Province VARCHAR2(50),
    City VARCHAR2(50),
    StreetAddress VARCHAR2(100),
    SkaterID INTEGER,
    PRIMARY KEY (Province, City, StreetAddress, SkaterID),
    FOREIGN KEY (Province, City, StreetAddress) 
        REFERENCES SkateLocation(Province, City, StreetAddress),
    FOREIGN KEY (SkaterID) 
        REFERENCES Skater(SkaterID) 
        ON DELETE CASCADE
);

CREATE TABLE Longboarder (
    SkaterID INTEGER PRIMARY KEY,
    FOREIGN KEY (SkaterID) 
        REFERENCES Skater(SkaterID) 
        ON DELETE CASCADE
);

CREATE TABLE Skateboarder (
    SkaterID INTEGER PRIMARY KEY,
    FOREIGN KEY (SkaterID) 
        REFERENCES Skater(SkaterID) 
        ON DELETE CASCADE
);

CREATE TABLE Surfskater (
    SkaterID INTEGER PRIMARY KEY,
    FOREIGN KEY (SkaterID) 
        REFERENCES Skater(SkaterID) 
        ON DELETE CASCADE
);

-- DML inserting values --
INSERT INTO Skater(SkaterID, SkaterName, YearOfSkating, Hometown, SocialMedia)
VALUES (1, 'Duffy', 10, 'Toronto', 'www.google.com');

INSERT INTO Skater(SkaterID, SkaterName, YearOfSkating, Hometown, SocialMedia)
VALUES (2, 'May', 1, 'New Zealand', 'www.ubc.com');

INSERT INTO Skater(SkaterID, SkaterName, YearOfSkating, Hometown, SocialMedia)
VALUES (3, 'Jonathan', 1, 'Hong Kong', 'www.Jonathan.com');

INSERT INTO Skater(SkaterID, SkaterName, YearOfSkating, Hometown, SocialMedia)
VALUES (4, 'Yifan', 15, 'Australia', 'www.redditYifan.com');

INSERT INTO Skater(SkaterID, SkaterName, YearOfSkating, Hometown, SocialMedia)
VALUES (5, 'Mary', 9, 'Jamaica', 'www.jam.com');

INSERT INTO BoardShopAddress(PostalCode, City, Province)
VALUES ('111111', 'Vancouver', 'British Columbia');

INSERT INTO BoardShopAddress(PostalCode, City, Province)
VALUES ('222222', 'Montreal', 'Quebec');

INSERT INTO BoardShopAddress(PostalCode, City, Province)
VALUES ('333333', 'Burnaby', 'British Columbia');

INSERT INTO BoardShopAddress(PostalCode, City, Province)
VALUES ('444444', 'Richmond', 'British Columbia');

INSERT INTO BoardShopAddress(PostalCode, City, Province)
VALUES ('555555', 'Surrey', 'British Columbia');

INSERT INTO BoardShop(PostalCode, Phone, BoardShopName, Website, StreetAddress)
VALUES ('111111', '1647123123', 'UBC Boards', 'www.boards.com', '1117 University Road');

INSERT INTO BoardShop(PostalCode, Phone, BoardShopName, Website, StreetAddress)
VALUES ('222222', '1416234234', 'Montreal Boards', 'www.monboards.com', '3823 Lucy Road');

INSERT INTO BoardShop(PostalCode, Phone, BoardShopName, Website, StreetAddress)
VALUES ('333333', '1203123123','Burnaby Boards', 'www.burnboards.com', '2222 Burnaby Road');

INSERT INTO BoardShop(PostalCode, Phone, BoardShopName, Website, StreetAddress)
VALUES ('444444', '1234567890', 'Richmond Boards', 'www.richboards.com', '1213 Rich Road');

INSERT INTO BoardShop(PostalCode, Phone, BoardShopName, Website, StreetAddress)
VALUES ('555555', '1876543210', 'Surrey Boards', 'www.uni.com', '9872 Surrey Road');

INSERT INTO Tricks(TrickName, Difficulty)
VALUES ('Pivot180', 4);

INSERT INTO Tricks(TrickName, Difficulty)
VALUES ('Kickflip', 8);

INSERT INTO Tricks(TrickName, Difficulty)
VALUES ('Shovit', 5);

INSERT INTO Tricks(TrickName, Difficulty)
VALUES ('Ghostride Kickflip', 4);

INSERT INTO Tricks(TrickName, Difficulty)
VALUES ('No-Comply', 5);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Pivot180',	1, 8);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Kickflip', 1, 7);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Shovit', 1, 6);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Ghostride Kickflip', 1, 5);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('No-Comply', 1, 10);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Pivot180', 2, 10);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Kickflip', 2, 10);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Pivot180', 3, 1);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Pivot180', 4, 10);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Kickflip', 4, 10);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Shovit', 4, 10);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Ghostride Kickflip', 4, 10);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('No-Comply', 4, 10);

INSERT INTO CanDo(TrickName, SkaterID, Familiarity)
VALUES ('Shovit', 5, 7);

INSERT INTO Organization(OrgName, Founder, WebLink)
VALUES ('SkateOrDie', 'Duffy', 'www.duffySk8er.com');

INSERT INTO Organization(OrgName, Founder, WebLink)
VALUES ('UBC Skate', 'Yifan', 'www.ubcskate8.com');

INSERT INTO Organization(OrgName, Founder, WebLink)
VALUES ('SkateBurnaby', 'Girish', 'www.burnabyskate.com');

INSERT INTO Organization(OrgName, Founder, WebLink)
VALUES ('SkaterVan', 'Lucy', 'www.vanskate.com');

INSERT INTO Organization(OrgName, Founder, WebLink)
VALUES ('SkaterinCad', 'Mary',	'www.maryinskate.com');


INSERT INTO Affiliate (OrgName, SkaterID)
VALUES ('SkateOrDie', 1);

INSERT INTO Affiliate (OrgName, SkaterID)
VALUES ('UBC Skate', 4);

INSERT INTO Affiliate (OrgName, SkaterID)
VALUES ('SkateBurnaby', 3);

INSERT INTO Affiliate (OrgName, SkaterID)
VALUES ('SkaterVan', 3);

INSERT INTO Affiliate (OrgName, SkaterID)
VALUES ('SkaterinCad', 4);

INSERT INTO Affiliate (OrgName, SkaterID)
VALUES ('SkaterinCad', 1);

INSERT INTO Affiliate (OrgName, SkaterID)
VALUES ('UBC Skate', 1);

INSERT INTO Affiliate (OrgName, SkaterID)
VALUES ('UBC Skate', 5);

INSERT INTO Affiliate (OrgName, SkaterID)
VALUES ('SkateBurnaby', 1);

INSERT INTO Affiliate (OrgName, SkaterID)
VALUES ('SkateBurnaby', 2);

INSERT INTO Skateboarder (SkaterID)
VALUES (1);

INSERT INTO Skateboarder (SkaterID)
VALUES (2);

INSERT INTO Skateboarder (SkaterID)
VALUES (3);

INSERT INTO Skateboarder (SkaterID)
VALUES (4);

INSERT INTO Skateboarder (SkaterID)
VALUES (5);

INSERT INTO Longboarder (SkaterID)
VALUES (1);

INSERT INTO Longboarder (SkaterID)
VALUES (2);

INSERT INTO Longboarder (SkaterID)
VALUES (3);

INSERT INTO Longboarder (SkaterID)
VALUES (4);

INSERT INTO Longboarder (SkaterID)
VALUES (5);

INSERT INTO Surfskater (SkaterID)
VALUES (1);

INSERT INTO Surfskater (SkaterID)
VALUES (2);

INSERT INTO Surfskater (SkaterID)
VALUES (3);

INSERT INTO Surfskater (SkaterID)
VALUES (4);

INSERT INTO Surfskater (SkaterID)
VALUES (5);

INSERT INTO Events (EventName, Capacity)
VALUES ('Skate to Toronto', 999);

INSERT INTO Events (EventName, Capacity)
VALUES ('Skate to Stanley park', 100);

INSERT INTO Events (EventName, Capacity)
VALUES ('Vancouver International Skate Competition', 9999);

INSERT INTO Events (EventName, Capacity)
VALUES ('Toronto International Skate Competition', 8888);

INSERT INTO Events (EventName, Capacity)
VALUES ('Montreal International Skate Competition', 7777);

INSERT INTO Host (OrgName, EventName)
VALUES ('SkateOrDie', 'Skate to Toronto');

INSERT INTO Host (OrgName, EventName)
VALUES ('UBC Skate', 'Skate to Stanley park');

INSERT INTO Host (OrgName, EventName)
VALUES ('SkateBurnaby', 'Vancouver International Skate Competition');

INSERT INTO Host (OrgName, EventName)
VALUES ('SkaterVan', 'Toronto International Skate Competition');

INSERT INTO Host (OrgName, EventName)
VALUES ('SkaterVan', 'Montreal International Skate Competition');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Skate to Toronto', 1, 'DJ');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Skate to Stanley park', 2, 'DJ');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Vancouver International Skate Competition', 3, 'DJ');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Skate to Toronto', 4, 'DJ');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Skate to Stanley park', 4, 'DJ');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Toronto International Skate Competition', 4, 'DJ');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Vancouver International Skate Competition', 4, 'DJ');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Montreal International Skate Competition', 4, 'DJ');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Montreal International Skate Competition', 5, 'Competitor');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Skate to Toronto', 5, 'Competitor');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Skate to Stanley park', 5, 'Competitor');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Toronto International Skate Competition', 5, 'Competitor');

INSERT INTO Participate (EventName, SkaterID, ParticipantRole) 
VALUES ('Vancouver International Skate Competition', 5, 'Competitor');

INSERT INTO SkateLocation (StreetAddress, City, Province, LocationDescription, Rating) 
VALUES ('1288 West Georgia', 'Calgary', 'Alberta', 'Very good place to skate, lots of skaters', 8);

INSERT INTO SkateLocation (StreetAddress, City, Province, LocationDescription, Rating) 
VALUES ('1111 Christina Road', 'Richmond', 'British Columbia', 'Bowl for surfskater', 7);

INSERT INTO SkateLocation (StreetAddress, City, Province, LocationDescription, Rating) 
VALUES ('2133 University Road', 'Vancouver', 'British Columbia', 'Parking lot at UBC,  be careful of security guards ', 8);

INSERT INTO SkateLocation (StreetAddress, City, Province, LocationDescription, Rating) 
VALUES ('1323 Univeirsity Road', 'Vancouver', 'British Columbia', 'Nice skate park', 7);

INSERT INTO SkateLocation (StreetAddress, City, Province, LocationDescription, Rating) 
VALUES ('3221 East Vancouver Road', 'Montreal', 'Quebec', 'Skate park for longboard, very original', 9);

INSERT INTO HappenedAt (EventName, StreetAddress, City, Province, EventDate) 
VALUES ('Skate to Toronto', '1288 West Georgia', 'Calgary', 'Alberta', TO_DATE('2022-01-13', 'YYYY-MM-DD'));

INSERT INTO HappenedAt (EventName, StreetAddress, City, Province, EventDate) 
VALUES ('Skate to Stanley park', '1111 Christina Road', 'Richmond', 'British Columbia', TO_DATE('2021-09-28', 'YYYY-MM-DD'));

INSERT INTO HappenedAt (EventName, StreetAddress, City, Province, EventDate) 
VALUES ('Vancouver International Skate Competition', '2133 University Road', 'Vancouver', 'British Columbia', TO_DATE('2021-12-21', 'YYYY-MM-DD'));

INSERT INTO HappenedAt (EventName, StreetAddress, City, Province, EventDate) 
VALUES ('Toronto International Skate Competition', '1323 Univeirsity Road', 'Vancouver', 'British Columbia', TO_DATE('2022-07-07', 'YYYY-MM-DD'));

INSERT INTO HappenedAt (EventName, StreetAddress, City, Province, EventDate) 
VALUES ('Montreal International Skate Competition', '3221 East Vancouver Road', 'Montreal', 'Quebec', TO_DATE('2022-06-27', 'YYYY-MM-DD'));

-- INSERT INTO HappenedAt (EventName, StreetAddress, City, Province, EventDate) VALUES ('Skate to Toronto', '1288 West Georgia', 'Calgary', 'Alberta', TO_DATE('2022-01-13', 'YYYY-MM-DD'));
-- select table_name from user_tables;
-- SELECT * FROM HappenedAt;
-- SELECT * FROM Events;
-- SELECT * FROM SkateLocation;

INSERT INTO Brands (BrandName, Website)
VALUES ('Landyatchz', 'https://landyachtz.ca/');

INSERT INTO Brands (BrandName, Website)
VALUES ('Loaded', 'https://loadedboards.com/');

INSERT INTO Brands (BrandName, Website)
VALUES ('Zenit', 'https://zenitboards.com/');

INSERT INTO Brands (BrandName, Website)
VALUES ('Arbor', 'https://www.arborcollective.com/');

INSERT INTO Brands (BrandName, Website)
VALUES ('Moonshine', 'https://www.moonshinemfg.com/');

INSERT INTO Brands (BrandName, Website)
VALUES ('Santa Cruz', 'https://santacruzskateboards.com/');

INSERT INTO Boards (ProductNum, BrandName, BoardName, Kicktail, BoardLength)
VALUES (100, 'Landyatchz', 'Butter White Oak Lines',1, 31.2);

INSERT INTO Boards (ProductNum, BrandName, BoardName, Kicktail, BoardLength)
VALUES (200, 'Loaded', 'Mata Hari', 2, 44.5);

INSERT INTO Boards (ProductNum, BrandName, BoardName, Kicktail, BoardLength)
VALUES (300, 'Zenit', 'Jig 3.0 All-Around', 2, 46);

INSERT INTO Boards (ProductNum, BrandName, BoardName, Kicktail, BoardLength)
VALUES (400, 'Arbor', 'Tyler Warren Shaper', 1, 29);

INSERT INTO Boards (ProductNum, BrandName, BoardName, Kicktail, BoardLength)
VALUES (500, 'Moonshine', 'Eclipse Firm Flex Complete', 2, 46);

INSERT INTO Boards (ProductNum, BrandName, BoardName, Kicktail, BoardLength)
VALUES (600, 'Santa Cruz', 'Asp Slither Pro', 2, 31.83);

INSERT INTO BoardType (Kicktail, BoardLength, BoardType)
VALUES (1, 31.2, 'Surfskate');

INSERT INTO BoardType (Kicktail, BoardLength, BoardType)
VALUES (2, 44.5, 'Longboard');

INSERT INTO BoardType (Kicktail, BoardLength, BoardType)
VALUES (2, 46, 'Longboard');

INSERT INTO BoardType (Kicktail, BoardLength, BoardType)
VALUES (1, 29, 'Surfskate');

INSERT INTO BoardType (Kicktail, BoardLength, BoardType)
VALUES (2, 46.5, 'Longboard');

INSERT INTO BoardType (Kicktail, BoardLength, BoardType)
VALUES (2, 31.83, 'Skateboard');

INSERT INTO Owns (SkaterID, BoardRating, BrandName, ProductNum)
VALUES (1, 3, 'Landyatchz', 100);

INSERT INTO Owns (SkaterID, BoardRating, BrandName, ProductNum)
VALUES (2, 6, 'Loaded',200);

INSERT INTO Owns (SkaterID, BoardRating, BrandName, ProductNum)
VALUES (3, 7, 'Zenit', 300);

INSERT INTO Owns (SkaterID, BoardRating, BrandName, ProductNum)
VALUES (4, 1, 'Arbor', 400);

INSERT INTO Owns (SkaterID, BoardRating, BrandName, ProductNum)
VALUES (5, 9, 'Moonshine',  500);

INSERT INTO Sell (BrandName, ProductNum, Phone, Price)
VALUES ('Landyatchz', 100, '1647123123', 287);

INSERT INTO Sell (BrandName, ProductNum, Phone, Price)
VALUES ('Loaded', 200, '1416234234', 300);

INSERT INTO Sell (BrandName, ProductNum, Phone, Price)
VALUES ('Zenit', 300, '1203123123', 258);

INSERT INTO Sell (BrandName, ProductNum, Phone, Price)
VALUES ('Arbor', 400, '1234567890', 372);

INSERT INTO Sell (BrandName, ProductNum, Phone, Price)
VALUES ('Moonshine', 500, '1876543210', 200);