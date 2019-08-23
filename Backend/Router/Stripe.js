const express = require('express');
require('dotenv').config();
const router = express.Router();
const dbConn = require('../database/db').dbConn;
const jwt = require('jsonwebtoken');
const config = require('./config');

const keyPublishable = process.env.PUBLISHABLE_KEY;
const keySecret = process.env.SECRET_KEY;
const stripe = require('stripe')(keySecret);

router.get('/stripe', (req, res) => {
    res.json({keyPublishable})
 
});


router.post('/api/charge', (req, res) => {
        let amount = req.body.amount * 100;
        stripe.customers.create({
            email: req.body.email,
        })
        .then(customer => {
            return stripe.customers.createSource(customer.id, {
                source: req.body.token,
    
            })
            .then(source => {
                return stripe.charges.create({
                    amount: amount,
                    description: "charge",
                    currency: "eur",
                    customer: source.customer,
                })
            })
        })
   
 /*    dbConn.query('INSERT INTO cart () VALUES (?,?,?,?,?,?,?,?)', cart,

        (err, user) => {
            if (err) return res.status(500).send("There was a problem payment of your cart.")
            let token = jwt.sign({ id: user.id }, config.secret, {
                expiresIn: 86400 // expires in 24 hours
            });
            res.status(200).send({ auth: true, token: token, user: user });
        }); */
});

module.exports = router;