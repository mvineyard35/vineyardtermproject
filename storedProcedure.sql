# Change the default delimiter so you can use ; in the SQL statement 
DELIMITER //
CREATE PROCEDURE getStudentList( )
BEGIN
    SELECT * FROM student ORDER BY student_name;
END //
/* put the delimiter back to default */
DELIMITER ;