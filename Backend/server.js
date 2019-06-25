const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const mysql = require('mysql');

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
    extended:true
}));

app.use((req, res, next)=>{
    
   // Website you wish to allow to connect
  res.setHeader('Access-Control-Allow-Origin', '*');

  // Request methods you wish to allow
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');

  // Request headers you wish to allow
  res.setHeader('Access-Control-Allow-Headers', 'Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers,X-Access-Token,XKey,Authorization');

//  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");

  // Pass to next layer of middleware
  next()
})

app.get('/', (req, res)=> {
    return res.send({ error: true, message: 'hello world' })
});

// connection configurations
 var dbConn = mysql.createConnection({
     host: 'localhost',
     user: 'root',
     password: 'root',
     database: 'e-motion'
 });

 // connect to database
 dbConn.connect(); 

 // Retrieve all users 
 app.get('/users', (req, res)=> {
     dbConn.query('SELECT * FROM users', function (error, results, fields) {
         if (error) throw error;
         return res.json({ error: false, data: results, message: 'users list.'});
     });
 });
 
// Retrieve user with id 
app.get('/user/:id', (req, res)=> {
  
    let user_id = req.params.id;
  
    if (!user_id) {
        return res.status(400).send({ error: true, message: 'Please provide user_id' });
    }
  
    dbConnect.query('SELECT * FROM users where id=?', user_id, function (error, results, fields) {
        if (error) throw error;
        return res.json({ error: false, data: results[0], message: 'users list.' });
    });
  
});


// Add a new user  
app.post('/user', (req, res) => {
  
    let user = req.body.user;
  
    if (!user) {
        return res.status(400).send({ error:true, message: 'Please provide user' });
    }
  
    dbConn.query("INSERT INTO users SET ? ", { user: user }, function (error, results, fields) {
        if (error) throw error;
        return res.send({ error: false, data: results, message: 'New user has been created successfully.' });
    });
});
 
 
//  Update user with id
app.put('/user', (req, res) => {
  
    let user_id = req.body.user_id;
    let user = req.body.user;
  
    if (!user_id || !user) {
        return res.status(400).send({ error: user, message: 'Please provide user and user_id' });
    }
  
    dbConn.query("UPDATE users SET user = ? WHERE id = ?", [user, user_id], function (error, results, fields) {
        if (error) throw error;
        return res.send({ error: false, data: results, message: 'user has been updated successfully.' });
    });
});
 
 
//  Delete user
app.delete('/user', (req, res) => {
  
    let user_id = req.body.user_id;
  
    if (!user_id) {
        return res.status(400).send({ error: true, message: 'Please provide user_id' });
    }
    dbConn.query('DELETE FROM users WHERE id = ?', [user_id], function (error, results, fields) {
        if (error) throw error;
        return res.send({ error: false, data: results, message: 'User has been updated successfully.' });
    });
}); 

app.listen(3000, ()=> {
    console.log('Node app is running on port 3000')
});

module.exports = app;