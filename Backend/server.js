const express = require('express');
const app = express();
require('dotenv').config()
const bodyParser = require('body-parser');
const cookieSession = require('cookie-session');
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

const PORT = process.env.PORT || 3000;

app.listen(PORT, ()=> {
    console.log(`Node app is running on port: ${PORT}`)
});

module.exports = app;