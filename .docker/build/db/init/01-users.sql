CREATE USER 'brisingr_app'@'localhost' IDENTIFIED BY 'XLToALmdxZ';
GRANT ALL PRIVILEGES ON *.* TO 'brisingr_app'@'localhost' WITH GRANT OPTION;

CREATE USER 'brisingr_app'@'%' IDENTIFIED BY 'XLToALmdxZ';
GRANT ALL PRIVILEGES ON *.* TO 'brisingr_app'@'%' WITH GRANT OPTION;