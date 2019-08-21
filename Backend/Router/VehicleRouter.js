const express = require('express');
const router = express.Router();
const dbConn = require('../database/db').dbConn;
const jwt = require('jsonwebtoken');
const multerConfig = require("./config/multer");
const config = require('./config');

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
      vehicle =  [
          req.body.image,
          req.body.marque,
          req.body.serial_number,
          req.body.color,
          req.body.nb_plate,
          req.body.nb_kilometer,
          req.body.purchase_date,
          req.body.price
      ]; 
    console.log(vehicle)
    dbConn.query('INSERT INTO vehicles (image, marque, serial_number, color, nb_plate, nb_kilometer, purchase_date, price) VALUES (?,?,?,?,?,?,?,?)', vehicle,

    (err, user) => {
        if (err) return res.status(500).send("There was a problem registering the vehicles.")
            let token = jwt.sign({ id: user.id }, config.secret, { expiresIn: 86400 // expires in 24 hours
            });
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

//  Delete vehicle
router.delete('/api/vehicle', (req, res) => {

    let vehicle_id = req.body.vehicle_id

    console.log(vehicle_id)

    if (!vehicle_id) {
        return res.status(400).send({ error: true, message: 'Please provide vehicle_id' });
    }
    dbConn.query('DELETE FROM vehicles WHERE id_vehicle = ?', [vehicle_id], function (error, results, fields) {
        if (error) throw error;
        return res.send({ error: false, data: results, message: 'Delete has been updated successfully.' });
    });
}); 


router.post('/api/upload', multerConfig.saveToUploads, (req, res) => {
    return res.json("file uploaded successfully");
})

module.exports = router;
