CREATE DATABASE EventVenue
GO
USE EventVenue;

CREATE TABLE Users (
  UserID INT PRIMARY KEY IDENTITY(1,1),
  UserName VARCHAR(255) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  UserRole VARCHAR(20) NOT NULL CHECK (UserRole IN ('admin', 'organizer')),
  FirstName VARCHAR(255),
  LastName VARCHAR(255),
  Email VARCHAR(255),
  PhoneNumber VARCHAR(20)
);

CREATE TABLE Venues (
  VenueID INT PRIMARY KEY IDENTITY(1,1),
  VenueName VARCHAR(255) NOT NULL,
  Location VARCHAR(255) NOT NULL,
  Capacity INT NOT NULL,
  Amenities TEXT,
  PricePerDay INT NOT NULL
);

CREATE TABLE Bookings (
  BookingID INT PRIMARY KEY IDENTITY(1,1),
  VenueID INT,
  UserID INT,
  BookingDate DATE NOT NULL,
  EndBooking DATE NOT NULL,
  FOREIGN KEY (VenueID) REFERENCES Venues(VenueID),
  FOREIGN KEY (UserID) REFERENCES Users(UserID)
);


-- Dummy data for Users table
INSERT INTO Users (UserName, Password, UserRole, FirstName, LastName, Email, PhoneNumber)
VALUES
  ('john_doe', 'password123', 'admin', 'John', 'Doe', 'john.doe@example.com', '123-456-7890'),
  ('organizer_jane_smith', 'pass456', 'organizer', 'Jane', 'Smith', 'jane.smith@example.com', '987-654-3210'),
  ('organizer_alice_jones', 'qwerty', 'organizer', 'Alice', 'Jones', 'alice.jones@example.com', '555-123-4567'),
  ('organizer_michael_jackson', 'kingofpop', 'organizer', 'Michael', 'Jackson', 'michael.jackson@example.com', '123-555-7890'),
  ('admin_emily_white', 'password567', 'admin', 'Emily', 'White', 'emily.white@example.com', '876-543-2109'),
  ('organizer_charlie_brown', 'peanuts123', 'organizer', 'Charlie', 'Brown', 'charlie.brown@example.com', '456-789-0123'),
  ('organizer_olivia_taylor', 'secret789', 'organizer', 'Olivia', 'Taylor', 'olivia.taylor@example.com', '111-222-3333'),
  ('organizer_david_miller', 'miller123', 'organizer', 'David', 'Miller', 'david.miller@example.com', '999-888-7777'),
  ('admin_sophia_roberts', 'sophie456', 'admin', 'Sophia', 'Roberts', 'sophia.roberts@example.com', '777-666-5555'),
  ('organizer_ryan_anderson', 'ryan789', 'organizer', 'Ryan', 'Anderson', 'ryan.anderson@example.com', '444-333-2222'),
  ('organizer_zoey_harrison', 'zoey123', 'organizer', 'Zoey', 'Harrison', 'zoey.harrison@example.com', '666-555-4444'),
  ('organizer_brandon_wilson', 'brandon456', 'organizer', 'Brandon', 'Wilson', 'brandon.wilson@example.com', '222-333-4444'),
  ('admin_emma_smith', 'emma789', 'admin', 'Emma', 'Smith', 'emma.smith@example.com', '555-444-3333'),
  ('organizer_luke_jackson', 'luke123', 'organizer', 'Luke', 'Jackson', 'luke.jackson@example.com', '111-222-3333'),
  ('organizer_aubrey_miller', 'aubrey456', 'organizer', 'Aubrey', 'Miller', 'aubrey.miller@example.com', '777-888-9999'),
  ('zack', 'org123', 'organizer', 'Zack', 'Miller', 'zack.miller@example.com', '777-333-9999'),
  ('lee', 'adm123', 'admin', 'Lee', 'Miller', 'lee.miller@example.com', '777-888-4444');

-- Dummy data for Venues table
INSERT INTO Venues (VenueName, Location, Capacity, Amenities, PricePerDay)
VALUES
  ('Grand Hall', 'Downtown', 200, 'Projector, Stage, Lighting', 1500000),
  ('Crystal Palace', 'Uptown', 500, 'Stage, Lighting, Sound system', 3000000),
  ('Community Center', 'Suburb', 100, 'Kitchen, Outdoor space', 500000),
  ('The Summit', 'City Center', 300, 'Projector, Sound system, Rooftop terrace', 2000000),
  ('Pine Grove Park', 'Outskirts', 150, 'Outdoor space, Picnic area', 800000),
  ('City View Ballroom', 'Downtown', 250, 'Panoramic view, Projector', 1800000),
  ('Lakeside Pavilion', 'Lakeside', 120, 'Outdoor space, Lakeside view', 1000000),
  ('Maple Mansion', 'Suburb', 180, 'Garden, Indoor pool, Theater', 2500000),
  ('Skyline Loft', 'Downtown', 150, 'City view, Rooftop terrace, Bar', 2000000),
  ('The Oasis', 'Desert', 100, 'Sand dunes, Camel rides, Starry nights', 1200000),
  ('Evergreen Hall', 'Forest', 120, 'Forest view, Fireplace, Nature trails', 800000),
  ('Oceanfront Pavilion', 'Coast', 200, 'Ocean view, Beach access', 3000000),
  ('Golden Gate Hall', 'City Center', 300, 'Golden Gate view, Modern design', 2500000),
  ('Mountain Retreat', 'Mountains', 80, 'Mountain view, Skiing, Fireplace', 1200000),
  ('Riverside Plaza', 'Riverside', 120, 'River view, Garden, Amphitheater', 1000000);

-- Dummy data for Bookings table
INSERT INTO Bookings (VenueID, UserID, BookingDate, EndBooking)
VALUES
  (1, 2, '2023-12-15', '2023-12-16'),
  (2, 3, '2023-12-20', '2023-12-22'),
  (3, 1, '2023-12-25', '2023-12-27'),
  (4, 4, '2023-12-18', '2023-12-20'),
  (5, 5, '2023-12-10', '2023-12-11'),
  (6, 6, '2023-12-28', '2023-12-30'),
  (7, 7, '2023-12-05', '2023-12-07'),
  (8, 8, '2023-12-12', '2023-12-13'),
  (9, 9, '2023-12-08', '2023-12-10'),
  (10, 10, '2023-12-22', '2023-12-24'),
  (11, 11, '2023-12-02', '2023-12-04'),
  (12, 12, '2023-12-30', '2023-12-31'),
  (13, 13, '2023-12-14', '2023-12-15'),
  (14, 14, '2023-12-17', '2023-12-19'),
  (15, 15, '2023-12-26', '2023-12-28');

--show all the data in the tables
SELECT * FROM Users;
SELECT * FROM Venues;
SELECT * FROM Bookings;

--drop all the table to reset 
DROP TABLE IF EXISTS Bookings;
DROP TABLE IF EXISTS Venues;
DROP TABLE IF EXISTS Users;

