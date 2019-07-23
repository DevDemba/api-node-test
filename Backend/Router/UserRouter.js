const express = require('express');
const router = express.Router();
const dbConn = require('../database/db').dbConn;
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
// getting the local authentication type
const passport = require('passport');
const LocalStrategy = require('passport-local').Strategy;
const authMiddleware = (req, res, next) => {
  if (!req.isAuthenticated()) {
    res.status(401).send('You are not authenticated');
  } else {
    return next()
  }
}

const config = require('./config');


let users = [
  {
    id: 1,
    name: 'admin',
    email: 'admin@gmail.com',
    password: 'admin'
  },
  {
    id: 2,
    name: "emma",
    email: "emma@gmail.com",
    password: "password2"
  }
];


 // connect to database
 dbConn.connect(); 

router.use(passport.initialize());
router.use(passport.session());

// Retrieve all users 
router.get('/api/users', (req, res) => {
    dbConn.query('SELECT * FROM users', function (error, results, fields) {
        if (error) throw error;
        return res.json({ error: false, data: results, message: 'users list.'});
    });
});

/*router.post("/api/login", (req, res, next) => {

    dbConn.query('SELECT * FROM users WHERE email = ?', [req.body.email], function (err, user) {
        if (err) return res.status(500).send('Error on the server.');
        if (!user) return res.status(404).send('No user found.');
        let passwordIsValid = bcrypt.compareSync(req.body.password, user.user_password, hash);
        if (!passwordIsValid) return res.status(401).send({ auth: false, token: null });

       // let token = jwt.sign({ id: user.id }, config.secret, { expiresIn: 86400 // expires in 24 hours
        });
        res.status(200).send({ auth: true, token: token, user: user });
        
    }); 
    
   /* passport.authenticate("local", (err, user, info) => {
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
});*/


router.post('/api/login', (req, res, next) => {

   /* passport.authenticate("local", (err, user, info) => {
        if (err) {
        return next(err);
        }

        if (!user) {
        return res.status(400).send([user, "Cannot log in", info]);
        }

        req.login(user, err => {
        res.send("Logged in");
        });
    })(req, res, next); */
    user = [req.body.email, req.body.password];

    dbConn.query(`SELECT * FROM users WHERE email = ?`, user, 
    
    (err, user) => {
        if (err) return res.status(500).send('Error on the server.');
        if (!user) return res.status(404).send('No user found.');
        let passwordIsValid = bcrypt.compareSync(req.body.password, user.password);
        if (!passwordIsValid) return res.status(401).send({ auth: false, token: null });
        let token = jwt.sign({ id: user.id }, config.secret, { expiresIn: 86400 // expires in 24 hours
        });
        res.status(200).send({ auth: true, token: token, user: user });
    });

});

router.get("/api/logout", function(req, res) {
  req.logout();

  console.log("logged out");

  return res.send();
});

router.post('/api/register', function(req, res) {
    user =  [
        req.body.gender,
        req.body.lastname,
        req.body.firstname,
        req.body.birthday,
        req.body.address,
        req.body.phone,
        req.body.license_driver,
        req.body.email,
        bcrypt.hashSync(req.body.password, 8)
    ];
    
    dbConn.query(`INSERT INTO users (gender, lastname, firstname, birthday, address, phone, license_driver, email, password) VALUES (?,?,?,?,?,?,?,?,?)`, user,

    (err, results) => {
        if (err) return res.status(500).send("There was a problem registering the user.");
        dbConn.query('SELECT * FROM users WHERE email = ?', req.body.email, (err, user) => {
            if (err) return res.status(500).send("There was a problem getting user");
            let token = jwt.sign({ id: user.id }, config.secret, { expiresIn: 86400 // expires in 24 hours
            });
            res.status(200).send({ auth: true, token: token, user: user });
        }); 
    });
});

router.post('/register-admin', function(req, res) {
    dbConn.query('INSERT INTO users (firstname,email,is_admin) VALUES (?,?,?,?)', [
        req.body.firstname,
        req.body.email,
        bcrypt.hashSync(req.body.password, 8),
        1
    ],
    function (err) {
        if (err) return res.status(500).send("There was a problem registering the user.");
        dbConn.query('SELECT * FROM users WHERE email = ?', req.body.email, (err,user) => {
            if (err) return res.status(500).send("There was a problem getting user");
            let token = jwt.sign({ id: user.id }, config.secret, { expiresIn: 86400 // expires in 24 hours
            });
            res.status(200).send({ auth: true, token: token, user: user });
        }); 
    }); 
});


router.get("/api/user", authMiddleware, (req, res) => {
  let user = users.find(user => {
    return user.id === req.session.passport.user
  });

  console.log([user, req.session]);

  res.send({ user: user })
});


// Retrieve user with id 
router.get('/api/user/:id', (req, res)=> {
  
    let user_id = req.params.id;
  
    if (!user_id) {
        return res.status(400).send({ error: true, message: 'Please provide user_id' });
    }
  
    dbConn.query('SELECT * FROM users where id = ?', user_id, function (error, results, fields) {
        if (error) throw error;
        return res.json({ error: false, data: results[0], message: 'users list.' });
    });
  
});


// Add a new user  
router.post('/api/user', (req, res) => {
  
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
router.put('/api/user', (req, res) => {
  
    let user_id = req.body.user_id;
    let user = req.body.user;
  
    if (!user_id || !user) {
        return res.status(400).send({ error: user, message: 'Please provide user and user_id' });
    }
  
    dbConn.query('UPDATE users SET user = ? WHERE id = ?', [user, user_id], function (error, results, fields) {
        if (error) throw error;
        return res.send({ error: false, data: results, message: 'user has been updated successfully.' });
    });
});
 
 
//  Delete user
router.delete('/api/user', (req, res) => {
  
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
      usernameField: 'email',
      passwordField: 'password'
    },

    (username, password, done) => {
      let user = users.find((user) => {
        return user.email === username && user.password === password
      });

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
  });

  done(null, user)
});

 module.exports = router;
