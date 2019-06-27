const express = require('express');
const app = express();
require('dotenv').config()
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const bodyParser = require('body-parser');
const cookieSession = require('cookie-session');
const passport = require('passport');
// getting the local authentication type
const LocalStrategy = require('passport-local').Strategy

const mysql = require('mysql');

const router = express.Router();

const HOST = process.env.HOST;
const MYSQL_USER = process.env.MYSQL_USER;
const MYSQL_PASSWORD = process.env.MYSQL_PASSWORD;
const DATABASE = process.env.DATABASE;

const authMiddleware = (req, res, next) => {
  if (!req.isAuthenticated()) {
    res.status(401).send('You are not authenticated');
  } else {
    return next()
  }
}

// connection configurations
const dbConn = mysql.createConnection({
     host: HOST,
     user: MYSQL_USER,
     password: MYSQL_PASSWORD,
     database: DATABASE
 });

const publicRoot = '../Front/vue-project/dist'


app.use(express.static(publicRoot));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
    extended:true
}));

app.use(cookieSession({
    name: 'mysession',
    keys: ['vueauthrandomkey'],
    maxAge: 24 * 60 * 60 * 1000 // 24 hours
}));

app.use(passport.initialize());
app.use(passport.session());

let users = [
  {
    id: 1,
    name: "admin",
    email: "admin@gmail.com",
    password: "admin"
  },
  {
    id: 2,
    name: "demba",
    email: "emma@email.com",
    password: "password2"
  }
] 

/*
let users ;


function test () {
    dbConn.query('SELECT * FROM users', function (error, results, fields) {
        if (error) throw error;
        return res.json({ error: false, data: results,  });
    })
}

test()
*/ 



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
});

app.get("/", (req, res, next) => {
  res.sendFile("index.html", { root: publicRoot })
});

app.get('/', (req, res, next)=> {
    return res.sendFile("index.html", { error: true, message: 'hello world', root: publicRoot })
});


 // connect to database
 dbConn.connect(); 

 app.post("/api/login", (req, res, next) => {

    /*dbConn.query('SELECT * FROM users WHERE email = ?', function (err, user) {
        if (err) return res.status(500).send('Error on the server.');
        if (!user) return res.status(404).send('No user found.');
        let passwordIsValid = bcrypt.compareSync(req.body.password, user.user_pass);
        if (!passwordIsValid) return res.status(401).send({ auth: false, token: null });

        let token = jwt.sign({ id: user.id }, config.secret, { expiresIn: 86400 // expires in 24 hours
        });
        res.status(200).send({ auth: true, token: token, user: user });
        
    }); */
    
    passport.authenticate("local", (err, user, info) => {
    if (err) {
      return next(err);
    }

    if (!user) {
      return res.status(400).send([user, "Cannot log in", info]);
    }

    req.login(user, err => {
      res.send("Logged in");
    });
  })(req, res, next); 
});


app.get("/api/logout", function(req, res) {
  req.logout();

  console.log("logged out")

  return res.send();
});

router.post('/api/register', function(req, res) {
    dbConn.query('INSERT INTO users (firstname, email, password) VALUES(?,?,?)', [
        req.body.name,
        req.body.email,
        bcrypt.hashSync(req.body.password, 8)
    ],
    function (err) {
        if (err) return res.status(500).send("There was a problem registering the user.")
        dbConn.query('SELECT * FROM user WHERE email = ?', req.body.email, (err,user) => {
            if (err) return res.status(500).send("There was a problem getting user")
            let token = jwt.sign({ id: user.id }, config.secret, { expiresIn: 86400 // expires in 24 hours
            });
            res.status(200).send({ auth: true, token: token, user: user });
        }); 
    }); 
});

router.post('/register-admin', function(req, res) {
    dbConn.query('INSERT INTO users (firstname,email,is_admin) VALUES (?,?,?,?)', [
        req.body.name,
        req.body.email,
        bcrypt.hashSync(req.body.password, 8),
        1
    ],
    function (err) {
        if (err) return res.status(500).send("There was a problem registering the user.")
        dbConn.selectByEmail(req.body.email, (err,user) => {
            if (err) return res.status(500).send("There was a problem getting user")
            let token = jwt.sign({ id: user.id }, config.secret, { expiresIn: 86400 // expires in 24 hours
            });
            res.status(200).send({ auth: true, token: token, user: user });
        }); 
    }); 
});


app.get("/api/user", authMiddleware, (req, res) => {
  let user = users.find(user => {
    return user.id === req.session.passport.user
  });

  console.log([user, req.session])

  res.send({ user: user })
});


 // Retrieve all users 
 app.get('/api/users', (req, res) => {
     dbConn.query('SELECT * FROM users', function (error, results, fields) {
         if (error) throw error;
         return res.json({ error: false, data: results, message: 'users list.'});
     });
 });
 
// Retrieve user with id 
app.get('/api/user/:id', (req, res)=> {
  
    let user_id = req.params.id;
  
    if (!user_id) {
        return res.status(400).send({ error: true, message: 'Please provide user_id' });
    }
  
    dbConn.query('SELECT * FROM users where id=?', user_id, function (error, results, fields) {
        if (error) throw error;
        return res.json({ error: false, data: results[0], message: 'users list.' });
    });
  
});


// Add a new user  
app.post('/api/user', (req, res) => {
  
    let user = req.body.user;
  
    if (!user) {
        return res.status(400).send({ error:true, message: 'Please provide user' });
    }
  
    dbConn.query("INSERT INTO users SET ? ", { user: user }, function (error, results, fields) {
        if (error) throw error;
        return res.json({ error: false, data: results, message: 'New user has been created successfully.' });
    });
});
 
 
//  Update user with id
app.put('/api/user', (req, res) => {
  
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
app.delete('/api/user', (req, res) => {
  
    let user_id = req.body.user_id;
  
    if (!user_id) {
        return res.status(400).send({ error: true, message: 'Please provide user_id' });
    }
    dbConn.query('DELETE FROM users WHERE id = ?', [user_id], function (error, results, fields) {
        if (error) throw error;
        return res.send({ error: false, data: results, message: 'User has been updated successfully.' });
    });
}); 

passport.use(
  new LocalStrategy(
    {
      usernameField: "email",
      passwordField: "password"
    },

    (username, password, done) => {
      let user = users.find((user) => {
        return user.email === username && user.password === password
      })

      if (user) {
        done(null, user)
      } else {
        done(null, false, { message: 'Incorrect username or password'})
      }
    }
  )
);

passport.serializeUser((user, done) => {
  done(null, user.id)
});

passport.deserializeUser((id, done) => {
  let user = users.find((user) => {
    return user.id === id
  })

  done(null, user)
});

app.use(router);

const PORT = process.env.PORT || 3000;

app.listen(PORT, ()=> {
    console.log(`Node app is running on port: ${PORT}`)
});

module.exports = app;