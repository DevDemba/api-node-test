const mysql = require('mysql');

const HOST = process.env.HOST;
const MYSQL_USER = process.env.MYSQL_USER;
const MYSQL_PASSWORD = process.env.MYSQL_PASSWORD;
const DATABASE = process.env.DATABASE;

// connection configurations
const connection = { 
    dbConn: mysql.createConnection({
    host: HOST,
    user: MYSQL_USER,
    password: MYSQL_PASSWORD,
    database: DATABASE
})
}
 
module.exports = connection;

