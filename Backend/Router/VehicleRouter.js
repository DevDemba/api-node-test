const express = require('express');
const router = express.Router();
const dbConn = require('../database/db').dbConn;
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');

const authMiddleware = (req, res, next) => {
    if (!req.isAuthenticated()) {
        res.status(401).send('You are not authenticated');
    } else {
        return next();
    }
};


// Retrieve all vehicles
router.get('/api/vehicle', (req, res) => {
    dbConn.query('SELECT * FROM vehicles', function (error, results, fields) {
        if (error) throw error;
        return res.json({ error: false, data: results, message: 'vehicles list.' });
    });
});


router.post('/api/vehicle', (req, res) => {
    vehicle = [
        req.body.marque,
        req.body.serial_number,
        req.body.color,
        req.body.nb_plate,
        req.body.nb_kilometer,
        req.body.purchase_date,
        req.body.price
    ];

    dbConn.query('INSERT INTO vehicles (marque, serial_number, color, nb_plate, nb_kilometer, purchase_date, price) VALUES (?,?,?,?,?,?,?)', vehicle,

        (err) => {
            if (err) return res.status(500).send("There was a problem registering the vehicles.")
            res.status(200).send({ auth: true, token: token, user: user });
        });
});

// Retrieve vehicle with id 
router.get('/api/vehicle/:id', (req, res) => {

    let vehicle_id = req.params.id;

    if (!vehicle_id) {
        return res.status(400).send({ error: true, message: 'Please provide vehicle_id' });
    }

    dbConn.query('SELECT * FROM vehicles where id_vehicle = ?', vehicle_id, function (error, results, fields) {
        if (error) throw error;
        return res.json({ error: false, data: results[0], message: 'vehicle list.' });
    });

});

module.exports = router;