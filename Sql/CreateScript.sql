-- Database is created with the name "Memberadministration".
CREATE DATABASE IF NOT EXISTS Memberadministration;

-- Database is selected to create new tables.
USE Memberadministration;

-- Table "Families" is created, every family has there own unique id number, Family name add Adress. Every family member is displayed with a FOREIGN KEY
CREATE TABLE IF NOT EXISTS Families (
    FamId int AUTO_INCREMENT PRIMARY KEY,
    Famname varchar(100) NOT NULL,
    Adress varchar(100),                                            -- Street and house number
    City varchar(100),                                              
    Postcode varchar(100),                                          -- 0000 AA
    Country varchar(100)                                            -- The Netherlands (Nederland)
);

-- Table "MemberType" is created, MemberType is to sort out the different members to calculate the 
CREATE TABLE IF NOT EXISTS MemberType (
    MemTypId int AUTO_INCREMENT PRIMARY KEY,                        -- MemTypId refers to the type of member 
    Description varchar (100),                                      -- Description about the member and what kind of memberschip they have (1=Youth, 2=Aspirant, 3=Junior, 4=Senior, 5=Older)
    DiscountPercentage int
);

-- Table "FamMember" is created, every person in a family is a own fammember 
CREATE TABLE IF NOT EXISTS FamMember (
    FamMemId int AUTO_INCREMENT PRIMARY KEY,
    Name varchar (100) NOT NULL,                                    -- Name of family member
    DateOfBirth DATE,                                               -- Format YYYY-MM-DD
    MemDes varchar (100),                                           -- Member discription
    FamId int,                                                      -- Refers to familie name 
    MemTypId int,                                                   -- Refers to the type of member based on the age
    CONSTRAINT FK_FamId FOREIGN KEY (FamId) REFERENCES Families (FamId),
    CONSTRAINT FK_MemTypId FOREIGN KEY (MemTypId) REFERENCES MemberType (MemTypId)
);

CREATE TABLE IF NOT EXISTS BookingYear (
    BookYearId int AUTO_INCREMENT PRIMARY KEY,                      -- The id of the year
    Year YEAR                                                       -- The booking year
);

-- Table "Contribution" is created, Contribution determines with amoount the members have to pay.
CREATE TABLE IF NOT EXISTS Contribution (
    ConId int AUTO_INCREMENT PRIMARY KEY,                           -- Id number of contribution
    Age int,                                                        -- The age of the person paying the contribution, The age is calculated from the current year and the birthyear of the person
    ConAmount DECIMAL(10,2),                                        -- The amount of money the person has to pay
    FamMemId int,                                                   -- The FamMemId to checks wich members pays what amount
    MemTypId int,                                                   -- The type of member the person is
    BookYearId int,                                                 -- The year the contribution is for 
    CONSTRAINT FK_FamMemId FOREIGN KEY (FamMemId) REFERENCES FamMember (FamMemId),
    CONSTRAINT FK_Con_MemTypId FOREIGN KEY (MemTypId) REFERENCES MemberType (MemTypId),
    CONSTRAINT FK_BookYearId FOREIGN KEY (BookYearId) REFERENCES BookingYear (BookYearId)
);

-- Tabel "LoginData"
CREATE TABLE IF NOT EXISTS LoginUsers (
    UserId  int AUTO_INCREMENT PRIMARY KEY,                         -- Id number of the user account
    Username varchar(100),
    Role varchar(100),
    Password varchar(100)
);

-- The different families are created with there own values, two families have grantparentsliving on differend adresses
INSERT INTO Families (Famname, Adress, City, Postcode, Country)
VALUES  ('Heskes', 'Hazelaar 11', 'Naaldwijk', '2671 PC', 'Nederland'),
        ('Patel', 'Vlotlaan 8', 'Monster', '2681 RX', 'Nederland'),
        ('De Vries', 'Grote Achterweg 19', 'Naaldwijk', '2671 LR ', 'Nederland'),
        ('Van den Berg', 'Kerkstraat 7', 'Naaldwijk', '2671 HC', 'Nederland'),
        ('Bakker', 'Veilingweg 14', 'Honserlersdijk', '2675 BR', 'Nederland'),
        ('El Amrani', 'Bloementuin 6', 'Naaldwijk', '2672 DW', 'Nederland');

-- The membertypes have a given values of discount percentage
INSERT INTO MemberType (Description, DiscountPercentage)
VALUES  ('Youth', '50'),
        ('Aspirant', '40'),
        ('Junior', '25'),
        ('Senior', '0'),
        ('Older', '45');

-- For the appllication we have the differend booking years from 2024 till 2026
INSERT INTO BookingYear (Year)
VALUES  ('2024'),
        ('2025'),
        ('2026');

-- FamMember and Contribution are filled later because they need other tables to work.        
INSERT INTO FamMember (FamId, MemTypId, Name, DateOfBirth, MemDes)
VALUES  -- Fam "Heskes"
        ('1', '4', 'Kaj', '1996-02-10', 'Vader'),
        ('1', '4', 'Denise', '1995-08-23', 'Moeder'),
        ('1', '1', 'Charlie', '2025-05-02', 'Dochter'),

        -- Fam Patel
        ('2', '4', 'Raj', '1979-03-23', 'Vader'),
        ('2', '4', 'Priya', '1981-05-07', 'Moeder'),
        ('2', '4', 'Ananya', '2006-09-15', 'Dochter'),
        ('2', '3', 'Nisha', '2009-04-30', 'Dochter'),

        -- Fam De Vries
        ('3', '5', 'Willen', '1948-05-03', 'Opa'),
        ('3', '5', 'Corrie', '1950-09-19', 'Oma'),

        -- Van den Berg
        ('4', '5', 'Gerrit', '1945-02-14', 'Opa'),
        ('4', '5', 'Ria', '1947-06-08', 'Oma'),

        -- Bakker
        ('5', '4', 'Joost', '1990-04-12', 'Vader'),
        ('5', '4', 'Melissa', '1992-08-03', 'Moeder'),
        ('5', '2', 'Thijs', '2018-01-27', 'Zoon'),

        -- El Amrani
        ('6', '4', 'Youssef', '1988-09-18', 'Vader'),
        ('6', '4', 'Fatima', '1991-02-05', 'Moeder'),
        ('6', '2', 'Imane', '2016-06-22', 'Dochter'),
        ('6', '1', 'Karim', '2019-11-10', 'Zoon');


-- Testdata is added, contribution will be done bij PHP
INSERT INTO Contribution (FamMemId, MemTypId, BookYearId, Age, ConAmount)
VALUES  ('1', '4', '2', '29', '100.00'),
        ('2', '4', '2', '29', '100.00'),
        ('3', '1', '2', '0', '50.00'),
        ('1', '4', '3', '30', '100.00'),
        ('2', '4', '3', '30', '100.00'),
        ('3', '1', '3', '1', '50.00'),

        ('4', '4', '2', '47', '100.00'),
        ('5', '4', '2', '45', '100.00'),
        ('6', '4', '2', '20', '100.00'),
        ('7', '3', '2', '17', '75.00'),
        ('4', '4', '3', '47', '100.00'),
        ('5', '4', '3', '45', '100.00'),
        ('6', '4', '3', '20', '100.00'),
        ('7', '4', '3', '17', '75.00');

-- Test data for three account to test the login function. The passwords are hashed, to test the application you can find the passwords in the README.MD
INSERT INTO LoginUsers (Username, Role, Password)
VALUES  ('Admin', 'admin', '$2y$10$OEy6s3CBpXY0j9Efpez8YOFmQBvAHh08dnDHpIYs252X9cCytnmo.'),
        ('Secretaris', 'secretaris', '$2y$10$hQTRC/Mb3HCcMdAWoZ.5lu6bTIISRS99/vKAZ.M87PVzD5farzQQ2'),
        ('Penningmeester', 'penningmeester', '$2y$10$CUrSeWO37hfD1kfUuf40nOo2LVU9vjFeMXxlzQ8GoJEGoQCmjvR.q');

