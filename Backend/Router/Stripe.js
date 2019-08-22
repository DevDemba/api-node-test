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
        let amount = 500;

        stripe.customers.create({
            email: req.body.stripeEmail,
            source: req.body.stripeToken
        })
        .then(customer => {
            stripe.charges.create({
                amount,
                description: "charge",
                currency: "euros",
                customer: customer.id
            })
            .then(charge => res.render('charge'))
        })
   
 /*    dbConn.query('INSERT INTO payments () VALUES (?,?,?,?,?,?,?,?)', cart,

        (err, user) => {
            if (err) return res.status(500).send("There was a problem payment of your cart.")
            let token = jwt.sign({ id: user.id }, config.secret, {
                expiresIn: 86400 // expires in 24 hours
            });
            res.status(200).send({ auth: true, token: token, user: user });
        }); */
});

module.exports = router;