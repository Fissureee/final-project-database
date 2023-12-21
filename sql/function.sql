CREATE FUNCTION dbo.CalculateBookingPrice (@BookingID INT)
RETURNS INT
AS
BEGIN
    DECLARE @BookingStartDate DATE;
    DECLARE @BookingEndDate DATE;
    DECLARE @PricePerDay INT;
    DECLARE @TotalDays INT;

    -- Fetch booking details
    SELECT @BookingStartDate = BookingDate, @BookingEndDate = EndBooking, @PricePerDay = PricePerDay
    FROM Bookings
    JOIN Venues ON Bookings.VenueID = Venues.VenueID
    WHERE BookingID = @BookingID;

    -- Calculate the duration in days
    SET @TotalDays = DATEDIFF(DAY, @BookingStartDate, @BookingEndDate) + 1;

    -- Calculate the total price
    DECLARE @TotalPrice INT;
    SET @TotalPrice = @TotalDays * @PricePerDay;

    RETURN @TotalPrice;
END;

CREATE FUNCTION dbo.CalculateTotalBookingPrice ()
RETURNS INT
AS
BEGIN
    DECLARE @TotalPrice INT;
    DECLARE @BookingID INT;
    
    -- Cursor to iterate over each booking
    DECLARE bookingCursor CURSOR FOR
    SELECT BookingID
    FROM Bookings;
    
    -- Variables to store booking details
    DECLARE @BookingStartDate DATE;
    DECLARE @BookingEndDate DATE;
    DECLARE @PricePerDay INT;
    DECLARE @TotalDays INT;

    SET @TotalPrice = 0; -- Initialize total price
    
    OPEN bookingCursor;
    
    FETCH NEXT FROM bookingCursor INTO @BookingID;

    WHILE @@FETCH_STATUS = 0
    BEGIN
        -- Fetch booking details
        SELECT @BookingStartDate = BookingDate, @BookingEndDate = EndBooking, @PricePerDay = PricePerDay
        FROM Bookings
        JOIN Venues ON Bookings.VenueID = Venues.VenueID
        WHERE BookingID = @BookingID;

        -- Calculate the duration in days
        SET @TotalDays = DATEDIFF(DAY, @BookingStartDate, @BookingEndDate) + 1;

        -- Calculate the total price for the current booking and add it to the overall total
        SET @TotalPrice = @TotalPrice + (@TotalDays * @PricePerDay);

        FETCH NEXT FROM bookingCursor INTO @BookingID;
    END;

    CLOSE bookingCursor;
    DEALLOCATE bookingCursor;

    RETURN @TotalPrice;
END;
