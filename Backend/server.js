const express = require('express');
const app = express();
require('dotenv').config()
const bodyParser = require('body-parser');
const cookieSession = require('cookie-session');

// getting the local authentication type
const passport = require('passport');
const LocalStrategy = require('passport-local').Strategy

const router = express.Router();

const indexRoutes = require('./Router/IndexRouter');
const userRoutes = require('./Router/UserRouter');

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
    name: "emma",
    email: "emma@gmail.com",
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

router.get("/", (req, res, next) => {
    res.sendFile("index.html", { root: publicRoot })
});


app.use('/', userRoutes);


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


const PORT = process.env.PORT || 3000;

app.listen(PORT, ()=> {
    console.log(`Node app is running on port: ${PORT}`)
});

module.exports = app;