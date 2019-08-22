const express = require('express');
const app = express();
require('dotenv').config();
const bodyParser = require('body-parser');
const cookieSession = require('cookie-session');
const router = express.Router();
const indexRoutes = require('./Router/IndexRouter');
const userRoutes = require('./Router/UserRouter');
const vehicleRoutes = require('./Router/VehicleRouter');
const stripe = require('./Router/Stripe')
const cors = require('cors');
const publicRoot = '../Front/vue-project/dist';
const corsOptions = {
    origin: '*',
    optionsSuccessStatus: 200,
};

app.use(cors(corsOptions));
app.use(express.static(publicRoot));
app.use('/uploads', express.static('uploads'));
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
    res.setHeader('Access-Control-Allow-Origin', 'http://localhost:8081');

  // Request methods you wish to allow
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');

  // Request headers you wish to allow
  res.setHeader('Access-Control-Allow-Headers', 'Access-Control-Allow-Headers, Origin, Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers,X-Access-Token,XKey,Authorization');

  res.header('Access-Control-Allow-Credentials', true);

  // Pass to next layer of middleware
  next()
});

router.get("/", (req, res, next) => {
    res.sendFile('index.html', { root: publicRoot });
});

app.use('/', userRoutes, vehicleRoutes, stripe);

const PORT = process.env.PORT || 3000;

app.listen(PORT, ()=> {
    console.log(`Node app is running on port: ${PORT}`);
});

module.exports = app;
