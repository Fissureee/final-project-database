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
