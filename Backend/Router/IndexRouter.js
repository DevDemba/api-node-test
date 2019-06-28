const express = require('express');
const router = express.Router();

router.get("/", (req, res, next) => {
    res.sendFile("index.html", { root: publicRoot })
});

router.get('/', (req, res, next) => {
    return res.sendFile("index.html", { error: true, message: 'hello world', root: publicRoot })
});
